@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')
    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                @include('dashboard.marquee.stage-bookings.components.typeselection')

                <div class="row">
                    <div class="col-md-12">
                        <div id="withBooking" style="display: none">
                            @include('dashboard.marquee.stage-bookings.create')
                        </div>
                        <div id="withoutBooking" style="display: none">
                            @include('dashboard.marquee.stage-bookings.create-without-booking')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('dashboard.marquee.bookings.components.customer-model')
    @endsection
@endsection

@include('dashboard.marquee.stage-bookings.common-script')