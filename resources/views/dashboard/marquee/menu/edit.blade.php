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
            {!! Form::model($model, ['route' => ['dashboard.marquee.menu.update', $model->id], 'files' => true, 'id' => 'menu_form', 'class' => 'solid-validation'] ) !!}
            @method('PATCH')
                <div class="card">
                    <div class="panel-title ">
                        <div class="row border-grey border-bottom">
                            <div class="col-lg-6">
                                <h3 class="p-3 text-dark">{{ $page_title }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body justify-content-center" style="width:96%;">
                        <div class="row">
                            <div class="col-lg-12">
                                @include('dashboard.marquee.menu.components.general', ['for'=>'edit'])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="panel-title ">
                        <div class="row border-grey border-bottom">
                            <div class="col-lg-6">
                                <h3 class="p-3 text-dark">Menu Dishes</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body justify-content-center" style="width:96%;">
                        <div class="row">
                            <div class="col-lg-12">
                                @include('dashboard.marquee.menu.components.items', ['for'=>'edit'])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body justify-content-center" style="width:100%;">
                        <div class="row mb-3">
                            <div class="col-md-7">&nbsp;</div>
                            <div class="col-md-5 text-right ">
                                <div class="row">
                                    <div class="col-md-5">
                                        {!!  Form::label('estimated_cost' ,'Estimated Cost:' ,['class'=>'col-form-label text-right ml-5'])  !!}
                                    </div>
                                    <div class="col-md-7">
                                        {!!  Form::text('estimated_cost',null,['min'=>'0','id'=>'estimated_cost','class'=>'form-control cost text-right','readonly']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('dashboard.accounts.common.buttons.buttons-crud', ['update' => true,
                            'form_id' => 'menu_form', 'cancel' => true, 'cancel_route' => 'dashboard.marquee.menu.index'])

                    </div>
                </div>
            {!! Form::close() !!}
            </div>
            @include('includes.dashboard-footer')
        </div>
    @endsection
@endsection

@include('dashboard.marquee.menu.common-scripts', ['for'=>'edit'])
