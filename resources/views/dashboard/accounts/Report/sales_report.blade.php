@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
    @include('includes.dashboard-breadcrumbs')
    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    @include('dashboard.accounts.common.filter-by-start-end-date',['route'=>'sales.report'])
                </div>
                <div class="row">
                    <div class="col-12">
                            <div class="card">
                                @include('includes.report-header')
                                <div class="card-body">
                                    <div id="printArea">
                                        @include('includes.company-detail-header')
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table table-striped table-bordered" cellpadding="6" cellspacing="1" width="100%">
                                                    <thead>
                                                    <tr>
                                                        <th class="text-left">Sales Date</th>
                                                        <th class="text-center">Invoice No</th>
                                                        <th class="text-center">Customer Name</th>
                                                        <th class="text-right">Total Amount</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    @php $balance=0; @endphp
                                                    @foreach($invoice as $report)
                                                        @php $balance += $report->grand_total_price;  @endphp
                                                        <tr>
                                                            <td>{{$report->date}}</td>
                                                            <td>{{$report->id}}</td>
                                                            <td>{{$report->customer->customer_name}}</td>
                                                            <td>{{$report->grand_total_price}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td colspan="3" class="text-right"><b>Total Purchase:</b></td>
                                                        <td class="text-right" ><b>{{$balance}}</b></td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
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
