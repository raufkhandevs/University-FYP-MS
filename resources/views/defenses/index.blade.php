@extends('layouts.master')

@section('meta', 'Defense')

@section('content')
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Defense</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Defense </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage Defense </h2>
                        @can('create_defenses')
                            <a href="{{ route('faculty.defenses.create') }}" class="btn btn-primary float-right">Create</a>
                        @endcan
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (count($defenses))
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Project</th>
                                        <th>FYP ID</th>
                                        <th>Panel</th>
                                        <th>Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($defenses as $key => $defense)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td>{{ $defense->project->name }}</td>
                                            <td>{{ $defense->project->project_number }}</td>
                                            <td>{{ $defense->panel->name }}</td>
                                            <td>
                                                <button
                                                    class="btn {{ $defense->defenseType->name == 'Pre Defense' ? 'btn-warning' : 'btn-info' }}">{{ $defense->defenseType->name }}</button>

                                            </td>
                                            <td>
                                                @can('view_defenses')
                                                    <a class="btn btn-primary text-light py-0"
                                                        href="{{ route('faculty.defenses.show', $defense->id) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
                                                {{-- @can('update_defenses')
                                                    <a class="btn text-info py-0" href="">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan --}}
                                                {{-- @can('delete_defenses')
                                                    <a class="btn text-danger py-0" href="">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @endcan --}}
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
