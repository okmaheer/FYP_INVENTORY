@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    @include('includes.datatable-css')
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')
    @section('body')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    @include('includes.messages')
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="no-sort"></th>
                                        <th class="no-sort text-center">Actions</th>
                                        <th>Booking Number</th>
                                        <th>Person Name</th>
                                        <th>Event Date</th>
                                        <th>Event Time</th>
                                        <th># of Persons</th>
                                        <th>Booking Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $d)
                                        <tr>
                                            <td></td>
                                            <td class="text-center">
                                                <div class="dropdown d-inline-block">
                                                    <a class="nav-link dropdown-toggle arrow-none" id="dLabel8" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-left"
                                                         aria-labelledby="dLabel8" x-placement="top-end"
                                                         style="position: absolute; transform: translate3d(-121px, -72px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                        <a href="{{ route('dashboard.marquee.tentative-booking.edit', $d->id) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                        <a href="javascript:void(0);" onclick="DeleteEntry({{$d->id}});" class="dropdown-item"><i class="fas fa-trash"></i> Delete Record</a>
                                                        <div class="dropdown-divider"></div>
                                                        <form action="{{ route('dashboard.marquee.tentative-booking.destroy',$d->id) }}" method="POST" id="deleteForm{{$d->id}}" style="display: none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $d->tentative_number }}</td>
                                            <td>{{ $d->customer_name }}</td>
                                            <td>{{ \AccountHelper::date_format( $d->event_date ) }}</td>
                                            <td>{{ \MarqueeHelper::eventTime( $d->event_time ) }}</td>
                                            <td>{{ $d->no_person }}</td>
                                            <td>{{ \AccountHelper::date_format( $d->created_at ) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.dashboard-footer')
    </div>
    @endsection
@endsection
@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    @include('includes.datatable-js')
@endsection
@section('innerScript')
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.marquee.tentative-booking.create'])
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
