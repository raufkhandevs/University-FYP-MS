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
                                <div class="icon"><i class="fa fa-graduation-cap"></i></div>
                                <div class="count">{{ $totalRoles ?? 0 }}</div>
                                <h3>Roles</h3>
                                <p>Total registered Roles .</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-graduation-cap"></i></div>
                                <div class="count">{{ $totalStudents ?? 0 }}</div>
                                <h3>Total Students</h3>
                                <p>Total registered students for fyp portal.</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-users"></i></div>
                                <div class="count">{{ $totalFaculty ?? 0 }}</div>
                                <h3>Total Faculty</h3>
                                <p>Total registered faculty stuff for fyp portal.</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-cubes"></i></div>
                                <div class="count">{{ $totalPanels ?? 0 }}</div>
                                <h3>Total Panels</h3>
                                <p>Total panels for fyp portal.</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa  fa-list"></i></div>
                                <div class="count">{{ $totalProjects ?? 0 }}</div>
                                <h3>Projects</h3>
                                <p>Registered Projects.</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-comments-o"></i></div>
                                <div class="count">{{ $totalMeetings ?? 0 }}</div>
                                <h3>Meetings</h3>
                                <p>All scheduled and upcomming meetings.</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                                <div class="count">{{ $totalPendingRequests ?? 0 }}</div>
                                <h3>Pending Registrations</h3>
                                <p>FYP registration request on pending status.</p>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-check-square-o"></i></div>
                                <div class="count">{{ $totalAlumni ?? 0 }}</div>
                                <h3>Alumni Students</h3>
                                <p>Student with completed FYP project.</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
