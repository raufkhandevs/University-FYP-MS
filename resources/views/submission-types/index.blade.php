@extends('layouts.master')

@section('meta', 'Submission Types')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Submission Types</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Submission Types</h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage Submission Types</h2>
                        @can('create_submissiontypes')
                            <a href="{{ route('faculty.submission-types.create') }}"
                                class="btn btn-primary float-right">Create</a>
                        @endcan

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (count($submissionTypes))
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>About</th>
                                        <th>Total Submissions</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($submissionTypes as $key => $submissionType)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td>{{ $submissionType->name }}</td>
                                            <td>{{ $submissionType->about }}</td>
                                            <td>{{ $submissionType->submissions->count() }}</td>
                                            <td>
                                                {{-- @can('view_submissiontypes')
                                                    <a class="btn text-success py-0"
                                                        href="{{ route('faculty.submission-types.show', $submissionType->id) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan --}}
                                                @can('update_submissiontypes')
                                                    <a class="btn text-info py-0"
                                                        href="{{ route('faculty.submission-types.edit', $submissionType->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete_submissiontypes')
                                                    <a class="btn text-danger py-0"
                                                        href="{{ route('faculty.submission-types.destroy', $submissionType->id) }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @endcan
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
