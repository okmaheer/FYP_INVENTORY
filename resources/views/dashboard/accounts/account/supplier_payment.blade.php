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
                    <div class="penal-title  border-grey border-bottom">
                        <h4 class="p-3 text-dark">{{ __('accounts.supplier.voucher_title') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::open(['route' => 'add.supplier.payment', 'files' => true, 'id'=>'voucher_form', 'class' => 'solid-validation'] ) !!}
                                {!! csrf_field() !!}
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            {!!  Form::label('voucher_no' ,'Voucher No' ,['class'=>'col-form-label'])   !!}
                                        </div>
                                        <div class="col-sm-9">
                                            {!!  Form::text('voucher_no',$vocherNo,['id'=>'voucher_no','class'=>'form-control ','placeholder'=>'PM-4','readonly']) !!}

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            {!!  Html::decode(Form::label('date' ,'Date   <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}
                                        </div>
                                        <div class="col-sm-9 input-group">
                                            {!!  Form::text('date',\AccountHelper::date_format(\Carbon\Carbon::today()),['id'=>'date','class'=>'form-control datepicker','required','autocomplete'=>'off']) !!}
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            {!!  Html::decode(Form::label('supplier_id' ,'Supplier   <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                        </div>
                                        <div class="col-sm-9">
                                            {!!  Form::select('supplier_id',$supplier,null,['id'=>'supplier_id',
                                                        'class'=>'select2 form-control mb-3 custom-select float-right',
                                                        'placeholder'=>'Choose Supplier', 'required','onchange'=>'getSupplierBalance(this, "amount_balance", "amount_last", null)'])
                                                        !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            {!!  Html::decode(Form::label('payment_type' ,'Payment Type   <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                        </div>
                                        <div class="col-sm-9">
                                            {!!  Form::select('payment_type',$paymentTypes,1,['id'=>'payment_type',
                                                'class'=>'select2 form-control',
                                                'placeholder'=>'Select Payment Type', 'required'])
                                            !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            {!!  Html::decode(Form::label('payment_account' ,'Payment Account   <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                        </div>
                                        <div class="col-sm-9">
                                            {!!  Form::select('payment_account',$paymentAccounts,null,['id'=>'payment_account',
                                                'class'=>'select2 form-control',
                                                'placeholder'=>'Select Payment Account', 'required'])
                                            !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            {!!  Html::decode(Form::label('amount' ,'Amount   <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                        </div>
                                        <div class="col-sm-9">
                                            {!!  Form::number('amount',null,['step'=>'any','min'=>'1','id'=>'amount','class'=>'form-control ', 'required','autocomplete'=>'off']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            {!!  Form::label('remarks' ,'Remark' ,['class'=>'col-form-label'])   !!}
                                        </div>
                                        <div class="col-sm-9">
                                            {!! Form::textarea('remarks',null,['id'=>'remarks','class' => 'form-control', 'size' => '50x2','placeholder'=>'Remarks']) !!}
                                        </div>
                                    </div>
                                    @include('dashboard.accounts.common.buttons.buttons-crud', ['save'=>true, 'save_print'=>true, 'form_id'=>'voucher_form', 'cancel'=>true, 'cancel_route'=>'dashboard.accounts.supplier.index'])
                                    {!! Form::close() !!}
                            </div>
                            <div class="col-md-2">&nbsp;</div>
                            <div class="col-md-4 text-right">
                                <h4 class="text-dark">{{ __('accounts.general.last_paid_amount') }}: <span class="font-weight-bold text-muted" id="amount_last">0.00</span></h4>
                                <h4 class="text-dark">{{ __('accounts.general.amount_pending') }}: <span class="font-weight-bold text-muted" id="amount_balance">0.00</span></h4>
                            </div>
                        </div>
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
@endsection
@section('innerScript')

    <script>
        (function (){
            $('.select2').select2();
        })();
    </script>


@endsection

