@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@include('includes.dashboard-breadcrumbs')
@section('body')
    <div class="page-content">
        <div class="container-fluid">
            {!! Form::open(['route' => 'dashboard.marquee.booking.store', 'files' => true,] ) !!}
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    {!!  Html::decode(Form::label('customer_option' ,'Do No' ,['class'=>'col-form-label text-left']))   !!}
                                    <div class="input-group">
                                        {!!  Form::text('sec_contact_no',null,['id'=>'sec_contact_no','class'=>'form-control ','placeholder'=>'Enter Do No']) !!}

                                    </div>
                                    {!!  Html::decode(Form::label('sec_contact_no' ,'Request Dat' ,['class'=>'col-form-label text-right']))   !!}
                                    <div class="input-group">
                                        {!!  Form::date('sec_contact_no',null,['id'=>'sec_contact_no','class'=>'form-control ','placeholder'=>'']) !!}

                                    </div>

                                    {!!  Html::decode(Form::label('event_area' ,'Delivery Location' ,['class'=>'col-form-label text-left']))   !!}
                                    <div class="input-group">
                                        {!!  Form::select('event_area', AccountHelper::eventArea(),null,['id'=>'event_area','class'=>'select2 form-control mb-3 custom-select float-right','placeholder'=>'location'])
                                            !!}
                                    </div>
                                    {!!  Html::decode(Form::label('event_date' ,'Food Issue by' ,['class'=>'col-form-label text-right']))   !!}
                                    <div class="input-group ">
                                        {!!  Form::select('event_area', AccountHelper::eventArea(),null,['id'=>'event_area','class'=>'select2 form-control mb-3 custom-select float-right','placeholder'=>'Food Issue by'])
                                        !!}
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    {!!  Html::decode(Form::label('phone_number' ,'Request Generted BY ' ,['class'=>'col-form-label text-right']))   !!}
                                    <div class="input-group ">
                                        {!!  Form::select('event_area', MarqueeHelper::departments(),null,['id'=>'event_area','class'=>'select2 form-control mb-3 custom-select float-right','placeholder'=>'Select HR'])
                                        !!}
                                    </div>

                                    {!!  Html::decode(Form::label('national_id_card' ,'Delivery Dat' ,['class'=>'col-form-label text-right ml-1']))   !!}
                                    <div class="input-group ">
                                        {!!  Form::date('national_id_card',null,['id'=>'national_id_card','class'=>'form-control ','placeholder'=>'33100-1106497-4']) !!}

                                    </div>
                                    {!!  Html::decode(Form::label('address' ,' Phone No' ,['class'=>'col-form-label text-right']))   !!}
                                    <div class="input-group ">
                                        {!!  Form::text('address',null,['id'=>'address','class'=>'form-control ','placeholder'=>'No']) !!}
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-address-book"></i></span>
                                        </div>
                                    </div>
                                    {!!  Html::decode(Form::label('booking_detail' ,'Adresss' ,['class'=>'col-form-label text-right']))   !!}
                                    <div class="input-group ">
                                        {!! Form::text('booking_detail',null,['id'=>'booking_detail','class' => 'form-control', 'size' => '20x5','placeholder'=>'Address1']) !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-white bg-transparent py-0">
                            <h4 class="mt-1 ml-2 header-title">
                                {!!  Html::decode(Form::label('food_items' ,'Demand Items' ,['class'=>'col-form-label text-right']))   !!}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center form-group">
                                {{-- <div class="col-md-6">
                                    {!!  Form::select('menus',MarqueeHelper::pluckMenus(),null,['id'=>'menus','class'=>'form-control ','placeholder'=>'Select Menu','onchange'=>'getMenuFoodItems(this);']) !!}
                                    <small class="text-info">Select menu and then all of the food item for this menu
                                        will automatically
                                        load</small>
                                </div> --}}
                            </div>
                            @include('dashboard.marquee.demand.comp.food-items')
                            {!! Form::submit('Submit', array('class' => 'btn btn-success float-right')) !!}
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

