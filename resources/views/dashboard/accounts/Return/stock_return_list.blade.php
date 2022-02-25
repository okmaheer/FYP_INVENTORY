@extends('layouts.dashboard')
@section('page_title')
@section('content')
@include('includes.dashboard-breadcrumbs')
<style>

    .company-txt{
        font-size: 24px;
        font-weight: bold;
    }
    .btn-warning{
        margin-left:-40px;
    }



</style>
        <div class="page-wrapper">
            <div class="page-wrapper-inner">

                <!-- Navbar Custom Menu -->
                @include('includes.dashboard-nav-bar')
                <!-- end left-sidenav-->
                  <!-- Page Content-->

            <div class="page-content">
                <div class="row ml-1 ">
                    <div class="col-sm-12">
                        <a href="#" class="btn btn-primary m-b-5 m-r-2">
                            <i class="ti-plus"></i> &nbsp;Add Return

                        </a>

                    </div>
                </div>
                <div class="container-fluid mt-2">
                    <div class="card">
                        <div class="row">
                            <div class="col-lg-12">

                                    <div class="card-body">
                                        {{-- {!! Form::open(['route' => 'dashboard.accounts.supplier.store', 'files' => true] ) !!} --}}
                                         {!! csrf_field() !!}
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        {!!  Form::label('start_date' ,'Start Date' ,['class'=>'col-form-label text-right'])   !!}

                                                    </div>
                                                    <div class="col-sm-8">
                                                        {!!  Form::date('start_date',null,['id'=>'start_date','class'=>'form-control ','placeholder'=>'2021-04-03']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        {!!  Form::label('end_date' ,'End Date' ,['class'=>'col-form-label text-left'])   !!}

                                                    </div>
                                                    <div class="col-sm-10">
                                                        {!!  Form::date('end_date',null,['id'=>'end_date','class'=>'form-control ','placeholder'=>'2021-04-03']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 text-right">
                                                <div class="form-group row">
                                                    {!! Form::submit('Search', array('class' => 'btn btn-success')) !!}
                                                </div>
                                            </div>

                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <!--end card-body-->

                                <!--end card-->
                            </div>
                        </div>

                    </div>
                    <div class="card ">

                        <div class="table-rep-plugin mb-5 mt-3 container-fluid">
                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                <table class="table table-striped table-bordered mb-0 table-centered" cellpadding="6" cellspacing="1" width="100%">
                                    <div class="table-title">

                                        <tbody>

                                            <tr>
                                                <td class="text-left">SL.</td>
                                                <td class="text-left">Invoice ID</td>
                                                <td class="text-left">Customer Name</td>
                                                <td class="text-left">Date</td>
                                                <td class="text-left">Total Amount</td>
                                                <td class="text-left">Action</td>


                                            </tr>

                                        </tbody>



                                    </div>

                                </table>
                            </div>

                        </div>


                    </div>

                </div><!-- container -->

               @include('includes.dashboard-footer')
            </div>
            <!-- end page content -->
            </div>
            <!--end page-wrapper-inner -->

        </div>
        <!-- end page-wrapper -->
        @endsection



