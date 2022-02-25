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
                                <div class="col-lg-12">
                                    <h3 class="p-3 text-dark text-center">{{__('accounts.income.add_income')}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="general-label">
                                {!! Form::open(['route' => 'dashboard.accounts.income.store', 'files' => true, 'id' => 'income_form', 'class' => 'solid-validation'] ) !!}

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            {!!  Html::decode(Form::label('date' ,__('accounts.income.date').'<i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}
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
                                            {!!  Html::decode(Form::label('income_head' ,__('accounts.income.e_head').'<i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                        </div>
                                        <div class="col-md-5">
                                            {!!  Form::select('income_head',$incomeHeads,null,['id'=>'income_head',
                                                    'class'=>'select2 form-control', 'style'=>'width:100%',
                                                    'placeholder'=>'Select Income Head', 'required'])
                                            !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            {!!  Html::decode(Form::label('payment_type' ,__('accounts.income.p_type').'<i class="text-danger">*</i>' ,['class'=>' text-right col-form-label']))   !!}
                                        </div>
                                        <div class="col-md-5">
                                            {!!  Form::select('payment_type',AccountHelper::paymentTypes(),null,['id'=>'payment_type',
                                                    'class'=>'select2 form-control', 'style'=>'width:100%',
                                                    'placeholder'=>'Select Payment Type', 'required'])
                                            !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            {!!  Html::decode(Form::label('amount' ,__('accounts.income.amount').' <i class="text-danger">*</i>' ,['class'=>' text-right col-form-label']))   !!}
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
                                    @include('dashboard.accounts.common.buttons.buttons-crud', ['save' => true, 'save_print' => true, 'form_id' => 'income_form', 'reset' => true, 'cancel' => true, 'cancel_route' => 'dashboard.accounts.income.index'])
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
@endsection
@section('innerScript')

    <script>
        (function (){
            $('.select2').select2();
        })();

        function SubmitAndPrint() {
            $("#doPrint").val('1');
            $("#income_form").submit();
        }
    </script>

@endsection

