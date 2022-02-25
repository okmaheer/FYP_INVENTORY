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
                                    {!! Form::model($model, ['route' => ['dashboard.marquee.add-on-features.update', $model->id], 'method' => 'PUT', 'files' => true, 'id' => 'addon_form', 'class' => 'solid-validation'] ) !!}
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        {!! Html::decode(Form::label('name', 'Name <i class="text-danger">*</i>')) !!}
                                        {!! Form::text('name', null, ['class' => 'form-control', 'required', 'id' => 'name']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('price', 'Price') !!}
                                        {!! Form::number('price', null, ['step'=>'any','min'=>'0','class' => 'form-control', 'id' => 'price']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('barcode', 'BarCode') !!}
                                        {!! Form::text('barcode', null, ['class' => 'form-control', 'id' => 'barcode']) !!}
                                    </div>
                                    @include('dashboard.accounts.common.buttons.buttons-crud', ['update' => true, 'cancel' => true, 'cancel_route' => 'dashboard.marquee.add-on-features.index'])
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
