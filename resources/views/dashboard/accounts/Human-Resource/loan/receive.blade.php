@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')
    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    @include('includes.messages')
                    <div class="panel-title ">
                        <div class="row border-grey border-bottom">
                            <div class="col-md-12">
                                <h3 class="p-3 text-dark">{{__('accounts.employee_loan.receive_loan')}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'employee.loan.add.receive', 'files' => true, 'id' => 'loan_receive_form', 'class' => 'solid-validation'] ) !!}
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!!  Html::decode(Form::label('date' ,__('accounts.general.date') ,['class'=>' col-form-label']))   !!}
                            </div>
                            <div class="col-md-4 input-group">
                                {!!  Form::text('date',\AccountHelper::date_format(\Carbon\Carbon::today()->toDateString()),['id'=>'date', 'class'=>'form-control datepicker', 'autocomplete'=>'off'])  !!}
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!!  Html::decode(Form::label('employee_id' ,__('accounts.general.employee').'<i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}
                            </div>
                            <div class="col-md-4">
                                {!!  Form::select('employee_id',$loanEmployees,null,['id'=>'employee_id',
                                    'class'=>'select2 form-control', 'style' => 'width:100%',
                                    'onchange' => 'getLoanReceiveData();',
                                    'placeholder'=>'Select Employee', 'required'])
                                !!}
                            </div>
                        </div>
                        <div class="form-group row loan-row" style="display: none;">
                            <div class="col-md-2">
                                {!!  Html::decode(Form::label('loan_amount_display' ,__('accounts.employee_loan.loan_amount') ,['class'=>' col-form-label']))   !!}
                            </div>
                            <div class="col-md-4">
                                {!!  Form::hidden('loan_amount',null,['id'=>'loan_amount'])  !!}
                                {!!  Form::text('loan_amount_display',null,['id'=>'loan_amount_display', 'class'=>'form-control text-right', 'readonly' , 'tabindex'=>'-1'])  !!}
                            </div>
                        </div>
                        <div class="form-group row loan-row" style="display: none;">
                            <div class="col-md-2">
                                {!!  Html::decode(Form::label('amount_received' ,__('accounts.employee_loan.received_amount').'<i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}
                            </div>
                            <div class="col-md-4">
                                {!!  Form::number('amount_received',null,['step'=>'any','id'=>'amount_received', 'class'=>'form-control text-right', 'placeholder'=>'0.00', 'onkeyup'=>'loanReceiveCalculation();', 'onchange'=>'loanReceiveCalculation();'])  !!}
                            </div>
                        </div>
                        <div class="form-group row loan-row" style="display: none;">
                            <div class="col-md-2">
                                {!!  Html::decode(Form::label('loan_remain' ,__('accounts.employee_loan.loan_remain') ,['class'=>' col-form-label']))   !!}
                            </div>
                            <div class="col-md-4">
                                {!!  Form::text('loan_remain','0.00',['id'=>'loan_remain', 'class'=>'form-control text-right', 'readonly' , 'tabindex'=>'-1'])  !!}
                            </div>
                        </div>
                        @include('dashboard.accounts.common.buttons.buttons-crud', ['save' => true, 'save_print' => true, 'form_id' => 'loan_receive_form', 'reset' => true, 'cancel' => true, 'cancel_route' => 'dashboard.accounts.employee_loan.index'])
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
    <script src="{{ asset('js/admin_js/employee_loan.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
