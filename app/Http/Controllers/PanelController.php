<?php

namespace App\Http\Controllers;

use App\Models\Panel;
use App\Http\Requests\StorePanelRequest;
use App\Http\Requests\UpdatePanelRequest;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\PanelHasFaculty;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panels.index', [
            'panels' => Panel::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teacherIds = User::Role([
            Role::ROLE_SUPERVISOR,
            Role::ROLE_TEACHER,
            Role::ROLE_GUEST
        ])->get()->pluck('id')->toArray();

        $teachers = Faculty::whereIn('user_id', $teacherIds)->get();

        return view('panels.create', [
            'teachers' => $teachers,
            'departments' => Department::all(),
        ]);
    }

    public function getMembers(Request $request)
    {
        $this->validate($request, [
            'department_id' => 'required|exists:departments,id'
        ]);

        return response()->json([
            'status' => 200,
            'teachers' => Faculty::with('user')
                ->where('department_id', $request->department_id)
                ->get(),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePanelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePanelRequest $request)
    {
        $panel = Panel::create([
            'name' => $request->name,
            'department_id' => $request->department_id,
        ]);

        return redirect()->route('faculty.panels.index')
            ->with(
                'success_message',
                'Panel Created Successfully, You can add members now!'
            );
    }

    public function addMembers(Request $request)
    {
        $this->validate($request, [
            'panel_id' => 'required|exists:panels,id',
            'faculty_id' => 'required|exists:faculties,id'
        ]);

        $exists = PanelHasFaculty::where('faculty_id', $request->faculty_id)
            ->where('panel_id', $request->panel_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'status' => 409,
            ], 200);
        }

        PanelHasFaculty::create([
            'panel_id' => $request->panel_id,
            'faculty_id' => $request->faculty_id,
        ]);

        return response()->json([
            'status' => 201,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function show(Panel $panel)
    {
        return view('panels.show', [
            'panel' => $panel,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function edit(Panel $panel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePanelRequest  $request
     * @param  \App\Models\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePanelRequest $request, Panel $panel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Panel  $panel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Panel $panel)
    {
        return back()
            ->with(
                'warning_message',
                'Functionality Coming Soon'
            );
    }
}
