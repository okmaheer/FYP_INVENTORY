@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
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
                            <div class="col-sm-3">
                                <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link waves-effect waves-light active" id="v-pills-general-tab" data-toggle="pill" href="#v-pills-general" role="tab" aria-controls="v-pills-general" aria-selected="true">General</a>
                                    <a class="nav-link waves-effect waves-light" id="v-pills-prefix-tab" data-toggle="pill" href="#v-pills-prefix" role="tab" aria-controls="v-pills-prefix" aria-selected="false">Voucher Prefixes</a>
                                </div>
                            </div>
                            <div class="col-sm-9">

                                <div class="tab-content mo-mt-2" id="v-pills-tabContent">
                                    <!-- GENERAL SETTINGS TAB START -->
                                    <div class="tab-pane fade active show" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                                        {!! Form::model($general,['route' => 'dashboard.settings.savegeneral', 'files' => true, 'id' => 'setting_general_form'] ) !!}
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                {!!  Html::decode(Form::label('logo' ,'Logo  <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-9">
                                                {!!  Form::file('logo',['id'=>'logo','class'=>'form-control ','data-default-file'=>asset($general->logo)]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                {!!  Html::decode(Form::label('footer_text' ,'Footer Text <i class="text-danger">*</i>' ,['class'=>'col-form-label ']))   !!}
                                            </div>
                                            <div class="col-sm-9">
                                                {!!  Form::text('footer_text',$general->footer_text,['id'=>'footer_text','class'=>'form-control ','placeholder'=>'Copyright© 2021 OptimumTech. All rights reserved.']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                {!!  Html::decode(Form::label('date_format' ,'Date Format <i class="text-danger">*</i>' ,['class'=>'col-form-label ']))   !!}
                                            </div>
                                            <div class="col-sm-9 input-group">
                                                {!!  Form::text('date_format',$general->date_format,['id'=>'date_format','class'=>'form-control ']) !!}
                                                <div class="input-group-append">
                                                    <span id="myElement" class="input-group-text tippy-btn" data-tippy-interactive="true" data-tippy-arrow="true" data-tippy-size="large" ><i class="fas fa-info-circle"></i></span>
                                                    <div id="feature__html" data-template>
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
                                                {!! Form::submit('Update', ['class' => 'btn btn-success btn-large']) !!}
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <!-- GENERAL SETTINGS TAB END -->

                                    <!-- PREFIXES TAB START -->
                                    <div class="tab-pane fade" id="v-pills-prefix" role="tabpanel" aria-labelledby="v-pills-prefix-tab">
                                        {!! Form::model($general,['route' => 'dashboard.settings.saveprefixes', 'files' => true, 'id' => 'setting_prefix_form'] ) !!}
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

                        {{--<div class="general-label">
                            {!! Form::model($settings,['route' => 'dashboard.accounts.settings.store',$settings->id, 'files' => true] ) !!}
                            {!! csrf_field() !!}

                            <div class="form-group row">
                                <div class="col-sm-2">
                                    {!!  Html::decode(Form::label('logo' ,'Logo  <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                </div>
                                <div class="col-sm-10">
                                    {!!  Form::file('logo',['id'=>'logo','class'=>'form-control ','data-default-file'=>asset($settings->logo)]) !!}
                                    {!! Form::hidden('id',null) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-2">
                                    {!!  Html::decode(Form::label('footer_text' ,'Footer Text <i class="text-danger">*</i>' ,['class'=>'col-form-label ']))   !!}
                                </div>
                                <div class="col-sm-10">
                                    {!!  Form::text('footer_text',$settings->footer_text,['id'=>'footer_text','class'=>'form-control ','placeholder'=>'Copyright© 2021 Devsbeta. All rights reserved.']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    {!!  Html::decode(Form::label('date_format' ,'Date Format <i class="text-danger">*</i>' ,['class'=>'col-form-label ']))   !!}
                                </div>
                                <div class="col-sm-10 input-group">
                                    {!!  Form::text('date_format',$settings->date_format,['id'=>'date_format','class'=>'form-control ']) !!}
                                    <div class="input-group-append">
                                        <span id="myElement" class="input-group-text tippy-btn" data-tippy-interactive="true" data-tippy-arrow="true" data-tippy-size="large" ><i class="fas fa-info-circle"></i></span>
                                        <div id="feature__html" data-template>
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
                                                    <li>a - Lowercase am or pm</li>
                                                    <li>A - Uppercase AM or PM</li>
                                                    <li>h - 12-hour format of an hour (01 to 12)</li>
                                                    <li>H - 24-hour format of an hour (00 to 23)</li>
                                                    <li>i - Minutes with leading zeros (00 to 59)</li>
                                                    <li>s - Seconds, with leading zeros (00 to 59)</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    {!! Form::submit('Save ', array('class' => 'btn btn-success btn-large')) !!}


                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>--}}
                    </div>
                    <!--end card-body-->
                </div>
            </div><!-- container -->

            @include('includes.dashboard-footer')
        </div>

    @endsection
@endsection

@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/tippy/tippy.all.min.js') }}"></script>
    <script src="{{ asset('dashboard/pages/jquery.tooltipster.js') }}"></script>
    <script src="{{ asset('js/admin_js/settings.js') }}"></script>
@endsection
@section('innerScript')

    <script>
        $(document).ready(function () {
            $('.select2').select2();
            $('input[type=file]').dropify();
        });
    </script>


@endsection


