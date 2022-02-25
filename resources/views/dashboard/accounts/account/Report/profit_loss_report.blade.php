@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
    @include('includes.dashboard-breadcrumbs')

    @php
        $GLOBALS['TotalAssertF']   = 0;
        $GLOBALS['TotalLiabilityF']= 0;
    @endphp

@section('body')
    <div class="page-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-rep-plugin mt-3" id="printArea">
                                @include('includes.company-detail-header')
                                <div class="table-responsive" data-pattern="priority-columns">
                                    <table class="table table-bordered" >
                                        <thead>
                                        <tr class="text-center">
                                            <th colspan="2"><h3 class="mt-0 mb-0 text-dark"><b>Statement of Comprehensive Income<br/>From {{$date['start_date']}} To {{$date['end_date']}}</b></h3></th>
                                        </tr>
                                        <tr>
                                            <th width="85%" class="text-center" style="color: #FFFFFF !important; background-color: #5766da !important;"><h4><b>Particulars</b></h4></th>
                                            <th width="15%" class="text-center" style="color: #FFFFFF !important; background-color: #5766da !important;"><h4><b>Amount</b></h4></th>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @for($i=0;$i<count($oResultAsset);$i++)
                                            {{ $Visited[$i] = false }}
                                        @endfor

                                        @php
                                            QueryHelper::AssertCoa("COA","0",0,$oResultAsset,$Visited,0,$date['start_date'],$date['end_date'],0);
                                         $TotalAssetF=$GLOBALS['TotalAssertF']
                                        @endphp

                                        <tr>
                                            <td align="right" style="color: #5766da !important; background-color: rgba(87, 102, 218, 0.15) !important;"><h4 class="mt-0 mb-0">Total Income</h4></td>
                                            <td align="right" style="color: #5766da !important; background-color: rgba(87, 102, 218, 0.15) !important;"><h4 class="mt-0 mb-0">{{ AccountHelper::number_format($TotalAssetF)}}</h4></td>
                                        </tr>




                                        @php
                                            $totalGoods= QueryHelper::costOfGoodsSold($date['start_date'],$date['end_date']);
                                        @endphp


                                        <tr>
                                            <td align='left'><h5 class='mt-0 mb-0'>Cost Of Goods Sold</h5></td>
                                            <td align='right'><h5 class='mt-0 mb-0'>{{AccountHelper::number_format($totalGoods['totalCOGS'],2)}}</h5></td>
                                        </tr>
                                        <tr>
                                            <td align='left'><h5 class='mt-0 mb-0'>Gross Profit</h5></td>
                                            <td align='right'><h5 class='mt-0 mb-0'>{{AccountHelper::number_format($totalGoods['gProfit'],2)}}</h5></td>
                                        </tr>

                                        {{--                                                <tr>--}}
                                        {{--                                                    <td align="right" style="color: #5766da !important; background-color: rgba(87, 102, 218, 0.15) !important;"><h4 class="mt-0 mb-0">Total Inventory</h4></td>--}}
                                        {{--                                                    <td align="right" style="color: #5766da !important; background-color: rgba(87, 102, 218, 0.15) !important;"><h4 class="mt-0 mb-0">{{ AccountHelper::number_format($TotalAssetF)}}</h4></td>--}}
                                        {{--                                                </tr>--}}

                                        <tr>
                                            <td colspan="2" align="right"></td>
                                        </tr>
                                        @for($i=0;$i<count($oResultLiability);$i++)
                                            @php $Visited[$i] = false @endphp
                                        @endfor
                                        @php $GLOBALS['TotalLiability'] = 0;
                                            QueryHelper::AssertCoa("COA","0",0,$oResultLiability,$Visited,0,$date['start_date'],$date['end_date'],1);
                                            $TotalLibilityF=$GLOBALS['TotalLiabilityF'];
                                        @endphp


                                        <tr>
                                            <td align="right" style="color: #5766da !important; background-color: rgba(87, 102, 218, 0.15) !important;"><h4 class="mt-0 mb-0">Total Expense</h4></td>
                                            <td align="right" style="color: #5766da !important; background-color: rgba(87, 102, 218, 0.15) !important;"><h4 class="mt-0 mb-0">{{AccountHelper::number_format($TotalLibilityF)}}</h4></td>
                                        </tr>
                                        <tr class="profitloss-result">



                                            <td align="right" style="color: #FFFFFF !important; background-color: #5766da !important;"><h3 class="mt-0 mb-0">Profit-Loss

                                                    @if($TotalAssetF>$TotalLibilityF) (Profit)
                                                    @elseif($TotalAssetF=$TotalLibilityF) (Break-Even)
                                                    @else (Loss)
                                                    @endif

                                                </h3></td>
                                            <td align="right" style="color: #FFFFFF !important; background-color: #5766da !important;"><h3 class="mt-0 mb-0">{{ AccountHelper::number_format($totalGoods['gProfit']-$TotalLibilityF,2) }}</h3></td>
                                        </tr>
                                        </tbody>

                                    </table>



                                </div>
                                @include('includes.report-footer')
                            </div>
                            <div class="col-12 py-3 text-right">
                                {!! Form::button('Print', ['class' => 'btn btn-primary w-sm', 'id' => "printBtn"]) !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div><!-- container -->
        </div>
        @include('includes.dashboard-footer')
    </div>

@endsection
@endsection
