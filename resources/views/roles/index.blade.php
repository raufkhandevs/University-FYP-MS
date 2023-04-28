@extends('layouts.master')

@section('meta', 'Roles')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Roles</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Roles</h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage Roles</h2>
                        @can('create_roles')
                            <a href="{{ route('faculty.roles.create') }}" class="btn btn-primary float-right">Create</a>
                        @endcan

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (count($roles))
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Assigned Users</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $key => $role)
                                        <tr>
                                            <td scope="row">{{ $key + 1 }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->users->count() }}</td>
                                            <td>
                                                @can('view_roles')
                                                    <a class="btn text-success py-0"
                                                        href="{{ route('faculty.roles.show', $role->id) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('update_roles')
                                                    <a class="btn text-info py-0"
                                                        href="{{ route('faculty.roles.edit', $role->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete_roles')
                                                    <a class="btn text-danger py-0" href="javascript:void(0)">
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
