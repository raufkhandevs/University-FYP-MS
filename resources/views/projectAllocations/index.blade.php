@extends('layouts.master')

@section('meta', 'Fyp / Supervisor Allocation')

@section('content')
    <div class="">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">FYP Alloations</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>All Allocation Requests</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage Allocation Requests</h2>
                        @can('update_fypregistrationnumbers')
                            <form action="{{ route('faculty.project.allocation.index') }}" class="float-right d-inline"
                                method="GET">
                                <input type="hidden" name="page"
                                    value="{{ $buttonText == 'History' ? 'history' : 'back' }}">
                                <button type="submit" class="btn btn-warning float-right">{{ $buttonText }}</button>
                            </form>

                            @if (count($projectAllocations) && $buttonText == 'History')
                                <form action="{{ route('faculty.project.allocation.approve-all') }}"
                                    class="float-right d-inline" method="POST">
                                    @csrf
                                    <input type="hidden" name="approved_all" value="1">
                                    <button type="submit" class="btn btn-primary float-right">Approve All</button>
                                </form>
                            @endif

                        @endcan

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (count($projectAllocations))
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Project Number</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Pref. Supervisor</th>
                                        <th>Request at</th>
                                        <th data-sortable="false">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projectAllocations as $key => $projectAllocation)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $projectAllocation->project->project_number }}</td>
                                            <td>{{ $projectAllocation->project->name }}</td>
                                            <td>{{ $projectAllocation->project->is_approved }}</td>
                                            <td>{{ $projectAllocation->supervisor->user->name }}</td>
                                            <td>{{ $projectAllocation->created_at->format('d/m/Y') }}</td>

                                            <td>
                                                @can('view_fypregistrationnumbers')
                                                    <a class="btn btn-primary py-0" title="Show"
                                                        href="{{ route('faculty.project.allocation.show', $projectAllocation->id) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
                                                @can('update_fypregistrationnumbers')
                                                    {{-- <button type="button" class="btn btn-info py-0 modal-button-icon"
                                                        data-toggle="modal" data-target="#exampleModal"
                                                        data-id="{{ $projectAllocation->id }}" href="" title="Remarks">
                                                        <i class="fa fa-edit"></i>
                                                    </button> --}}

                                                    @if ($projectAllocation->project->is_approved == '1')
                                                        <a class="btn btn-success py-0" title="Already Approved"
                                                            href="javascript:void(0)">
                                                            Approved
                                                        </a>
                                                    @else
                                                        <a class="btn btn-warning py-0" title="Approve"
                                                            href="{{ route('faculty.project.allocation.approve', $projectAllocation->id) }}">
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
                <form action="{{ route('faculty.project.allocation.add-remarks') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Remarks</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="project_allocation_id" id="project_allocation_id">
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
                let project_allocation_id = $(this).attr("data-id");
                $('#project_allocation_id').val(project_allocation_id);
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

    @error('project_allocation_id')
        <script>
            toastr.error("", "{{ $message }}", {
                timeOut: 3000
            })
        </script>
    @enderror

@endsection
