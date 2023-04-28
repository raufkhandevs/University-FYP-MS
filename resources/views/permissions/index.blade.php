@extends('layouts.master')

@section('meta', 'Permissions')

@section('content')
    <div class="">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Permissions</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Permissions</h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage Permissions</h2>
                        @can('create_permissions')
                            <a href="javascript:void(0)" class="btn btn-primary float-right">Create</a>
                        @endcan

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (count($permissions))
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Assigned Roles</th>
                                        <th>Roles</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($permissions as $key => $permission)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $permission->title }}</td>
                                            <td>{{ $permission->roles->count() }}</td>
                                            <td>

                                                <div class="container d-block">
                                                    <div class="row">
                                                        @foreach ($permission->roles as $role)
                                                            <div class="col-lg-3 col-md-4 col-sm-6 d-flex flex-column">
                                                                <img src="{{ asset('assets/images/avatar/user.png') }}"
                                                                    class="avatar" alt="">
                                                                <div>{{ $role->name }}</div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            {{ $permissions->links() }}
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
