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
                        @include('dashboard.accounts.common.filter-by-start-end-date',['route'=>'supplier.return.report'])
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    @include('includes.report-header')
                                    <div class="container-fluid" id="printArea">
                                        @include('includes.company-detail-header')
                                        <div class="table-rep-plugin mt-3">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table class="table table-striped  table-bordered mb-0 table-centered" cellpadding="6" cellspacing="1" width="100%">
                                                    <div class="table-title">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-left">SL.</th>
                                                                <th class="text-left">Purchase ID</th>
                                                                <th class="text-left">Supplier Name</th>
                                                                <th class="text-left">Date</th>
                                                                <th class="text-left">Total Amount</th>

                                                            </tr>
                                                        </thead>




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



