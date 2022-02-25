@extends('layouts.dashboard')
@section('page_title')
@section('content')
@include('includes.dashboard-breadcrumbs')
<style>
  /* .col-sm-1{
      margin-left: -115px;
  } */
</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row  mb-2">
                        <div class="col-sm-12">
                            <a href="#" class="btn btn-primary m-b-5 m-r-2">
                                <i class="ti-plus"></i> &nbsp;Add Person
                            </a>
                            <a href="#" class="btn btn-primary m-b-5 m-r-2">
                                <i class="ti-plus"></i> &nbsp;Add Loan
                            </a>
                            <a href="#" class="btn btn-success m-b-5 m-r-2">
                                <i class="ti-plus"></i> &nbsp;Add Payemnet
                            </a>

                        </div>
                    </div>

                    <div class="row ">

                        <div class="col-12">

                            <div class="card">
                                <div class="panel-title">
                                    <span class="p-3">

                                        <div class="penal-tilte  border-grey border-bottom">
                                            <h4 class="p-3 text-dark">{{__('accounts.personal.manage')}}</h4>
                                            </div>
                                    </span>


                                </div>
                                @include('includes.messages')  <!--ALert Message--->
                                <div class="card-body">

                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" >
                                        <thead>
                                                <tr>
                                                    <th>{{__('accounts.personal.name')}}</th>
                                                    <th>{{__('accounts.personal.address')}}</th>
                                                    <th>{{__('accounts.personal.phone')}}</th>
                                                    <th class="text-right">{{__('accounts.personal.balance')}}</th>
                                                    <th>{{__('accounts.personal.action')}}</th>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-center">Total</td>
                                                    <td class="text-right">$0.00</td>
                                                    <td></td>
                                                </tr>

                                        </thead>



                                    </table>
                                </div>
                            </div>
                        </div> <!-- end col -->
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

