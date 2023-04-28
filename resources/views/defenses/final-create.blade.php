@extends('layouts.master')

@section('meta', 'Pre Defense')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('faculty.defenses.index') }}">Defense </a></li>
                <li class="breadcrumb-item active" aria-current="page">Pre Defense</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Pre Defense</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <form action="{{ route('faculty.defenses.final.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="defense_id" value="{{ $defense->id }}" id="">
                        <div class="x_title">
                            <h2>Evaluate Pre Defense </h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content text-center">

                            <h1 class="text-center m-auto">Project Details</h1>

                            <div class="border text-left d-flex m-auto flex-column shadow rounded p-2 pt-4">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Project Title
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" disabled value="{{ $allocation->project->name }}"
                                            class="form-control" id="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Project Idea
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <textarea disabled class="form-control" rows="10">{{ $allocation->project->idea }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="x_content " style="min-height: 300px">

                            <h1 class="text-center">Members Details</h1>

                            <div>
                                <table class="table table-striped table-bordered text-center" style="width:100%">
                                    <thead style="font-weight: bold">
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>Academic</td>
                                            <td>Project Work</td>
                                            <td>Presentation</td>
                                            <td>Documentation</td>
                                            <td>TOTAL</td>
                                        </tr>
                                        <tr>
                                            <td>Roll Num.</td>
                                            <td>Student Name</td>
                                            <td>Session</td>
                                            <td>[30]</td>
                                            <td>[10]</td>
                                            <td>[10]</td>
                                            <td>[50]</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allocation->group->members ?? [] as $key => $student)
                                            <input type="hidden" name="studentfinal[{{ $key }}][student_id]"
                                                value="{{ $student->id }}">
                                            <tr>
                                                <td>{{ $student->roll_number }}</td>
                                                <td>{{ $student->user->name }}</td>
                                                <td>{{ $student->sessions->session_name }}</td>
                                                <td>
                                                    <input type="number" required
                                                        name="studentfinal[{{ $key }}][project_work]"
                                                        placeholder="Enter marks..." class="form-control px-3 m-0 w-100">
                                                </td>
                                                <td>
                                                    <input type="number" required
                                                        name="studentfinal[{{ $key }}][presentation]"
                                                        placeholder="Enter marks..." class="form-control px-3 m-0 w-100">
                                                </td>
                                                <td>
                                                    <input type="number" required
                                                        name="studentfinal[{{ $key }}][documentation]"
                                                        placeholder="Enter marks..." class="form-control px-3 m-0 w-100">
                                                </td>
                                                <td>
                                                    <input disabled type="text" placeholder="Total =/" name=""
                                                        class="form-control px-3 m-0 w-100">
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3" class="text-right">
                                                <b> Evaluator's Name and signature ==></b>
                                            </td>
                                            <td colspan="2">
                                                <b> {{ auth()->user()->name }}</b>
                                            </td>

                                            <td colspan="2">
                                                <i><u>{{ auth()->user()->name }}</u></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-center">
                                <button type="submit" class=" w-25 btn btn-primary">Submit</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    @error('defense_type_id')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror
@endsection
@endsection
