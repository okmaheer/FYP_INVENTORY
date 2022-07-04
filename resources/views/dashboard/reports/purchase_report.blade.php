@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
@include('includes.dashboard-breadcrumbs')
@section('body')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="card">
                        @include('dashboard.accounts.common.filter-by-start-end-date',['route'=>'purchase.report'])

                    </div>
                    <div class="card">
                        <h4 class="ml-4 mt-3 text-center">Purchase Report </h4>

                        {{-- @include('includes.report-header') --}}
                        <div class="card-body" id="printArea">
                            {{-- @include('includes.company-detail-header') --}}
                            <div class="row">
                                <div class="col-12" >
                                    <table class="table table-striped mb-3 table-bordered mb-0 table-centered" cellpadding="6" cellspacing="1" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Sr.</th>
                                                                <th>Purchase Date</th>
                                                                <th>Invoice No</th>
                                                                <th>Supplier Name</th>
                                                                <th>Total Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $balance = $paidAmount = $dueAmount =0; @endphp
                                                            @forelse($report as $key => $report)
                                                                @php
                                                                    $balance += $report->grand_total_amount;
                                                                @endphp
                                                                <tr>
                                                                    <td>{{$key + 1}}</td>
                                                                    <td>{{$report->purchase_date}}</td>
                                                                    <td>{{$report->id}}</td>
                                                                    <td>{{$report->supplier->supplier_name}}</td>
                                                                    <td>{{$report->grand_total_amount}}</td>

                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="5"> No Record Found</td>
                                                                </tr>
                                                            @endforelse

                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="4" class="text-right"><b>Total Purchase:</b></td>
                                                                <td><b>{{ $balance }}</b></td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                </div>
                            </div>
                            {{-- @include('includes.report-footer') --}}
                        </div>
                    </div>
                </div>

               @include('includes.dashboard-footer')
            </div>

        @endsection
    @endsection



