@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
@include('includes.dashboard-breadcrumbs')
<style>

    .company-txt{
        font-size: 24px;
        font-weight: bold;
    }




</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="card">
                        @include('dashboard.accounts.common.filter-by-start-end-date',['route'=>'sales.return'])
                    </div>
                    <div class="card">
                        <div class="">
                            <div class="col-lg-12">
                                <div class="">
                                    @include('includes.report-header')
                                    <div class="container-fluid" id="printArea">
                                        @include('includes.company-detail-header')
                                        <div class="table-rep-plugin mt-3">
                                            <div class="table-responsive " data-pattern="priority-columns">
                                                <table class="table table-striped mb-3 table-bordered  table-centered" cellpadding="6" cellspacing="1" width="100%">
                                                    <div class="table-title">
                                                        <tbody>
                                                            <tr>
                                                                <td >SL.</td>
                                                                <td >Invoice ID</td>
                                                                <td >Customer Name</td>
                                                                <td >Date</td>
                                                                <td >Total Amount</td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="6" class="text-center">Record not found</th>
                                                            </tr>
                                                        </tbody>



                                                    </div>

                                                </table>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                        </div>

                    </div>

                </div><!-- container -->

               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection



