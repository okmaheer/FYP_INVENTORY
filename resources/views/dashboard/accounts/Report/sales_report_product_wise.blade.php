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
                        @include('dashboard.accounts.common.filter-by-start-end-date',['route'=>'product.wise'])

                    </div>
                    <div class="card">
                        <div class="">
                            <div class="col-lg-12">
                                <div class="">
                                    @include('includes.report-header')
                                    <div class="container-fluid" id="printArea">
                                        @include('includes.company-detail-header')
                                        <div class="table-rep-plugin mt-3">
                                            <div class="table-responsive mb-3" data-pattern="priority-columns">
                                                <table class="table table-striped table-bordered mb-0 table-centered" cellpadding="6" cellspacing="1" width="100%">
                                                    <div class="table-title">

                                                        <tbody>

                                                            <tr>
                                                                <td>Sales Date</td>
                                                                <td>Product Name</td>
                                                                <td>Invoice No</td>
                                                                <td>Customer Name</td>
                                                                <td>Rate</td>
                                                                <td>Total Amount</td>
                                                            </tr>

                                                        @php $balance = $paidAmount = $dueAmount =0; @endphp
                                                        @forelse($report as $key => $report)
                                                            @php
                                                                    $balance += $report->grand_total_price;
                                                            @endphp
                                                            <tr>

                                                                <td>{{$report->invoiceDetails[$key]->product->product_name}}</td>
                                                                <td>{{$report->date}}</td>
                                                                <td>{{$report->id}}</td>
                                                                <td>{{$report->customer->customer_name}}</td>
                                                                <td>{{$report->invoiceDetails[$key]->rate}}</td>
                                                                <td>{{$report->grand_total_price}}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="6"> No Record Found</td>
                                                            </tr>
                                                        @endforelse


                                                        <tfoot>
                                                        <tr>
                                                            <td colspan="5" class="text-right"><b>Total Purchase:</b></td>
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

