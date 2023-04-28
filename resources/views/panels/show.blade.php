@extends('layouts.master')

@section('meta', 'Panel Show')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('faculty.panels.index') }}">Panels</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Panels </h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">

                <div class="x_panel">
                    <div class="x_title">
                        <h2>Panel Details: {{ $panel->name }}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @foreach ($panel->facultyMembers as $key => $facultyMembers)
                            <div class="col-md-4 col-sm-4  profile_details">
                                <div class="well profile_view">
                                    <div class="col-sm-12">
                                        <h4 class="brief"><b
                                                class="btn-success">{{ $facultyMembers->department->name }}</b></h4>
                                        <div class="left col-sm-7">
                                            <h2 class="fw-bold">Name: {{ $facultyMembers->user->name }}</h2>
                                            <p><strong>Designation: </strong> {{ $facultyMembers->designation }} </p>
                                            <ul class="list-unstyled">
                                                <li><i class="fa fa-building"></i> Email: {{ $facultyMembers->user->email }}
                                                </li>
                                                <li><i class="fa fa-phone"></i> Phone #: {{ $facultyMembers->user->phone }}
                                                </li>
                                                <li><i class="fa fa-building"></i> Working Status #:
                                                    {{ $facultyMembers->working_status == '1' ? 'Active' : 'Inactive' }}
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="right col-sm-5 text-center">
                                            <img src="{{ asset('assets\images\avatar\default-avatar.png') }}" width="100%"
                                                alt="" class="img-circle img-fluid">
                                        </div>
                                    </div>
                                    <div class=" bottom text-center">
                                        <div class=" col-sm-6 emphasis">
                                            <p class="ratings">
                                                <a>4.0</a>
                                                <a href="#"><span class="fa fa-star"></span></a>
                                                <a href="#"><span class="fa fa-star"></span></a>
                                                <a href="#"><span class="fa fa-star"></span></a>
                                                <a href="#"><span class="fa fa-star"></span></a>
                                                <a href="#"><span class="fa fa-star-o"></span></a>
                                            </p>
                                        </div>
                                        <div class=" col-sm-6 emphasis">
                                            <button type="button" class="btn btn-success btn-sm"> <i class="fa fa-user">
                                                </i> <i class="fa fa-comments-o"></i> </button>
                                            <button type="button" class="btn btn-primary btn-sm">
                                                <i class="fa fa-user"> </i> View Profile
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
