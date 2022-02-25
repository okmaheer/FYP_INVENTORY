@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
@section('innerStyleSheet')
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@include('includes.dashboard-breadcrumbs')
<style>
   .col-sm-2::selection{
        color: #fff;
        background-color: #37a000;
    }
    .text-success::selection{
        color: #fff;
        background-color: #37a000;

    }

</style>
@section('body')
            <div class="page-content">

                <div class="container-fluid">
                    <div class="row  mb-2">
                        <div class="col-sm-12">
                            <a href="#" class="btn btn-info m-b-5 m-r-2">
                                <i class="ti-align-justify"></i> &nbsp;Add New Bank
                            </a>
                            <a href="#" class="btn btn-success m-b-5 m-r-2">
                                <i class="ti-align-justify"></i> &nbsp;Manage Bank
                            </a>


                        </div>
                    </div>

                        <div class="card">
                            <div class="penal-tilte  border-grey border-bottom ">
                                <h4 class="p-3 text-success">Bank Transaction</h4>
                                </div>
                            <div class="card-body">

                                <div class="general-label">
                                    {!! Form::open([ 'route' => 'add.bank.transactions','files' => true] ) !!}
                                    {!! csrf_field() !!}

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('date' ,'Date<i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::date('date',null,['id'=>'date','class'=>'form-control ']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('bank_transaction_type' ,'Account Type<i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}
                                            {{-- <label for="horizontalInput2" class=" col-form-label">Account Type<i class="text-danger"> *</i></label> --}}
                                            </div>
                                            <div class="col-sm-10">
                                                 {!!  Form::select('bank_transaction_type', AccountHelper::bankAccountTypes(), null, ['placeholder' => 'Select Option' ,'class'=>'select2 form-control mb-3 custom-select float-right'])!!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('bank_name' ,'Bank Name<i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::select('bank_name', $banks, null, ['placeholder' => 'Select Option' ,'class'=>'select2 form-control mb-3 custom-select float-right'])!!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('withdraw_deposit_id' ,'Withdraw / Deposite ID<i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('withdraw_deposit_id',null,['id'=>'withdraw_deposit_id','class'=>'form-control ']) !!}

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('amount' ,'Amount<i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('amount',null,['id'=>'amount','class'=>'form-control ']) !!}

                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('description' ,'Description' ,['class'=>' col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-10">
                                                {!! Form::textarea('description', null, ['class'=>'form-control','rows' => 0, 'cols' => 50]) !!}
                                            </div>
                                        </div>



                                        <div class="row mr-5">
                                            <div class="col-sm-12 text-center">
                                                {!! Form::submit('Reset', array('class' => 'btn btn-danger')) !!}
                                                {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}

                                            </div>
                                        </div>
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
