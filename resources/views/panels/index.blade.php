@extends('layouts.master')

@section('meta', 'Panels')

@section('content')
    <div class="">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Panels</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>All Panels</h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage Panels</h2>
                        @can('create_panels')
                            <a href="{{ route('faculty.panels.create') }}" class="btn btn-primary float-right">Create</a>
                            {{-- <a href="#" class="btn btn-info float-right">Import</a> --}}
                        @endcan

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (count($panels))
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Members</th>
                                        <th data-sortable="false">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($panels as $key => $panel)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $panel->name }}</td>
                                            <td>{{ $panel->department->name ?? 'N/A' }}</td>
                                            <td>{{ $panel->facultyMembers ? $panel->facultyMembers->count() : 0 }}</td>
                                            <td class="parent-element">
                                                @can('view_users')
                                                    <a class="btn text-primary py-0"
                                                        href="{{ route('faculty.panels.show', $panel->id) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('update_panels')
                                                    <a class="btn text-info py-0 add-members" href="javascript:void(0)"
                                                        title="Add Members">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <input type="hidden" name="panel_id" class="panel_id"
                                                        value="{{ $panel->id }}" data-id="{{ $panel->id }}">
                                                    <input type="hidden" name="department_name" class="department_name"
                                                        value="{{ $panel->department->name ?? 'N/A' }}">
                                                    <input type="hidden" name="department_id" class="department_id"
                                                        value="{{ $panel->department->id ?? 'N/A' }}">
                                                @endcan
                                                @can('delete_panels')
                                                    <a class="btn text-danger py-0"
                                                        href="{{ route('faculty.panels.destroy', $panel->id) }}">
                                                        <i class="fa fa-trash"></i>
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

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        id="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="#" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="">All Members</label>
                        <div class="">
                            <table class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="add-members-here">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="window.location.reload()">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@section('scripts')

    @error('department_id')
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

    @error('faculty_id')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror
    <script>
        function addMemberHandler(panel_id, member_id) {
            if (panel_id && member_id) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('faculty.panels.members.add') }}",
                    data: {
                        panel_id: panel_id,
                        faculty_id: member_id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if (response.status === 409) {
                            // conflict 
                            toastr.error("", "Already a Member", {
                                timeOut: 3000
                            })
                        }
                        if (response.status === 201) {
                            // created 
                            toastr.success("", "Added Successfully", {
                                timeOut: 3000
                            })
                        }
                    }
                });
            } else {
                toastr.error("", "Something went wrong", {
                    timeOut: 3000
                })
            }
        }

        $(document).ready(function() {

            $('.add-members').click(function(e) {
                e.preventDefault();

                let panel_id = $(this).closest('.parent-element').find('.panel_id').val();
                let department_name = $(this).closest('.parent-element').find('.department_name').val();
                let department_id = $(this).closest('.parent-element').find('.department_id').val();

                if (panel_id) {
                    $('#exampleModalLabel').empty();
                    $('#exampleModalLabel').html(`All Members from ${department_name}`);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('faculty.panels.members') }}",
                        data: {
                            department_id: department_id,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.status === 200) {

                                let html = '';

                                if (response.teachers.length) {
                                    response.teachers.forEach(function(item, index) {
                                        html += `
                                        <tr class="modal-parent">
                                            <td>${item?.user?.name}</td>
                                            <td>
                                                <input type="hidden" name="member_id" class="member_id"
                                                            value="${item?.user?.id}">
                                                <input type="hidden" name="panel_id" class="panel_id"
                                                            value="${panel_id}">
                                                <button type="button" onclick="addMemberHandler(${panel_id}, ${item?.id})" class="add-member-class btn btn-success">Add Member</button>
                                            </td>
                                        </tr>
                                    `;
                                    });

                                } else {
                                    html =
                                        '<tr><td colspan="2" class="text-center"><span>No Members</span></td></tr>'
                                }

                                $('#add-members-here').html(html);


                                $('#myLargeModalLabel').modal('show');
                            } else {
                                toastr.error("", "Something went wrong", {
                                    timeOut: 3000
                                })
                            }
                        },
                        error: function() {
                            toastr.error("", "Something went wrong", {
                                timeOut: 3000
                            })
                        },
                    });
                }
            });

        });
    </script>
@endsection
@endsection
