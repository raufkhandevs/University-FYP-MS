<?php

namespace App\Http\Controllers;

use App\Models\FinalGrade;
use App\Http\Requests\StoreFinalGradeRequest;
use App\Http\Requests\UpdateFinalGradeRequest;
use App\Models\Defense;
use App\Models\DefenseType;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Project;
use App\Models\Student;

class FinalGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::with('project')->whereHas('project', function ($query) {
            return $query->where('in_progress', '0');
        })->get();

        return view('final-grades.index', [
            'groups' => $groups,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFianlGradeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFinalGradeRequest $request)
    {
        $group = Group::find($request->group_id);
        $project = Project::find($group->project->id);
        $type = DefenseType::where('name', DefenseType::DEFENSE_TYPE_FINAL)->first();
        $defense = Defense::where('project_id', $project->id)
            ->where('defense_type_id', $type->id)->first();

        $studentData = $defense->finalGradeStudents->groupBy('student_id');
        $studentIds = [];

        foreach ($studentData as $key => $singleStudent) {
            $total = $singleStudent->count() * 50;
            $marks = 0;
            $obtained = 0;
            $obtained_percentage = 0;
            $studentId = null;

            foreach ($singleStudent as $grade) {
                $marks += $grade->total;
                $studentId = $grade->student_id;
            }

            $studentIds[] = $studentId;

            $obtained = $marks / $total;
            $obtained_percentage = $obtained * 100;

            // find grade 
            $grade = Grade::where('upper_range_for_100', '>=', round($obtained_percentage))
                ->where('lower_range_for_100', '<=', round($obtained_percentage))->first();

            // mark final grade for single student
            FinalGrade::create([
                'student_id' => $studentId,
                'project_id' => $project->id,
                'marks' => $obtained_percentage,
                'grade' => $grade->grade,
            ]);
        }

        $data = [];

        foreach (Student::whereIn('id', $studentIds)->get() as $student) {
            $student->update(['is_alumni', '1']);
            $data[] = [
                'name' => $student->user->name,
                'roll_number' => $student->roll_number,
                'marks' => $student->finalGrade->marks,
                'grade' => $student->finalGrade->grade,
            ];
        }

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FianlGrade  $fianlGrade
     * @return \Illuminate\Http\Response
     */
    public function show(FinalGrade $fianlGrade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FianlGrade  $fianlGrade
     * @return \Illuminate\Http\Response
     */
    public function edit(FinalGrade $fianlGrade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFianlGradeRequest  $request
     * @param  \App\Models\FianlGrade  $fianlGrade
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFinalGradeRequest $request, FinalGrade $fianlGrade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FianlGrade  $fianlGrade
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinalGrade $fianlGrade)
    {
        //
    }
}
