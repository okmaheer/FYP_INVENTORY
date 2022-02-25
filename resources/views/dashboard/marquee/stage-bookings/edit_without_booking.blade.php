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
                {!! Form::model($model,['route' => ['dashboard.marquee.stage.booking.update',$model->id],'method' => 'PUT', 'files' => true, 'id' => 'booking_form', 'class' => 'solid-validation'] ) !!}
                {!! Form::hidden('custom_stage_number',$model->custom_stage_number, ['id' => 'custom_stage_number']) !!}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="panel-title ">
                                <div class="row border-grey border-bottom">
                                    <div class="col-lg-12">
                                        <h3 class="p-3 text-dark text-center">Stage Booking Form</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('dashboard.marquee.stage-bookings.components.generalwob',['for'=>'edit'])
                            </div>
                        </div>
                        {{--                    <div class="card">--}}
                        {{--                        <div class="card-header bg-white bg-transparent py-0">--}}
                        {{--                            <h4 class="mt-1 ml-2 header-title">--}}
                        {{--                                {!!  Html::decode(Form::label('stage_information' ,'Fill Stage Information ' ,['class'=>'col-form-label text-right']))   !!}--}}
                        {{--                            </h4>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="card-body">--}}
                        {{--                            @include('dashboard.marquee.bookings.components.stage-information')--}}
                        {{--                        </div>--}}
                        {{--                    </div>--}}
                        <div class="card">
                            <div class="card-header bg-white bg-transparent py-0">
                                <h4 class="mt-1 ml-2 header-title">
                                    {!!  Html::decode(Form::label('stage_decoration' ,'Stage Decoration ' ,['class'=>'col-form-label text-right']))   !!}
                                </h4>
                            </div>
                            <div class="card-body">
                                @include('dashboard.marquee.stage-bookings.components.stage-decorations',['for'=>'edit'])
                            </div>
                        </div>
                    </div>
                </div>
                @include('dashboard.marquee.stage-bookings.components.totalswob',['for'=>'edit'])
                <div class="row">
                    <div class="col-12 text-right">
                        <div class="card">
                            <div class="card-body">
                                @include('dashboard.accounts.common.buttons.buttons-crud', ['update' => true, 'update_print' => true, 'form_id' => 'booking_form',
                                    'cancel' => true, 'cancel_route' => 'dashboard.marquee.stage.booking.index'])
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        @include('dashboard.marquee.bookings.components.customer-model')
    @endsection
@endsection
@include('dashboard.marquee.stage-bookings.common-script', ['for'=>'edit'])
