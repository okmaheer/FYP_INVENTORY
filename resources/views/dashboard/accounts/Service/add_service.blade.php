,'required'@extends('layouts.dashboard')
@section('page_title')
@section('content')
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

                <div class="row ml-1 mb-2">
                    <div class="col-sm-12 ">
                        <a href="#" class="btn btn-info m-b-5 m-r-2">
                            <i class="ti-align-justify"></i> &nbsp; Manage Service
                        </a>&nbsp;
                        <a href="#" class="btn btn-info m-b-5 m-r-2">
                            Service CSV Upload
                        </a>

                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="penal-tilte  border-grey border-bottom">
                                    <h4 class="mt-0 header-title">Add Service</h4>
                                    </div>

                                                <div class="general-label mt-4">
                                                    {!! Form::open(['route' => 'dashboard.accounts.service.store','files' => true] ) !!}
                                                    {!! csrf_field() !!}
                                                        <div class="form-group row">
                                                            <div class="col-sm-2">
                                                                {!!  Html::decode(Form::label('service_name' ,'Service Name  <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}

                                                            </div>
                                                            <div class="col-sm-10">
                                                                {!!  Form::text('service_name',null,['id'=>'service_name','class'=>'form-control ','placeholder'=>'Service Name']) !!}

                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-2">
                                                                {!!  Html::decode(Form::label('charge' ,'Charge   <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}

                                                            </div>
                                                            <div class="col-sm-10">
                                                                {!!  Form::text('charge',null,['id'=>'charge','class'=>'form-control ','placeholder'=>'Charge ']) !!}

                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-2">
                                                                {!!  Html::decode(Form::label('description' ,'Description  <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}

                                                            </div>
                                                            <div class="col-sm-10">
                                                                {!!  Form::text('description',null,['id'=>'description','class'=>'form-control ','placeholder'=>'Description']) !!}

                                                            </div>
                                                        </div>

                                                        <div class="row ml-5">
                                                            <div class="col-sm-10 ml-auto">
                                                                {!! Form::submit('Save', array('class' => 'btn btn-success ')) !!}

                                                            </div>
                                                        </div>

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


