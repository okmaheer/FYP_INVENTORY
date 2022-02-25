<div class="row mt-3">
    <div class="col-md-12 bg-dark text-center">
        <h3 class="text-white">Addon Booking Details</h3>
    </div>
</div>

<div class="row mt-3">
    <div style="width:50%"></div>
    <div style="width:50%">
        <table style="width: 100%; border: 1px solid var(--table-border); border-collapse: collapse;">
            <tbody>
                <tr style="border: 1px solid var(--table-border);">
                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">No. of Persons</td>
                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border);">{{ $addonModel->no_person }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@php
    $addon_foodTotal = 0;
    $addon_addonTotal = 0;
@endphp
@if(!$addonModel->foodItems->isEmpty())
<div class="row">
    <div style="width: 100%;">
        <h4 class="text-center">Food Items</h4>
        <table style="width: 100%; border: 1px solid var(--table-border);">
            <thead style="background-color: var(--table-header-color)">
                <tr style="border: 1px solid var(--table-border);">
                    <th style="width: 10%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">No.</th>
                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Menu</th>
                    <th style="width: 10%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Qty.</th>
                    <th style="width: 10%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Price</th>
                    <th style="width: 10%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Total</th>
                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Details</th>
                </tr>
            </thead>
            <tbody>
            @foreach($addonModel->foodItems as $key => $menu)
                @php $addon_foodTotal += $menu->pivot->total; @endphp
                <tr style="border: 1px solid var(--table-border);{{ ($key+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $key+1 }}</td>
                    <td style="width: 30%; text-align: left; padding: .3rem;border: 1px solid var(--table-border);"><b>{{ strtoupper( $menu->product_name ) }}</b></td>
                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->quantity > 0 ? $menu->pivot->quantity : ''}}</td>
                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->price > 0 ? \AccountHelper::number_format( $menu->pivot->price ) : '' }}</td>
                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->total > 0 ? \AccountHelper::number_format( $menu->pivot->total ) : '' }}</td>
                    <td style="width: 30%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->details }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@if(!$addonModel->addOnFeatures->isEmpty())
<div class="row">
    <div style="width:100%">
        <h4 class="text-center">Addon Services</h4>
        <table style="width: 100%; border: 1px solid var(--table-border);">
            <thead style="background-color: var(--table-header-color)">
                <tr style="border: 1px solid var(--table-border);">
                    <th style="width: 10%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">No.</th>
                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Addon</th>
                    <th style="width: 10%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Qty.</th>
                    <th style="width: 10%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);"># of Hours</th>
                    <th style="width: 10%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Price</th>
                    <th style="width: 10%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Total</th>
                    <th style="width: 20%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Details</th>
                </tr>
            </thead>
            <tbody>
            @foreach($addonModel->addOnFeatures as $key => $menu)
                @php $addon_addonTotal += $menu->pivot->total; @endphp
                <tr style="border: 1px solid var(--table-border);{{ ($key+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $key+1 }}</td>
                    <td style="width: 30%; text-align: left; padding: .3rem;border: 1px solid var(--table-border);"><b>{{ strtoupper($menu->name) }}</b></td>
                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->quantity > 0 ? $menu->pivot->quantity : '' }}</td>
                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->hourly > 0 ? $menu->pivot->hourly : '' }}</td>
                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->price > 0 ? \AccountHelper::number_format( $menu->pivot->price ) : '' }}</td>
                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->total > 0 ? \AccountHelper::number_format( $menu->pivot->total ) : '' }}</td>
                    <td style="width: 20%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->details }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@if(!$addonModel->seatPlannings->isEmpty())
<div class="row">
    <div style="width:100%">
        <h4 class="text-center">Sitting Plan</h4>
        <table style="width: 100%; border: 1px solid var(--table-border);">
            <thead style="background-color: var(--table-header-color)">
                <tr style="border: 1px solid var(--table-border);">
                    <th style="width: 10%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">No.</th>
                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Package</th>
                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">No. of Persons</th>
                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Details</th>
                </tr>
            </thead>
            <tbody>
            @foreach($addonModel->seatPlannings as $key => $menu)
                <tr style="border: 1px solid var(--table-border);{{ ($key+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $key+1 }}</td>
                    <td style="width: 30%; text-align: left; padding: .3rem;border: 1px solid var(--table-border);"><b>{{ strtoupper( $menu->name ) }}</b></td>
                    <td style="width: 12%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->quantity > 0 ? \AccountHelper::number_format($menu->pivot->quantity) : '' }}</td>
                    <td style="width: 12%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->details }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@if(!$addonModel->stageDecorations->isEmpty())
<div class="row">
    <div style="width:100%">
        <h4 class="text-center">Stage Decorations</h4>
        <table style="width: 100%; border: 1px solid var(--table-border);">
            <thead style="background-color: var(--table-header-color)">
                <tr style="border: 1px solid var(--table-border);">
                    <th style="width: 10%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">No.</th>
                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Name</th>
                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Qty.</th>
                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Price</th>
                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Net Amount</th>
                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Discount</th>
                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Total</th>
                </tr>
            </thead>
            <tbody>
            @php
                $totalStagePrice = 0;
            @endphp
            @foreach($addonModel->stageDecorations as $key => $menu)
                @php
                    $totalStagePrice += $menu->pivot->total;
                @endphp
                <tr style="border: 1px solid var(--table-border);{{ ($key+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $key+1 }}</td>
                    <td style="width: 30%; text-align: left; padding: .3rem;border: 1px solid var(--table-border);"><b>{{ strtoupper($menu->name) }}</b></td>
                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->quantity > 0 ? $menu->pivot->quantity : '' }}</td>
                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->price > 0 ? \AccountHelper::number_format( $menu->pivot->price ) : '' }}</td>
                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->net_total > 0 ? \AccountHelper::number_format( $menu->pivot->net_total ) : '' }}</td>
                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->discount > 0 ? \AccountHelper::number_format( $menu->pivot->discount ) : '' }}</td>
                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->total > 0 ? \AccountHelper::number_format( $menu->pivot->total ) : '' }}</td>
                </tr>
            @endforeach
            <tr style="border: 1px solid var(--table-border);{{ ($key+2) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                <td style="font-weight:bold;padding: .3rem; text-align: right;border: 1px solid var(--table-border);" colspan="6">Total Stage Decorations Price</td>
                <td style="font-weight:bold;padding: .3rem; text-align: right;border: 1px solid var(--table-border);">{{ AccountHelper::number_format($totalStagePrice) }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
@endif

<!-- ADDITIONAL DETAILS -->
@if (!empty($addonModel->booking_detail))
<div class="row">
    <div class="col-md-12">
        <h5 class="mt-4">Additional Details:</h5>
        <p>{{ $addonModel->booking_detail }}</p>
    </div>
</div>
@endif
