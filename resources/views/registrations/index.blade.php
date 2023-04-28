@extends('layouts.master')

@section('meta', 'Fyp Registrations')

@section('content')
    <div class="">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">FYP Registrations</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>All Registration Requests</h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage Requests</h2>
                        @can('update_fypregistrationnumbers')
                            <form action="{{ route('faculty.fyp-registration.index') }}" class="float-right d-inline"
                                method="GET">
                                <input type="hidden" name="page"
                                    value="{{ $buttonText == 'History' ? 'history' : 'back' }}">
                                <button type="submit" class="btn btn-warning float-right">{{ $buttonText }}</button>
                            </form>

                            @if (count($fypRegistrations) && $buttonText == 'History')
                                <form action="{{ route('faculty.fyp-registration.approve-all') }}" class="float-right d-inline"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="approved_all" value="1">
                                    <button type="submit" class="btn btn-primary float-right">Approve All</button>
                                </form>
                            @endif

                        @endcan

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (count($fypRegistrations))
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Roll Number</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Semester</th>
                                        <th>Session</th>
                                        <th>Passed Subjects</th>
                                        <th>Request at</th>
                                        <th data-sortable="false">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fypRegistrations as $key => $fypRegistration)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $fypRegistration->student->roll_number }}</td>
                                            <td>{{ $fypRegistration->student->user->name }}</td>
                                            <td>{{ $fypRegistration->student->department->name }}</td>
                                            <td>{{ $fypRegistration->student->semester }}</td>
                                            <td>{{ $fypRegistration->student->sessions->session_name }}</td>
                                            <td>{{ $fypRegistration->passed_subjects }}</td>
                                            <td>{{ $fypRegistration->registration_date->format('d/m/Y') }}</td>

                                            <td>
                                                @can('view_fypregistrationnumbers')
                                                    <a class="btn btn-primary py-0" title="Show"
                                                        href="{{ route('faculty.fyp-registration.show', $fypRegistration->id) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('update_fypregistrationnumbers')
                                                    <button type="button" class="btn btn-info py-0 modal-button-icon"
                                                        data-toggle="modal" data-target="#exampleModal"
                                                        data-id="{{ $fypRegistration->id }}" href="" title="Remarks">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    @if ($buttonText == 'History')
                                                        @if (isset($fypRegistration->remarks))
                                                            <a type="button" class="btn btn-danger py-0 modal-button-icon"
                                                                href="{{ route('faculty.fyp-registration.reject', $fypRegistration->id) }}"
                                                                title="Reject">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                        @else
                                                            <button type="button" id="reject-btn"
                                                                class="btn btn-danger py-0 modal-button-icon"
                                                                href="javascript:void(0)" title="Reject"
                                                                data-id="{{ $fypRegistration->id }}">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        @endif
                                                    @endif

                                                    @if (isset($fypRegistration->approved_by) && $fypRegistration->is_rejected == '0')
                                                        <a class="btn btn-success py-0" title="Already Approved"
                                                            href="javascript:void(0)">
                                                            Approved
                                                        </a>
                                                    @elseif($fypRegistration->is_rejected == '1')
                                                        <a class="btn btn-danger py-0" title="Rejected"
                                                            href="javascript:void(0)">
                                                            Rejected
                                                        </a>
                                                    @else
                                                        <a class="btn btn-warning py-0" title="Approve"
                                                            href="{{ route('faculty.fyp-registration.approve', $fypRegistration->id) }}">
                                                            Approve
                                                        </a>
                                                    @endif
                                                @endcan

                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <div class="p-5 d-flex justify-content-center">
                                <img src="{{ asset('assets/images/imgs/nodata.png') }}" alt="No data Found">
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('faculty.fyp-registration.add-remarks') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Remarks</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="registration_id" id="registration_id">
                        <label for="">Remarks</label>
                        <textarea name="remarks" class="form-control" id="" cols="30" rows="4"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection


@section('scripts')

    <script>
        $(document).ready(function() {
            $('.modal-button-icon').click(function() {
                let registration_id = $(this).attr("data-id");
                $('#registration_id').val(registration_id);
            });

            $('#reject-btn').click(function() {
                toastr.warning("", "Please Add Remarks", {
                    timeOut: 3000
                })
                $('#exampleModal').modal('show');

            });

        });
    </script>
    @error('remarks')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror

    @error('registration_id')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror

@endsection
