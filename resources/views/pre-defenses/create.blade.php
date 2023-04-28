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
                    <form action="{{ route('faculty.pre-defenses.evaluate', $defense->id) }}" method="POST">
                        @csrf
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
                            <div class="row">
                                @foreach ($allocation->group->members ?? [] as $key => $student)
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
                                                <input type="text" id="semester" class="form-control" name="semester"
                                                    disabled value="{{ $student->semester }}" />
                                            </div>
                                            <input type="hidden" name="students[][id]" value="{{ $student->id }}">
                                            <div class="mb-2">
                                                <label for="status">Status <span class="text-danger">*</span> :</label>
                                                <select name="students[{{ $key }}][status]" class="form-control"
                                                    required id="status">
                                                    <option value="">Choose Status...</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                    <option value="Repeat again">Repeat again</option>
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <label for="review">Review <span class="text-danger">*</span> :</label>
                                                <textarea name="students[{{ $key }}][review]" required id="review" class="form-control" cols="30"
                                                    rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
@endsection
@endsection
