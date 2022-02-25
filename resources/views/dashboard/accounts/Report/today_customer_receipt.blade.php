@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
    @include('includes.dashboard-breadcrumbs')
@section('body')
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                @include('dashboard.accounts.common.filter-by-start-end-date',['route'=>'today.customer.receipt'])
            </div>
            <div class="card" id="printArea">
                @include('includes.report-header')
                <div class="card-body">
                    @include('includes.company-detail-header')
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped table-bordered mb-3" cellpadding="6"
                                   cellspacing="1" width="100%">
                                <thead>
                                    <tr>
                                        <td class="text-left">SL.</td>
                                        <td class="text-center">Customer Name</td>
                                        <td class="text-center">Description </td>
                                        <td class="text-right">Receipt</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $balance = $i =0; @endphp
                                    @forelse($rpt as $report)
                                        @php
                                            $balance += $report->Credit;
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $report->accountHead->customer->customer_name }}</td>
                                            <td>{{ $report->Narration }}</td>
                                            <td class="text-right">{{ \AccountHelper::number_format( $report->Credit ) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center"> No Record Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right"><b>Total Purchase:</b></td>
                                        <td class="text-right"><b>{{ \AccountHelper::number_format( $balance ) }}</b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    @include('includes.report-footer')
                </div>
            </div>
        </div>
        @include('includes.dashboard-footer')
    </div>

@endsection
