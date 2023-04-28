@extends('layouts.master')

@section('meta', 'Defense Types')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Defense Types</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Defense Types</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage Defense Types</h2>
                        @can('create_defensetypes')
                            <a href="{{ route('faculty.defense-types.create') }}" class="btn btn-primary float-right">Create</a>
                        @endcan

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (count($defenseTypes))
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
                                    @foreach ($defenseTypes as $key => $defenseType)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td>{{ $defenseType->name }}</td>
                                            <td>{{ $defenseType->about }}</td>
                                            <td>{{ $defenseType->defenses->count() ?? 0 }}</td>
                                            <td>
                                                {{-- @can('view_defensetypes')
                                                    <a class="btn text-success py-0"
                                                        href="{{ route('faculty.defense-types.show', $defenseType->id) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan --}}
                                                @can('update_defensetypes')
                                                    <a class="btn text-info py-0"
                                                        href="{{ route('faculty.defense-types.edit', $defenseType->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete_defensetypes')
                                                    <a class="btn text-danger py-0"
                                                        href="{{ route('faculty.defense-types.destroy', $defenseType->id) }}">
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
