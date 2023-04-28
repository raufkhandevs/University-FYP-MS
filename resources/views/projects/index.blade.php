@extends('layouts.master')

@section('meta', 'Projects')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Projects</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Projects</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage Projects</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (count($projects))
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Proj. Number</th>
                                        <th>Status</th>
                                        <th>Defenses</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $key => $project)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td>{{ $project->name }}</td>
                                            <td>{{ $project->project_number }}</td>
                                            <td>
                                                @if ($project->is_rejected === '1')
                                                    <button class="btn btn-danger">Rejected</button>
                                                @elseif ($project->is_approved === '1')
                                                    <button class="btn btn-success">Approved</button>
                                                @else
                                                    <button class="btn btn-secondary">Pending</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($project->defenses->count())
                                                    <div class="d-flex flex-columns">
                                                        @if ($project->finalDefense)
                                                            @if ($project->finalDefense->finalDefense)
                                                                <button class="btn btn-success">Final Defense Conducted on
                                                                    <b>{{ $project->finalDefense->finalDefense->created_at->format('d/m/Y') }}</b></button>
                                                            @else
                                                                <button class="btn btn-success">Final Defense Scheduled on
                                                                    <b>{{ $project->finalDefense->created_at->format('d/m/Y') }}</b></button>
                                                            @endif
                                                        @else
                                                            @if ($project->preDefense->preDefense)
                                                                <button class="btn btn-info">Pre Defense Conducted on
                                                                    <b>{{ $project->preDefense->preDefense->created_at->format('d/m/Y') }}</b></button>
                                                            @else
                                                                <button class="btn btn-info">Pre Defense Scheduled on
                                                                    <b>{{ $project->preDefense->created_at->format('d/m/Y') }}</b></button>
                                                            @endif
                                                        @endif
                                                    </div>
                                                @else
                                                    <button class="btn btn-secondary">Never had defense</button>
                                                @endif
                                            </td>
                                            <td>
                                                @can('view_projects')
                                                    <a class="btn text-success py-0" href="">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('update_projects')
                                                    <a class="btn text-info py-0" href="">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete_projects')
                                                    <a class="btn text-danger py-0" href="">
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
