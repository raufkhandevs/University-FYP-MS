@extends('layouts.master')

@section('meta', 'Final Defense')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('faculty.defenses.index') }}">Defense </a></li>
                <li class="breadcrumb-item active" aria-current="page">Final Defense</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Defense</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <form action="{{ route('faculty.defenses.update', $defense->id) }}" method="POST">
                        @csrf
                        <div class="x_title">
                            <h2>Defense Evaluation </h2>
                            @can('create_defenses')
                                @if ($editable)
                                    <button type="submit" class="btn btn-primary float-right">Update</button>
                                    <a href="{{ route('faculty.defenses.show', $defense->id) }}"
                                        class="btn btn-danger float-right">Cancel</a>
                                @else
                                    <a href="{{ route('faculty.defenses.show', $defense->id . '?editable=true') }}"
                                        class="btn btn-primary float-right">Make
                                        Changes</a>
                                @endif

                                @if ($defense->preDefense && $defense->is_final == '1')
                                    <a href="{{ route('faculty.defense-types.create') }}"
                                        class="btn btn-success float-right">Mark
                                        as Finalized</a>
                                @else
                                    <a href="javascript:void(0)" class="btn btn-success warning-show float-right">Mark
                                        as Finalized</a>
                                @endif

                            @endcan
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

                            <h1 class="text-center">Members Details (Final-Defense)</h1>
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

    @error('project_id')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror

    @error('panel_id')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror

    <script>
        $(document).ready(function() {
            $('.warning-show').click(function(e) {
                e.preventDefault();
                toastr.error("", "Can't finalized before final defensw", {
                    timeOut: 3000
                })
            });
        });
    </script>
@endsection
@endsection
