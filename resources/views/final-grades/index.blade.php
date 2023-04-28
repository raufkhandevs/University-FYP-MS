@extends('layouts.master')

@section('meta', 'Mark Grades')

@section('content')
    <div class="">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mark Grades</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Mark Grades</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage Grades </h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (count($groups))
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>FYP Number</th>
                                        <th>Members</th>
                                        <th>Department</th>
                                        <th>Semester</th>
                                        <th>Session</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groups as $key => $group)
                                        <tr class="parent-element">
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $group->name }}</td>
                                            <td>{{ $group->project->project_number }}</td>
                                            <th>
                                                <div class="container d-block">
                                                    <div class="row">
                                                        @foreach ($group->members as $member)
                                                            <div class="col-lg-4 col-md-4 col-sm-6 d-flex flex-column">
                                                                <img src="{{ asset('assets/images/avatar/user.png') }}"
                                                                    class="avatar" alt="">
                                                                <div>{{ $member->user->name }} <br>
                                                                    ({{ $member->roll_number }})
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </th>
                                            <td>{{ $group->members ? $group->members[0]->department->name : 'N/A' }}</td>
                                            <td>{{ $group->members ? $group->members[0]->semester : 'N/A' }}</td>
                                            <td>{{ $group->members ? $group->members[0]->sessions->session_name : 'N/A' }}
                                            </td>
                                            <td>
                                                <input type="hidden" name="group_id" class="group_id"
                                                    value="{{ $group->id }}">
                                                @can('view_finalgrades')
                                                    <a class="btn btn-success h2 btn-modal text-light py-0"
                                                        href="javascript:void(0)" data-toggle="modal"
                                                        data-target="#exampleModal">
                                                        <i class="fa fa-calculator"></i>
                                                    </a>
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
                <form id="form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Final Grades</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="seached-students">
                            <table id="" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Roll Number</th>
                                        <th>Marks(%)</th>
                                        <th>Grade</th>
                                    </tr>
                                </thead>
                                <tbody id="add-here">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @error('group_id')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror
    <script>
        $(document).ready(function() {
            let group_id;


            $('.btn-modal').click(function(e) {
                e.preventDefault();

                let group_id = $(this).closest('.parent-element').find('.group_id').val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('faculty.final-grades.store') }}",
                    data: {
                        group_id: group_id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        let html = '';

                        if (response.length) {
                            response.forEach(function(item, index) {
                                html += `
                                        <tr>
                                            <td>${index + 1}</td>
                                            <td>${item?.name}</td>
                                            <td>${item?.roll_number}</td>
                                            <td>${item?.marks}%</td>
                                            <td>${item?.grade}</td>
                                        </tr>
                                    `;
                            });

                        } else {
                            html =
                                '<tr><td colspan="5" class="text-center"><span>No Members</span></td></tr>'
                        }

                        $('#add-here').html(html);

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
