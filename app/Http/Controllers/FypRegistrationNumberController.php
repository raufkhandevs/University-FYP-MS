<?php

namespace App\Http\Controllers;

use App\Models\FypRegistrationNumber;
use App\Http\Requests\StoreFypRegistrationNumberRequest;
use App\Http\Requests\UpdateFypRegistrationNumberRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FypRegistrationNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->page == 'history') {
            $fypRegistrations = FypRegistrationNumber::where('approved_by', '!=', null)
                ->orWhere('is_rejected', '1')
                ->get();
            $buttonText = 'Back';
        } else {
            $fypRegistrations = FypRegistrationNumber::where('approved_by', null)
                ->where('is_rejected', '0')
                ->get();
            $buttonText = 'History';
        }

        return view('registrations.index', [
            'fypRegistrations' => $fypRegistrations,
            'buttonText' => $buttonText,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registrationCreate()
    {
        $user = User::find(auth()->user()->id);
        $student = Student::where('user_id', $user->id)->first();
        $fypRegistration = FypRegistrationNumber::where('student_id', $student->id)->first();
        return view('registrations.registration-form', [
            'user' => $user,
            'student' => $student,
            'fypRegistration' => $fypRegistration
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFypRegistrationNumberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function registrationStore(StoreFypRegistrationNumberRequest $request)
    {
        $student = Student::find($request->student_id);

        if (!isset($student)) {
            return back()->with('error_message', 'something went wrong');
        }

        $imageName = '';
        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = 'fyp-image-' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/fyp-students-imgs/'), $imageName);
        }

        if ($request->has('registration_id') && $request->registration_id != '') {
            $fypRegistration = FypRegistrationNumber::find($request->registration_id);

            $path = public_path('assets/images/fyp-students-imgs/' . $fypRegistration->image);
            if (File::exists($path)) {
                File::delete($path);
            }

            $fypRegistration->update([
                'registration_date' => now(),
                'personal_email' => $request->personal_email,
                'passed_subjects' => $request->passed_subjects,
                'current_residential' => $request->current_residential,
                'permanent_address' => $request->permanent_address,
                'image' => $request->has('image') ? $imageName : null,
                'fyp_student_agreement' => $request->agreement == 'on' ? 1 : 0,
                'is_rejected' => 0,
                'rejected_by' => null,
            ]);

            return back()->with('success_message', 'Request Successfully Sent');
        }


        $fypNumber = 'FYP' . now()->format('y') . '-' . $student->sessions->starting->format('y') . '-' . substr($student->roll_number, 2);


        FypRegistrationNumber::create([
            'student_id' => $student->id,
            'registration_number' => $fypNumber,
            'registration_date' => now(),
            'personal_email' => $request->personal_email,
            'passed_subjects' => $request->passed_subjects,
            'current_residential' => $request->current_residential,
            'permanent_address' => $request->permanent_address,
            'image' => $request->has('image') ? $imageName : null,
            'fyp_student_agreement' => $request->agreement == 'on' ? 1 : 0,
        ]);

        $student->update([
            'progress_level' => '33',
        ]);

        return back()->with('success_message', 'Request Successfully Sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FypRegistrationNumber  $fypRegistrationNumber
     * @return \Illuminate\Http\Response
     */
    public function show(FypRegistrationNumber $fypRegistrationNumber)
    {
        return view('registrations.show', [
            'fypRegistration' => $fypRegistrationNumber,
            'student' => Student::find($fypRegistrationNumber->student_id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FypRegistrationNumber  $fypRegistrationNumber
     * @return \Illuminate\Http\Response
     */
    public function edit(FypRegistrationNumber $fypRegistrationNumber)
    {
        $this->authorize('update_fypregistrationnumbers');

        if (!isset($fypRegistrationNumber)) {
            return back()->with('error_message', 'Bad Request');
        }

        if (isset($fypRegistrationNumber->approved_by)) {
            return back()->with('error_message', 'Request Already Approved');
        }

        $fypRegistrationNumber->update([
            'is_approved' => 1,
            'approved_by' => auth()->user()->id,
        ]);

        Student::find($fypRegistrationNumber->student_id)->update([
            'fyp_registration_status' => 1,
        ]);

        return back()->with('success_message', 'Request Approved Successfully');
    }

    public function editAll(Request $request)
    {
        $this->authorize('update_fypregistrationnumbers');

        if ($request->approved_all) {
            $student_ids = FypRegistrationNumber::where('approved_by', null)
                ->get()
                ->pluck('student_id')
                ->toArray();

            FypRegistrationNumber::where('approved_by', null)->update([
                'is_approved' => 1,
                'approved_by' => auth()->user()->id,
            ]);

            Student::whereIn('id', $student_ids)->update([
                'fyp_registration_status' => 1
            ]);

            return redirect()->route('faculty.fyp-registration.index')
                ->with('success_message', 'Successfully Approved all Request');
        }
        return back()->with('error_message', 'Bad Request');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFypRegistrationNumberRequest  $request
     * @param  \App\Models\FypRegistrationNumber  $fypRegistrationNumber
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFypRegistrationNumberRequest $request)
    {
        $this->authorize('update_fypregistrationnumbers');

        FypRegistrationNumber::find($request->registration_id)->update([
            'remarks' => $request->remarks
        ]);

        return back()->with('success_message', 'Remarks Added Successfully');
    }

    public function reject(FypRegistrationNumber $fypRegistrationNumber)
    {
        $this->authorize('update_fypregistrationnumbers');

        if (!isset($fypRegistrationNumber)) {
            return back()->with('error_message', 'Bad Request');
        }

        $fypRegistrationNumber->update([
            'is_rejected' => 1,
            'rejected_by' => auth()->user()->id
        ]);

        return back()->with('success_message', 'Request Rejected Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FypRegistrationNumber  $fypRegistrationNumber
     * @return \Illuminate\Http\Response
     */
    public function destroy(FypRegistrationNumber $fypRegistrationNumber)
    {
        $this->authorize('delete_fypregistrationnumbers');
    }
}
