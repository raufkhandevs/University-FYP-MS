@extends('layouts.master')

@section('meta', 'Users')

@section('content')
    <div class="">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>All Users</h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage Users</h2>
                        @can('create_users')
                            <a href="{{ route('faculty.users.create') }}" class="btn btn-primary float-right">Create</a>
                            {{-- <a href="#" class="btn btn-info float-right">Import</a> --}}
                        @endcan

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (count($users))
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th data-sortable="false">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>
                                                @foreach ($user->getRoleNames()  as $roleName)
                                                    <button class="btn bg-secondary text-white pill rounded">{{ $roleName }}</button>
                                                @endforeach
                                            </td>
                                            <td>
                                                @can('view_users')
                                                    <a class="btn text-primary py-0"
                                                        href="{{ route('faculty.users.show', $user->id) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('update_users')
                                                    <a class="btn text-info py-0"
                                                        href="{{ route('faculty.users.edit', $user->id) }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete_users')
                                                    <a class="btn text-danger py-0"
                                                        href="{{ route('faculty.users.destroy', $user->id) }}">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @endcan
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            {{-- {{ $users->links() }} --}}
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
