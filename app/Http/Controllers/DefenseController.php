<?php

namespace App\Http\Controllers;

use App\Models\Defense;
use App\Http\Requests\StoreDefenseRequest;
use App\Http\Requests\UpdateDefenseRequest;
use App\Models\DefenseGrade;
use App\Models\DefenseType;
use App\Models\Faculty;
use App\Models\Panel;
use App\Models\PreDefense;
use App\Models\Project;
use App\Models\ProjectAllocation;
use Illuminate\Http\Request;

class DefenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $defense = Defense::with('defenseType', 'panel', 'project')->get();

        return view('defenses.index', [
            'defenses' => $defense,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('defenses.create', [
            'defenseTypes' => DefenseType::all(),
            'panels' => Panel::all(),
            'projects' => Project::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function finalDefense()
    {
        return view('defenses.final-index', [
            'defenseTypes' => DefenseType::all(),
            'panels' => Panel::all(),
            'projects' => Project::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createFinalDefense(Request $request)
    {
        $defense = Defense::where('panel_id', $request->panel_id)
            ->where('project_id', $request->project_id)
            ->where('defense_type_id', $request->defense_type_id)
            ->first();

        if (!$defense) {
            return back()
                ->with('success_error', 'Not Defense Found');
        }

        $allocation = ProjectAllocation::where('project_id', $defense->project->id)->first();

        return view('defenses.final-create', [
            'defense' => $defense,
            'allocation' => $allocation,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDefenseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDefenseRequest $request)
    {
        $type = DefenseType::find($request->defense_type_id);
        Defense::create([
            'defense_type_id' => $request->defense_type_id,
            'project_id' =>  $request->project_id,
            'panel_id' => $request->panel_id,
            'is_final' =>  $type->name == DefenseType::DEFENSE_TYPE_FINAL ? '1' : '0',
        ]);

        return redirect()->route('faculty.defenses.index')
            ->with('success_message', 'Defense Created Successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDefenseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFinalDefense(Request $request)
    {
        $this->validate($request, [
            'studentfinal' => 'required|array',
            'defense_id' => 'required|exists:defenses,id',
        ]);

        $defense = Defense::find($request->defense_id);
        $faculty = Faculty::where('user_id', auth()->user()->id)->first();

        foreach ($request->studentfinal as $key => $student) {
            DefenseGrade::updateOrCreate([
                'defense_id' => $defense->id,
                'faculty_id' => $faculty->id,
                'student_id' => $student['student_id'],
            ], [
                'project_work' => $student['project_work'],
                'presentation' => $student['presentation'],
                'documentation' => $student['documentation'],
                'total' =>  (float)$student['project_work'] + (float)$student['presentation'] + (float)$student['documentation'],
            ]);
        }

        return redirect()->route('faculty.defenses.index')
            ->with('success_message', 'Final Defense Evaluated Successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Defense  $defense
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Defense $defense)
    {
        if (!$defense->preDefense && !$defense->finalDefenseGrades) {
            return redirect()->route('faculty.defenses.index')
                ->with("warning_message", "Defense haven't take place, no data to show");
        }
        $allocation = ProjectAllocation::where('project_id', $defense->project->id)->first();
        $editable = $request->editable ? true : false;

        return view('defenses.show', [
            'defense' => $defense,
            'allocation' => $allocation,
            'editable' => $editable,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Defense  $defense
     * @return \Illuminate\Http\Response
     */
    public function edit(Defense $defense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDefenseRequest  $request
     * @param  \App\Models\Defense  $defense
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDefenseRequest $request, Defense $defense)
    {
        $faculty = Faculty::where('user_id', auth()->user()->id)->first();

        if ($request->has('studentfinal')) {

            foreach ($request->studentfinal as $key => $student) {
                $marked = DefenseGrade::updateOrCreate([
                    'defense_id' => $defense->id,
                    'student_id' => $student['student_id'],
                ], [
                    'faculty_id' => $faculty->id,
                    'project_work' => $student['project_work'],
                    'presentation' => $student['presentation'],
                    'documentation' => $student['documentation'],
                    'total' =>  (float)$student['project_work'] + (float)$student['presentation'] + (float)$student['documentation'],
                ]);

                if ($marked) {
                    $project = Project::find($defense->project_id);
                    $project->update([
                        'in_progress' => '0',
                    ]);
                }
            }
        }


        if ($request->has('students')) {
            foreach ($request->students as $key => $student) {
                PreDefense::updateOrCreate([
                    'defense_id' => $defense->id,
                    'student_id' => $student['id'],
                ], [
                    'faculty_id' => $faculty->id,
                    'reviews' => $student['review'] ? $student['review'] : 'None',
                    'status' => $student['status'],
                ]);
            }
        }

        return redirect()->route('faculty.defenses.show', $defense->id)
            ->with('success_message', 'Updated Evaluated Successfully');
    }

    public function markAsFinalized(Defense $defense)
    {
        $grade = DefenseGrade::where('defense_id', $defense->id)->first();
        $grade->update([
            'is_finalized' => '1',
        ]);

        return redirect()->route('faculty.defenses.show', $defense->id)
            ->with('success_message', 'Marked Evaluated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Defense  $defense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Defense $defense)
    {
        //
    }
}
