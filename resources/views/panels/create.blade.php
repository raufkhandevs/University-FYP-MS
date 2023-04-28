@extends('layouts.master')

@section('meta', 'Panel Create')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('faculty.panels.index') }}">Panels</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Panels</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">

                    <div class="x_title">
                        <h2>Create new Panel</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <!-- Smart Wizard -->
                        <div id="" class="form_wizard wizard_horizontal p-4">

                            <form action="{{ route('faculty.panels.store') }}" method="POST">
                                @csrf
                                <div id="step-1">
                                    <div class="form-horizontal form-label-left">

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name
                                                <span class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" name="name" id="name" class="form-control "
                                                    required value="{{ old('name') }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Department
                                                <span class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <select class="form-control" name="department_id" id="department_id">
                                                    <option value="">Choose Department</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}">{{ $department->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="email">Faculty
                                                <span class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6  " id="select-teachers">
                                                <span class="bg-info rounded text-light p-1">You can add mmebers
                                                    later.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Create</button>
                                {{-- <button type="button" class="btn seach btn-success float-right">Search Members</button> --}}
                            </form>
                        </div>
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
    @error('department_id')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror

@endsection
@endsection
