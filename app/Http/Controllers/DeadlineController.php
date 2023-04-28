<?php

namespace App\Http\Controllers;

use App\Models\Deadline;
use App\Http\Requests\StoreDeadlineRequest;
use App\Http\Requests\UpdateDeadlineRequest;

class DeadlineController extends Controller
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
     * @param  \App\Http\Requests\StoreDeadlineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeadlineRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deadline  $deadline
     * @return \Illuminate\Http\Response
     */
    public function show(Deadline $deadline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deadline  $deadline
     * @return \Illuminate\Http\Response
     */
    public function edit(Deadline $deadline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDeadlineRequest  $request
     * @param  \App\Models\Deadline  $deadline
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeadlineRequest $request, Deadline $deadline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deadline  $deadline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deadline $deadline)
    {
        //
    }
}
