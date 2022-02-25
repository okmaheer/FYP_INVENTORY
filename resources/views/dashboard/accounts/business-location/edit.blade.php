@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')
    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="penal-title border-grey border-bottom">
                        <h4 class="p-3 text-dark">Software Settings</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link waves-effect waves-light active" id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true">General</a>
                                    <a class="nav-link waves-effect waves-light" id="v-pills-prefix-tab" data-toggle="pill" href="#v-pills-prefix" role="tab" aria-controls="v-pills-prefix" aria-selected="false">Voucher Prefixes</a>
                                </div>
                            </div>

                            <div class="col-md-9">
                                <div class="tab-content mo-mt-2" id="v-pills-tabContent">
                                    <!-- GENERAL SETTINGS TAB START -->
                                    <div class="tab-pane fade active show" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                                        {!! Form::model($model,['route' => 'dashboard.accounts.update.location-settings', 'files' => true, 'id' => 'setting_general_form'] ) !!}
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                {!!  Html::decode(Form::label('name' ,'Business Name <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-9">
                                                {!!  Form::text('name', null, ['id'=>'name','class'=>'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                {!!  Html::decode(Form::label('phone_1' ,'Phone 1' ,['class'=>'col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-9">
                                                {!!  Form::text('phone_1', null, ['id'=>'phone_1','class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                {!!  Html::decode(Form::label('phone_2' ,'Phone 2' ,['class'=>'col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-9">
                                                {!!  Form::text('phone_2', null, ['id'=>'phone_2','class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                {!!  Html::decode(Form::label('mobile_1' ,'Mobile 1' ,['class'=>'col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-9">
                                                {!!  Form::text('mobile_1', null, ['id'=>'mobile_1','class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                {!!  Html::decode(Form::label('mobile_2' ,'Mobile 2' ,['class'=>'col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-9">
                                                {!!  Form::text('mobile_2', null, ['id'=>'mobile_2','class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                {!!  Html::decode(Form::label('address_1' ,'Address Line 1' ,['class'=>'col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-9">
                                                {!!  Form::text('address_1', null, ['id'=>'address_1','class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                {!!  Html::decode(Form::label('address_2' ,'Address Line 2' ,['class'=>'col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-9">
                                                {!!  Form::text('address_2', null, ['id'=>'address_2','class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                {!!  Html::decode(Form::label('email' ,'Email' ,['class'=>'col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-9">
                                                {!!  Form::email('email', null, ['id'=>'email','class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                {!!  Html::decode(Form::label('website' ,'Website' ,['class'=>'col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-9">
                                                {!!  Form::text('website', null, ['id'=>'website','class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                {!!  Html::decode(Form::label('logo' ,'Logo' ,['class'=>'col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-9">
                                                {!!  Form::file('logo',['id'=>'logo','class'=>'dropify','data-default-file'=>asset($model->logo), 'data-allowed-file-extensions' => 'png']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                {!!  Html::decode(Form::label('date_format' ,'Date Format <i class="text-danger">*</i>' ,['class'=>'col-form-label ']))   !!}
                                            </div>
                                            <div class="col-sm-9 input-group">
                                                {!!  Form::text('date_format', null, ['id'=>'date_format','class'=>'form-control', 'required']) !!}
                                                <div class="input-group-append">
                                                    <span id="dateInformation" class="input-group-text tippy-btn" data-tippy-interactive="true" data-tippy-arrow="true" data-tippy-size="large" ><i class="fas fa-info-circle"></i></span>
                                                    <div id="info_html" data-template>
                                                        <div style="padding:20px">
                                                            <ul class="text-left">
                                                                <li>d - The day of the month (from 01 to 31)</li>
                                                                <li>j - The day of the month without leading zeros (1 to 31)</li>
                                                                <li>F - A full textual representation of a month (January through December)</li>
                                                                <li>m - A numeric representation of a month (from 01 to 12)</li>
                                                                <li>M - A short textual representation of a month (three letters)</li>
                                                                <li>n - A numeric representation of a month, without leading zeros (1 to 12)</li>
                                                                <li>Y - A four digit representation of a year</li>
                                                                <li>y - A two digit representation of a year</li>
                                                                {{--<li>a - Lowercase am or pm</li>
                                                                <li>A - Uppercase AM or PM</li>
                                                                <li>h - 12-hour format of an hour (01 to 12)</li>
                                                                <li>H - 24-hour format of an hour (00 to 23)</li>
                                                                <li>i - Minutes with leading zeros (00 to 59)</li>
                                                                <li>s - Seconds, with leading zeros (00 to 59)</li>--}}
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                {!! Form::submit('Update Settings', ['class' => 'btn btn-success btn-large']) !!}
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <!-- GENERAL SETTINGS TAB END -->

                                    <!-- PREFIXES TAB START -->
                                    <div class="tab-pane fade" id="v-pills-prefix" role="tabpanel" aria-labelledby="v-pills-prefix-tab">
                                        {!! Form::open(['route' => 'dashboard.settings.saveprefixes', 'files' => true, 'id' => 'setting_prefix_form'] ) !!}
                                        <div class="row">
                                            @foreach ($prefixes as $prefix)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        {!!  Html::decode(Form::label('prefix[value][]' ,$prefix->full_name ,['class'=>'col-form-label ']))   !!}
                                                        {!!  Form::hidden('prefix[id][]', $prefix->id)  !!}
                                                        {!!  Form::text('prefix[value][]',$prefix->prefix,['id'=>'prefix[value][]','class'=>'form-control ']) !!}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                {!! Form::submit('Update Prefixes', ['class' => 'btn btn-success btn-large']) !!}
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <!-- PREFIXES TAB END -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('includes.dashboard-footer')
        </div>
    @endsection
@endsection
@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/tippy/tippy.all.min.js') }}"></script>
    <script src="{{ asset('js/admin_js/settings.js') }}"></script>
@endsection
@section('innerScript')

    <script>
        $(document).ready(function () {
            $('.dropify').dropify();

            tippy('#dateInformation', {
                html: document.querySelector('#info_html'), // DIRECT ELEMENT option
                arrow: true,
                animation: 'fade'
            });
        });
    </script>
@endsection
