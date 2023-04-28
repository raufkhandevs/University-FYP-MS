@extends('layouts.master')

@section('meta', 'Dashboard')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Project / Supervisor Allocation</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Project / Supervisor Allocation </h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">

                <div class="x_panel">
                    <div class="x_title">
                        <h2>Group Details: {{ $group->name }}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @foreach ($group->members as $key => $memberStudent)
                            <div class="col-md-4 col-sm-4  profile_details">
                                <div class="well profile_view">
                                    <div class="col-sm-12">
                                        <h4 class="brief"><i>{{ $memberStudent->department->name }}</i></h4>
                                        <div class="left col-sm-7">
                                            <h2>{{ $memberStudent->user->name }}</h2>
                                            <p><strong>Roll Number: </strong> {{ $memberStudent->roll_number }} </p>
                                            <ul class="list-unstyled">
                                                <li><i class="fa fa-building"></i> Semester: {{ $memberStudent->semester }}
                                                </li>
                                                <li><i class="fa fa-phone"></i> Phone #: {{ $memberStudent->user->phone }}
                                                </li>
                                                <li><i class="fa fa-building"></i> Session #:
                                                    {{ $memberStudent->sessions->session_name }} </li>
                                            </ul>
                                        </div>
                                        <div class="right col-sm-5 text-center">
                                            <img src="{{ asset('assets\images\avatar\default-avatar.png') }}" width="100%"
                                                alt="" class="img-circle img-fluid">
                                        </div>
                                    </div>
                                    <div class=" bottom text-center">
                                        <div class=" col-sm-6 emphasis">
                                            <p class="ratings">
                                                <a>4.0</a>
                                                <a href="#"><span class="fa fa-star"></span></a>
                                                <a href="#"><span class="fa fa-star"></span></a>
                                                <a href="#"><span class="fa fa-star"></span></a>
                                                <a href="#"><span class="fa fa-star"></span></a>
                                                <a href="#"><span class="fa fa-star-o"></span></a>
                                            </p>
                                        </div>
                                        <div class=" col-sm-6 emphasis">
                                            <button type="button" class="btn btn-success btn-sm"> <i class="fa fa-user">
                                                </i> <i class="fa fa-comments-o"></i> </button>
                                            <button type="button" class="btn btn-primary btn-sm">
                                                <i class="fa fa-user"> </i> View Profile
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>

                <div class="x_panel">
                    <div class="x_title">
                        <h2>Allocation Form</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        @if ($registeredStudent && !$isProjectAllocated)
                            <form action="" method="POST">
                                @csrf
                                <div id="step-1">

                                    <div class="form-horizontal form-label-left">

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Project Title
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="project_title" class=" form-control" required
                                                    value="{{ old('project_title') }}" name="project_title" type="text">
                                            </div>
                                        </div>

                                        <input type="hidden" name="student_id" value="{{ $student->id }}">

                                        <div class="form-group row ">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="project_idea">Project Idea
                                            </label>
                                            <div class="col-md-6 col-sm-6  d-block">
                                                <div class="d-block">
                                                    <textarea name="project_idea" required class="form-control" id="" rows="4">{{ old('project_idea') }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Supervisors
                                                <span class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <select class="form-control" required name="supervisor_id"
                                                    id="supervisor_id">
                                                    <option value="">Choose Supervisor</option>
                                                    @foreach ($supervisors as $supervisor)
                                                        <option value="{{ $supervisor->id }}">
                                                            {{ $supervisor->user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group row px-5">
                                    <label class="col-form-label label-align"> Agreement
                                        <span class="required text-danger">*</span>
                                    </label>
                                    <div class="">
                                        I hereby request the department of computer science to register me for my BSCS/MCS
                                        final
                                        year project so that I can start working on my FYP proposal. I declare that all data
                                        provided here is true and accurate. I understand the meaning and consequences of the
                                        act
                                        of
                                        plagiarism in academic works and I do solemnly declare and promise not to indulge
                                        directly
                                        or indirectly in any acts of plagiarism and other foul activities that are
                                        disallowed by
                                        the
                                        university. I understand that I have to complete my FYP within the instructed time.
                                        I
                                        have
                                        also attached my latest photograph and my latest transcript with this application.
                                    </div>
                                    <div class="m-3">
                                        <input type="checkbox" required class=" mr-2" name="agreement" class=""
                                            id="">
                                        <span>I Agree to all the above statments.</span>
                                    </div>
                                    <div class="d-block w-100">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-info">Your FYP Allocation requets has been send, You will get your
                                registration number via Email</div>

                        @endif

                    </div>

                </div>

                {{-- TODO --}}
                {{-- <div class="x_panel">
                    <div class="x_title">
                        <h2>Allocation Details</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">


                    </div>

                </div> --}}

            </div>
        </div>
    </div>
@endsection

@section('scripts')

    @error('project_title')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror

    @error('project_idea')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror


@endsection
