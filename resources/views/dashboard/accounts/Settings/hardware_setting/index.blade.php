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
                    <div class="penal-tilte  border-grey border-bottom">
                        <h4 class="p-3 text-dark">Hardware Settings</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::model($model,['route' => 'settings.hardware.update', 'files' => true, 'id' => 'hardware_setting_form'] ) !!}
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link waves-effect waves-light active" id="v-pills-attendance-tab" data-toggle="pill" href="#v-pills-attendance" role="tab" aria-controls="v-pills-attendance" aria-selected="true">Attendance</a>
                                    <a class="nav-link waves-effect waves-light" id="v-pills-printer-tab" data-toggle="pill" href="#v-pills-printer" role="tab" aria-controls="v-pills-printer" aria-selected="false">Printer</a>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="tab-content mo-mt-2" id="v-pills-tabContent">
                                    <!-- ATTENDANCE TAB START -->
                                    <div class="tab-pane fade active show" id="v-pills-attendance" role="tabpanel" aria-labelledby="v-pills-attendance-tab">

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                {!!  Html::decode(Form::label('attendance_ip' ,'Attendance Machine IP' ,['class'=>'col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-9">
                                                {!!  Form::text('attendance_ip', $model->attendance_ip ,['id'=>'attendance_ip','class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                {!!  Html::decode(Form::label('attendance_port' ,'Attendance Machine Port' ,['class'=>'col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-9">
                                                {!!  Form::text('attendance_port', $model->attendance_port ,['id'=>'attendance_port','class'=>'form-control']) !!}
                                            </div>
                                        </div>

                                    </div>
                                    <!-- ATTENDANCE TAB END -->

                                    <!-- PRINTER TAB START -->
                                    <div class="tab-pane fade" id="v-pills-printer" role="tabpanel" aria-labelledby="v-pills-printer-tab">
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                {!!  Html::decode(Form::label('printer_ip' ,'Printer IP' ,['class'=>'col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-9">
                                                {!!  Form::text('printer_ip', $model->printer_ip ,['id'=>'printer_ip','class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                {!!  Html::decode(Form::label('printer_port' ,'Printer Port' ,['class'=>'col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-9">
                                                {!!  Form::text('printer_port', $model->printer_port ,['id'=>'printer_port','class'=>'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- PRINTER TAB END -->
                                </div>
                            </div>
                        </div>

                        @include('dashboard.accounts.common.buttons.buttons-crud', ['update' => true])
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
        $(document).ready(function () {
            $('.select2').select2();
        });

        $(document).on('submit', 'form#hardware_setting_form', function(e) {
            e.preventDefault();
            swal.fire({
                html: 'Please Wait!<br>Processing Request...',
                allowOutsideClick: () => !swal.isLoading()
            });
            swal.showLoading();

            var form = $(this);
            var data = form.serialize();

            $.ajax({
                method: 'POST',
                url: form.attr('action'),
                dataType: 'json',
                data: data,
                beforeSend: function() {
                    $(form.find('button[type="submit"]')).attr('disabled', true);
                },
                complete: function() {
                    $(form.find('button[type="submit"]')).attr('disabled', false);
                },
                success: function(result) {
                    swal.close();
                    if (result.success == true) {
                        toastr.success(result.msg);
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        });
    </script>


@endsection
