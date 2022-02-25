@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')
    <div class="page-wrapper">
        <div class="page-wrapper-inner">
            @include('includes.dashboard-nav-bar')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    {!! Form::model($model, ['route' => ['dashboard.marquee.seat-plannings.update', $model->id], 'method' => 'PUT', 'files' => true] ) !!}
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        {!! Form::label('name', 'Name') !!}
                                        {!! Form::text('name', null, ['class' => 'form-control', 'required', 'id' => 'name','required']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('price', 'Price') !!}
                                        {!! Form::number('price', null, ['step'=>'any','min'=>'0','class' => 'form-control', 'required', 'id' => 'price','required']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('barcode', 'BarCode') !!}
                                        {!! Form::text('barcode', null, ['class' => 'form-control', 'required', 'id' => 'barcode','required']) !!}
                                    </div>
                                    <div class="form-group text-right">
                                        {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
                                        <button type="button" class="btn btn-danger">Cancel</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
