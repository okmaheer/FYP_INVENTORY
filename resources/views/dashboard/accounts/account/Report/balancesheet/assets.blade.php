@foreach ($fixed_assets as $assets)
    @php
        $total_assets = 0;
    $head_data = QueryHelper::assets_info($assets->HeadName);
    @endphp
    <tr>
        <td align="left"
            class="paddingleft10px @if ($assets->HeadName == 'Current Asset' || $assets->HeadName == 'Non Current Assets')
            {{'balancesheet_head'}}
            @endif">
            {{$assets->HeadName}}
        </td>

        <td align="right" class="cashflowamnt">

        </td>
    </tr>
    @foreach ($head_data as $assets_head)

        @php $ass_balance = QueryHelper::assets_balance($assets_head[0]->HeadCode, $start_date, $end_date); @endphp
        @if ($assets_head[0]->PHeadName == 'Current Asset' || $assets_head[0]->PHeadName == 'Non Current Assets')
            @php

                if($assets_head[0]->PHeadName == 'Non Current Assets'){
                   $child_head_current = QueryHelper::asset_non_cur_childs($assets_head[0]->HeadName, $start_date, $end_date);
                }
                else{
                    if($assets_head[0]->HeadName == 'Inventory'){
                         $child_head_current = QueryHelper::asset_non_cur_childs($assets_head[0]->HeadName, $start_date, $end_date);
                    }
                    else{
                        $child_head_current = QueryHelper::asset_childs($assets_head[0]->HeadName, $start_date, $end_date);
                    }

                }
            @endphp
            @foreach ($child_head_current as $cchead)

                @php
                    $cur_ass_balance = QueryHelper::assets_balance($cchead[0]->HeadCode, $start_date, $end_date);

                    if($assets_head[0]->PHeadName == 'Non Current Assets'){
                        $schild_head_current = QueryHelper::asset_non_cur_childs($cchead[0]->HeadName, $start_date, $end_date);
                    }
                    elseif($assets_head[0]->HeadName == 'Inventory'){
                        $schild_head_current = QueryHelper::asset_non_cur_childs($cchead[0]->HeadName, $start_date, $end_date);
                    }
                    else{
                        $schild_head_current = QueryHelper::asset_childs($cchead[0]->HeadName, $start_date, $end_date);
                    }

                @endphp
                @if ($cur_ass_balance->balance <> 0)
                    <tr>
                        <td align="left"
                            class="paddingleft10px">{{ $cchead[0]->HeadName }}</td>

                        <td align="right" class="cashflowamnt">
                            {{ AccountHelper::number_format($cur_ass_balance->balance,2) }}
                            @php $total_assets += $cur_ass_balance->balance; @endphp

                        </td>
                    </tr>
                @endif

                @if ($cchead[0]->HeadName == 'Cash At Bank' || $cchead[0]->HeadName == 'Cash In Hand' || $cchead[0]->HeadName == 'Account Receivable' || $cchead[0]->HeadName == 'Customer Receivable' || $cchead[0]->HeadName == 'Loan Receivable')
                    @foreach ($schild_head_current as $scchild)
                        @php $cur_bank_balance = QueryHelper::assets_balance($scchild[0]->HeadCode, $start_date, $end_date) @endphp

                        @if ($cur_bank_balance->balance <> 0)
                            <tr>
                                <td align="left"
                                    class="paddingleft10px">
                                    ↳ {{$scchild[0]->HeadName}}
                                </td>

                                <td align="right" class="cashflowamnt">
                                    {{ AccountHelper::number_format($cur_bank_balance->balance,2) }}
                                    @php $total_assets += $cur_bank_balance->balance; @endphp

                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif




            @endforeach

        @endif


    @endforeach

    <tr>
        <td class="text-right" style="padding-right: 10px;">
            <b>Total {{$assets->HeadName}}</b></td>

        <td align="right" class="cashflowamnt" style="border: solid 2px #000;">
            <b>{{AccountHelper::number_format($total_assets, 2)}}</b>
            @php  $GLOBALS['totalAssets']  +=  $total_assets; @endphp
        </td>
    </tr>

@endforeach
