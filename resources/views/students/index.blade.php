@extends('layouts.master')

@section('meta', 'Students')

@section('content')
    <div class="">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Students</li>
            </ol>
        </nav>

        <div class="page-title">
            <div class="title_left">
                <h3>All Students</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage Students</h2>
                        @can('create_students')
                            <a href="{{ route('faculty.students.create') }}" class="btn btn-primary float-right">Create</a>
                            <a href="{{ route('faculty.students.import.show') }}" class="btn btn-info float-right">Import</a>
                        @endcan

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (count($students))
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Roll Number</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Semester</th>
                                        <th data-sortable="false">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $key => $student)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $student->roll_number }}</td>
                                            <td>{{ $student->user->name }}</td>
                                            <td>{{ $student->department->name }}</td>
                                            <td>{{ $student->semester }}</td>
                                            <td>
                                                @can('view_students')
                                                    <a class="btn text-primary py-0"
                                                        href="{{ route('faculty.students.show', $student->id) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('update_students')
                                                    <a class="btn text-info py-0"
                                                        href="{{ route('faculty.students.edit', $student->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete_students')
                                                    <a class="btn text-danger py-0"
                                                        href="{{ route('faculty.students.destroy', $student->id) }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            {{-- {{ $students->links() }} --}}
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
