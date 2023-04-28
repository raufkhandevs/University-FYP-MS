@extends('layouts.master')

@section('meta', 'Roles')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('faculty.students.index') }}">Students</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Students</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">

                    <div class="x_title">
                        <h2>Create new Student</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <!-- Smart Wizard -->
                        <div id="wizard" class="form_wizard wizard_horizontal p-4">
                            <ul class="wizard_steps">
                                <li>
                                    <a href="#step-1">
                                        <span class="step_no">1</span>
                                        <span class="step_descr">
                                            Step 1<br />
                                            <small>Basic Info</small>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-2">
                                        <span class="step_no">2</span>
                                        <span class="step_descr">
                                            Step 2<br />
                                            <small>Student Details</small>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-3">
                                        <span class="step_no">3</span>
                                        <span class="step_descr">
                                            Step 3<br />
                                            <small>Department</small>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-4">
                                        <span class="step_no">4</span>
                                        <span class="step_descr">
                                            Step 4<br />
                                            <small>Session</small>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                            <form action="{{ route('faculty.students.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div id="step-1">

                                    <div class="form-horizontal form-label-left">

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name
                                                <span class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" name="name" id="name" class="form-control ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone">Phone
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="phone" name="phone" class="form-control ">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <div id="gender" class="btn-group" data-toggle="buttons">
                                                    <label class="btn btn-secondary" data-toggle-class="btn-primary"
                                                        data-toggle-passive-class="btn-secondary">
                                                        <input type="radio" name="gender" value="male"
                                                            class="join-btn"> &nbsp; Male &nbsp;
                                                    </label>
                                                    <label class="btn btn-primary" data-toggle-class="btn-primary"
                                                        data-toggle-passive-class="btn-secondary">
                                                        <input type="radio" name="gender" value="female"
                                                            class="join-btn"> Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Date Of Birth

                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="birthday" class="date-picker form-control"
                                                    placeholder="mm-dd-yyyy" type="text" type="text"
                                                    onfocus="this.type='date'" onmouseover="this.type='date'"
                                                    onclick="this.type='date'" onblur="this.type='text'"
                                                    onmouseout="timeFunctionLong(this)">
                                                <script>
                                                    function timeFunctionLong(input) {
                                                        setTimeout(function() {
                                                            input.type = 'text';
                                                        }, 60000);
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">City
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="city" name="city" class=" form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">State
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="state" name="state" class=" form-control"
                                                    type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Country
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="country" name="country" class=" form-control"
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
                                <div id="step-2">
                                    <div class="form-horizontal form-label-left">

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="roll_number">Roll Number <span class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" name="roll_number" id="roll_number"
                                                    class="form-control ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="semester">Semester
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="semester" name="semester"
                                                    class="form-control ">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Alumni</label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <div id="alimni" class="btn-group" data-toggle="buttons">
                                                    <label class="btn btn-secondary" data-toggle-class="btn-primary"
                                                        data-toggle-passive-class="btn-secondary">
                                                        <input type="radio" name="is_alumni" value="1"
                                                            class="join-btn"> &nbsp; Yes &nbsp;
                                                    </label>
                                                    <label class="btn btn-primary" data-toggle-class="btn-primary"
                                                        data-toggle-passive-class="btn-secondary">
                                                        <input type="radio" name="is_alumni" value="0"
                                                            class="join-btn"> No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Credit Hours
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="credit_hours" name="credit_hours" class=" form-control"
                                                    type="number">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Quality Points
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="quality_points" name="quality_points" class=" form-control"
                                                    type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">CGPA
                                                <span class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="cgpa" class=" form-control" name="cgpa"
                                                    type="text">
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div id="step-3">
                                    <div class="form-horizontal form-label-left">

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Department
                                                <span class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <select class="form-control" name="department_id" id="department_id">
                                                    <option value="">Choose option</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}">{{ $department->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="step-4">
                                    <div class="form-horizontal form-label-left">

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Session
                                                <span class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <select class="form-control" name="session_id" id="session_id">
                                                    <option value="">Choose option</option>
                                                    @foreach ($sessions as $session)
                                                        <option value="{{ $session->id }}">
                                                            {{ $session->session_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>



                                    </div>
                                </div>
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

    @error('roll_number')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror

    @error('cgpa')
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

    @error('session_id')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror
    <script type="text/javascript">
        $(document).ready(function() {

            $('#wizard').smartWizard({
                onFinish: onFinishCallback
            });

            function onFinishCallback(objs, context) {
                if (validateAllSteps()) {
                    $('form').submit();
                }
            }

            function validateAllSteps(param) {
                let name = $('#name').val();
                let roll_number = $('#roll_number').val();
                let cgpa = $('#cgpa').val();
                let department_id = $('#department_id').val();
                let session_id = $('#session_id').val();

                if (name === "" || name === null) {
                    toastr.error("", "Name field is required", {
                        timeOut: 3000
                    })
                }

                if (roll_number === "" || roll_number === null) {
                    toastr.error("", "Roll Number field is required", {
                        timeOut: 3000
                    })
                }

                if (cgpa === "" || cgpa === null) {
                    toastr.error("", "CGPA field is required", {
                        timeOut: 3000
                    })
                }

                if (department_id === "" || department_id === null) {
                    toastr.error("", "Department field is required", {
                        timeOut: 3000
                    })
                }

                if (session_id === "" || session_id === null) {
                    toastr.error("", "Session field is required", {
                        timeOut: 3000
                    })
                }
                if (name && roll_number && cgpa && department_id && session_id) {
                    return true;
                } else {
                    return false;
                }
            }
        });
    </script>
@endsection
@endsection
