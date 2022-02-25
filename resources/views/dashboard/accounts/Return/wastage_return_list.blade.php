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
                <div class="row ml-1 mb-1">
                    <div class="col-sm-12">
                        <a href="#" class="btn btn-primary m-b-5 m-r-2">
                            <i class="ti-align-justify"></i> &nbsp;Add Return

                        </a>

                    </div>
                </div>
                <div class="container-fluid">

                    <div class="card">

                        <div class="col-lg-12">
                            <div class="container-fluid">
                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table class="table table-striped table-bordered mb-5 mt-3 table-centered " cellpadding="6" cellspacing="1" width="100%">
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



