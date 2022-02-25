@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link rel="stylesheet" href="{{ asset('dashboard/fonts/urdu/stylesheet.css') }}">
    <style>
        @media print {
            body {
                background-color: #000  !important;
                -webkit-print-color-adjust: exact !important;
            }
            .page-wrapper {
                background-color: #000  !important;
                -webkit-print-color-adjust: exact !important;
            }
            .page-wrapper .page-wrapper-inner {
                background-color: #000  !important;
                -webkit-print-color-adjust: exact !important;
            }
            .page-content {
                background-color: #000  !important;
                -webkit-print-color-adjust: exact !important;
            }
            .container-fluid {
                background-color: #000  !important;
                -webkit-print-color-adjust: exact !important;
            }
        }
    </style>
@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')

    @section('body')

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-12 mx-auto">
                        <div class="card" id="printableArea">
                            <div class="card-body invoice-head">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="float-right d-print-none">
                                            <a href="javascript:void(0);" class="btn btn-info print-page"><i
                                                    class="fa fa-print"></i></a>
                                            <a href="{{route('dashboard.marquee.payments.create',['bookingid'=>$model->id])}}"
                                            class="btn btn-primary">Add Voucher</a>
                                            <a href="{{route('dashboard.marquee.booking.index')}}" class="btn btn-danger">Back</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 align-self-center ml-3">
                                        <h4>Booking No.:
                                            @if (!is_null($model->parent_booking_id))
                                                {{$model->parentBooking->custom_booking_number}} -
                                            @endif
                                            {{$model->custom_booking_number}}
                                        </h4>
                                    </div>
                                </div>

                            </div><!--end card-body-->

                            <div class="card-body">
                                <div class="row">
                                    <div style="width:48%">
                                        <h4>Customer Details</h4>
                                        <table style="width: 100%; border: 1px solid #dee2e6; border-collapse: collapse;">
                                            <tbody>
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 25%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">Name</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid #dee2e6;">{{ $model->customer->customer_name }}</td>
                                                </tr>
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 25%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">Phone</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid #dee2e6;">{{ $model->customer->customer_mobile }}</td>
                                                </tr>
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 25%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">Other Phone</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid #dee2e6;">{{ $model->customer->phone }}</td>
                                                </tr>
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 25%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">CNIC</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid #dee2e6;">{{ $model->customer->cnic }}</td>
                                                </tr>
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 25%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">Address</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid #dee2e6;">{{ $model->customer->customer_address }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="width:4%"></div>
                                    <div style="width:48%">
                                        <h4>Booking Details</h4>
                                        <table style="width: 100%; border: 1px solid #dee2e6; border-collapse: collapse;">
                                            <tbody>
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 30%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">Booking Date</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid #dee2e6;">{{ $model->created_at }}</td>
                                                </tr>
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 30%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">Event Date</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid #dee2e6;">{{ $model->event_date }}</td>
                                                </tr>
                                                @if ($model->event_area == 2)
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 30%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">Delivery Date</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid #dee2e6;">{{ $model->delivery_date }}</td>
                                                </tr>
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 30%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">Delivery Time</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid #dee2e6;">{{ date('g:i A', strtotime($model->delivery_time)) }}</td>
                                                </tr>
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 30%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">Delivery Address</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid #dee2e6;">{{ $model->delivery_address }}</td>
                                                </tr>
                                                @else
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 30%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">Event Time</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid #dee2e6;">{{ MarqueeHelper::eventTime($model->event_time) }}</td>
                                                </tr>
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 30%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">Venue</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid #dee2e6;">@foreach ($model->venue as $ven)
                                                                                                                        {{ $model->eventAreaName($ven) }}@if (!$loop->last), @endif
                                                                                                                    @endforeach</td>
                                                </tr>
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 30%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">No. of Persons</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid #dee2e6;">{{ $model->no_person }}</td>
                                                </tr>
                                                @endif
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 30%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">Partition</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid #dee2e6;">{{ MarqueeHelper::isPartition($model->partition) }}</td>
                                                </tr>
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 30%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">Rate Per Person</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid #dee2e6;">{{ \AccountHelper::number_format( $model->rate_per_head ) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @if(!$model->foodItems->isEmpty())
                                <div class="row">
                                    <div style="width: 100%;">
                                        <h4 class="text-center">Food Items</h4>
                                        <table style="width: 100%; border: 1px solid #dee2e6;">
                                            <thead style="background-color: #f8f9fa">
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <th style="width: 10%; font-weight: bold; text-align: left; padding: .3rem;border: 1px solid #dee2e6;">No.</th>
                                                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">Menu</th>
                                                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">No of Persons</th>
                                                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">Details</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $totalFoodPrice = 0;
                                                $currentPrice = 0;
                                            @endphp
                                            @foreach($model->foodItems as $key => $menu)
                                                @php
                                                    $currentPrice = ($menu->pivot->price * $menu->pivot->quantity) - ( ($menu->pivot->discount) ? $menu->pivot->discount : 0  );
                                                    $totalFoodPrice += $currentPrice;
                                                @endphp

                                                <tr style="border: 1px solid #dee2e6;{{ ($key+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <td style="width: 10%; text-align: left; padding: .3rem;border: 1px solid #dee2e6;">{{ $key+1 }}</td>
                                                    <td style="width: 30%; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">{{ $menu->product_name }}</td>
                                                    <td style="width: 30%; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">{{ $menu->pivot->quantity }}</td>
                                                    <td style="width: 30%; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">{{ $menu->pivot->details }}</td>

                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif

                                @if(!$model->addOnFeatures->isEmpty())
                                <div class="row">
                                    <div style="width:100%">
                                        <h4 class="text-center">Addon Services</h4>
                                        <table style="width: 100%; border: 1px solid #dee2e6;">
                                            <thead style="background-color: #f8f9fa">
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <th style="width: 10%; font-weight: bold; text-align: left; padding: .3rem;border: 1px solid #dee2e6;">No.</th>
                                                    <th style="width: 18%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">Addon</th>
                                                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">No of Persons</th>
                                                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">Details</th>



                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $totalAddonPrice = 0;
                                            @endphp
                                            @foreach($model->addOnFeatures as $key => $menu)
                                                @php
                                                    $currentPrice = $menu->pivot->total;
                                                    $totalAddonPrice += $currentPrice;
                                                @endphp

                                                <tr style="border: 1px solid #dee2e6;{{ ($key+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <td style="width: 10%; text-align: left; padding: .3rem;border: 1px solid #dee2e6;">{{ $key+1 }}</td>
                                                    <td style="width: 30%; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">{{ $menu->name }}</td>

                                                    <td style="width: 30%; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">{{ AccountHelper::number_format($menu->pivot->quantity) }}</td>
                                                    <td style="width: 30%; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">{{ $menu->pivot->details }}</td>


                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif

                                @if(!$model->seatPlannings->isEmpty())
                                <div class="row">
                                    <div style="width:100%">
                                        <h4 class="text-center">Sitting Plan</h4>
                                        <table style="width: 100%; border: 1px solid #dee2e6;">
                                            <thead style="background-color: #f8f9fa">
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <th style="width: 10%; font-weight: bold; text-align: left; padding: .3rem;border: 1px solid #dee2e6;">No.</th>
                                                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">Package</th>
                                                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">No of Persons</th>
                                                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">Details</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $totalSittingPrice = 0;
                                            @endphp
                                            @foreach($model->seatPlannings as $key => $menu)
                                                @php
                                                    $currentPrice = ($menu->pivot->price * $menu->pivot->quantity) - ( ($menu->pivot->discount) ? $menu->pivot->discount :0 );
                                                    $totalSittingPrice += $currentPrice;
                                                @endphp

                                                <tr style="border: 1px solid #dee2e6;{{ ($key+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <td style="width: 10%; text-align: left; padding: .3rem;border: 1px solid #dee2e6;">{{ $key+1 }}</td>
                                                    <td style="width: 30%; text-align: left; padding: .3rem;border: 1px solid #dee2e6;">{{ $menu->name }}</td>
                                                    <td style="width: 12%; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">{{ AccountHelper::number_format($menu->pivot->quantity) }}</td>
                                                    <td style="width: 12%; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">{{ $menu->pivot->details }}</td>


                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif

                                @if(!$model->stageDecorations->isEmpty())
                                <div class="row">
                                    <div style="width:100%">
                                        <h4 class="text-center">Stage Decorations</h4>
                                        <table style="width: 100%; border: 1px solid #dee2e6;">
                                            <thead style="background-color: #f8f9fa">
                                            <tr style="border: 1px solid #dee2e6;">
                                                    <th style="width: 10%; font-weight: bold; text-align: left; padding: .3rem;border: 1px solid #dee2e6;">No.</th>
                                                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">Name</th>
                                                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">No of Persons</th>
                                                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">Details</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $totalStagePrice = 0;
                                            @endphp
                                            @foreach($model->stageDecorations as $key => $menu)
                                                @php
                                                    $currentPrice = ($menu->pivot->price * $menu->pivot->quantity) - ( ($menu->pivot->discount) ? $menu->pivot->discount :0 );
                                                    $totalStagePrice += $currentPrice;
                                                @endphp

                                                <tr style="border: 1px solid #dee2e6;{{ ($key+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <td style="width: 10%; text-align: left; padding: .3rem;border: 1px solid #dee2e6;">{{ $key+1 }}</td>
                                                    <td style="width: 30%; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">{{ $menu->name }}</td>

                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid #dee2e6;">{{ AccountHelper::number_format($menu->pivot->quantity) }}</td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid #dee2e6;">{{ $menu->pivot->details }}</td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif

                                @php
                                    $i = 0;
                                    $totalPayment = 0;
                                    $transactionData = \MarqueeHelper::bookingTransactions($model->id);
                                @endphp
                                @if(!$transactionData->isEmpty())
                                <div class="row">
                                    <div style="width:100%">
                                        <h4 class="text-center">Payments</h4>
                                        <table style="width: 100%; border: 1px solid #dee2e6;">
                                            <thead style="background-color: #f8f9fa">
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <th style="width: 10%; font-weight: bold; text-align: left; padding: .3rem;border: 1px solid #dee2e6;">No.</th>
                                                    <th style="width: 20%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">Date</th>
                                                    <th style="width: 58%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">Remarks</th>
                                                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($transactionData as $key => $data)
                                                @if($data->Credit > 0)
                                                @php
                                                    $totalPayment += $data->Credit;
                                                    $i++;
                                                @endphp
                                                <tr style="border: 1px solid #dee2e6;{{ ($i+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <td style="width: 10%; text-align: left; padding: .3rem;border: 1px solid #dee2e6;">{{ $i }}</td>
                                                    <td style="width: 20%; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">{{ $data->VDate }}</td>
                                                    <td style="width: 58%; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">{{ $data->Narration }}</td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid #dee2e6;">{{ AccountHelper::number_format($data->Credit) }}</td>
                                                </tr>
                                                @endif
                                            @empty
                                            @endforelse
                                                <tr style="border: 1px solid #dee2e6;{{ ($i+2) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <th style="font-weight:bold;padding: .3rem; text-align: right;border: 1px solid #dee2e6;" colspan="3">Total Payment</th>
                                                    <td style="font-weight:bold;padding: .3rem; text-align: right;border: 1px solid #dee2e6;">{{AccountHelper::number_format($totalPayment)}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif

                                <!-- ALL TOTAL -->
                                <div class="row mt-3">
                                    <div style="width:100%">
                                        <table style="width: 100%; border: 1px solid #b3b7bb;">
                                            <tbody>
                                                <tr style="border: 1px solid #b3b7bb;background-color: #d6d8db;">
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">Total Bill</th>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">{{AccountHelper::number_format($model->grand_total)}}</td>
                                                </tr>
                                                <tr style="border: 1px solid #b3b7bb;background-color: #d6d8db;">
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">Global Discount</th>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">{{AccountHelper::number_format($model->misc_discount_total)}}</td>
                                                </tr>
                                                <tr style="border: 1px solid #b3b7bb;background-color: #d6d8db;">
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">Net Total</th>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">{{AccountHelper::number_format($model->net_total)}}</td>
                                                </tr>
                                                <tr style="border: 1px solid #b3b7bb;background-color: #d6d8db;">
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">Total Payment Received</th>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">{{AccountHelper::number_format($totalPayment)}}</td>
                                                </tr>
                                                <tr style="border: 1px solid #b3b7bb;background-color: #d6d8db;">
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">Remaining Balance</th>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">{{AccountHelper::number_format(MarqueeHelper::bookingTotalNetAmount($model->id) - MarqueeHelper::bookingAmountClc($model->id))}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row justify-content-center pr-1">
                                    <div style="width:55%">
                                        <h5 class="mt-4">Terms And Condition :</h5>
                                        <div @class(['urdu-font' => $terms->is_urdu ])>
                                            {!! $terms->event_terms !!}
                                        </div>
                                    </div>

                                    <div class="align-self-end" style="width: 15%;">
                                        <div class="mt-4 float-right">
                                            <small>Customer: {{ $model->customer->customer_name }}</small>
                                            <p class="border-top pt-2 text-right">&nbsp;</p>
                                        </div>
                                    </div>

                                    <div class="align-self-end" style="width: 15%;">
                                        <div class="mt-4 float-right">
                                            <small>Event Booked By: {{ $model->processingBY->name }}</small>
                                            <p class="border-top pt-2 user-signature text-right">{{ $model->processingBY->name }}</p>
                                        </div>
                                    </div>

                                    <div class="align-self-end" style="width: 15%;">
                                        <div class="mt-4 float-right">
                                            <small>Account Manager</small>
                                            <p class="border-top pt-2 text-right">&nbsp;</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row d-flex justify-content-center">
                                    <div class="text-center text-muted"><small><span class="text-muted text-center">{{ AccountHelper::CurrentCompany()->company_name }} Crafted with <i
                                        class="mdi mdi-heart text-danger"></i> by Optimum Tech www.optimumtech.org 0313-6650965</span></small>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="float-right d-print-none">
                                            <a href="javascript:void(0);" class="btn btn-info print-page"><i
                                                    class="fa fa-print"></i></a>
                                            <a href="{{route('dashboard.marquee.payments.create',['bookingid'=>$model->id])}}"
                                            class="btn btn-primary">Add Voucher</a>
                                            <a href="{{route('dashboard.marquee.booking.index')}}" class="btn btn-danger">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->

            </div><!-- container -->

            @include('includes.dashboard-footer')
        </div>

    @endsection
@endsection
@section('innerScriptFiles')
    <script src="{{ asset('js/jquery.PrintArea.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        $(".print-page").click(function() {
			var mode = 'iframe'; //popup
			var close = mode == "popup";
			var options = {
					mode: mode,
					popClose: close
			};
			$("div#printableArea").printArea(options);
		});
    </script>
@endsection
