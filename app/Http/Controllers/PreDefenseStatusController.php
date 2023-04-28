<?php

namespace App\Http\Controllers;

use App\Models\PreDefenseStatus;
use App\Http\Requests\StorePreDefenseStatusRequest;
use App\Http\Requests\UpdatePreDefenseStatusRequest;

class PreDefenseStatusController extends Controller
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
     * @param  \App\Http\Requests\StorePreDefenseStatusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePreDefenseStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PreDefenseStatus  $preDefenseStatus
     * @return \Illuminate\Http\Response
     */
    public function show(PreDefenseStatus $preDefenseStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PreDefenseStatus  $preDefenseStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(PreDefenseStatus $preDefenseStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePreDefenseStatusRequest  $request
     * @param  \App\Models\PreDefenseStatus  $preDefenseStatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePreDefenseStatusRequest $request, PreDefenseStatus $preDefenseStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PreDefenseStatus  $preDefenseStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(PreDefenseStatus $preDefenseStatus)
    {
        //
    }
}
