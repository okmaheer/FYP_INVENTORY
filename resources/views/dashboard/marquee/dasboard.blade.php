@extends('layouts.dashboard')

@section('innerStyleSheet')

@section('content')
@include('includes.dashboard-breadcrumbs')
@section('body')

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="card-deck-wrapper">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="card" id="img_card">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <h3 class="card-title font-24 flex-fill mr-4">Event Booking</h3>
                                                                <div class="flex-fill"><i class="fas fa-ticket-alt fa-10x text-center text-dark mb-4"></i></div>
                                                            </div>
                                                            <a href="{{route('dashboard.marquee.booking.create')}}" class="btn btn-primary btn-sm waves-effect waves-light">Create</a>
                                                            <a href="{{route('dashboard.marquee.booking.index')}}" class="btn btn-dark btn-sm waves-effect waves-light float-right">Manage</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="card" id="img_card">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <h3 class="card-title font-24 flex-fill mr-4">Stage Booking</h3>
                                                                <div class="flex-fill"><i class="fas fa-bars fa-10x text-center text-dark mb-4"></i></div>
                                                            </div>
                                                            <a href="{{route('dashboard.marquee.stage.booking.create')}}" class="btn btn-primary btn-sm waves-effect waves-light">Create</a>
                                                            <a href="{{route('dashboard.marquee.stage.booking.index')}}" class="btn btn-dark btn-sm waves-effect waves-light float-right">Manage</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="card" id="img_card">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <h3 class="card-title font-24 flex-fill mr-4">Food Menu</h3>
                                                                <div class="flex-fill"><i class="fab fa-apple fa-10x text-center text-dark mb-4"></i></div>
                                                            </div>
                                                            <a href="{{route('dashboard.marquee.menu.create')}}" class="btn btn-primary btn-sm waves-effect waves-light">Create</a>
                                                            <a href="{{route('dashboard.marquee.menu.index')}}" class="btn btn-dark btn-sm waves-effect waves-light float-right">Manage</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="card" id="img_card">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <h3 class="card-title font-24 flex-fill mr-4">Event Quotations</h3>
                                                                <div class="flex-fill"><i class="fas fa-dollar-sign fa-10x text-center text-dark mb-4"></i></div>
                                                            </div>
                                                            <a href="{{route('dashboard.marquee.quotation.booking.create')}}" class="btn btn-primary btn-sm waves-effect waves-light">Create</a>
                                                            <a href="{{route('dashboard.marquee.quotation.booking.index')}}" class="btn btn-dark btn-sm waves-effect waves-light float-right">Manage</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="card" id="img_card">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center">
                                                                <h3 class="card-title font-24 flex-fill mr-4">Stage Quotations</h3>
                                                                <div class="flex-fill"><i class="fas fa-dollar-sign fa-10x text-center text-dark mb-4"></i></div>
                                                            </div>
                                                            <a href="{{route('dashboard.marquee.quotation.stage.create')}}" class="btn btn-primary btn-sm waves-effect waves-light">Create</a>
                                                            <a href="{{route('dashboard.marquee.quotation.stage.index')}}" class="btn btn-dark btn-sm waves-effect waves-light float-right">Manage</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div><!-- container -->
                    @include('includes.dashboard-footer')
                </div>
            </div>
        </div>
     @endsection
@endsection


