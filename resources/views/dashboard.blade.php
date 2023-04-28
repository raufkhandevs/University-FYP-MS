@extends('layouts.master')

@section('meta', 'Dashboard')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Dashboard</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Welcome</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-group"></i></div>
                                <div class="count">{{ $groupMembers ?? 0 }}</div>
                                <h3>Members</h3>
                                <p>Your FYP group members</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-comments-o"></i></div>
                                <div class="count">{{ $totalMeetings ?? 0 }}</div>
                                <h3>Meetings</h3>
                                <p>Total scheduled and upcoming meetings</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-check-square-o"></i></div>
                                <div class="count">{{ $totalSubmissions ?? '0' }}</div>
                                <h3>Submissions </h3>
                                <p>This includes all your FYP chapaters submissions. </p>
                            </div>
                        </div>

                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                                <div class="count">{{ $finalGrade ?? 'N/A' }}</div>
                                <h3>Final Grade</h3>
                                <p>Your grade after final defense.</p>
                            </div>
                        </div>


                    </div>

                </div>
                <div class="conatiner {{ $progress == 100 ? 'd-none-' : '' }} my-5 p-2">
                    <h4>Registration Process: {{ $progress }}%</h4>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped" role="progressbar"
                            style="width: {{ $progress }}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                    <div class="alert alert-light d-flex justify-content-between align-items-center">
                        <span>
                            @if ($progress == '100')
                                <i class="text-success"> You have succesfully completed the FYP Registraton process.</i>
                            @else
                                <i class="text-danger"> You haven't completed the FYP registration process.</i>
                            @endif

                        </span>
                        <span>
                            @if ($progress == 0)
                                Click here <a href="{{ route('registration.create') }}"
                                    class="btn btn-primary ml-3">Continue</a>
                            @elseif($progress == 33)
                                Click here <a href="{{ route('project.allocation.create') }}"
                                    class="btn btn-primary ml-3">Continue</a>
                            @elseif($progress == 66)
                                <a href="javascript:void(0)" class="btn btn-dark ml-3">Project Allocation Pending</a>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
