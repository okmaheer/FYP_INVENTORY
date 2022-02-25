@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')

    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="penal-title ">
                        <h4 class="p-3 text-dark">{{ __('accounts.tax.modify_tax') }}</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::model($model, ['route' => ['dashboard.accounts.tax.update', $model->id], 'method' => 'PATCH', 'files' => true, 'class' => 'solid-validation'] ) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        {!!  Html::decode(Form::label('tax_name' ,__('accounts.tax.tax_name').'<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
                                    </div>
                                    <div class="col-md-9">
                                        {!!  Form::text('tax_name',$model->tax_name,['id'=>'tax_name','class'=>'form-control ','placeholder'=>__('accounts.tax.tax_name'), 'required']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        {!!  Html::decode(Form::label('tax_type' ,__('accounts.tax.tax_type').'<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
                                    </div>
                                    <div class="col-md-9">
                                        {!!  Form::select('tax_type', \AccountHelper::FixPercentTypes(),$model->tax_type,['id'=>'tax_type',
                                            'class'=>'select2 form-control mb-3 custom-select float-right',
                                            'style' => 'width: 100%',
                                            'placeholder'=>'Select Tax Type','required'])
                                        !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        {!!  Html::decode(Form::label('tax_value' ,__('accounts.general.value').'<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
                                    </div>
                                    <div class="col-md-9">
                                        {!!  Form::number('tax_value',$model->tax_value,['min'=> '0', 'id'=>'tax_value','class'=>'form-control ', 'required']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        {!!  Html::decode(Form::label('status' ,__('accounts.general.status'),['class'=>'col-form-label text-right']))   !!}
                                    </div>
                                    <div class="col-md-9">
                                        {!!  Form::select('status', \AccountHelper::manualStatus(),$model->status,['id'=>'status',
                                            'class'=>'select2 form-control mb-3 custom-select float-right',
                                            'style' => 'width: 100%'])
                                        !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('dashboard.accounts.common.buttons.buttons-crud', ['update' => true, 'reset' => true, 'cancel' => true, 'cancel_route' => 'dashboard.accounts.tax.index'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            @include('includes.dashboard-footer')
        </div>
    @endsection
@endsection
@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        (function () {
            $('.select2').select2();
        })();
    </script>
@endsection
