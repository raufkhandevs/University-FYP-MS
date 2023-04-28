@extends('layouts.master')

@section('meta', 'Roles')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('faculty.students.index') }}">Students</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Students</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">

                    <div class="x_title">
                        <h2> Student View: {{ $student->user->name }}</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">


                        <div id="step-1">

                            <div class="form-horizontal form-label-left">

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name
                                        <span class="required text-danger">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled type="text" name="name" value="{{ $student->user->name }}"
                                            id="name" class="form-control ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Phone
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled type="text" id="phone" value="{{ $student->user->phone }}"
                                            name="phone" class="form-control ">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <div id="gender" class="btn-group" data-toggle="buttons">
                                            @if ($student->user->gender == 'male')
                                                <label class="btn btn-secondary" data-toggle-class="btn-primary"
                                                    data-toggle-passive-class="btn-secondary">
                                                    <input type="radio"
                                                        {{ $student->user->gender == 'male' ? 'checked' : '' }}
                                                        name="gender" value="male" class="join-btn"> &nbsp; Male
                                                    &nbsp;
                                                </label>
                                            @elseif ($student->user->gender == 'female')
                                                <label class="btn btn-primary" data-toggle-class="btn-primary"
                                                    data-toggle-passive-class="btn-secondary">
                                                    <input type="radio"
                                                        {{ $student->user->gender == 'female' ? 'checked' : '' }}
                                                        name="gender" value="female" class="join-btn"> Female
                                                </label>
                                            @else
                                                <label class="btn btn-primary" data-toggle-class="btn-primary"
                                                    data-toggle-passive-class="btn-secondary">
                                                    <input type="radio"
                                                        {{ $student->user->gender == 'female' ? 'checked' : '' }}
                                                        name="gender" value="female" class="join-btn"> Not Specified
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Date Of Birth

                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="birthday" class="date-picker form-control" placeholder="mm-dd-yyyy"
                                            type="text" disabled />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">City
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled id="city" class=" form-control"
                                            value="{{ $student->user->city }}" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">State
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled id="state" class=" form-control"
                                            value="{{ $student->user->state }}" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Country
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled id="country" class=" form-control"
                                            value="{{ $student->user->country }}" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Avatar
                                    </label>
                                    <div class="col-md-6 col-sm-6 custom-file">
                                        <div>
                                            @if ($student->user->avatar)
                                                <img width="90px"
                                                    src="{{ asset('assets/images/avatar/default-avatar.png') }}"
                                                    alt="Image">
                                            @else
                                                <span>No Image Uploaded</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if ($student->user->avatar)
                                    <div>
                                        <img width="80px"
                                            src="{{ asset('assets/images/avatar/' . $student->user->avatar) }}"
                                            alt="Image" />
                                    </div>
                                @endif

                            </div>

                        </div>
                        <div id="step-2">
                            <div class="form-horizontal form-label-left">

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="roll_number">Roll
                                        Number <span class="required text-danger">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled type="text" value="{{ $student->roll_number }}"
                                            name="roll_number" id="roll_number" class="form-control ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="semester">Semester
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled type="number" value="{{ $student->semester }}" id="semester"
                                            name="semester" class="form-control ">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Alumni</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <div id="alimni" class="btn-group" data-toggle="buttons">
                                            @if ($student->is_alumni == '1')
                                                <label class="btn btn-secondary" data-toggle-class="btn-primary"
                                                    data-toggle-passive-class="btn-secondary">
                                                    <input type="radio"
                                                        {{ $student->is_alumni == '1' ? 'checked' : '' }} name="is_alumni"
                                                        value="1" class="join-btn"> &nbsp; Yes
                                                    &nbsp;
                                                </label>
                                            @else
                                                <label class="btn btn-primary" data-toggle-class="btn-primary"
                                                    data-toggle-passive-class="btn-secondary">
                                                    <input type="radio"
                                                        {{ $student->is_alumni == '0' ? 'checked' : '' }} name="is_alumni"
                                                        value="0" class="join-btn"> No
                                                </label>
                                            @endif


                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Credit Hours
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled id="credit_hours" value="{{ $student->credit_hours }}"
                                            name="credit_hours" class=" form-control" type="number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Quality Points
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled id="quality_points" value="{{ $student->quality_points }}"
                                            name="quality_points" class=" form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">CGPA
                                        <span class="required text-danger">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled id="cgpa" value="{{ $student->cgpa }}"
                                            class=" form-control" name="cgpa" type="text">
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div id="step-3">
                            <div class="form-horizontal form-label-left">

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Department
                                        <span class="required text-danger">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled id="cgpa" value="{{ $student->department->name }}"
                                            class=" form-control" name="cgpa" type="text">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div id="step-4">
                            <div class="form-horizontal form-label-left">

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Session
                                        <span class="required text-danger">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled id="cgpa" value="{{ $student->sessions->session_name }}"
                                            class=" form-control" name="cgpa" type="text">
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
