<?php

namespace App\Http\Controllers;

use App\Models\DefenseGrade;
use App\Http\Requests\StoreDefenseGradeRequest;
use App\Http\Requests\UpdateDefenseGradeRequest;

class DefenseGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreDefenseGradeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDefenseGradeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DefenseGrade  $defenseGrade
     * @return \Illuminate\Http\Response
     */
    public function show(DefenseGrade $defenseGrade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DefenseGrade  $defenseGrade
     * @return \Illuminate\Http\Response
     */
    public function edit(DefenseGrade $defenseGrade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDefenseGradeRequest  $request
     * @param  \App\Models\DefenseGrade  $defenseGrade
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDefenseGradeRequest $request, DefenseGrade $defenseGrade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DefenseGrade  $defenseGrade
     * @return \Illuminate\Http\Response
     */
    public function destroy(DefenseGrade $defenseGrade)
    {
        //
    }
}
