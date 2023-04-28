<?php

namespace App\Http\Controllers;

use App\Models\SubmissionType;
use App\Http\Requests\StoreSubmissionTypeRequest;
use App\Http\Requests\UpdateSubmissionTypeRequest;

class SubmissionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('submission-types.index', [
            'submissionTypes' => SubmissionType::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('submission-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubmissionTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubmissionTypeRequest $request)
    {
        SubmissionType::create([
            'name' => $request->name,
            'about' => $request->about,
        ]);

        return redirect()->route('faculty.submission-types.index')
            ->with('success_message', 'Submission Type created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubmissionType  $submissionType
     * @return \Illuminate\Http\Response
     */
    public function show(SubmissionType $submissionType)
    {
        return view('submission-types.show', [
            'submissionType' => $submissionType,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubmissionType  $submissionType
     * @return \Illuminate\Http\Response
     */
    public function edit(SubmissionType $submissionType)
    {
        return view('submission-types.edit', [
            'submissionType' => $submissionType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubmissionTypeRequest  $request
     * @param  \App\Models\SubmissionType  $submissionType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubmissionTypeRequest $request, SubmissionType $submissionType)
    {
        $submissionType->update([
            'name' => $request->name,
            'about' => $request->about,
        ]);

        return redirect()->route('faculty.submission-types.index')
            ->with('success_message', 'Submission Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubmissionType  $submissionType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubmissionType $submissionType)
    {
        if ($submissionType->submissions) {
            return back()
                ->with('warning_message', 'Submission Type has files Under');
        }
        $submissionType->delete();

        return redirect()->route('faculty.submission-types.index')
            ->with('success_message', 'Submission Type deleted successfully');
    }
}
