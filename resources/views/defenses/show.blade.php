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
                            @can('update_defenses')
                                @if (
                                    ($defense->finalDefenseGrades && $defense->finalDefenseGrades->is_finalized != '1') ||
                                        auth()->user()->isAuthoritativeUser())
                                    @if ($editable)
                                        <button type="submit" class="btn btn-primary float-right">Update</button>
                                        <a href="{{ route('faculty.defenses.show', $defense->id) }}"
                                            class="btn btn-danger float-right">Cancel</a>
                                    @else
                                        <a href="{{ route('faculty.defenses.show', $defense->id . '?editable=true') }}"
                                            class="btn btn-primary float-right">Make
                                            Changes</a>
                                    @endif
                                @endif


                                @if ($defense->is_final == '1')
                                    @if ($defense->finalDefenseGrades && $defense->finalDefenseGrades->is_finalized == '1')
                                        <button type="button" class="btn btn-success float-right">Finalized</button>
                                    @else
                                        <a href="{{ route('faculty.defenses.finalized', $defense->id) }}"
                                            class="btn btn-success float-right">Mark
                                            as Finalized</a>
                                    @endif
                                @else
                                    {{-- <a href="javascript:void(0)" class="btn btn-success warning-show float-right">Mark
                                        as Finalized</a> --}}
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

                        @if ($defense->is_final == '1')
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
                                                        <input type="number" {{ $editable ? 'required' : 'disabled' }}
                                                            name="studentfinal[{{ $key }}][project_work]"
                                                            placeholder="Enter marks..."
                                                            value="{{ $student->finalDefenseGrade->project_work }}"
                                                            class="form-control px-3 m-0 w-100">
                                                    </td>
                                                    <td>
                                                        <input type="number" {{ $editable ? 'required' : 'disabled' }}
                                                            name="studentfinal[{{ $key }}][presentation]"
                                                            placeholder="Enter marks..."
                                                            value="{{ $student->finalDefenseGrade->presentation }}"
                                                            class="form-control px-3 m-0 w-100">
                                                    </td>
                                                    <td>
                                                        <input type="number" {{ $editable ? 'required' : 'disabled' }}
                                                            name="studentfinal[{{ $key }}][documentation]"
                                                            placeholder="Enter marks..."
                                                            value="{{ $student->finalDefenseGrade->documentation }}"
                                                            class="form-control px-3 m-0 w-100">
                                                    </td>
                                                    <td>
                                                        <input disabled type="text" placeholder="Total =/" name=""
                                                            value="{{ $student->finalDefenseGrade->total }}"
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
                        @else
                            <div class="x_content " style="min-height: 300px">

                                <h1 class="text-center">Members Details (Pre-Defense)</h1>
                                <div class="row">
                                    @forelse ($allocation->group->members ?? [] as $key => $student)
                                        <div class="col-lg-4 col-md-4 col-sm-12 mb-3 ">
                                            <div class="border shadow rounded p-2">
                                                <h2 class=""><u> Member {{ $key + 1 }}</u></h2>
                                                <div class="mb-2">
                                                    <label for="name">Full Name :</label>
                                                    <input type="text" value="{{ $student->user->name }}" id="name"
                                                        class="form-control" name="name" disabled />
                                                </div>
                                                <div class="mb-2">
                                                    <label for="roll_number">Roll Number :</label>
                                                    <input type="text" id="roll_number" class="form-control"
                                                        name="roll_number" disabled value="{{ $student->roll_number }}" />
                                                </div>
                                                <div class="mb-2">
                                                    <label for="semester">Semester :</label>
                                                    <input type="text" id="semester" class="form-control"
                                                        name="semester" disabled value="{{ $student->semester }}" />
                                                </div>
                                                <input type="hidden" name="students[][id]" value="{{ $student->id }}">
                                                <div class="mb-2">
                                                    <label for="status">Status <span class="text-danger">*</span>
                                                        :</label>
                                                    <select name="students[{{ $key }}][status]"
                                                        class="form-control" {{ $editable ? 'required' : 'disabled' }}
                                                        id="status">
                                                        <option value="">Choose Status...</option>
                                                        <option
                                                            {{ $student->preDefense->status == 'Yes' ? 'selected' : '' }}
                                                            value="Yes">Yes</option>
                                                        <option
                                                            {{ $student->preDefense->status == 'No' ? 'selected' : '' }}
                                                            value="No">No</option>
                                                        <option
                                                            {{ $student->preDefense->status == 'Repeat again' ? 'selected' : '' }}
                                                            value="Repeat again">Repeat again</option>
                                                    </select>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="review">Review <span class="text-danger">*</span>
                                                        :</label>
                                                    <textarea {{ $editable ? 'required' : 'disabled' }} name="students[{{ $key }}][review]" id="review"
                                                        class="form-control text-left" cols="30" rows="10">{{ $student->preDefense->reviews }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                    @empty
                                        <div class="">
                                            <div class="alert  alert-info">No Data</div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        @endif




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
