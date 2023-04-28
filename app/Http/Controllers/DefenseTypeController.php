<?php

namespace App\Http\Controllers;

use App\Models\DefenseType;
use App\Http\Requests\StoreDefenseTypeRequest;
use App\Http\Requests\UpdateDefenseTypeRequest;

class DefenseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('defense-types.index', [
            'defenseTypes' => DefenseType::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('defense-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDefenseTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDefenseTypeRequest $request)
    {
        DefenseType::create([
            'name' => $request->name,
            'about' => $request->about,
        ]);

        return redirect()->route('faculty.defense-types.index')
            ->with('success_message', 'Defense type created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DefenseType  $defenseType
     * @return \Illuminate\Http\Response
     */
    public function show(DefenseType $defenseType)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DefenseType  $defenseType
     * @return \Illuminate\Http\Response
     */
    public function edit(DefenseType $defenseType)
    {
        return view('defense-types.edit', [
            'defenseType' => $defenseType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDefenseTypeRequest  $request
     * @param  \App\Models\DefenseType  $defenseType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDefenseTypeRequest $request, DefenseType $defenseType)
    {
        $defenseType->update([
            'name' => $request->name,
            'about' => $request->about,
        ]);

        return redirect()->route('faculty.defense-types.index')
            ->with('success_message', 'Defense type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DefenseType  $defenseType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DefenseType $defenseType)
    {
        if ($defenseType->defenses->count()) {
            return redirect()->route('faculty.defense-types.index')
                ->with('warning_message', 'Defense type contains others defenses');
        }
        $defenseType->delete();

        return redirect()->route('faculty.defense-types.index')
            ->with('success_message', 'Defense type deleted successfully');
    }
}
