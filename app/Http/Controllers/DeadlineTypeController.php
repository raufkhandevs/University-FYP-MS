<?php

namespace App\Http\Controllers;

use App\Models\DeadlineType;
use App\Http\Requests\StoreDeadlineTypeRequest;
use App\Http\Requests\UpdateDeadlineTypeRequest;

class DeadlineTypeController extends Controller
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
     * @param  \App\Http\Requests\StoreDeadlineTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeadlineTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeadlineType  $deadlineType
     * @return \Illuminate\Http\Response
     */
    public function show(DeadlineType $deadlineType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeadlineType  $deadlineType
     * @return \Illuminate\Http\Response
     */
    public function edit(DeadlineType $deadlineType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDeadlineTypeRequest  $request
     * @param  \App\Models\DeadlineType  $deadlineType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeadlineTypeRequest $request, DeadlineType $deadlineType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeadlineType  $deadlineType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeadlineType $deadlineType)
    {
        //
    }
}
