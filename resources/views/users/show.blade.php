@extends('layouts.master')

@section('meta', 'Users Show')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('faculty.users.index') }}">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Users</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">

                    <div class="x_title">
                        <h2> User View: {{ $user->name }}</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">


                        <div id="step-1">

                            <div class="form-horizontal form-label-left">

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="role">Role
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled type="text" name="role" value="{{ $user->roles[0]->name }}"
                                            id="name" class="form-control ">
                                    </div>
                                </div>
                               
                                 <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled type="text" name="name" value="{{ $user->name }}"
                                            id="name" class="form-control ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Email
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled type="email" name="email" value="{{ $user->email }}"
                                            id="name" class="form-control ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Phone
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled type="text" id="phone" value="{{ $user->phone }}"
                                            name="phone" class="form-control ">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <div id="gender" class="btn-group" data-toggle="buttons">
                                            @if ($user->gender == 'male')
                                                <label class="btn btn-secondary" data-toggle-class="btn-primary"
                                                    data-toggle-passive-class="btn-secondary">
                                                    <input type="radio"
                                                        {{ $user->gender == 'male' ? 'checked' : '' }}
                                                        name="gender" value="male" class="join-btn"> &nbsp; Male
                                                    &nbsp;
                                                </label>
                                            @elseif ($user->gender == 'female')
                                                <label class="btn btn-primary" data-toggle-class="btn-primary"
                                                    data-toggle-passive-class="btn-secondary">
                                                    <input type="radio"
                                                        {{ $user->gender == 'female' ? 'checked' : '' }}
                                                        name="gender" value="female" class="join-btn"> Female
                                                </label>
                                            @else
                                                <label class="btn btn-primary" data-toggle-class="btn-primary"
                                                    data-toggle-passive-class="btn-secondary">
                                                    <input type="radio"
                                                        {{ $user->gender == 'female' ? 'checked' : '' }}
                                                        name="gender" value="female" class="join-btn"> Not Specified
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Department 
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled type="text" id="phone" value="{{ $user->faculty->department->name ?? 'N/A' }}"
                                            name="phone" class="form-control ">
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">City
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled id="city" class=" form-control"
                                            value="{{ $user->city }}" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">State
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled id="state" class=" form-control"
                                            value="{{ $user->state }}" type="text">
                                    </div>
                                </div>
                              
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Country
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled id="country" class=" form-control"
                                            value="{{ $user->country }}" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Designation 
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input disabled id="country" class=" form-control"
                                            value="{{ $user->faculty->designation ?? 'N/A' }}" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Avatar
                                    </label>
                                    <div class="col-md-6 col-sm-6 custom-file">
                                        <div>
                                            @if ($user->avatar)
                                                <img width="90px"
                                                    src="{{ asset('assets/images/avatar/default-avatar.png') }}"
                                                    alt="Image">
                                            @else
                                                <span>No Image Uploaded</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if ($user->avatar)
                                    <div>
                                        <img width="80px"
                                            src="{{ asset('assets/images/avatar/' . $student->user->avatar) }}"
                                            alt="Image" />
                                    </div>
                                @endif

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
