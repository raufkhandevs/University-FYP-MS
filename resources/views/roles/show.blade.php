@extends('layouts.master')

@section('meta', 'Roles')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('faculty.roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                        <h2>Edit {{ $role->name }}</h2>
                        <button type="submit" class="btn btn-primary float-right">Update</button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Permissions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $key = 0;
                                @endphp
                                @foreach ($all_group_permissions as $permission_group)
                                    <tr>
                                        <td scope="row">{{ $key += 1 }}</td>
                                        <td>
                                            <div class="form-group row">
                                                @foreach ($permissions as $permission)
                                                    @if ($permission->group_name == $permission_group)
                                                        <div class="col-lg-3 col-md-6 col-sm-6 ">
                                                            <input class="js-switch" type="checkbox"
                                                                id="flexSwitchCheckChecked"
                                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="flexSwitchCheckChecked">{{ $permission->title }}</label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
