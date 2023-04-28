@extends('layouts.master')

@section('meta', 'Roles')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('faculty.roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
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
                    <form action="{{ route('faculty.roles.store') }}" method="POST">

                        @csrf
                        <div class="x_title">
                            <h2>Create new Role</h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content d-flex justify-content-center" style="min-height: 300px">

                            <div class="w-50">

                                <div class="col-md-8 col-sm-8 form-group has-feedback">
                                    <input type="text" required name="name" class="form-control has-feedback-left"
                                        id="inputSuccess2" placeholder="Role Name..." autofocus>
                                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                    @error('name')
                                        <div class="mt-1">
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                                <div class="text-center col-md-4 col-sm-4">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
