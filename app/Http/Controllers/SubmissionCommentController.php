<?php

namespace App\Http\Controllers;

use App\Models\SubmissionComment;
use App\Http\Requests\StoreSubmissionCommentRequest;
use App\Http\Requests\UpdateSubmissionCommentRequest;

class SubmissionCommentController extends Controller
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
     * @param  \App\Http\Requests\StoreSubmissionCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubmissionCommentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubmissionComment  $submissionComment
     * @return \Illuminate\Http\Response
     */
    public function show(SubmissionComment $submissionComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubmissionComment  $submissionComment
     * @return \Illuminate\Http\Response
     */
    public function edit(SubmissionComment $submissionComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubmissionCommentRequest  $request
     * @param  \App\Models\SubmissionComment  $submissionComment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubmissionCommentRequest $request, SubmissionComment $submissionComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubmissionComment  $submissionComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubmissionComment $submissionComment)
    {
        //
    }
}
