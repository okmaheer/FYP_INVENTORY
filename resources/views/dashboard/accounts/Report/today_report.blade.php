@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
    @include('includes.dashboard-breadcrumbs')

    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="penal-title border-grey border-bottom">
                                <div class="row">
                                    <div class="col-md-12 text-center mt-4 mb-5">
                                        <span class="padding-lefttitle ">
                                            <a href="" class="btn btn-primary "><i class="ti-align-justify"></i> Today
                                                Report </a> &nbsp;
                                            <a href="" class="btn btn-primary "><i class="ti-align-justify"></i>
                                                Purchase
                                                Report </a> &nbsp;
                                            <a href="" class="btn btn-primary "><i class="ti-align-justify"></i> Sales
                                                Report (Product Wise) </a>
                                            &nbsp;
                                            <a href="" class="btn btn-primary  ml-0"><i class="ti-align-justify"></i>
                                                Profit
                                                Report (Sale Wise)
                                            </a>&nbsp; &nbsp; &nbsp;

                                        </span>
                                    </div>

                                </div>
                            </div>

                            <div id="printArea">
                                <div class="card-body">
                                    @include('includes.company-detail-header')
                                    <div class="row">
                                        <div class="col-8 ml-4">
                                            <h3 ><b>Sales Report</b></h3>
                                        </div>
                                        <div class="col-3 text-right mt-1">
                                            <h5 class=""><b>Date :</b> {{ \AccountHelper::date_format(\Carbon\Carbon::today())}}</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-striped table-bordered" cellpadding="6" cellspacing="1" width="100%">
                                                <thead>
                                                <tr>
                                                    <th class="text-left">Sale Date</th>
                                                    <th class="text-left">Invoice No</th>
                                                    <th class="text-left">Customer Name </th>
                                                    <th class="text-right">Total Amount</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $balance = $i =0; @endphp
                                                @foreach($todaySaleReport as $report)
                                                    @php
                                                        $balance += $report->grand_total_price;
                                                        $i++;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td>{{ $report->date }}</td>
                                                        <td>{{ $report->id }}</td>
                                                        <td>{{ $report->customer->customer_name }}</td>
                                                        <td>{{ $report->grand_total_price }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="3" class="text-right"><b>Total Purchase:</b></td>
                                                    <td class="text-right"><b>{{ $balance }}</b></td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8 ml-4">
                                            <h3 ><b>Purchase Report</b></h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-striped table-bordered" cellpadding="6"
                                                   cellspacing="1" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-left">Purchase Date</th>
                                                        <th class="text-left">Invoice No</th>
                                                        <th class="text-left">Supplier Name </th>
                                                        <th class="text-right">Total Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $purchaseBalance=0; @endphp
                                                    @foreach($todayPurchaseReport as $report)
                                                        @php $purchaseBalance += $report->grand_total_amount;  @endphp
                                                        <tr>
                                                            <td>{{ $report->purchase_date }}</td>
                                                            <td>{{ $report->id }}</td>
                                                            <td>{{ $report->supplier->supplier_name }}</td>
                                                            <td>{{ $report->grand_total_amount }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3" class="text-right"><b>Total Purchase:</b></td>
                                                        <td class="text-right"><b>{{ $purchaseBalance }}</b></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="text-right col-12">
                                            <a href="javascript:void(0);" class="btn btn-primary w-sm" id="printBtn">Print</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('includes.dashboard-footer')
        </div>
    @endsection
@endsection
@section('innerScriptFiles')
    <!-- Plugins js -->
    <script src="{{ asset('dashboard/plugins/reports/report.js') }}"></script>
@endsection
