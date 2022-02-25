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
                        <h4 class="p-3 text-dark">{{ __('accounts.vouchers.opening_balance_voucher') }}</h4>
                    </div>
                    <div class="card-body">

                        <div class="general-label">
                                {!! Form::open(['route' => 'add.opening.balance', 'files' => true, 'id'=>'voucher_form', 'class' => 'solid-validation'] ) !!}
                                {!! csrf_field() !!}
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        {!!  Form::label('voucher_no' ,'Voucher No' ,['class'=>'col-form-label'])   !!}
                                    </div>
                                    <div class="col-sm-10">
                                        {!!  Form::text('voucher_no',$vocherNo,['id'=>'voucher_no','class'=>'form-control ','placeholder'=>'OP-1','readonly']) !!}

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
                                        {!!  Html::decode(Form::label('account_head' ,'Account Head   <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}
                                    </div>
                                    <div class="col-sm-10">
                                        {!!  Form::select('account_head',$accountHeads,null,['id'=>'account_head',
                                                    'class'=>'select2 form-control mb-3 custom-select float-right',
                                                    'placeholder'=>'Select Option','required'])
                                                    !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        {!!  Html::decode(Form::label('amount' ,'Amount   <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}
                                    </div>
                                    <div class="col-sm-10">
                                        {!!  Form::number('amount',null,['step'=>'any','min'=>'1','id'=>'amount','class'=>'form-control ','placeholder'=>'0.00','required','autocomplete'=>'off']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        {!!  Form::label('remark' ,'Remark' ,['class'=>'col-form-label'])   !!}
                                    </div>
                                    <div class="col-sm-10">
                                        {!! Form::textarea('remarks',null,['class' => 'form-control', 'size' => '50x2','placeholder'=>'Remark']) !!}
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
