@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
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
                            {!! Form::open(['route' => 'dashboard.marquee.eventarea.store', 'method' => 'POST', 'files' => true, 'id' => 'area_form', 'class' => 'solid-validation'] ) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Html::decode(Form::label('name', 'Name <i class="text-danger">*</i>')) !!}
                                        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name','required']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('bgColor', 'Calendar Color') !!}
                                        {!! Form::color('bgColor', null, ['class' => 'form-control', 'id' => 'bgColor','required']) !!}
                                    </div>
                                </div>
                            </div>
                            @include('dashboard.accounts.common.buttons.buttons-crud', ['save' => true, 'save_new' => true, 'form_id' => 'area_form', 'cancel' => true, 'cancel_route' => 'dashboard.marquee.eventarea.index'])
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@endsection
@section('innerScriptFiles')

@endsection
@section('innerScript')

@endsection
