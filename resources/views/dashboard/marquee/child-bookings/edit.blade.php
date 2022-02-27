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
                {!! Form::model($model, ['route' => ['dashboard.marquee.add-on-invoice.update', $model->id], 'method' => 'PUT', 'files' => true,'id' => 'booking_form', 'class' => 'solid-validation'] ) !!}
                {!! Form::hidden('custom_booking_number',$model->custom_booking_number) !!}
                {!! Form::hidden('parent_booking_id',$model->parent_booking_id) !!}
                {!! Form::hidden('is_child',1) !!}
                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="panel-title ">
                                <div class="row border-grey border-bottom">
                                    <div class="col-lg-12">
                                        <h3 class="p-3 text-dark text-center">Addon Booking Form</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                {!! Form::label('status','Status') !!}
                                {!! Form::select('status',MarqueeHelper::getBookingStatuses(),null,['class'=>'form-control','placeholder'=>'Change Status']) !!}
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                @include('dashboard.marquee.child-bookings.components.general',['for'=>'edit'])
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-white bg-transparent py-0">
                                <h4 class="mt-1 ml-2 header-title">
                                    {!!  Html::decode(Form::label('food_items' ,'Food Menu' ,['class'=>'col-form-label text-right']))   !!}
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center form-group">
                                    <div class="col-md-6">
                                        {!!  Form::select('menus',MarqueeHelper::pluckMenus(),null,['id'=>'menus','class'=>'form-control ','placeholder'=>'Select Menu','onchange'=>'getMenuFoodItems(this);']) !!}
                                        <br /><small class="text-info">Select menu and then all of the food item for this menu
                                            will automatically
                                            load</small>
                                    </div>
                                    <div class="col-md-2">
                                        {{ Form::button('Reset', ['class' => 'btn btn-danger','onclick' => 'ResetFoodMenu();']) }}
                                    </div>
                                </div>
                                @include('dashboard.marquee.bookings.components.food-items',['for'=>'edit'])
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-white bg-transparent py-0">
                                <h4 class="mt-1 ml-2 header-title">
                                    {!!  Html::decode(Form::label('extra_food_items' ,'EXTRA FOOD ITEMS' ,['class'=>'col-form-label text-right']))   !!}
                                </h4>
                            </div>
                            <div class="card-body">
                                @include('dashboard.marquee.child-bookings.components.extra-food-item',['for'=>'edit'])
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-white bg-transparent py-0">
                                <h4 class="mt-1 ml-2 header-title">
                                    {!!  Html::decode(Form::label('add_on_features' ,'ADD ON SERVICES ' ,['class'=>'col-form-label text-right']))   !!}
                                </h4>
                            </div>
                            <div class="card-body">
                                @include('dashboard.marquee.bookings.components.add-on-features',['for'=>'edit'])
                            </div>
                        </div>
                        {{--<div class="card">
                            <div class="card-header bg-white bg-transparent py-0">
                                <h4 class="mt-1 ml-2 header-title">
                                    {!!  Html::decode(Form::label('seat_plannings' ,'Seat Plannings' ,['class'=>'col-form-label text-right']))   !!}
                                </h4>
                            </div>
                            <div class="card-body">
                                @include('dashboard.marquee.bookings.components.seat-plannings',['for'=>'edit'])
                            </div>
                        </div>--}}
                        <div class="card">
                            <div class="card-header bg-white bg-transparent py-0">
                                <h4 class="mt-1 ml-2 header-title">
                                    {!!  Html::decode(Form::label('booking_detail' ,'SPECIAL INSTRUCTIONS' ,['class'=>'col-form-label text-right']))   !!}
                                </h4>
                            </div>
                            <div class="card-body">
                                {!!  Html::decode(Form::label('additional_charges' ,'Additional Charges' ,['class'=>'col-form-label text-right']))   !!}
                                <div class="form-group">
                                    {!! Form::number('additional_charges',null,['id'=>'additional_charges','class' => 'form-control col-md-3','placeholder'=>'0.00', 'onkeyup'=>'applyCalculations();', 'tabindex' => 37]) !!}
                                </div>
                                <div class="input-group ">
                                    {!! Form::textarea('booking_detail',null,['id'=>'booking_detail','class' => 'form-control', 'size' => '20x5','placeholder'=>'Details']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                @include('dashboard.marquee.child-bookings.components.totals', ['for'=>'edit'])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-right">
                        <div class="card">
                            <div class="card-body">
                                @include('dashboard.accounts.common.buttons.buttons-crud', ['update' => true, 'update_print' => true, 'form_id' => 'booking_form',
                                    'cancel' => true, 'cancel_route' => 'dashboard.marquee.add-on-invoice.index'])
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    @endsection
@endsection
@include('dashboard.marquee.child-bookings.common-script', ['for'=>'edit'])