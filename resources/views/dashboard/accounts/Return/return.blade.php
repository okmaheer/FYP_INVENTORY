@extends('layouts.dashboard')
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
    .penal-tilte{
        background-color: #f5f5f5;
        border-color:#f5f5f5;
    }

</style>
        <div class="page-wrapper">
            <div class="page-wrapper-inner">

                <!-- Navbar Custom Menu -->
                @include('includes.dashboard-nav-bar')
                <div class="container-fluid">
                    <div class="row  mb-2">
                        <div class="col-sm-12">
                            <a href="#" class="btn btn-primary m-b-5 m-r-2">
                                <i class="ti-align-justify"></i> &nbsp;Customer Return List
                            </a>
                            <a href="#" class="btn btn-primary m-b-5 m-r-2">
                                <i class="ti-align-justify"></i> &nbsp;Supplier Return
                            </a>
                            <a href="#" class="btn btn-primary m-b-5 m-r-2">
                                <i class="ti-align-justify"></i> &nbsp;Wastage List
                            </a>


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="penal-tilte  border-grey border-bottom">
                                    <h4 class="p-3 text-dark">Return From Customer</h4>
                                    </div>
                                <div class="card-body">

                                    <div class="general-label">
                                       {{-- {!! Form::open(['route' => 'dashboard.accounts.supplier.store', 'files' => true] ) !!} --}}
                                        {!! csrf_field() !!}

                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    {!!  Form::label('invoice_no' ,'Invoice No:' ,['class'=>'col-form-label'])   !!}

                                                </div>
                                                <div class="col-sm-10">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            {!!  Form::text('invoice_no',null,['id'=>'invoice_no','class'=>'form-control ','placeholder'=>'Invoice No']) !!}

                                                        </div>
                                                        <div class="col-lg-6">
                                                            {!! Form::submit('Search', array('class' => 'btn btn-success mr-5')) !!}

                                                            </div>
                                                    </div>


                                                </div>

                                            </div>
                                            {!! Form::close() !!}
                                    </div>
                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="penal-tilte  border-grey border-bottom">
                                    <h4 class="p-3 text-dark">Return To Supplier</h4>
                                    </div>
                                <div class="card-body">

                                    <div class="general-label">
                                         {{-- {!! Form::open(['route' => 'supplier.store', 'files' => true] ) !!} --}}
                                         {!! csrf_field() !!}
                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    {!!  Form::label('purchase_id' ,'Purchase ID:' ,['class'=>'col-form-label'])   !!}

                                                </div>
                                                <div class="col-sm-10">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            {!!  Form::text('purchase_id',null,['id'=>'purchase_id','class'=>'form-control ','placeholder'=>'Return purchase id']) !!}

                                                        </div>
                                                        <div class="col-lg-6">{!! Form::submit('Search', array('class' => 'btn btn-success mr-5')) !!}</div>
                                                    </div>


                                                </div>

                                            </div>


                                            {!! Form::close() !!}
                                    </div>
                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                    </div>


                                    </div><!-- container -->

                                @include('includes.dashboard-footer')
                                </div>
                                <!-- end page content -->
                <!-- end left-sidenav-->
            </div>
            <!--end page-wrapper-inner -->
            <!-- Page Content-->
            <div class="page-content">


                            </div>
                            <!-- end page-wrapper -->
                            @endsection

