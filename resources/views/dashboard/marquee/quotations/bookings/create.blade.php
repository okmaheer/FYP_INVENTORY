@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')
    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                {!! Form::open(['route' => 'dashboard.marquee.quotation.booking.store', 'files' => true,'id' => 'booking_form', 'class' => 'solid-validation'] ) !!}
                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="panel-title ">
                                <div class="row border-grey border-bottom">
                                    <div class="col-lg-12">
                                        <h3 class="p-3 text-dark text-center">Booking Quotation Form</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('dashboard.marquee.quotations.common-components.general')
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-white bg-transparent py-0">
                                <h4 class="mt-1 ml-2 header-title">
                                    {!!  Html::decode(Form::label('food_items' ,'Food Menu ' ,['class'=>'col-form-label text-right']))   !!}
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center form-group">
                                    <div class="col-md-6">
                                        {!!  Form::select('menus',MarqueeHelper::pluckMenus(),null,['id'=>'menus','class'=>'form-control select2','placeholder'=>'Select Menu','onchange'=>'getMenuFoodItems(this);','tabindex' => 18]) !!}
                                        <br /><small class="text-info ml-3">Select menu and then all of the food item for this menu
                                            will automatically
                                            load</small>
                                    </div>
                                    <div class="col-md-2">
                                        {{ Form::button('Reset', ['class' => 'btn btn-danger','onclick' => 'ResetFoodMenu();']) }}
                                    </div>
                                </div>
                                @include('dashboard.marquee.bookings.components.food-items')
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-white bg-transparent py-0">
                                <h4 class="mt-1 ml-2 header-title">
                                    {!!  Html::decode(Form::label('extra_food_items' ,'Extra Food Items' ,['class'=>'col-form-label text-right']))   !!}
                                </h4>
                            </div>
                            <div class="card-body">
                                @include('dashboard.marquee.bookings.components.extra-food-item')
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-white bg-transparent py-0">
                                <h4 class="mt-1 ml-2 header-title">
                                    {!!  Html::decode(Form::label('add_on_features' ,'Addon Services' ,['class'=>'col-form-label text-right']))   !!}
                                </h4>
                            </div>
                            <div class="card-body">
                                @include('dashboard.marquee.bookings.components.add-on-features')
                            </div>
                        </div>

                        {{--<div class="card">
                            <div class="card-header bg-white bg-transparent py-0">
                                <h4 class="mt-1 ml-2 header-title">
                                    {!!  Html::decode(Form::label('seat_plannings' ,'Sitting Plan' ,['class'=>'col-form-label text-right']))   !!}
                                </h4>
                            </div>
                            <div class="card-body">
                                @include('dashboard.marquee.bookings.components.seat-plannings')
                            </div>
                        </div>--}}
                        <div class="card">
                            <div class="card-header bg-white bg-transparent py-0">
                                <h4 class="mt-1 ml-2 header-title">
                                    {!!  Html::decode(Form::label('booking_detail' ,'Additional Details' ,['class'=>'col-form-label text-right']))   !!}
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="input-group ">
                                    {!! Form::textarea('booking_detail',null,['id'=>'booking_detail','class' => 'form-control', 'size' => '20x5','placeholder'=>'Details','tabindex' => 32]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                @include('dashboard.marquee.quotations.common-components.totals')
                                @include('dashboard.accounts.common.buttons.buttons-crud', ['save' => true, 'save_print' => true, 'form_id' => 'booking_form',
                                    'reset' => true, 'cancel' => true, 'cancel_route' => 'dashboard.marquee.quotation.booking.index'])
                            </div>
                        </div>
                    </div>
                </div>



                {!! Form::close() !!}
            </div>
        </div>

    @endsection
@endsection
@include('dashboard.marquee.bookings.common-script')
