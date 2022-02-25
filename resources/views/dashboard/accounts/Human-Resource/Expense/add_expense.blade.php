@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')
    @section('body')
        <div class="page-content">
            <div class="container-fluid">

                    <div class="card">
                        <div class="panel-title ">
                            <div class="row border-grey border-bottom">
                                <div class="col-md-7">
                                    <h3 class="p-3 text-dark">{{__('accounts.expense.add_expense')}}</h3>
                                </div>
                                <div class="d-flex col-md-5 align-items-center justify-content-end">
                                    <h3 id="amount_span" class="text-dark p-3" style="display: none;">
                                        {{ __('accounts.general.current_balance') }}: <b><span id="amount_balance" class="text-muted">0.00</span></b>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="general-label">
                                {!! Form::open(['route' => 'dashboard.accounts.expense.store', 'files' => true, 'id' => 'voucher_form', 'class' => 'solid-validation'] ) !!}
                                {!! csrf_field() !!}


                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            {!!  Html::decode(Form::label('date' ,__('accounts.expense.date').'<i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}
                                        </div>
                                        <div class="col-md-5 input-group">
                                            {!!  Form::text('date',\AccountHelper::date_format(\Carbon\Carbon::today()),['id'=>'date','class'=>'form-control datepicker','required','autocomplete'=>'off']) !!}
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            {!!  Html::decode(Form::label('expense_head' ,__('accounts.expense.e_head').'<i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                        </div>
                                        <div class="col-md-5">
                                            {!!  Form::select('expense_head',$expenseHeads,null,['id'=>'expense_head',
                                                    'class'=>'select2 form-control mb-3 custom-select float-right',
                                                    'placeholder'=>'Select Expense Head', 'required'])
                                            !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            {!!  Html::decode(Form::label('payment_account' ,__('accounts.general.payment_account').'<i class="text-danger">*</i>' ,['class'=>' text-right col-form-label']))   !!}
                                        </div>
                                        <div class="col-md-5">
                                            {!!  Form::select('payment_account',$pettyCashAccounts,null,['id'=>'payment_account',
                                                    'class'=>'select2 form-control mb-3 custom-select float-right', 'style'=>'width:100%',
                                                    'onchange'=>'getAccountBalance(this, "amount_balance", null, "amount_span");',
                                                    'placeholder'=>'Select Payment Account', 'required'])
                                            !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            {!!  Html::decode(Form::label('amount' ,__('accounts.expense.amount').' <i class="text-danger">*</i>' ,['class'=>' text-right col-form-label']))   !!}
                                        </div>
                                        <div class="col-md-5">
                                            {!!  Form::number('amount',null,['id'=>'amount','class'=>'form-control ','placeholder'=>'Amount', 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            {!!  Html::decode(Form::label('description' ,__('accounts.general.details') ,['class'=>' text-right col-form-label']))   !!}
                                        </div>
                                        <div class="col-md-5">
                                            {!!  Form::textarea('description',null,['id'=>'description','class'=>'form-control ','placeholder'=>__('accounts.general.details'), 'rows'=>'2']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            {!!  Html::decode(Form::label('attachment' ,__('accounts.general.attachment') ,['class'=>' text-right col-form-label']))   !!}
                                        </div>
                                        <div class="col-md-5">
                                            {!!  Form::file('attachment',['id'=>'attachment','class'=>'form-control dropify', 'data-height' => '150', 'data-max-file-size' => '3M', 'data-allowed-file-extensions' => 'png bmp gif jpg jpeg pdf']) !!}
                                        </div>
                                    </div>
                                    @include('dashboard.accounts.common.buttons.buttons-crud', ['save'=>true, 'save_print'=>true, 'form_id'=>'voucher_form', 'cancel'=>true, 'cancel_route'=>'dashboard.accounts.expense.index'])
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->

            </div><!-- container -->

            @include('includes.dashboard-footer')
        </div>
        <!-- end page content -->
        </div>
        <!--end page-wrapper-inner -->

    </div>
    <!-- end page-wrapper -->

    @endsection
@endsection


@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/dropify/js/dropify.min.js') }}"></script>
@endsection
@section('innerScript')

    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('.dropify').dropify();
        });
    </script>

@endsection

