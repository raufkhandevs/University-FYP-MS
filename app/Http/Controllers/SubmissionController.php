<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Http\Requests\StoreSubmissionRequest;
use App\Http\Requests\UpdateSubmissionRequest;
use App\Models\Project;
use App\Models\Role;
use App\Models\SubmissionType;
use Illuminate\Support\Facades\File;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole(Role::ROLE_STUDENT)) {
            $projectId = MeetupController::getProjectId();
            $submissions = Submission::where('project_id', $projectId)->get();
        } else {
            $submissions = Submission::all();
        }

        return view('submissions.index', [
            'submissions' => $submissions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();
        if (auth()->user()->isStudent()) {
            try {
                return view('submissions.create', [
                    'submissionTypes' => SubmissionType::all(),
                    'projectId' => MeetupController::getProjectId(),
                ]);
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        return view('submissions.create', [
            'submissionTypes' => SubmissionType::all(),
            'projectId' => $project,
        ]);

        return redirect()->route('faculty.submissions.index')
            ->with('warning_message', 'Only Project associated user can create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubmissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubmissionRequest $request)
    {
        $fileName = '';

        $file = $request->file('file');
        $fileName = time() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('assets/submissions/'), $fileName);

        Submission::create([
            'submission_type_id' => $request->submission_type_id,
            'project_id' => $request->project_id,
            // 'deadline_status' => $request->deadline_status,
            'file' => $fileName,
        ]);

        return redirect()->route('faculty.submissions.index')
            ->with('success_message', 'Submitted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function show(Submission $submission)
    {
        return view('submissions.show', [
            'submission' => $submission,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function edit(Submission $submission)
    {
        return view('submissions.edit', [
            'submission' => $submission,
            'submissionType' => SubmissionType::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubmissionRequest  $request
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubmissionRequest $request, Submission $submission)
    {
        if ($request->has('file')) {

            // delete existing file 
            $olfFile = public_path('assets/submissions/' . $submission->file);
            if (File::exists($olfFile)) {
                File::delete($olfFile);
            }

            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('assets/submissions/'), $fileName);
        } else {
            $fileName = $submission->file;
        }

        $submission->update([
            'submission_type_id' => $request->submission_type_id,
            'project_id' => $request->project_id,
            // 'deadline_status' => $request->deadline_status,
            'file' => $fileName,
        ]);

        return redirect()->route('faculty.submissions.index')
            ->with('success_message', 'Submitted Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Submission $submission)
    {
        $submission->forceDelete();

        return redirect()->route('faculty.submissions.index')
            ->with('success_message', 'Submitted Deleted Successfully');
    }

    public function download(Submission $submission)
    {
        $file = public_path('assets/submissions/') . $submission->file;
        return response()->download($file);
    }
}
