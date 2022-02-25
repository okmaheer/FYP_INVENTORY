@foreach ($liabilities as $liability)
    @php
        $total_liab = 0;
    $liab_head_data = QueryHelper::liabilities_info($liability->HeadName);
    @endphp
    <tr>
        <td align="left"
            class="paddingleft10px
                            @if ($liability->HeadName == 'Current Liabilities' || $liability->HeadName == 'Non Current Liabilities')
            {{'balancesheet_head'}}
            @endif"
        >
            {{$liability->HeadName}}
        </td>

        <td align="right" class="cashflowamnt">

        </td>
    </tr>

    @foreach ($liab_head_data as $liab_head)

        @if ($liab_head->HeadName == 'Tax')
            @php $child_liability = QueryHelper::liabilities_info_tax($liab_head->HeadName); @endphp
        @else
            @php $child_liability = QueryHelper::liabilities_info($liab_head->HeadName); @endphp
        @endif

        @if ($liab_head->HeadName != 'Tax')
            <tr>
                <td align="left"
                    class="paddingleft10px">{{$liab_head->HeadName}}</td>

                <td align="right" class="cashflowamnt">
                    @php
                        $total_liab += 0;
                    @endphp
                </td>
            </tr>
        @endif

        @foreach ($child_liability as $chliab_head)
            @php $liab_balance = QueryHelper::liabilities_balance($chliab_head->HeadCode, $start_date, $end_date); @endphp
            @if (!empty($liab_balance->balance) && $liab_balance->balance <> 0)
                <tr>
                    <td align="left"
                        class="paddingleft10px"> ↳ {{ $chliab_head->HeadName }}</td>

                    <td align="right" class="cashflowamnt">
                        {{ AccountHelper::number_format($liab_balance->balance,2) }}
                        @php $total_liab += $liab_balance->balance; @endphp

                    </td>
                </tr>
            @endif

        @endforeach
    @endforeach
    <tr>
        <td class="paddingleft10px text-right" style="padding-right: 10px;">
            <b>Total: <?php echo $liability->HeadName; ?></b></td>

        <td align="right" class="cashflowamnt" style="border: solid 2px #000;">
            <b>{{ AccountHelper::number_format($total_liab, 2) }}</b>
            @php  $GLOBALS['totalLiabEqPL']   +=  $total_liab; @endphp
        </td>
    </tr>
@endforeach
