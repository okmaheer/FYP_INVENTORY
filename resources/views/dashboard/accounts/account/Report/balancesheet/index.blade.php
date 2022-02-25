@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
    @include('includes.dashboard-breadcrumbs')
    <style>
        .company-txt {
            font-size: 24px;
            font-weight: bold;
        }

        .paddin5ps {
            padding: 5px;
        }

        .paddingleft10px {
            padding-left: 10px;
        }

        .balancesheet_head {
            font-size: 14px;
            font-weight: bold;
        }

        .cashflowamnt {
            padding-right: 10px;
            border-left: solid 1px #000;
            border-right: solid 1px #000;
        }
    </style>
@section('body')
    @php
        $GLOBALS['totalAssets']   = 0;
        $GLOBALS['totalLiabEqPL']   = 0;
    @endphp
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                @include('dashboard.accounts.common.filter-by-start-end-date',['route'=>'balance.sheet'])
            </div>
            <div class="card" id="printArea">
                <div class="card-body">
                    @include('includes.company-detail-header')
                    <div class="paddin5ps">
                        <table width="100%" class="table_boxnew table-bordered" cellpadding="0" cellspacing="0">
                            <tr class="table_head">
                                <td width="73%" height="29" align="center" class="cashflowparticular">
                                    <b>Particulars</b></td>

                                <td width="30%" align="right" class="cashflowamnt"><b>Amount</b>
                                </td>
                            </tr>

                            @include('dashboard.accounts.account.Report.balancesheet.assets',['totalAssets'=>$GLOBALS['totalAssets']])

                            <tr>
                                <td class="text-right" style="padding-right: 10px;">
                                    <h3>Total Assets</h3>
                                </td>
                                <td align="right" class="cashflowamnt" style="border: solid 2px #000;">
                                    <b>{{AccountHelper::number_format($GLOBALS['totalAssets'])}}</td>
                            </tr>


                            @include('dashboard.accounts.account.Report.balancesheet.liability',['totalLiabEqPL'=>$GLOBALS['totalLiabEqPL'] ])

                            @include('dashboard.accounts.account.Report.balancesheet.equity',['totalLiabEqPL'=>$GLOBALS['totalLiabEqPL'] ])
                            @include('dashboard.accounts.account.Report.balancesheet.profit-loss',['totalLiabEqPL'=>$GLOBALS['totalLiabEqPL'] ])


                            <tr>
                                <td class="text-right" style="padding-right: 10px;">
                                    <h3>Total </h3>
                                </td>
                                <td align="right" class="cashflowamnt" style="border: solid 2px #000;">
                                    <b>{{AccountHelper::number_format($GLOBALS['totalLiabEqPL'] ,2)}}</td>
                            </tr>


                        </table>
                    </div>
                    @include('includes.report-footer')
                </div>
            </div>

        </div><!-- container -->
        @include('includes.dashboard-footer')
    </div>

@endsection
@endsection
