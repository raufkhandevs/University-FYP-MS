<?php

namespace App\Http\Controllers;

use App\Models\ProjectAllocation;
use App\Http\Requests\StoreProjectAllocationRequest;
use App\Http\Requests\UpdateProjectAllocationRequest;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\FypRegistrationNumber;
use App\Models\Group;
use App\Models\Project;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectAllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->page == 'history') {
            $projectAllocations = ProjectAllocation::whereHas('project', function ($query) {
                return $query->where('is_approved', '1')->orWhere('is_rejected', '1');
            })->get();
            $buttonText = 'Back';
        } else {
            $projectAllocations = ProjectAllocation::whereHas('project', function ($query) {
                return $query->where('is_approved', '0')->where('in_progress', '1')->where('is_rejected', '0');
            })->get();
            $buttonText = 'History';
        }

        return view('projectAllocations.index', [
            'projectAllocations' => $projectAllocations,
            'buttonText' => $buttonText,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student = Student::where('user_id', auth()->user()->id)->first();

        if (!$student->group) {
            return back()->with('error_message', 'Please make a group of 3 members');
        }

        $isProjectAllocated = $student->group->project ? true : false;

        $supervisor_ids = User::role(Role::ROLE_SUPERVISOR)->get()->pluck('id')->toArray();
        $supervisors = Faculty::whereHas('department', function ($query) {
            $query->where('name', Department::COMPUTER_SCIENCE_DEPARTMENT);
        })->whereIn('user_id', $supervisor_ids)->get();

        $registeredStudent = FypRegistrationNumber::where('student_id', $student->id)
            ->where('is_approved', '1')
            ->first();

        return view('projectAllocations.create', [
            'supervisors' => $supervisors,
            'student' => $student,
            'registeredStudent' => $registeredStudent,
            'group' => $student->group,
            'isProjectAllocated' => $isProjectAllocated,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectAllocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectAllocationRequest $request)
    {
        $date = now()->format('y-m-d');
        $student = Student::find($request->student_id);
        try {
            DB::beginTransaction();

            $project = Project::create([
                'name' => $request->project_title,
                'idea' => $request->project_idea,
                'project_number' => 'CSFP' . $date, # CSFP22-04-10
            ]);

            $projectAllocation = ProjectAllocation::create([
                'group_id' => $student->group->id,
                'project_id' => $project->id,
                'supervisor_id' => $request->supervisor_id,
            ]);

            $groupMembers = $student->group->members;

            foreach ($groupMembers as $member) {
                $member->update(['progress_level' => '66']);
            }

            DB::commit();

            return redirect()->route('project.allocation.create')
                ->with('success_message', 'Project Allocation Submitted');
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()
                ->with('error_message', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectAllocation  $projectAllocation
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectAllocation $projectAllocation)
    {
        $supervisor_ids = User::role(Role::ROLE_SUPERVISOR)->get()->pluck('id')->toArray();
        $supervisors = Faculty::whereIn('user_id', $supervisor_ids)->get();

        return view('projectAllocations.show', [
            'projectAllocation' => $projectAllocation,
            'group' => Group::find($projectAllocation->group_id),
            'project' => Project::find($projectAllocation->project_id),
            'supervisors' => $supervisors,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectAllocation  $projectAllocation
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectAllocation $projectAllocation)
    {
        try {
            $projectAllocation->project->update([
                'is_approved' => '1'
            ]);

            $group = Group::find($projectAllocation->group_id);
            $this->markStudentProgress($group->members, '100');
        } catch (\Throwable $th) {
            return redirect()->route('faculty.project.allocation.index')
                ->with('error_message', 'Something Went Wrong');
        }
        return redirect()->route('faculty.project.allocation.index')
            ->with('success_message', 'Allocation Approved Successfully');
    }

    public function editAll()
    {
        $pendingProjectIds = Project::where('is_approved', '0')->get()->pluck('id')->toArray();
        $pendingAllocations = ProjectAllocation::whereIn('project_id', $pendingProjectIds)->get();

        try {
            foreach ($pendingAllocations as $projectAllocation) {
                $projectAllocation->project->update([
                    'is_approved' => '1'
                ]);
                $group = Group::find($projectAllocation->group_id);
                $this->markStudentProgress($group->members, '100');
            }
        } catch (\Throwable $th) {
            return redirect()->route('faculty.project.allocation.index')
                ->with('error_message', 'Something Went Wrong');
        }
        return redirect()->route('faculty.project.allocation.index')
            ->with('success_message', 'Allocations Approved Successfully');
    }

    public function markStudentProgress($students, $progress)
    {
        foreach ($students as $student) {
            $student->update(['progress_level' => $progress]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectAllocationRequest  $request
     * @param  \App\Models\ProjectAllocation  $projectAllocation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectAllocationRequest $request, ProjectAllocation $projectAllocation)
    {
        $update = $projectAllocation->update([
            'supervisor_id' => $request->supervisor_id,
        ]);

        return redirect()->route('faculty.project.allocation.index')
            ->with('success_message', 'Allocation Updated Successfully');
    }

    public function reject()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectAllocation  $projectAllocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectAllocation $projectAllocation)
    {
        //
    }
}
