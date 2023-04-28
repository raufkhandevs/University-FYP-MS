@extends('layouts.master')

@section('meta', 'Meetups')

@section('content')
    <div class="">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0" style="background: none">
                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Meetups</li>
            </ol>
        </nav>
        <div class="page-title">
            <div class="title_left">
                <h3>My Meetups</h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Manage Meetups</h2>
                        @can('create_meetups')
                            <a href="{{ route('faculty.meetups.index.requests') }}" class="btn btn-primary float-right">Make
                                Request</a>
                            {{-- <a href="#" class="btn btn-info float-right">Import</a> --}}
                        @endcan

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (count($meetups))
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Project</th>
                                        <th>Event Dates</th>
                                        <th>Link </th>
                                        <th data-sortable="false">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($meetups as $key => $meetup)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $meetup->title }}</td>
                                            <td>{{ $meetup->description }}</td>
                                            <td>{{ $meetup->project->name }}</td>
                                            <td>
                                                {{ $meetup->event_start->format('d/m/Y') }} -
                                                {{ $meetup->event_end->format('d/m/Y') }}
                                            </td>
                                            <td class="text-center">
                                                @if ($meetup->meet_link)
                                                    [<a style="text-decoration: underline; color: blue" target="_blank"
                                                        href="{{ $meetup->meet_link }}">Open Link</a>]
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @can('create_meetups')
                                                    <a href="{{ route('faculty.meetups.destroy', $meetup->id) }}">
                                                        <h1 class="text-danger text-center " style="cursor: pointer"><i
                                                                class="fa fa-trash"></i></h1>
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

@endsection
