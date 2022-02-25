@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('content')
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@include('includes.dashboard-breadcrumbs')
@section('body')


            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    {!! Form::model($model, ['route' => ['dashboard.marquee.stage-decorations.update', $model->id], 'method' => 'PUT', 'files' => true, 'class' => 'solid-validation'] ) !!}
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        {!! Html::decode(Form::label('name', 'Name <i class="text-danger">*</i>')) !!}
                                        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name','required']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('price', 'Price') !!}
                                        {!! Form::number('price', null, ['step'=>'any','min'=>'0','class' => 'form-control', 'id' => 'price']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('barcode', 'BarCode') !!}
                                        {!! Form::text('barcode', null, ['class' => 'form-control', 'id' => 'barcode']) !!}
                                    </div>
                                    @include('dashboard.accounts.common.buttons.buttons-crud', ['update' => true, 'cancel' => true, 'cancel_route' => 'dashboard.marquee.stage-decorations.index'])
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
    <script src="{{ asset('dashboard/plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        (function () {
            $('select').select2();
        })();
    </script>
@endsection
