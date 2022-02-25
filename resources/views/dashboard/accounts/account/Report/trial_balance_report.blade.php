@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
    @include('includes.dashboard-breadcrumbs')
    <style>

        .company-txt {
            font-size: 24px;
            font-weight: bold;
        }

        .mr-5 {
            margin-left: -43%;
        }
        .signaturetable {
            margin-top: 50px;
        }
        .footersignature {
            border-top: solid 1px #000;
        }


    </style>
@section('body')
    <div class="page-content">
        <div class="container-fluid">
            <div class="card" id="printArea">
                @include('includes.report-header')
                <div class="card-body">
                    @include('includes.company-detail-header')
                    <div class="row pb-5">
                        <div class="col-12">
                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                <table
                                    class="table table-striped mb-0 table-bordered mb-0 table-centered"
                                    cellpadding="6" cellspacing="1" width="100%">
                                        <thead>
                                        <tr>
                                            <th colspan="7" class="text-dark">Trial Balance With Opening
                                                from {{ \AccountHelper::date_format( $filterDate['start_date'] ) }}
                                                - {{ \AccountHelper::date_format( $filterDate['end_date'] ) }}</th>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Code</th>
                                            <th class="text-left">Account Name</th>
                                            <th class="text-left">Debit</th>
                                            <th class="text-left">Credit</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $TotalCredit=0;
                                                $TotalDebit=0;
                                                $k=0;
                                            @endphp
                                            @for($i=0;$i<count($oResultTr);$i++)

                                            @php $COAID=$oResultTr[$i]->HeadCode;

                                                        $oResultTrial=QueryHelper::trial_balance_firstquery($filterDate['start_date'],$filterDate['end_date'],$COAID);

                                                        $bg=$k&1?"#FFFFFF":"#E7E0EE";
                                            @endphp
                                            @if($oResultTrial[0]->Credit != $oResultTrial[0]->Debit)


                                                @php  $k++; @endphp

                                                <tr class="table_data">
                                                    <td align="left" bgcolor="{{$bg}}">{{ $oResultTr[$i]->HeadCode }}
                                                    </td>
                                                    <td align="left"
                                                        bgcolor="{{$bg}}">{{ $oResultTr[$i]->HeadName }}</td>

                                                    @if($oResultTrial[0]->Debit>$oResultTrial[0]->Credit)


                                                        <td align="right" bgcolor="{{$bg}}">
                                                            @php   $TotalDebit += $oResultTrial[0]->Debit-$oResultTrial[0]->Credit; @endphp
                                                            {{ AccountHelper::number_format($oResultTrial[0]->Debit-$oResultTrial[0]->Credit,2) }}
                                                        </td>
                                                        <td align="right" bgcolor="{{$bg}}">
                                                            {{ AccountHelper::number_format(0) }}</td>


                                                    @else


                                                        <td align="right" bgcolor="{{$bg}}">
                                                            {{ number_format('0.00',2) }}
                                                        </td>
                                                        <td align="right" bgcolor="{{$bg}}">
                                                            @php $TotalCredit += $oResultTrial[0]->Credit-$oResultTrial[0]->Debit; @endphp
                                                            {{ number_format($oResultTrial[0]->Credit-$oResultTrial[0]->Debit,2) }} </td>

                                                    @endif

                                                </tr>

                                            @endif
                                        @endfor

                                            @for($i=0;$i<count($oResultInEx);$i++)

                                            @php $COAID=$oResultInEx[$i]->HeadCode;

                            $oResultTrial= QueryHelper::trial_balance_secondquery($dtpFromDate,$dtpToDate,$COAID);



                            $bg=$k&1?"#FFFFFF":"#E7E0EE";
                                            @endphp
                                            @if($oResultTrial[0]->Credit!=$oResultTrial[0]->Debit)


                                                @php  $k++; @endphp
                                                <tr class="table_data">
                                                    <td align="center" bgcolor="{{$bg}}">{{ $oResultInEx[$i]->HeadCode }}
                                                    </td>
                                                    <td align="center"
                                                        bgcolor="{{$bg}}">{{ $oResultInEx[$i]->HeadName }}</td>

                                                    @if($oResultTrial[0]->Debit>$oResultTrial[0]->Credit)

                                                        <td align="right" bgcolor="{{$bg}}">
                                                            @php $TotalDebit += $oResultTrial[0]->Debit-$oResultTrial[0]->Credit; @endphp
                                                            {{ number_format($oResultTrial[0]->Debit-$oResultTrial[0]->Credit,2) }}
                                                        </td>
                                                        <td align="right" bgcolor="{{$bg}}">
                                                            {{ number_format('0.00',2) }}</td>

                                                    @else
                                                        <td align="right" bgcolor="{{$bg}}">
                                                            {{ number_format('0.00',2) }}
                                                        </td>
                                                        <td align="right" bgcolor="{{$bg}}">
                                                            @php $TotalCredit += $oResultTrial[0]->Credit-$oResultTrial[0]->Debit @endphp
                                                            {{ number_format($oResultTrial[0]->Credit-$oResultTrial[0]->Debit,2)  }}</td>
                                                    @endif
                                                </tr>

                                            @endif
                                        @endfor

                                            @php $ProfitLoss=$TotalDebit-$TotalCredit; @endphp
                                            @if($ProfitLoss!=0)


                                            <tr class="table_data">
                                                <td align="left" bgcolor="{{$bg}}">&nbsp;</td>
                                                <td align="left" bgcolor="{{$bg}}">Profit-Loss</td>
                                                @endif
                                                @if($ProfitLoss<0)

                                                    <td align="right" bgcolor="{{$bg}}">
                                                        @php $TotalDebit += abs($ProfitLoss) @endphp
                                                        {{ number_format( abs($ProfitLoss),2) }}
                                                    </td>
                                                    <td align="right" bgcolor="{{$bg}}">
                                                        {{ number_format('0.00',2) }}</td>

                                            </tr>

                                        @elseif($ProfitLoss>0)

                                            <td align="right" bgcolor="{{ $bg }}">
                                                {{ number_format('0.00',2) }}
                                            </td>
                                            <td align="right" bgcolor="{{ $bg }}">
                                                @php  $TotalCredit+= abs($ProfitLoss) @endphp
                                                {{ number_format(abs($ProfitLoss),2) }}</td>

                                            </tr>
                                        @endif


                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-right"><b>Total</b></td>
                                                <td class="text-right">{{ \AccountHelper::number_format( $TotalDebit ) }}</td>
                                                <td class="text-right">{{ \AccountHelper::number_format( $TotalCredit ) }}</td>
                                            </tr>
                                        </tfoot>
                                </table>
                                <table width="100%" cellpadding="1" cellspacing="20" class="signaturetable pt-2">
                                    <tr>
                                        <td width="20%" class="footersignature"
                                            align="center">Prepared By</td>
                                        <td width="20%" class="footersignature"
                                            align="center">Accounts</td>
                                        <td width="20%" class="footersignature"
                                            align='center'>Chairman</td>
                                    </tr>
                                </table>
                            </div>
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



