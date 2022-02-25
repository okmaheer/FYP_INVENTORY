@extends('layouts.dashboard')
@section('page_title')
@section('content')

@include('includes.dashboard-breadcrumbs')
<style>

</style>
@section('body')
            <div class="page-content">
                <div class="row ml-1 mb-2">
                    <div class="col-sm-12 ">
                        <a href="#" class="btn btn-info m-b-5 m-r-2">
                            <i class="ti-align-justify"></i> &nbsp;Bank Transaction
                        </a>&nbsp;
                        <a href="#" class="btn btn-success m-b-5 m-r-2">
                            <i class="ti-align-justify"></i> &nbsp;Manage Bank
                        </a>

                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="penal-tilte  border-grey border-bottom">
                                    <h4 class="mt-0 header-title">Add New Bank</h4>
                                    </div>

                                                <div class="general-label mt-4">
                                                    {!! Form::model($bank , ['route' => ['dashboard.accounts.bank.update', $bank->id], 'files' => true, 'class' => 'solid-validation'] ) !!}
                                                    {!! csrf_field() !!}
                                                    @method('PATCH')

                                                        <div class="form-group row">
                                                            <div class="col-sm-2">
                                                                {!!  Html::decode(Form::label('name' ,'Bank Name <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}

                                                            </div>
                                                            <div class="col-sm-10">
                                                                {!!  Form::text('name',null,['id'=>'name','class'=>'form-control ','placeholder'=>'Bank Name', 'required']) !!}

                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-2">
                                                                {!!  Html::decode(Form::label('account_name' ,'A/C Name  <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}

                                                            </div>
                                                            <div class="col-sm-10">
                                                                {!!  Form::text('account_name',null,['id'=>'account_name','class'=>'form-control ','placeholder'=>'A/C', 'required']) !!}

                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-2">
                                                                {!!  Html::decode(Form::label('account_number' ,'A/C Number  <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}

                                                            </div>
                                                            <div class="col-sm-10">
                                                                {!!  Form::number('account_number',null,['id'=>'account_number','class'=>'form-control ','placeholder'=>'A/C Number', 'required']) !!}

                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-2">
                                                                {!!  Html::decode(Form::label('branch' ,'Branch  <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}

                                                            </div>
                                                            <div class="col-sm-10">
                                                                {!!  Form::text('branch',null,['id'=>'branch','class'=>'form-control ','placeholder'=>'Branch', 'required']) !!}

                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-2">
                                                                {!!  Html::decode(Form::label('signature_pic' ,'Signature Picture  <i class="text-danger">*</i>' ,['class'=>'col-form-label']))  !!}

                                                            </div>
                                                            <div class="col-sm-10">
                                                                {!!  Form::file('signature_pic',null,['id'=>'signature_pic','class'=>'form-control ','placeholder'=>'Signature Picture', 'required']) !!}

                                                            </div>
                                                        </div>

                                                        @include('dashboard.accounts.common.buttons.buttons-crud', ['update' => true, 'cancel' => true, 'cancel_route' => 'dashboard.accounts.bank.index'])
                                                    {!! Form::close() !!}
                                                </div>

                                        <!--end card-->

                                    </div>
                                    <!--end /tableresponsive-->
                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                        <!-- end col -->



                    </div>

                </div>
                <!-- container -->

               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection

