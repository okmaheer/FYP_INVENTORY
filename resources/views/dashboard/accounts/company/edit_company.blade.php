@extends('layouts.dashboard')
@section('page_title', trans('accounts.company.modify_company'))
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('includes.dashboard-breadcrumbs')
    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="panel-title border-grey border-bottom">
                        <h3 class="p-3 text-dark">{{ trans('accounts.company.modify_company') }}</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::model($company, [ 'route' => ['dashboard.accounts.companies.update', $company->id], 'files' => true, 'class' => 'solid-validation'] ) !!}
                        @method('PATCH')
                        {!! Form::hidden('id',null) !!}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        {!!  Html::decode(Form::label('company_name', trans("accounts.general.company_name") . '<i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
                                    </div>
                                    <div class="col-sm-8">
                                        {!!  Form::text('company_name',null,['id'=>'company_name','class'=>'form-control ','placeholder'=>trans('accounts.general.company_name'),'required'=>'']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        {!!  Html::decode(Form::label('gstn', trans("accounts.general.gstn") ,['class'=>'col-form-label text-left']))   !!}
                                    </div>
                                    <div class="col-sm-8">
                                        {!!  Form::text('gstn',null,['id'=>'gstn','class'=>'form-control ','placeholder'=>trans('accounts.general.gstn')]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        {!!  Html::decode(Form::label('email', trans("accounts.general.email") ,['class'=>'col-form-label text-left']))   !!}
                                    </div>
                                    <div class="col-sm-8">
                                        {!!  Form::email('email',null,['id'=>'email','class'=>'form-control ','placeholder'=>trans('accounts.general.email')]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        {!!  Html::decode(Form::label('website', trans("accounts.general.website") ,['class'=>'col-form-label text-left']))   !!}

                                    </div>
                                    <div class="col-sm-8">
                                        {!!  Form::url('website',null,['id'=>'website','class'=>'form-control ','placeholder'=>trans('accounts.general.website')]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        {!!  Html::decode(Form::label('mobile', trans("accounts.general.mobile") ,['class'=>'col-form-label text-left']))   !!}
                                    </div>
                                    <div class="col-sm-8">
                                        {!!  Form::text('mobile',null,['id'=>'mobile','class'=>'form-control ','placeholder'=>trans('accounts.general.mobile')]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        {!!  Html::decode(Form::label('phone', trans("accounts.general.phone") ,['class'=>'col-form-label text-left']))   !!}
                                    </div>
                                    <div class="col-sm-8">
                                        {!!  Form::text('phone',null,['id'=>'phone','class'=>'form-control ','placeholder'=>trans('accounts.general.phone')]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        {!!  Html::decode(Form::label('address', trans("accounts.general.address") ,['class'=>'col-form-label text-left']))   !!}
                                    </div>
                                    <div class="col-sm-10">
                                        {!!  Form::textarea('address',null,['id'=>'address','class'=>'form-control ','placeholder'=>trans('accounts.general.address'), 'rows'=>'2']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        {!!  Html::decode(Form::label('logo', trans("accounts.general.logo") ,['class'=>'col-form-label text-left']))   !!}
                                        <p class="text-muted">Size 128x128 pixels</p>
                                    </div>
                                    <div class="col-md-4">
                                        {!!  Form::file('logo', ['id'=>'logo', 'class'=>'dropify', 'data-default-file'=>asset($company->logo)]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('dashboard.accounts.common.buttons.buttons-crud', ['update' => true, 'cancel' => true, 'cancel_route' => 'dashboard.accounts.companies.index'])
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endsection
@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/dropify/js/dropify.min.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        (function () {
            $('select').select2();
            $('.dropify').dropify();
        })();
    </script>
@endsection
