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
                    <div class="panel-title ">
                        <div class="row border-grey border-bottom">
                            <div class="col-md-12">
                                <h3 class="p-3 text-dark">{{__('accounts.employee_loan.add_loan')}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'dashboard.accounts.employee_loan.store', 'files' => true, 'id' => 'loan_form', 'class' => 'solid-validation'] ) !!}
                        {!! Form::hidden('loan_no',\App\Models\Prefixes::generateNumber('Loan'))  !!}

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
                                {!!  Form::select('employee_id',$employees,null,['id'=>'employee_id',
                                    'class'=>'select2 form-control', 'style' => 'width:100%',
                                    'onchange' => 'getLoanAmount();',
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
                                {!!  Html::decode(Form::label('return_type' ,__('accounts.employee_loan.return_type').'<i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}
                            </div>
                            <div class="col-md-4">
                                {!!  Form::select('return_type',\AccountHelper::loanReturnTypes(),null,['id'=>'return_type',
                                    'class'=>'select2 form-control', 'style' => 'width:100%',
                                    'onchange'=>'applyReturnCondition();',
                                    'placeholder'=>'Select Return Type'])
                                !!}
                            </div>
                        </div>
                        <div class="form-group row all-return" style="display: none;">
                            <div class="col-md-2">
                                {!!  Html::decode(Form::label('return_date' ,__('accounts.employee_loan.return_date').'<i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}
                            </div>
                            <div class="col-md-4 input-group">
                                {!!  Form::text('return_date',null,['id'=>'return_date', 'class'=>'form-control datepicker', 'autocomplete'=>'off'])  !!}
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row salary-deduct" style="display: none;">
                            <div class="col-md-2">
                                {!!  Html::decode(Form::label('deduct_type' ,__('accounts.employee_loan.deduct_type').'<i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}
                            </div>
                            <div class="col-md-4">
                                {!!  Form::select('deduct_type',\AccountHelper::FixPercentTypes(),null,['id'=>'deduct_type',
                                    'class'=>'select2 form-control', 'style' => 'width:100%',
                                    'onchange'=> 'calculateReturnAmount();',
                                    'placeholder'=>'Select Deduction Type'])
                                !!}
                            </div>
                        </div>
                        <div class="form-group row salary-deduct" style="display: none;">
                            <div class="col-md-2">
                                {!!  Html::decode(Form::label('deduct_value' ,__('accounts.employee_loan.deduct_value').'<i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}
                            </div>
                            <div class="col-md-4">
                                {!!  Form::number('deduct_value',null,['step'=>'any', 'id'=>'deduct_value', 'class'=>'form-control', 'placeholder'=>'0.00', 'onkeyup'=>'calculateReturnAmount()', 'onchange'=>'calculateReturnAmount()'])  !!}
                            </div>
                        </div>
                        {!!  Form::hidden('deduct_amount',null,['id'=>'deduct_amount'])  !!}

                        <div class="form-group row">
                            <div class="col-md-2">
                                {!!  Html::decode(Form::label('details' ,__('accounts.general.details'),['class'=>' col-form-label']))   !!}
                            </div>
                            <div class="col-md-4">
                                {!!  Form::textarea('details',null,['id'=>'details', 'class'=>'form-control', 'size'=>'30x2'])  !!}
                            </div>
                        </div>

                        @include('dashboard.accounts.common.buttons.buttons-crud', ['save' => true, 'reset' => true, 'cancel' => true, 'cancel_route' => 'dashboard.accounts.employee_loan.index'])
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
