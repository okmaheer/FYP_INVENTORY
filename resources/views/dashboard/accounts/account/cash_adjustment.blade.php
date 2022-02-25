@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
@section('innerStyleSheet')
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@include('includes.dashboard-breadcrumbs')
@section('body')
            <div class="page-content">
                <div class="container-fluid">

                        <div class="card">
                            @include('includes.messages')
                            <div class="penal-title  border-grey border-bottom">
                                <h4 class="p-3 text-dark">Cash Adjustment</h4>
                            </div>
                            <div class="card-body">

                                <div class="general-label">
                                {!! Form::open(['route' =>'add.cash.adjustment', 'files' => true, 'id'=>'voucher_form', 'class' => 'solid-validation'] ) !!}
                                {!! csrf_field() !!}
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Form::label('voucher_no' ,'Voucher No' ,['class'=>'col-form-label'])   !!}
                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('voucher_no',$vocherNo,['id'=>'voucher_no','class'=>'form-control ','placeholder'=>'CR-3','readonly']) !!}

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('date' ,'Date   <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10 input-group">
                                                {!!  Form::text('date',\AccountHelper::date_format(\Carbon\Carbon::today()),['id'=>'date','class'=>'form-control datepicker','autocomplete'=>'off','required']) !!}
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('payment_type' ,'Type   <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::select('payment_type',AccountHelper::bankAccountTypes(),null,['id'=>'payment_type',
                                                'class'=>'select2 form-control mb-3 custom-select float-right',
                                                'placeholder'=>'Select Payment','required'])
                                                !!}
                                            </div>
                                        </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!!  Html::decode(Form::label('cash_account' ,'Cash Account   <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}
                                        </div>
                                        <div class="col-sm-10">
                                            {!!  Form::select('cash_account',$cashAccounts,null,['id'=>'cash_account',
                                            'class'=>'select2 form-control',
                                            'placeholder'=>'Select Cash Account','required'])
                                            !!}
                                        </div>
                                    </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Form::label('remarks' ,'Remarks' ,['class'=>'col-form-label'])   !!}
                                            </div>
                                            <div class="col-sm-10">

                                                {!! Form::textarea('remarks',null,['class' => 'form-control', 'size' => '50x2','placeholder'=>'Remark']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('amount' ,'Amount   <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::number('amount',null,['step'=>'any','min'=>'1','id'=>'amount','class'=>'form-control ', 'required','autocomplete'=>'off']) !!}
                                            </div>
                                        </div>
                                        @include('dashboard.accounts.common.buttons.buttons-crud', ['save'=>true, 'save_print'=>true, 'form_id'=>'voucher_form'])
                                        {!! Form::close() !!}
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->

                </div><!-- container -->
                &nbsp;
                &nbsp;
                &nbsp;
               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection

        @section('innerScriptFiles')
        <!-- Plugins js -->
        <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
        @endsection
        @section('innerScript')

        <script>
            (function (){
                $('select').select2();
            })();
        </script>


        @endsection


