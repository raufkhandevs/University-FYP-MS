@extends('layouts.master')

@section('meta', 'Users Edit')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('faculty.users.index') }}">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>User</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">

                    <div class="x_title">
                        <h2>Edit User</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <!-- Smart Wizard -->
                        <div id="" class="form_wizard wizard_horizontal p-4">

                            <form action="{{ route('faculty.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div id="step-1">

                                    <div class="form-horizontal form-label-left">


                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Role
                                                <span class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <select class="form-control" name="role_id" id="role_id">
                                                    <option value="">Choose Role</option>
                                                    @foreach ($roles as $role)
                                                        <option {{ $role->id == $user->roles[0]->id ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name
                                                <span class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email
                                                <span class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="email" name="email" value="{{ $user->email }}" id="email" class="form-control ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Phone
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="phone" name="phone" value="{{ $user->phone }}" class="form-control ">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <div id="gender" class="btn-group" data-toggle="buttons">
                                                    <label class="btn btn-secondary" data-toggle-class="btn-primary"
                                                        data-toggle-passive-class="btn-secondary">
                                                        <input type="radio"
                                                            {{ $user->gender == 'male' ? 'checked' : '' }}
                                                            name="gender" value="male" class="join-btn"> &nbsp; Male
                                                        &nbsp;
                                                    </label>
                                                    <label class="btn btn-primary" data-toggle-class="btn-primary"
                                                        data-toggle-passive-class="btn-secondary">
                                                        <input type="radio"
                                                            {{ $user->gender == 'female' ? 'checked' : '' }}
                                                            name="gender" value="female" class="join-btn"> Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Department
                                                <span class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <select class="form-control" name="department_id" id="department_id">
                                                    <option value="">Choose Department</option>
                                                    @php
                                                        $userDepartmentId = $user->faculty->department->id ?? null;
                                                    @endphp
                                                    @foreach ($departments as $department)
                                                        <option {{ $department->id == $userDepartmentId ? 'selected' : '' }} value="{{ $department->id }}">{{ $department->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">City
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="city" class=" form-control"  value="{{ $user->city }}" name="city" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">State
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="state" class=" form-control" name="state"  value="{{ $user->state }}"
                                                    type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Country
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="country" class=" form-control" name="country"  value="{{ $user->country }}"
                                                    type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Designation
                                                <span class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="designation" name="designation" required class=" form-control"  value="{{ $user->faculty->designation ?? '' }}"
                                                    type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="phone">Avatar
                                            </label>
                                            <div class="col-md-6 col-sm-6 custom-file">
                                                <input type="file" class="custom-file-input" name="avatar"
                                                    id="avatar" aria-describedby="inputGroupFileAddon01">
                                                <label class="custom-file-label" for="avatar">Choose
                                                    Image</label>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary float-right">Create</button>
                            </form>
                        </div>
                        <!-- End SmartWizard Content -->
                    </div>
                </div>
            </div>
        </div>
    </div>


@section('scripts')
    @error('name')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror
    @error('email')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror
    @error('phone')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror

    @error('gender')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror
    @error('designation')
    <script>
        toastr.error("", "{{ $message }}", {
            timeOut: 3000
        })
    </script>
@enderror
@endsection
@endsection
