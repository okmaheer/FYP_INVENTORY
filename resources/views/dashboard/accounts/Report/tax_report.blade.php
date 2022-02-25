@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
@include('includes.dashboard-breadcrumbs')
<style>

.company-txt{
        font-size: 24px;
        font-weight: bold;
    }
    .btn-warning{
        margin-left:-129px;
    }
    .mr-5{
        margin-left: -43%;
    }



</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid mb-5">
                    <div class="card">
                        @include('dashboard.accounts.common.filter-by-start-end-date',['route'=>'tax.report'])
                    </div>
                    <div class="card">
                        <div class="">
                            <div class="col-lg-12">
                                <div class="">
                                    @include('includes.report-header')
                                    <div class="container-fluid" id="printArea">
                                       @include('includes.company-detail-header')
                                        <div class="table-rep-plugin mt-2">
                                            <div class="table-responsive mb-3" data-pattern="priority-columns">
                                                <table class="table table-striped table-bordered mb-0 table-centered" cellpadding="6" cellspacing="1" width="100%">
                                                    <div class="table-title">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-left"> Sales Date</th>
                                                                <th class="text-left">Invoice No</th>
                                                                <th class="text-left">Total Tax</th>

                                                            </tr>
                                                            <tr>
                                                                <td  class="text-center" colspan="3">Record not found</td>
                                                            </tr>
                                                        </thead>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="2" class="text-right"><b>Total</b></td>
                                                                <td class="text-right">$0</td>
                                                            </tr>
                                                        </tfoot>




                                                    </div>

                                                </table>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                        </div>

                    </div>

                </div>
                <!-- container -->

               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection



