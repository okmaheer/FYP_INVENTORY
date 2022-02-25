@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
    @include('includes.dashboard-breadcrumbs')

    @section('body')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                @include('includes.report-header')
                                <div class="card-body" id="printArea">
                                    @include('includes.company-detail-header')
                                    <div class="row pb-2">
                                        <div class="col-12">
                                            <table class="table table-striped mb-0 table-bordered mb-0 table-centered" cellpadding="6" cellspacing="1" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th colspan="7" class="text-dark">General Ledger for <b>{{$headName[0]->HeadName}}</b> from <b>{{$filterDate['start_date']}}</b> to <b>{{$filterDate['end_date']}}</b></th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-center"> Sr.</th>
                                                        <th class="text-center">Transaction Date</th>
                                                        <th class="text-center">Head Code</th>
                                                        <th class="text-center">Particulars</th>
                                                        <th class="text-center">Debit</th>
                                                        <th class="text-center">Credit</th>
                                                        <th class="text-center">Balance</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $curBalance = $preBalance;
                                                    $totalDebit = $totalCredit = 0;
                                                @endphp
                                                @forelse($headName2 as $key => $data)
                                                    @php
                                                        $totalDebit += $data->Debit;
                                                        $curBalance += $data->Debit;

                                                        $totalCredit += $data->Credit;
                                                        $curBalance -= $data->Credit;

                                                    @endphp
                                                    <tr>
                                                        <td class="text-center">{{$key+1}}</td>
                                                        <td class="text-center">{{ \AccountHelper::date_format( $data->VDate ) }}</td>
                                                        <td class="text-center">{{$data->COAID}}</td>
                                                        <td class="text-center">{{$data->Narration}}</td>
                                                        <td class="text-center">{{AccountHelper::number_format($data->Debit) }}</td>
                                                        <td class="text-center">{{AccountHelper::number_format($data->Credit) }}</td>
                                                        <td class="text-center">{{AccountHelper::ledgerBalanceType($curBalance). __('accounts.currency.pkr')}}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7"> No Record Found</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="4" class="text-right"><b>Total</b></td>
                                                        <td class="text-center"><b>{{AccountHelper::number_format($totalDebit)}}</b></td>
                                                        <td class="text-center"><b>{{AccountHelper::number_format($totalCredit)}}</b></td>
                                                        <td class="text-center"><b>{{AccountHelper::ledgerBalanceType($curBalance). __('accounts.currency.pkr')}}</b></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="col-12 py-3 text-right d-print-none">
                                            {!! Form::button('Print', ['class' => 'btn btn-primary w-sm', 'id' => "printBtn"]) !!}
                                        </div>
                                    </div>
                                    @include('includes.report-footer')
                                </div>

                            </div><!-- container -->
                        </div>
                    </div>
                    @include('includes.dashboard-footer')
                </div>
                <!-- end page content -->
            </div>

@endsection
@endsection



