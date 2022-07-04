@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
@section('innerStyleSheet')
<link href="{{ url('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
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
                        @include('dashboard.accounts.common.filter-by-start-end-date',['route'=>'purchase_report.category_wise'])

                    </div>
                    <div class="card">
                        <div class="">
                            <div class="col-lg-12">
                                <div class="">
                                    <h4 class="ml-4 mt-3 text-center">Purchase Report Category Wise</h4>
                                    {{-- @include('includes.report-header') --}}
                                    <div class="container-fluid"  id="printArea">
                                        {{-- @include('includes.company-detail-header') --}}
                                        <div class="table-rep-plugin mt-3">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table class="table table-striped mb-3 table-bordered mb-0 table-centered" cellpadding="6" cellspacing="1" width="100%">
                                                    <div class="table-title">
                                                        <tbody>
                                                            <tr>
                                                                <td >Category Name</td>
                                                                <td >Product Name</td>
                                                                <td >Date</td>
                                                                <td >Qnty</td>
                                                                <td >Amount</td>
                                                            </tr>
                                                            @php $balance = $paidAmount = $dueAmount =0; @endphp
                                                            @forelse($report as $key => $report)
                                                                @php
                                                                    $balance += $report->grand_total_amount;
                                                                @endphp
                                                                <tr>
                                                                    <td>{{$report->purchaseDetails[$key]->product->category->name}}</td>
                                                                    <td>{{$report->purchaseDetails[$key]->product->product_name}}</td>
                                                                    <td>{{$report->purchase_date}}</td>
                                                                    <td>{{$report->purchaseDetails[$key]->quantity}}</td>
                                                                    <td>{{$report->grand_total_amount}}</td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="5"> No Record Found</td>
                                                                </tr>
                                                            @endforelse


                                                        <tfoot>
                                                        <tr>
                                                            <td colspan="4" class="text-right"><b>Total Purchase:</b></td>
                                                            <td><b>{{ $balance }}</b></td>
                                                        </tr>
                                                        </tfoot>
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



