@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
    @include('includes.dashboard-breadcrumbs')

    @section('body')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="card" id="printArea">
                        @include('includes.report-header')
                        <div class="card-body">
                            @include('includes.company-detail-header')

                            <div class="row pb-2">
                                <div class="col-12">
                                    <table class="table table-striped mb-0 table-bordered mb-0 table-centered" cellpadding="6" cellspacing="1" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="7" class="text-dark">General Ledger for {{$headName[0]->HeadName}} from {{$filterDate['start_date']}} - {{$filterDate['end_date']}}</th>
                                                            </tr>
                                                            <tr>
                                                                <th class="text-left"> Sr.</th>
                                                                <th class="text-left">Transaction Date</th>
                                                                <th class="text-left">Head Code</th>
                                                                <th class="text-left">Particulars</th>
                                                                <th class="text-left">Debit</th>
                                                                <th class="text-left">Credit</th>
                                                                <th class="text-left">Balance</th>
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
                                                                    <td>{{$key+1}}</td>
                                                                    <td>{{ \AccountHelper::date_format( $data->VDate ) }}</td>
                                                                    <td>{{$data->COAID}}</td>
                                                                    <td>{{$data->Narration}}</td>
                                                                    <td>{{ $data->Debit}}</td>
                                                                    <td>{{$data->Credit}}</td>
                                                                    <td>{{$curBalance}}</td>
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
                                                                <td class="text-right">{{$totalDebit}}</td>
                                                                <td class="text-right">{{$totalCredit}}</td>
                                                                <td class="text-right">{{$curBalance}}</td>
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
                    </div>
                </div>
                @include('includes.dashboard-footer')
            </div>

@endsection
@endsection



