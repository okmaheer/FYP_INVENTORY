@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('content')
@section('innerStyleSheet')
@endsection
@include('includes.dashboard-breadcrumbs')
@section('body')


    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::model($model, ['route' => ['dashboard.marquee.eventarea.update', $model->id], 'method' => 'PUT', 'files' => true, 'class' => 'solid-validation'] ) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! Html::decode(Form::label('name', 'Name <i class="text-danger">*</i>')) !!}
                                        {!! Form::text('name', $model->name, ['class' => 'form-control', 'id' => 'name','required']) !!}
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
                            @include('dashboard.accounts.common.buttons.buttons-crud', ['update' => true, 'cancel' => true, 'cancel_route' => 'dashboard.marquee.eventarea.index'])
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
