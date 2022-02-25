@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
    @include('includes.dashboard-breadcrumbs')
@section('body')
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                @include('dashboard.accounts.common.filter-by-start-end-date',['route'=>'profit_report.sales_wise'])

            </div>
            <div class="card">
                <div class="">
                    <div class="col-lg-12" id="report">
                        <div class="">
                            @include('includes.report-header')
                            <div class="container-fluid" id="printArea">
                                @include('includes.company-detail-header')
                                <div class="table-rep-plugin mt-3">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table class="table table-striped mb-3 table-bordered mb-0 table-centered"
                                               cellpadding="6" cellspacing="1" width="100%">
                                            <div class="table-title">
                                                <thead>
                                                <tr>
                                                    <th class="text-left"> Sales Date</th>
                                                    <th class="text-left">Invoice No</th>
                                                    <th class="text-left">Supplier Amount</th>
                                                    <th class="text-left">My Sale Amount</th>
                                                    <th class="text-left">Total Profit</th>


                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $balance = $supplierAmount = $saleAmount =0; @endphp
                                                @forelse($report as $key => $report)
                                                    @php
                                                        $saleAmount += $report->total_sale;
                                                        $supplierAmount += $report->total_supplier_rate;
                                                        $balance += $report->total_profit;
                                                    @endphp
                                                    <tr>
                                                        <td>{{$report->date}}</td>
                                                        <td>{{$report->id}}</td>
                                                        <td>{{$report->total_supplier_rate}}</td>
                                                        <td>{{$report->total_sale}}</td>
                                                        <td>{{$report->total_profit}}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5"> No Record Found</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="2" class="text-right"><b>Total</b></td>
                                                    <td class="text-right">{{$supplierAmount}}</td>
                                                    <td class="text-right">{{$saleAmount}}</td>
                                                    <td class="text-right">{{$balance}}</td>
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

            </div><!-- container -->

            @include('includes.dashboard-footer')
        </div>

@endsection
@endsection



