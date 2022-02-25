@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')
    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                {!! Form::open(['route' => 'dashboard.marquee.tentative-booking.store', 'files' => true,'id' => 'booking_form', 'class' => 'solid-validation'] ) !!}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="panel-title ">
                                <div class="row border-grey border-bottom">
                                    <div class="col-lg-12">
                                        <h3 class="p-3 text-dark text-center">Tentative Booking Form</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('dashboard.marquee.tentative-booking.components.general')
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-right">
                        <div class="card">
                            <div class="card-body">
                                @include('dashboard.accounts.common.buttons.buttons-crud', ['save' => true, 'reset' => true,
                                    'cancel' => true, 'cancel_route' => 'dashboard.marquee.tentative-booking.index'])
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            @include('includes.dashboard-footer')
        </div>
    @endsection
@endsection
@include('dashboard.marquee.tentative-booking.components.scripts')
