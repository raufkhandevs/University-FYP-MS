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
                <h3>Final Defense</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <form action="{{ route('faculty.defenses.final.create') }}" method="POST">

                        @csrf
                        <div class="x_title">
                            <h2>Select Final Defense to Evaluate </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content d-flex justify-content-center" style="min-height: 300px">

                            <div class="w-50">

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Defense Type
                                        <span class="required text-danger">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" required name="defense_type_id" id="defense_type_id">
                                            <option value="">Choose Type</option>
                                            @foreach ($defenseTypes as $defenseType)
                                                <option value="{{ $defenseType->id }}">{{ $defenseType->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Project
                                        <span class="required text-danger">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="project_id" id="project_id">
                                            <option value="">Choose Project</option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}">{{ $project->name }}
                                                    ({{ $project->project_number }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Panel
                                        <span class="required text-danger">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="form-control" name="panel_id" id="panel_id">
                                            <option value="">Choose Panel</option>
                                            @foreach ($panels as $panel)
                                                <option value="{{ $panel->id }}">{{ $panel->name }}
                                                    ({{ $panel->facultyMembers ? $panel->facultyMembers->count() : 0 }}
                                                    Members)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center col-md-12 col-sm-12">
                                    <button type="submit"
                                        class=" text-center btn btn-primary d-block w-50">Evaluate</button>
                                </div>
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
