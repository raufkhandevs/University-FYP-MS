@extends('layouts.master')

@section('meta', 'Meetups Requests')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/frontend/vendors/fullcalendar/dist/fullcalendar.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/frontend/vendors/fullcalendar/dist/fullcalendar.print.css') }}"> --}}
    <style>
        .fc-title {
            color: white !important;
        }
    </style>
@endsection

@section('content')
    <div class="">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('faculty.meetups.index.requests') }}">Meetups</a></li>
                <li class="breadcrumb-item active" aria-current="page">Requests</li>
            </ol>
        </nav>

        <div class="page-title">
            <div class="title_left">
                <h3>Meetups Requests</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage Meetup Requests</h2>
                        <a href="{{ route('faculty.meetups.index') }}" class="btn btn-primary float-right">My Meetups</a>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="project_id" id="project_id" value="{{ $projectId }}">

    <!-- calendar modal -->
    <div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">New Calendar Entry</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div id="testmodal" style="padding: 5px 20px;">
                        <form id="antoform" class="form-horizontal calender" role="form">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Title</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Meeting Link
                                    [<a href="https://meet.google.com/" target="_blank"
                                        style="text-decoration: underline">New</a>]
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="meet_link" name="meet_link">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" style="height:55px;" id="descr" name="descr"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary antosubmit">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">Edit Calendar Entry</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <div id="testmodal2" style="padding: 5px 20px;">
                        <form id="antoform2" class="form-horizontal calender" role="form">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Title</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="title2" name="title2">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" style="height:55px;" id="descr2" name="descr"></textarea>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary antosubmit2">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
    <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
    <!-- /calendar modal -->

@section('scripts')
    <script src="{{ asset('assets/frontend/vendors/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script>
        let event_start;
        let event_end;

        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                events: "{{ route('faculty.meetups.index.requests') }}",
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,list'
                },
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    event_start = start.format("Y-MM-DD HH:mm:ss");
                    event_end = end.format("Y-MM-DD HH:mm:ss");
                    $('#CalenderModalNew').modal();
                },
            });

            $('.antosubmit').click(function(e) {
                e.preventDefault();
                var title = $('#title').val();
                var descr = $('#descr').val();
                var meet_link = $('#meet_link').val();
                var project_id = $('#project_id').val();
                if (!title || title == '') {
                    toastr.error("", "Title is Required", {
                        timeOut: 3000
                    })
                }

                if (title && title != '') {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('faculty.meetups.store.requests') }}",
                        data: {
                            project_id: project_id,
                            title: title,
                            description: descr,
                            event_start: event_start,
                            event_end: event_end,
                            meet_link: meet_link,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            if (response.status == 201) {
                                toastr.success("", "Event Added", {
                                    timeOut: 3000
                                })
                                window.location.reload()
                            }

                            if (response.status == 409) {
                                toastr.error("", "Event Days are reserved!", {
                                    timeOut: 3000
                                })
                            }

                            $('#antoform').trigger("reset");
                            $('#CalenderModalNew').modal('hide');

                        },
                        error: function(error) {
                            toastr.error("", "You don't have assigned project", {
                                timeOut: 3000
                            })
                        }
                    });
                }
            });
        });
    </script>
@endsection

@endsection
