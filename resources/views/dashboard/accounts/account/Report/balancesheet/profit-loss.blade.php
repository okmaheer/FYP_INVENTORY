@php
    $GLOBALS['TotalAssertF']   = 0;
$GLOBALS['TotalLiabilityF']= 0;
@endphp
<tr>
    <td class="paddingleft10px text-right" style="padding-right: 10px;">
        <b>Total: P&L</b>
    </td>

    <td align="right" class="cashflowamnt" style="border: solid 2px #000;">


        @for($i=0;$i<count($oResultAsset);$i++)
            {{ $Visited[$i] = false }}
        @endfor

        @php
            QueryHelper::AssertCoaWithoutHtml("COA","0",0,$oResultAsset,$Visited,0,$start_date, $end_date,0);
         $TotalAssetF=$GLOBALS['TotalAssertF'];
        @endphp


        @for($i=0;$i<count($oResultClosingInventory);$i++)
            {{ $Visited[$i] = false }}
        @endfor

        @php
            QueryHelper::AssertCoaWithoutHtml("Current Asset","0",0,$oResultClosingInventory,$Visited,1,$start_date, $end_date,0);
         $TotalAssetF=$GLOBALS['TotalAssertF']
        @endphp



        @for($i=0;$i<count($oResultLiability);$i++)
            @php $Visited[$i] = false @endphp
        @endfor
        @php $GLOBALS['TotalLiability'] = 0;
                                                QueryHelper::AssertCoaWithoutHtml("COA","0",0,$oResultLiability,$Visited,0,$start_date, $end_date,1);
                                                $TotalLibilityF=$GLOBALS['TotalLiabilityF'];
        @endphp

        <b>{{ AccountHelper::number_format($TotalAssetF-$TotalLibilityF, 2) }}</b>
        @php  $GLOBALS['totalLiabEqPL']   +=  $TotalAssetF-$TotalLibilityF; @endphp


    </td>
</tr>
