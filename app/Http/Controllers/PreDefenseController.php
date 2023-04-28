<?php

namespace App\Http\Controllers;

use App\Models\PreDefense;
use App\Http\Requests\StorePreDefenseRequest;
use App\Http\Requests\UpdatePreDefenseRequest;
use App\Models\Defense;
use App\Models\DefenseType;
use App\Models\Faculty;
use App\Models\Panel;
use App\Models\Project;
use App\Models\ProjectAllocation;
use Illuminate\Http\Request;

class PreDefenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pre-defenses.index', [
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePreDefenseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePreDefenseRequest $request)
    {
        $defense = Defense::where('panel_id', $request->panel_id)
            ->where('project_id', $request->project_id)
            ->where('defense_type_id', $request->defense_type_id)
            ->first();

        if (!$defense) {
            return redirect()->route('faculty.pre-defenses.index')->with('warning_message', "Can't find any related pre-defense");
        } elseif ($defense->preDefense) {
            return redirect()->route('faculty.pre-defenses.index')->with('warning_message', "Pre defense already took place");
        }

        $allocation = ProjectAllocation::where('project_id', $defense->project->id)->first();

        return view('pre-defenses.create', [
            'defense' => $defense,
            'allocation' => $allocation,
        ]);
    }

    public function evaluate(Request $request, Defense $defense)
    {
        $this->validate($request, [
            'students' => 'required|array',
        ]);

        $faculty = Faculty::where('user_id', auth()->user()->id)->first();

        foreach ($request->students as $key => $student) {
            PreDefense::updateOrCreate([
                'defense_id' => $defense->id,
                'faculty_id' => $faculty->id,
                'student_id' => $student['id'],
            ], [
                'reviews' => $student['review'],
                'status' => $student['status'],
            ]);
        }

        return redirect()->route('faculty.defenses.index')
            ->with('success_message', 'Pre Defense evaluated Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PreDefense  $preDefense
     * @return \Illuminate\Http\Response
     */
    public function show(PreDefense $preDefense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PreDefense  $preDefense
     * @return \Illuminate\Http\Response
     */
    public function edit(PreDefense $preDefense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePreDefenseRequest  $request
     * @param  \App\Models\PreDefense  $preDefense
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePreDefenseRequest $request, PreDefense $preDefense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PreDefense  $preDefense
     * @return \Illuminate\Http\Response
     */
    public function destroy(PreDefense $preDefense)
    {
        //
    }
}
