@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@include('includes.dashboard-breadcrumbs')
<style>


</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">

                        <div class="card">
                            <div class="row">
                                <div class="col-md-3 mt-4"><h4 class="ml-4">Add Expense </h4></div>
                                <div class="col-md-9 text-right mt-4 ">

                                </div>

                            </div>
                            <div class="card-body">

                                <div class="general-label">
                                    {!! Form::model($expense , ['route' => ['dashboard.accounts.expense.update', $expense->id], 'files' => true, 'class' => 'solid-validation'] ) !!}
                                    {!! csrf_field() !!}
                                    @method('PATCH')


                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                            {!!  Html::decode(Form::label('date' ,'Date   <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                            {!!  Form::date('date',null,['id'=>'date','class'=>'form-control ']) !!}

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                            {!!  Html::decode(Form::label('expense_type' ,'Expense Type  <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::select('expense_type',AccountHelper::manualStatus(),null,['id'=>'expense_type',
                                                        'class'=>'select2 form-control mb-3 custom-select float-right',
                                                        'placeholder'=>'Select Model/Option'])
                                                !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                            {!!  Html::decode(Form::label('payeme_type' ,'Payment Type  <i class="text-danger">*</i>' ,['class'=>' text-right col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::select('payeme_type',AccountHelper::manualStatus(),null,['id'=>'payeme_type',
                                                        'class'=>'select2 form-control mb-3 custom-select float-right',
                                                        'placeholder'=>'Select Model/Option'])
                                                !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                            {!!  Html::decode(Form::label('amount' ,'Amount <i class="text-danger">*</i>' ,['class'=>' text-right col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                            {!!  Form::text('amount',null,['id'=>'amount','class'=>'form-control ','placeholder'=>'Amount']) !!}

                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                            {!! Form::submit('Save', array('class' => 'btn btn-success btn-large')) !!}


                                            </div>
                                        </div>
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

