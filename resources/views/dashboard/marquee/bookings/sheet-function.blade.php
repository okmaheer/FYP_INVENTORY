@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link rel="stylesheet" href="{{ asset('dashboard/fonts/urdu/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/marquee-print-tables.css') }}">
@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')

    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="printableArea">
                            <div class="card-body" style="padding-top: 0.5rem !important;">
                                @include('dashboard.marquee.common.report-header', ['page_title' => 'Event Booking'])
                                <div class="row">
                                    <div class="col-12">
                                        <div class="float-right d-print-none">
                                            <a href="javascript:void(0);" class="btn btn-info print-page"><i
                                                    class="fa fa-print"></i></a>
                                            <a href="{{route('dashboard.marquee.payments.create',['bookingid'=>$model->id])}}"
                                            class="btn btn-primary">Add Voucher</a>
                                            <a href="{{route('dashboard.marquee.booking.index')}}" class="btn btn-danger">Back</a>
                                        </div>
                                    </div>
                                    <div class="col-12 ml-3">
                                        <h4>Booking No.:
                                            @if (!is_null($model->parent_booking_id))
                                                {{$model->parentBooking->custom_booking_number}} -
                                            @endif
                                            {{$model->custom_booking_number}}
                                        </h4>
                                    </div>
                                </div>

                            </div><!--end card-body-->

                            <div class="card-body" style="padding-top: 0.5rem !important;">
                                <div class="row">
                                    <div style="width:48%">
                                        <h4>Customer Details</h4>
                                        <table class="details-table" style="width: 100%; border: 1px solid var(--table-border); border-collapse: collapse;">
                                            <tbody>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 25%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Name</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ $model->customer->customer_name }}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 25%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Phone</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ $model->customer->customer_mobile }}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 25%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Other Phone</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ $model->customer->phone }}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 25%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">CNIC</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ $model->customer->cnic }}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 25%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Address</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ $model->customer->customer_address }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="width:4%"></div>
                                    <div style="width:48%">
                                        <h4>Booking Details</h4>
                                        <table class="details-table" style="width: 100%; border: 1px solid var(--table-border); border-collapse: collapse;">
                                            <tbody>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Booking Date</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ \AccountHelper::date_format( $model->created_at ) }}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Event Date</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ \AccountHelper::date_format( $model->event_date ) }} ({{ \Carbon\Carbon::parse( $model->event_date)->format('l') }})</td>
                                                </tr>
                                                @if ($model->event_area == 2)
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Event Type</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ \MarqueeHelper::EventType( $model->event_type ) }}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Delivery Date</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ \AccountHelper::date_format(  $model->delivery_date ) }} ({{ \Carbon\Carbon::parse( $model->delivery_date)->format('l') }})</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Delivery Time</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ date('h:i A', strtotime($model->delivery_time)) }}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Delivery Address</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ $model->delivery_address }}</td>
                                                </tr>
                                                @else
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Event Time</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ MarqueeHelper::eventTime($model->event_time) }} ({{ date('h:i A', strtotime($model->start_time)) }} - {{ date('h:i A', strtotime($model->end_time)) }})</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Meal Time</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ date('h:i A', strtotime($model->meal_time)) }}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Event Type</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ \MarqueeHelper::EventType( $model->event_type ) }}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Venue</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">@foreach ($model->venue as $ven)
                                                                                                                        {{ $model->eventAreaName($ven) }}@if (!$loop->last), @endif
                                                                                                                    @endforeach</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">No. of Persons</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ $model->no_person }}</td>
                                                </tr>
                                                @endif
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Partition</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ MarqueeHelper::isPartition($model->partition) }}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Rate Per Person</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ \AccountHelper::number_format( $model->rate_per_head, 0 ) }}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Care Of</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ $model->care_of }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @php $foodTotal = 0; $addonTotal = 0; @endphp
                                @if(!$model->foodItems->isEmpty())
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
                                            @foreach($model->foodItems as $key => $menu)
                                                @php $foodTotal += $menu->pivot->total; @endphp
                                                <tr style="border: 1px solid var(--table-border);{{ ($key+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $key+1 }}</td>
                                                    <td style="width: 30%; text-align: left; padding: .3rem;border: 1px solid var(--table-border);"><b>{{ strtoupper($menu->product_name) }}</b></td>
                                                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->quantity > 0 ? $menu->pivot->quantity : ''}}</td>
                                                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->price > 0 ? \AccountHelper::number_format( $menu->pivot->price ) : ''}}</td>
                                                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->total > 0 ? \AccountHelper::number_format( $menu->pivot->total ) : ''}}</td>
                                                    <td style="width: 30%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->details }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif
                                @if (!$model->extraFoodItems->isEmpty())
                                    <div class="row">
                                        <div style="width: 100%;">
                                            <h4 class="text-center">Extra Food Items</h4>
                                            <table style="width: 100%; border: 1px solid var(--table-border);">
                                                <thead style="background-color: var(--table-header-color)">
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <th style="width: 10%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">No.</th>
                                                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Item Name</th>
                                                    <th style="width: 10%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Price</th>
                                                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Details</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($model->extraFoodItems as $key => $item)
                                                    @php $foodTotal += $item->pivot->total; @endphp
                                                    <tr style="border: 1px solid var(--table-border);{{ ($key+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                        <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $key+1 }}</td>
                                                        <td style="width: 30%; text-align: left; padding: .3rem;border: 1px solid var(--table-border);"><b>{{ strtoupper($item->name) }}</b></td>
                                                        <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $item->pivot->price > 0 ? \AccountHelper::number_format( $item->pivot->price ) : '' }}</td>
                                                        <td style="width: 30%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $item->pivot->details }}</td>
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
                                            @foreach($model->addOnFeatures as $key => $menu)
                                                @php $addonTotal += $menu->pivot->total; @endphp
                                                <tr style="border: 1px solid var(--table-border);{{ ($key+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $key+1 }}</td>
                                                    <td style="width: 30%; text-align: left; padding: .3rem;border: 1px solid var(--table-border);"><b>{{ strtoupper($menu->name) }}</b></td>
                                                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->quantity > 0 ? $menu->pivot->quantity : ''}}</td>
                                                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->hourly > 0 ? $menu->pivot->hourly : ''}}</td>
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

                                @if(!$model->seatPlannings->isEmpty())
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
                                            @foreach($model->seatPlannings as $key => $menu)
                                                <tr style="border: 1px solid var(--table-border);{{ ($key+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $key+1 }}</td>
                                                    <td style="width: 30%; text-align: left; padding: .3rem;border: 1px solid var(--table-border);"><b>{{ strtoupper($menu->name) }}</b></td>
                                                    <td style="width: 12%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{$menu->pivot->quantity > 0 ? AccountHelper::number_format($menu->pivot->quantity) : ''}}</td>
                                                    <td style="width: 12%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->details }}</td>
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
                                            @foreach($model->stageDecorations as $key => $menu)
                                                @php
                                                    $totalStagePrice += $menu->pivot->total;
                                                @endphp
                                                <tr style="border: 1px solid var(--table-border);{{ ($key+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $key+1 }}</td>
                                                    <td style="width: 30%; text-align: left; padding: .3rem;border: 1px solid var(--table-border);"><b>{{ strtoupper( $menu->name ) }}</b></td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->quantity > 0 ? $menu->pivot->quantity : ''}}</td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->price > 0 ? \AccountHelper::number_format( $menu->pivot->price ) : '' }}</td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->net_total > 0 ? \AccountHelper::number_format( $menu->pivot->net_total ) : '' }}</td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->discount > 0 ? \AccountHelper::number_format( $menu->pivot->discount ) : ''}}</td>
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
                                @if (!empty($model->booking_detail))
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="mt-4">Additional Details:</h5>
                                        <p>{{ $model->booking_detail }}</p>
                                    </div>
                                </div>
                                @endif
                                <!-- MAIN EVENT TOTAL -->
                                @php
                                    $tax_amount = 0;
                                    $delivery = 0;
                                @endphp
                                <div class="row mt-3">
                                    <div style="width:100%">
                                        <table style="width: 100%; border: 1px solid var(--summary-row-border);">
                                            <tbody>
                                                <tr style="border: 1px solid var(--summary-row-border);background-color: var(--summary-row-bg);">
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">Event Total</td>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">{{AccountHelper::number_format( ($model->no_person * $model->rate_per_head) + $foodTotal + $addonTotal )}}</td>
                                                </tr>
                                                @if (!empty($model->booking_detail))
                                                <tr style="border: 1px solid var(--summary-row-border);background-color: var(--summary-row-bg);">
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">Additional Charges</td>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);"><small>(+)</small>{{AccountHelper::number_format($model->additional_charges)}}</td>
                                                </tr>
                                                @endif
                                                @if($model->event_area == 2 && !empty($model->delivery_charges))
                                                <tr style="border: 1px solid var(--summary-row-border);background-color: var(--summary-row-bg);">
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">Delivery Charges</td>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);"><small>(+)</small>{{AccountHelper::number_format($model->delivery_charges)}}</td>
                                                </tr>
                                                @endif
                                                @if(!empty($model->tax_id))
                                                    @php $tax_amount = $model->total_tax @endphp
                                                    <tr style="border: 1px solid var(--summary-row-border);background-color: var(--summary-row-bg);">
                                                        <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">Tax ({{ $model->tax->tax_name }})</td>
                                                        <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);"><small>(+)</small>{{AccountHelper::number_format($model->total_tax)}}</td>
                                                    </tr>
                                                @endif
                                                <tr style="border: 1px solid var(--summary-row-border);background-color: var(--summary-row-bg);">
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">Event Grand Total</td>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">{{AccountHelper::number_format(MarqueeHelper::bookingGrandAmount($model->id) + $tax_amount)}}</td>
                                                </tr>
                                                @if(!empty($model->misc_discount_type))
                                                    <tr style="border: 1px solid var(--summary-row-border);background-color: var(--summary-row-bg);">
                                                        <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">
                                                            Discount ({{ MarqueeHelper::eventDiscount($model->misc_discount_type) }})&nbsp;
                                                            @if ($model->misc_discount_type === 2)
                                                                {{ $model->misc_discount_total }}%
                                                            @elseif ($model->misc_discount_type === 3)
                                                                {{ round($model->misc_discount_total,0) }} Persons
                                                        @endif
                                                        </th>
                                                        <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);"><small>(-)</small>{{AccountHelper::number_format($model->misc_discount_value)}}</td>
                                                    </tr>
                                                @endif
                                                @if(!$model->stageDecorations->isEmpty())
                                                    <tr style="border: 1px solid var(--summary-row-border);background-color: var(--summary-row-bg);">
                                                        <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">Stage Decorations</td>
                                                        <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);"><small>(+)</small>{{AccountHelper::number_format($totalStagePrice)}}</td>
                                                    </tr>
                                                @endif
                                                <tr style="border: 1px solid var(--summary-row-border);background-color: var(--summary-row-bg);">
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">Event Net Total</td>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">{{AccountHelper::number_format( MarqueeHelper::bookingTotalNetAmount($model->id) ) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                @if (!empty($model->addonBooking))
                                    @include('dashboard.marquee.bookings.sheet-function-addon')
                                @endif

                                <!-- RECEIVED PAYMENTS -->
                                @php
                                    $i = 0;
                                    $totalPayment = 0;
                                    $transactionData = \MarqueeHelper::bookingTransactions($model->id);
                                @endphp
                                @if(!$transactionData->isEmpty())
                                <div class="row">
                                    <div style="width:100%">
                                        <h4 class="text-center">Payments</h4>
                                        <table style="width: 100%; border: 1px solid var(--table-border);">
                                            <thead style="background-color: var(--table-heading-color)">
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <th style="width: 10%; font-weight: bold; text-align: left; padding: .3rem;border: 1px solid var(--table-border);">No.</th>
                                                    <th style="width: 20%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Date</th>
                                                    <th style="width: 58%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Remarks</th>
                                                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($transactionData as $key => $data)
                                                @if($data->Credit > 0)
                                                @php
                                                    $totalPayment += $data->Credit;
                                                    $i++;
                                                @endphp
                                                <tr style="border: 1px solid var(--table-border);{{ ($i+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <td style="width: 10%; text-align: left; padding: .3rem;border: 1px solid var(--table-border);">{{ $i }}</td>
                                                    <td style="width: 20%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ \AccountHelper::date_format( $data->VDate ) }}</td>
                                                    <td style="width: 58%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $data->Narration }}</td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid var(--table-border);">{{ AccountHelper::number_format($data->Credit) }}</td>
                                                </tr>
                                                @endif
                                            @empty
                                            @endforelse
                                                <tr style="border: 1px solid var(--table-border);{{ ($i+2) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <th style="font-weight:bold;padding: .3rem; text-align: right;border: 1px solid var(--table-border);" colspan="3">Total Payment</th>
                                                    <td style="font-weight:bold;padding: .3rem; text-align: right;border: 1px solid var(--table-border);">{{AccountHelper::number_format($totalPayment)}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif


                                <!-- OVERALL TOTAL -->
                                <div class="row mt-3">
                                    <div style="width:100%">
                                        <table style="width: 100%; border: 1px solid var(--summary-row-border);">
                                            <tbody>
                                                <tr style="border: 1px solid var(--summary-row-border);background-color: var(--summary-row-bg);">
                                                    @php $main_event_net_amount = MarqueeHelper::bookingTotalNetAmount($model->id); @endphp
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">Event Net Total</td>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">{{AccountHelper::number_format( $main_event_net_amount ) }}</td>
                                                </tr>
                                                @if (!empty($model->addonBooking))
                                                    @php $addon_event_net_amount = MarqueeHelper::bookingTotalNetAmount($addonModel->id); @endphp
                                                    <tr style="border: 1px solid var(--summary-row-border);background-color: var(--summary-row-bg);">
                                                        <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">Addon Event Net Total</td>
                                                        <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">{{AccountHelper::number_format( $addon_event_net_amount ) }}</td>
                                                    </tr>
                                                @else
                                                    @php $addon_event_net_amount = 0; @endphp
                                                @endif
                                                <tr style="border: 1px solid var(--summary-row-border);background-color: var(--summary-row-bg);">
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">Total Payable Amount</td>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">{{AccountHelper::number_format( ($main_event_net_amount + $addon_event_net_amount) ) }}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--summary-row-border);background-color: var(--summary-row-bg);">
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">Total Payment Received</td>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">{{AccountHelper::number_format($totalPayment)}}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--summary-row-border);background-color: var(--summary-row-bg);">
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">Remaining Balance</td>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">{{ AccountHelper::number_format( ($main_event_net_amount + $addon_event_net_amount) - $totalPayment) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- TERMS AND CONDITIONS -->
                                <div class="row mt-2 pr-3">
                                    <div style="width:55%">
                                        <h5>Terms And Condition:</h5>
                                        <div @class(['urdu-font' => $terms->is_urdu ])>
                                            {!! $terms->event_terms !!}
                                        </div>
                                    </div>

                                    <div class="align-self-end" style="width: 15%;">
                                        <div class="float-right">
                                            <h5>Customer:<br>{{ $model->customer->customer_name }}</h5>
                                            <p class="border-top pt-2 text-right">&nbsp;</p>
                                        </div>
                                    </div>

                                    <div class="align-self-end" style="width: 15%;">
                                        <div class="float-right">
                                            <h5>Event Booked By:<br>{{ $model->processingBY->name }}</h5>
                                            <p class="border-top pt-2 user-signature text-right">&nbsp;</p>
                                        </div>
                                    </div>

                                    <div class="align-self-end" style="width: 15%;">
                                        <div class="float-right">
                                            <h5>Accounts Manager<br>&nbsp;</h5>
                                            <p class="border-top pt-2 text-right">&nbsp;</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <h4>
                                            {{ auth()->user()->location->name }},{!! str_repeat('&nbsp;', 1) !!}
                                            {{ auth()->user()->location->address_1 }} {{ auth()->user()->location->address_2 }}<br>
                                            Contact: {{ auth()->user()->location->phone_1 }}, {{ auth()->user()->location->mobile_1 }}
                                        </h4>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-muted">
                                            <small>
                                            <span class="text-muted">
                                                Software provided by Optimum Tech<br>www.theoptimumtech.com 0313-6650965
                                            </span>
                                            </small>
                                        </div>
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
