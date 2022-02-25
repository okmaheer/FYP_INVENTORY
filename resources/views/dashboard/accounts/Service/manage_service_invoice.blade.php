@extends('layouts.dashboard')
@section('page_title')
@section('content')
@include('includes.dashboard-breadcrumbs')
<style>
   .btn-secondary{
        background-color: #31B404 !important;
        color: #fff;

    }
    .btn-secondary:hover{
        background-color: #e4e7e3 !important;
    }

</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">

                    <div class="row ">

                        <div class="col-12">

                            <div class="card">
                                @include('includes.messages')  <!--ALert Message--->
                                <div class="card-body">
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                <tbody>
                                                <tr>
                                                    <th class="text-center">SL.</th>
                                                    <th class="text-center">Customer Name</th>
                                                    <th class="text-center">Date </th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </tbody>

                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>


                </div>
                <!-- container -->

               @include('includes.dashboard-footer')
            </div>

 @endsection
        @endsection

