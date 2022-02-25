@if(!empty($equities[0]))
    <tr>
        <td align="left"
            class="paddingleft10px balancesheet_head">

            {{$equities[0]->PHeadName}}

        </td>

        <td align="right" class="cashflowamnt">

        </td>
    </tr>
    @php
        $total_eqt = 0;
    @endphp
    @foreach ($equities as $equity)
        @php
            $eqt_head_data = QueryHelper::asset_non_cur_childs($equity->HeadName,$start_date, $end_date);
        @endphp



        @foreach($eqt_head_data as $data)
            @php
                $total_eqt_balance = QueryHelper::equity_balance($data[0]->HeadCode, $start_date, $end_date);
            @endphp
            <tr>
                <td align="left"
                    class="paddingleft10px">
                    ↳ {{$data[0]->HeadName}}
                </td>

                <td align="right" class="cashflowamnt">
                    @if (!empty($total_eqt_balance->balance) && $total_eqt_balance->balance <> 0)
                        {{ AccountHelper::number_format($total_eqt_balance->balance,2) }}
                        @php
                            $total_eqt += $total_eqt_balance->balance;
                        @endphp
                    @endif
                </td>
            </tr>
        @endforeach

    @endforeach


    <tr>
        <td class="paddingleft10px text-right" style="padding-right: 10px;">
            <b>Total: {{ $equities[0]->PHeadName }}</b></td>

        <td align="right" class="cashflowamnt" style="border: solid 2px #000;">
            <b>{{ AccountHelper::number_format($total_eqt, 2) }}</b>
            @php  $GLOBALS['totalLiabEqPL']   +=  $total_eqt; @endphp
        </td>
    </tr>

@endif
