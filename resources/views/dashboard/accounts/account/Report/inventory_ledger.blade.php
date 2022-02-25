@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
    @include('includes.dashboard-breadcrumbs')
@section('body')
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="row">
                    <div class="col-lg-12">
                        @include('dashboard.accounts.common.filter-by-start-end-date',['route'=>'inventory.ledger'])
                    </div>
                </div>
            </div>
            <div class="card" id="printArea">
                <div class="card-body">
                    @include('includes.company-detail-header')
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped mb-0 table-bordered dt-responsive nowrap container-fluid mb-4"
                                   cellpadding="6" cellspacing="1" width="100%">
                                <thead>
                                    <tr class="table_data">
                                        <th class="text-right text-dark" colspan="7"><strong>Opening Balance</strong></th>
                                        <th class="text-right text-dark"><strong>{{ \AccountHelper::number_format( $preBalance ) }}</strong></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">SL.</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Voucher No</th>
                                        <th class="text-center">Voucher Type</th>
                                        <th class="text-center">Remark</th>
                                        <th class="text-right">Debit</th>
                                        <th class="text-right">Credit</th>
                                        <th class="text-right">Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalCredit = 0;
                                        $totalDebit = 0;
                                        $VNo = '';
                                        $balance = 0;
                                    @endphp
                                    @forelse($report2 as $key => $report)
                                        @php
                                            $totalDebit += $report->Debit;
                                            $totalCredit += $report->Credit;
                                            $balance += $totalDebit - $totalCredit;
                                        @endphp
                                        <tr class="table_data">
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $report->VDate }}</td>
                                            <td class="text-center">{{ $report->VNo }}</td>
                                            <td class="text-center">{{ $report->Vtype }}</td>
                                            <td class="text-center"><strong>{{ $report->Narration }}</strong>
                                            </td>
                                            <td class="text-right">{{ \AccountHelper::number_format( $report->Debit ) }}</td>
                                            <td class="text-right">{{ \AccountHelper::number_format( $report->Credit ) }}</td>
                                            <td class="text-center">{{ \AccountHelper::number_format( $balance ) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="8"> No Record Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr class="print-footercolor bg-primary">
                                        <td colspan="5" class="text-right text-white"><b>Total</b></td>
                                        <td class="text-right text-white">{{ \AccountHelper::number_format( $totalDebit ) }}</td>
                                        <td class="text-right text-white">{{ \AccountHelper::number_format( $totalCredit ) }}</td>
                                        <td class="text-right text-white">
                                            {{ AccountHelper::ledgerBalanceType($balance) . __('accounts.currency.pkr') }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    @include('includes.report-footer')
                </div>
            </div>

        </div><!-- container -->

        @include('includes.dashboard-footer')
    </div>

@endsection
@endsection
