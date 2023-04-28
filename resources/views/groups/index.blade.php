@extends('layouts.master')

@section('meta', 'Groups')

@section('content')
    <div class="">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Groups</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Group</h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage Group {{ $group ? $group->name : '' }}</h2>

                        <div class="float-right d-inline">
                            @if ($group)
                                @if ($approvedStudent)
                                    <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                        Invite Members</button>
                                @else
                                    <script>
                                        toastr.error("", "Complete your registration process", {
                                            timeOut: 3000
                                        })
                                    </script>
                                    <button class="btn text-danger">
                                        Complete your registration process, to invite students</button>
                                @endif
                            @else
                                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
                                    Make Group</button>
                            @endif
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (count($invitations) && empty($group))
                            <h4>Incoming Group Requests</h4>
                            <table class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Roll Number</th>
                                        <th>Group Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invitations as $key => $invitation)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $invitation->content->name }}</td>
                                            <td>{{ $invitation->content->roll_number }}</td>
                                            <td>{{ $invitation->content->group_name }}</td>
                                            <td>
                                                <div>
                                                    <a href="{{ route('groups.invite.accept', $invitation->id) }}"
                                                        class="btn btn-info">Accept</a>
                                                    <a href="{{ route('groups.invite.reject', $invitation->id) }}"
                                                        class="btn btn-danger">Reject</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @endif
                        @if ($group)
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Roll Number</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Semester</th>
                                        <th>Session</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($group->members as $key => $groupMember)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $groupMember->roll_number }}</td>
                                            <td>{{ $groupMember->user->name }}</td>
                                            <td>{{ $groupMember->department->name }}</td>
                                            <td>{{ $groupMember->semester }}</td>
                                            <td>{{ $groupMember->sessions->session_name }}</td>
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
                <form id="form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Invite Group Members</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <label for="">Search Roll Number</label>
                            <input type="text" required name="roll_number" id="roll-number" class="form-control"
                                id="">
                        </div>
                        <div id="seached-students">
                            <table id="" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Roll Number</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row" id="id"></th>
                                        <td id="name"></td>
                                        <td id="roll"></td>
                                        <td>
                                            <div id="btn-modal"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('groups.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Make Group</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="">Group Name</label>
                            <input type="text" required name="group_name" class="form-control" id="">
                            <small id="emailHelp" class="form-text  text-danger">
                                You only be able to create group once & you not be able to change group name later.
                            </small>

                        </div>
                        <div class="">
                            <label for="">Bio</label>
                            <textarea name="group_bio" class="form-control" id="" cols="30" rows="4"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    @error('group_name')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror
    <script>
        $(document).ready(function() {
            let student_id;

            $('#form').submit(function(e) {
                e.preventDefault();

                let roll_number = $('#roll-number').val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('student.search') }}",
                    data: {
                        roll_number: roll_number,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $('#id').html('1');
                        $('#name').html(response.user.name);
                        $('#roll').html(response.student.roll_number);
                        $('#btn-modal').html('Invite');
                        $('#btn-modal').addClass('btn btn-info');
                        student_id = response.student.roll_number
                    },
                    error: function(error) {
                        toastr.error("", "Member Not Found", {
                            timeOut: 3000
                        })
                    }
                });

            });

            $('#btn-modal').click(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('groups.invite.send') }}",
                    data: {
                        roll_number: student_id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if (response.status === 404) {
                            toastr.error("", "Already a group member", {
                                timeOut: 3000
                            })
                        }
                        if (response.status === 402) {
                            toastr.warning("", "Person Not Interested!", {
                                timeOut: 3000
                            })
                        }
                        if (response.status === 401) {
                            toastr.warning("", "Invitation already sent", {
                                timeOut: 3000
                            })
                        }
                        if (response.status === 403) {
                            toastr.warning("", "Group has reached max limit", {
                                timeOut: 3000
                            })
                        }
                        if (response.status === 405) {
                            toastr.warning("", "Student is not registered yet!", {
                                timeOut: 3000
                            })
                        }
                        if (response.status === 200) {
                            $('#exampleModal').modal('hide');
                            $('#roll-number').val('');
                            toastr.success("", "Invitation Sent!", {
                                timeOut: 3000
                            })
                        }

                    },
                    error: function(error) {
                        toastr.error("", "Something Went Wrong", {
                            timeOut: 3000
                        })
                    },
                });

            });
        });
    </script>
@endsection
