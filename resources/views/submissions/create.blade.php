@extends('layouts.master')

@section('meta', 'Submission Create')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('faculty.submissions.index') }}">Submission </a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Submission</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <form action="{{ route('faculty.submissions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="x_title">
                            <h2>Create Submission </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content d-flex justify-content-center" style="min-height: 300px">

                            <div class="w-50">
                                <input type="hidden" name="project_id" value="{{ $projectId ?? null }}">

                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12 ">
                                        <select class="form-control" name="submission_type_id" id="submission_type_id">
                                            <option value="">Choose Submission Type</option>
                                            @foreach ($submissionTypes as $submissionType)
                                                <option value="{{ $submissionType->id }}">{{ $submissionType->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12 custom-file">
                                        <input type="file" class="custom-file-input" name="file" id="file"
                                            aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="avatar">Choose
                                            File</label>
                                    </div>
                                </div>

                                <div class=" col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    @error('submission_type_id')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror
    @error('file')
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
@endsection

@endsection
