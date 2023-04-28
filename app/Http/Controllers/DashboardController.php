<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\FinalGrade;
use App\Models\FypRegistrationNumber;
use App\Models\Meetup;
use App\Models\Panel;
use App\Models\Project;
use App\Models\ProjectAllocation;
use App\Models\Role;
use App\Models\Student;
use App\Models\Submission;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Remderable
     */
    public function dashboard()
    {
        $student = Student::where('user_id', auth()->user()->id)->first();
        $group = $student->group ? $student->group : null;

        if ($group) {
            $groupMembers = $group->members ? $group->members->count() : 0;
            $project = $group->project ? $group->project : null;
        }

        if (isset($project)) {
            $totalMeetings = Meetup::where('user_id', $student->user_id)->orWhere('project_id', $project->id)->count();
            $totalSubmissions = Submission::where('project_id', $project->id)->count();
            $finalGrade = FinalGrade::where('student_id', $student->id)->where('project_id', $project->id)->first();
        }

        return view('dashboard', [
            'progress' => $student->progress_level,
            'groupMembers' => $groupMembers ?? 0,
            'totalMeetings' => $totalMeetings ?? 0,
            'totalSubmissions' => $totalSubmissions ?? 0,
            'finalGrade' => $finalGrade ?? 0 ? $finalGrade->grade : null,
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Remderable
     */
    public function facultyDashboard()
    {
        try {
            $faculty = Faculty::where('user_id', auth()->user()->id)->first();
            $projectAllocation = ProjectAllocation::where('supervisor_id', $faculty->id)->first();
            $totalMeetings =  Meetup::where('user_id', auth()->user()->id)->orWhere('project_id', $projectAllocation->project->id)->count();
        } catch (\Throwable $th) {
            $totalMeetings = 0;
        }

        return view('faculty-dashboard', [
            'totalRoles' => Role::count(),
            'totalStudents' => Student::count(),
            'totalFaculty' => Faculty::count(),
            'totalPanels' => Panel::count(),
            'totalProjects' => Project::count(),
            'totalMeetings' => $totalMeetings ?? 0,
            'totalPendingRequests' => FypRegistrationNumber::where('is_approved', '0')->where('is_rejected', 0)->count(),
            'totalAlumni' => Student::where('is_alumni', '1')->count(),
        ]);
    }
}
