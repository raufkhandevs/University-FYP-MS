@extends('layouts.master')

@section('meta', 'Show Fyp Registrations')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('faculty.fyp-registration.index') }}">Fyp Registration</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Fyp Registration Request</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">

                    <div class="x_title">
                        <h2> Request View: {{ $student->user->name }}
                            ({{ $student->roll_number }})</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="container">
                            <div class="row border">
                                <div class="col-6 pb-3">
                                    <h3>User Details</h3>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Name
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $student->user->name }}" name="phone"
                                                        class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Email
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $student->user->email }}" name="phone"
                                                        class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Phone
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $student->user->phone }}" name="phone"
                                                        class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Gender
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ (!isset($student->user->gender) ? 'N/A' : $student->user->gender == 'male') ? 'Male' : 'Female' }}"
                                                        name="phone" class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Status
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $student->user->status == '1' ? 'Active' : 'Not Active' }}"
                                                        name="phone" class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">City
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $student->user->city }}" name="phone"
                                                        class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">state
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $student->user->state }}" name="phone"
                                                        class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Country
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $student->user->country }}" name="phone"
                                                        class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 border pb-3">
                                    <h3>Student Details</h3>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Roll Number
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $student->roll_number }}" name="phone"
                                                        class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Semester
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $student->semester }}" name="phone"
                                                        class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Department
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $student->department->name }}" name="phone"
                                                        class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Session
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $student->sessions->session_name }}" name="phone"
                                                        class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Credit Hours
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $student->credit_hours }}" name="phone"
                                                        class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Quality Points
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $student->quality_points }}" name="phone"
                                                        class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">CGPA
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $student->cgpa }}" name="phone"
                                                        class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Is Late
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $student->is_late == '1' ? 'Yes' : 'No' }}"
                                                        name="phone" class="form-control ">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-12 border pb-3 my-4">
                                    <h3>
                                        Registration Details
                                    </h3>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">FYP Registration ID
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $fypRegistration->registration_number }}"
                                                        name="phone" class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Registration Date
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $fypRegistration->registration_date->format('d/m/Y') }}"
                                                        name="phone" class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Agreement
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $fypRegistration->fyp_student_agreement == '1' ? 'Signed' : 'Not Signed' }}"
                                                        name="phone" class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Personal Email
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $fypRegistration->personal_email }}" name="phone"
                                                        class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Passed Subjects
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $fypRegistration->passed_subjects }}" name="phone"
                                                        class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Approval
                                                </label>
                                                <div class="d-block">
                                                    <input disabled type="text" id="phone"
                                                        value="{{ $fypRegistration->is_approved == '0' ? 'Pending' : $fypRegistration->approvedBy->name }}"
                                                        name="phone" class="form-control ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Remarks
                                                </label>
                                                <div class="d-block">
                                                    <textarea disabled class="form-control" name="" id="" rows="4">{{ $fypRegistration->remarks }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">current Residential
                                                </label>
                                                <div class="d-block">
                                                    <textarea disabled class="form-control" name="" id="" rows="4">{{ $fypRegistration->current_residential }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group ">
                                                <label class="d-block" for="phone">Permanent Address
                                                </label>
                                                <div class="d-block">
                                                    <div class="d-block">
                                                        <textarea disabled class="form-control" name="" id="" rows="4">{{ $fypRegistration->permanent_address }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
