@extends('layouts.master')

@section('meta', 'Groups')

@section('content')
    <div class="">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Groups</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Groups</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage Groups </h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (count($groups))
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Members</th>
                                        <th>Department</th>
                                        <th>Semester</th>
                                        <th>Session</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groups as $key => $group)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $group->name }}</td>
                                            <th>
                                                <div class="container d-block">
                                                    <div class="row">
                                                        @foreach ($group->members as $member)
                                                            <div class="col-lg-3 col-md-4 col-sm-6 d-flex flex-column">
                                                                <img src="{{ asset('assets/images/avatar/user.png') }}"
                                                                    class="avatar" alt="">
                                                                <div>{{ $member->user->name }} <br>
                                                                    ({{ $member->roll_number }})
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </th>
                                            <td>{{ $group->members ? $group->members[0]->department->name : 'N/A' }}</td>
                                            <td>{{ $group->members ? $group->members[0]->semester : 'N/A' }}</td>
                                            <td>{{ $group->members ? $group->members[0]->sessions->session_name : 'N/A' }}
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <div class="p-5 d-flex justify-content-center">
                                <img src="{{ asset('assets/images/imgs/nodata.png') }}" alt="No data Found">
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
