@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
@section('innerStyleSheet')
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
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
                        @include('dashboard.accounts.common.filter-by-start-end-date',['route'=>'sales_report.category_wise'])
                    </div>
                    <div class="card">
                        <div class="">
                            <div class="col-lg-12">
                                <div class="" id="report">
                                    @include('includes.report-header')
                                    <div class="container-fluid" id="printArea">
                                        @include('includes.company-detail-header')
                                        <div class="table-rep-plugin mt-3">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table class="table table-striped mb-3 table-bordered mb-0 table-centered" cellpadding="6" cellspacing="1" width="100%">
                                                    <div class="table-title">

                                                        <tbody>

                                                            <tr>
                                                                <td class="text-left">Category Name</td>
                                                                <td class="text-left">Product Name</td>
                                                                <td class="text-left">Date</td>
                                                                <td class="text-left">Qty</td>
                                                                <td class="text-left">Total Amount</td>
                                                            </tr>

                                                            @php $balance = $paidAmount = $dueAmount =0; @endphp
                                                            @forelse($report as $key => $report)
                                                                @php
                                                                    $balance += $report->grand_total_price;
                                                                @endphp
                                                                <tr>
                                                                    <td>{{$report->invoiceDetails[$key]->product->category->name}}</td>
                                                                    <td>{{$report->invoiceDetails[$key]->product->product_name}}</td>
                                                                    <td>{{$report->date}}</td>
                                                                    <td>{{$report->invoiceDetails[$key]->quantity}}</td>
                                                                    <td>{{$report->grand_total_price}}</td>
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

        @section('innerScriptFiles')
        <!-- Plugins js -->
        <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
        @endsection
        @section('innerScript')

        <script>
            (function (){
                $('select').select2();
            })();
        </script>


        @endsection


