<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deskbook ERP | Event Booking Invoice - {{ $model->custom_booking_number }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('/images/favicon.svg') }}" type="image/gif" >
    <link rel="stylesheet" href="{{ asset('dashboard/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/fonts/signature/stylesheet.css') }}">

    <style>
        #invoice{
            padding: 15px;
        }
        body {
            background-color: #fff;
        }
        .cell-blue {
            color: #3989c6 !important;
            border-top: 1px solid #3989c6 !important;
        }
        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #3989c6
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #3989c6
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 50px
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #3989c6
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }

        .invoice table td,.invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #3989c6;
            font-size: 1.2em
        }

        .invoice table .qty,.invoice table .total,.invoice table .unit {
            text-align: right;
            font-size: 1.2em;
            width: 15%;
        }

        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #3989c6;
            width: 8%;
        }

        .invoice table .unit {
            background: #ddd;
        }

        .invoice table .total {
            background: #3989c6;
            color: #fff
        }

        .invoice table tbody tr:last-child td {
            border: none
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }

        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .invoice table tfoot tr:last-child td {
            color: #3989c6;
            font-size: 1.4em;
            border-top: 1px solid #3989c6
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #3989c6;
            padding: 8px 0
        }

        @media print {
            .invoice {
                font-size: 11px!important;
                overflow: hidden!important
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }

            .invoice>div:last-child {
                page-break-before: always
            }
        }
    </style>
</head>
<body>
<div id="invoice">
    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto" id="printArea">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <img src="{{ asset(auth()->user()->location->logo) }}" style="width:128px" />
                    </div>
                    <div class="col company-details">
                        <h2 class="name">{{ auth()->user()->location->name }}</h2>
                        <h5 style="margin: 0px;">{!! auth()->user()->location->address_1 !!} {!! auth()->user()->location->address_2 !!}</h5>
                        <h5 style="margin: 0px;">{{ auth()->user()->location->phone_1 }}</h5>
                        <h5 style="margin: 0px;">{{ auth()->user()->location->mobile_1 }}</h5>
                        <h5 style="margin: 0px;">{{ auth()->user()->location->website }}</h5>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <h4 class="text-gray-light">INVOICE TO:</h4>
                        <h1 class="to">{{ $model->customer->customer_name }}</h1>
                        <h4 class="address">{{ $model->customer->customer_address }}</h4>
                        <h4 class="email">{{ $model->customer->customer_mobile }}</h4>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">{{ $model->custom_booking_number }}</h1>
                        <h4 class="date">Date of Invoice: {{ \Carbon\Carbon::today()->format(\AccountHelper::settings()->date_format) }}</h4>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th style="font-weight: bold;">#</th>
                        <th class="text-left" style="font-weight: bold;">DESCRIPTION</th>
                        <th class="text-right" style="font-weight: bold;">QUANTITY</th>
                        <th class="text-right" style="font-weight: bold;">RATE</th>
                        <th class="text-right" style="font-weight: bold;">AMOUNT</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $id = 1;
                            $add_charges = 0;
                            $sub_total = 0;
                            $tax = 0;
                            $tax_name = 'TAX (<h6 style="display: inline;">';
                            $discount = 0;
                            $total_persons = $model->no_person + (empty($model->addonBooking) ? 0 : $model->addonBooking->no_person );

                        @endphp
                        <tr>
                            <td class="no">0{{ $id }}</td>
                            <td class="text-left">
                                <h3>{{ \MarqueeHelper::EventType( $model->event_type )  }} Event</h3>
                            </td>
                            <td class="unit">{{ $total_persons }} Persons</td>
                            <td class="qty">{{ \AccountHelper::number_format( $model->rate_per_head ) }}</td>
                            <td class="total">{{ \AccountHelper::number_format( \MarqueeHelper::bookingGrandAmount($model->id, true) ) }}</td>
                            @php
                                $sub_total += \MarqueeHelper::bookingGrandAmount($model->id, true);
                                $tax += $model->total_tax;
                                if (!empty($model->tax_id)) {
                                    $tax_name .= $model->tax->tax_name;
                                }
                                $discount += $model->misc_discount_value;
                            @endphp
                        </tr>
                        @if($model->event_area == 2 && !empty($model->delivery_charges))
                            @php $id += 1; @endphp
                            <tr>
                                <td class="no">0{{ $id }}</td>
                                <td class="text-left">
                                    <h3>Delivery Charges</h3>
                                </td>
                                <td class="unit">1</td>
                                <td class="qty">{{  \AccountHelper::number_format(  $model->delivery_charges ) }}</td>
                                <td class="total">{{  \AccountHelper::number_format(  $model->delivery_charges ) }}</td>
{{--                                @php $sub_total += $model->delivery_charges; @endphp--}}
                            </tr>
                        @endif

                        @if(!$model->stageDecorations->isEmpty())
                            @php $id += 1; @endphp
                            <tr>
                                <td class="no">0{{ $id }}</td>
                                <td class="text-left">
                                    <h3>Stage Booking</h3>
                                </td>
                                <td class="unit">1</td>
                                <td class="qty">{{  \AccountHelper::number_format( \MarqueeHelper::stageTotalNetAmount( null, $model->stages->id ) ) }}</td>
                                <td class="total">{{  \AccountHelper::number_format( \MarqueeHelper::stageTotalNetAmount( null, $model->stages->id ) ) }}</td>
                                @php
                                    $sub_total += \MarqueeHelper::stageTotalNetAmount( null, $model->stages->id );
                                    $discount += $model->stages->discount_total;
                                @endphp
                            </tr>
                        @endif
                        {{--@if (!empty($model->addonBooking))
                            @php $id += 1; @endphp
                            <tr>
                                <td class="no">0{{ $id }}</td>
                                <td class="text-left">
                                    <h3>Addon Booking</h3>
                                    @if(!empty($model->addonBooking->additional_charges))
                                        @php $add_charges = $model->addonBooking->additional_charges; @endphp
                                        <p style="margin-bottom:0rem !important;">Additional Charges: {{ \AccountHelper::number_format( $model->addonBooking->additional_charges ) }}</p>
                                    @else
                                        @php $add_charges = 0; @endphp
                                    @endif
                                </td>
                                <td class="unit">{{ $model->addonBooking->no_person }} Persons</td>
                                <td class="qty">{{ \AccountHelper::number_format( $model->addonBooking->rate_per_head ) }}</td>
                                <td class="total">{{ \AccountHelper::number_format( ($model->addonBooking->no_person * $model->addonBooking->rate_per_head) + $add_charges ) }}</td>
                                @php
                                    $sub_total += (($model->addonBooking->no_person * $model->addonBooking->rate_per_head) + $add_charges );
                                    $tax += $model->addonBooking->total_tax;
                                    if (!empty($model->addonBooking->tax_id)) {
                                        $tax_name .= 'Addon Booking (' . $model->addonBooking->tax->tax_name . ')';
                                    }
                                    $discount += $model->addonBooking->misc_discount_value;
                                @endphp
                            </tr>
                        @endif--}}
                    </tbody>
                    <tfoot>
                        @php $grand_amount = ($sub_total + $tax); $tax_name .= '</h6>)'; @endphp
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUB TOTAL</td>
                            <td>{{ \AccountHelper::number_format( $sub_total) }}</td>
                        </tr>
                        @if($tax > 0)
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">{!! $tax_name !!}</td>
                            <td>(+){{ \AccountHelper::number_format( $tax ) }}</td>
                        </tr>
                        @endif
                        @if($discount > 0)
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>{{ \AccountHelper::number_format( $grand_amount ) }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">DISCOUNT</td>
                            <td>(-){{ \AccountHelper::number_format( $discount ) }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" class="cell-blue" style="font-weight: bold;">AMOUNT PAYABLE</td>
                            <td class="cell-blue" style="font-weight: bold;">{{ \AccountHelper::number_format( ($grand_amount - $discount) ) }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" style="font-weight: bold;">TOTAL RECEIVED</td>
                            <td style="font-weight: bold;">{{ \AccountHelper::number_format( \MarqueeHelper::bookingAmountClc($model->id) ) }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2" style="font-weight: bold;">REMAINING BALANCE</td>
                            <td style="font-weight: bold;">{{ \AccountHelper::number_format( (($grand_amount - $discount) - \MarqueeHelper::bookingAmountClc($model->id)) ) }}</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="thanks">Thank you!</div>
            </main>
            <footer>
                <div class="row">
                    <div class="col-12 text-center">
                        <h4 style="color: #000000;">
                            {{ auth()->user()->location->name }},{!! str_repeat('&nbsp;', 1) !!}
                            {{ auth()->user()->location->address_1 }} {{ auth()->user()->location->address_2 }}<br>
                            Contact: {{ auth()->user()->location->phone_1 }}, {{ auth()->user()->location->mobile_1 }}
                        </h4>
                    </div>
                    <div class="col-12" style="text-align: left;">
                        <div class="text-muted">
                            <small>
                                <span class="text-muted">
                                    Software provided by Optimum Tech<br>www.theoptimumtech.com 0313-6650965
                                </span>
                            </small>
                        </div>
                    </div>
                </div>
            </footer>
            <div></div>
        </div>
        <div></div>
    </div>
</div>

<script src="{{ asset('dashboard/vendor.min.js') }}"></script>
<script>
    $('#printInvoice').click(function(){
        var printContents = document.getElementById('printArea').outerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        // document.body.style.marginTop = "0px";
        window.print();
        document.body.innerHTML = originalContents;
    });
</script>
</body>
</html>
