@extends('layouts.master')

@section('meta', 'Notifications')

@section('content')
    <div class="">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item active" aria-current="page">Notification</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>Notifications</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>All Notifications</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (count($notifications))
                            <div class="row">
                                <div class="col-sm-3 mail_list_column">
                                    {{-- <button id="compose" class="btn btn-sm btn-success btn-block"
                                type="button">COMPOSE</button> --}}
                                    @foreach ($notifications as $notification)
                                        <a class="parent-element" href="javascript:void(0)" id="notification-link">
                                            <div class="mail_list">
                                                <div class="left">
                                                    @if (!$notification->read_at)
                                                        <i class="fa fa-circle"></i>
                                                    @endif
                                                    {{-- <i class="fa fa-edit"></i> --}}
                                                </div>
                                                <input type="hidden" name="notification_id" class="notification_id"
                                                    data-id="{{ $notification->id }}" value="{{ $notification->id }}">
                                                <div class="right">
                                                    <h3>{{ $notification->data['name'] }}
                                                        <small>{{ $notification->created_at->diffForHumans() }}</small>
                                                    </h3>
                                                    <p>{{ $notification->data['message'] }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <!-- /MAIL LIST -->

                                <!-- CONTENT MAIL -->
                                <div class="col-sm-9 mail_view">
                                    <div class="inbox-body">
                                        <div class="mail_heading row">
                                            {{-- <div class="col-md-8">
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-primary" type="button"><i
                                                    class="fa fa-reply"></i> Reply</button>
                                            <button class="btn btn-sm btn-default" type="button" data-placement="top"
                                                data-toggle="tooltip" data-original-title="Forward"><i
                                                    class="fa fa-share"></i></button>
                                            <button class="btn btn-sm btn-default" type="button" data-placement="top"
                                                data-toggle="tooltip" data-original-title="Print"><i
                                                    class="fa fa-print"></i></button>
                                            <button class="btn btn-sm btn-default" type="button" data-placement="top"
                                                data-toggle="tooltip" data-original-title="Trash"><i
                                                    class="fa fa-trash-o"></i></button>
                                        </div>
                                    </div> --}}
                                            <div class="col-md-12">
                                                <h4 id="message"> </h4>
                                            </div>
                                            <div class="col-md-12 text-right">
                                                <p class="date" id="datetime"> </p>
                                            </div>

                                        </div>
                                        <div class="sender-info">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <strong id="name"></strong>
                                                    <span id="email"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="view-mail">
                                            <p id="detailed-message"></p>
                                        </div>

                                        <div class="attachment">
                                            <p class="add-links">
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <!-- /CONTENT MAIL -->
                            </div>
                        @else
                            <div class="alert alert-success">No Notifications</div>
                        @endif
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $('.parent-element').click(function(e) {
                e.preventDefault();

                let notification_id = $(this).closest('.parent-element').find('.notification_id').val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('notification.getNotification') }}",
                    data: {
                        notification_id: notification_id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        let notification = response.notification;
                        let notificationObject = JSON.parse(notification.data);

                        // empty the element
                        $('#datetime').empty();
                        $('#message').empty();
                        $('#name').empty();
                        $('#detailed-message').empty();
                        // $(this).closest('.parent-element').find('.left').empty();

                        $('#datetime').html(notification.created_at);
                        $('#message').html(notificationObject.message);
                        $('#name').html(notificationObject.name);
                        $('#detailed-message').html(notificationObject.detailed_message);

                        if (notificationObject.type === 'GroupInvitationNotification') {
                            $('.add-links').html(
                                `<span><i class="fa fa-paperclip"></i> Checkout - </span>
                                            <a href="{{ route('groups.index') }}" class="btn btn-dark" >Follow up</a> `
                            );

                        }
                    },
                    error: function() {
                        toastr.error("", "Something went wrong", {
                            timeOut: 3000
                        })
                    },
                });

            });
        });
    </script>
@endsection
