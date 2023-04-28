@extends('layouts.master')

@section('meta', 'Submission')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Submission</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Submission</h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage Submission</h2>
                        @can('create_submissions')
                            <a href="{{ route('faculty.submissions.create') }}" class="btn btn-primary float-right">Create</a>
                        @endcan

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (count($submissions))
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Project</th>
                                        <th>Type</th>
                                        <th>File</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($submissions as $key => $submission)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td>{{ $submission->project->name ?? 'N/A' }}</td>
                                            <td>{{ $submission->submissionType->name ?? 'N/A' }}</td>
                                            <td>
                                                <a href="{{ route('faculty.submissions.download', $submission->id) }}"
                                                    style="text-decoration: underline; color: rgb(0, 0, 168);">
                                                    {{ $submission->file }}
                                                </a>
                                            </td>
                                            <td>
                                                {{-- @can('view_submissions')
                                                    <a class="btn text-success py-0"
                                                        href="{{ route('faculty.submission-s.show', $submission->id) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan --}}
                                                {{-- @can('update_submissions')
                                                    <a class="btn text-info py-0"
                                                        href="{{ route('faculty.submissions.edit', $submission->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan --}}
                                                @can('delete_submissions')
                                                    <a class="btn text-danger py-0"
                                                        href="{{ route('faculty.submissions.destroy', $submission->id) }}">
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
