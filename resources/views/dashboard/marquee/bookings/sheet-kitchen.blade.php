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

                    <div class="col-lg-12 mx-auto">
                        <div class="card" id="printableArea">
                            <div class="card-body">
                                @include('dashboard.marquee.common.report-header', ['page_title' => 'Event Booking - Kitchen Sheet'])
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
                                        <table class="details-table" style="width: 100%; border: 1px solid var(--table-border); border-collapse: collapse;">
                                            <tbody>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 25%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Name</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold">{{ $model->customer->customer_name }}</td>
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
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold">{{ \AccountHelper::date_format( $model->created_at ) }}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Event Date</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold">{{ \AccountHelper::date_format( $model->event_date ) }} ({{ \Carbon\Carbon::parse( $model->event_date)->format('l') }})</td>
                                                </tr>
                                                @if ($model->event_area == 2)
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Event Type</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ \MarqueeHelper::EventType( $model->event_type ) }}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Delivery Date</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold">{{ \AccountHelper::date_format(  $model->delivery_date ) }} ({{ \Carbon\Carbon::parse( $model->delivery_date)->format('l') }})</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Delivery Time</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold">{{ date('h:i A', strtotime($model->delivery_time)) }}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Delivery Address</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold">{{ $model->delivery_address }}</td>
                                                </tr>
                                                @else
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Event Time</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold">{{ MarqueeHelper::eventTime($model->event_time) }} ({{ date('h:i A', strtotime($model->start_time)) }} - {{ date('h:i A', strtotime($model->end_time)) }})</td>
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
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold">@foreach ($model->venue as $ven)
                                                                                                                        {{ $model->eventAreaName($ven) }}@if (!$loop->last), @endif
                                                                                                                    @endforeach</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">No. of Persons</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold">{{ $model->no_person }}</td>
                                                </tr>
                                                @endif
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 30%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Partition</td>
                                                    <td style="width: 70%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold">{{ MarqueeHelper::isPartition($model->partition) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @if(!$model->foodItems->isEmpty())
                                <div class="row">
                                    <div style="width: 100%;">
                                        <h4 class="text-center">Food Items</h4>
                                        <table style="width: 100%; border: 1px solid var(--table-border);">
                                            <thead style="background-color: var(--table-header-color)">
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <th style="width: 10%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">No.</th>
                                                    <th style="width: 25%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Menu</th>
                                                    <th style="width: 10%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Qty.</th>
                                                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Instructions</th>
                                                    <th style="width: 25%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($model->foodItems as $key => $menu)
                                                <tr style="border: 1px solid var(--table-border);{{ ($key+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $key+1 }}</td>
                                                    <td style="width: 25%; text-align: left; padding: .3rem;border: 1px solid var(--table-border);"><b>{{ strtoupper($menu->product_name) }}</b></td>
                                                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->quantity > 0 ? $menu->pivot->quantity : '' }}</td>
                                                    <td style="width: 30%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">&nbsp;</td>
                                                    <td style="width: 25%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->details }}</td>
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
                                                    <th style="width: 20%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Addon</th>
                                                    <th style="width: 10%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Qty.</th>
                                                    <th style="width: 10%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);"># of Hours</th>
                                                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Instructions</th>
                                                    <th style="width: 20%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($model->addOnFeatures as $key => $menu)

                                                <tr style="border: 1px solid var(--table-border);{{ ($key+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $key+1 }}</td>
                                                    <td style="width: 20%; text-align: left; padding: .3rem;border: 1px solid var(--table-border);"><b>{{ strtoupper($menu->name) }}</b></td>
                                                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->quantity > 0 ? $menu->pivot->quantity : '' }}</td>
                                                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->hourly > 0 ? $menu->pivot->hourly : '' }}</td>
                                                    <td style="width: 30%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">&nbsp;</td>
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
                                                    <td style="width: 12%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->quantity > 0 ? $menu->pivot->quantity : '' }}</td>
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
                                            <thead style="background-color: var(--table-heading-color)">
                                            <tr style="border: 1px solid var(--table-border);">
                                                    <th style="width: 10%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">No.</th>
                                                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Name</th>
                                                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Qty.</th>
                                                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($model->stageDecorations as $key => $menu)
                                                <tr style="border: 1px solid var(--table-border);{{ ($key+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">{{ $key+1 }}</td>
                                                    <td style="width: 30%; text-align: left; padding: .3rem;border: 1px solid var(--table-border);"><b>{{ strtoupper($menu->name) }}</b></td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->quantity > 0 ? $menu->pivot->quantity : '' }}</td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid var(--table-border);">{{ $menu->pivot->details }}</td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif

                                <div class="row mt-2 pr-3">
                                    <div style="width:70%">
                                        <h5>Additional Details:</h5>
                                        <p>{{ $model->booking_detail }}</p>
                                    </div>

                                    <div class="align-self-end" style="width: 15%;">
                                        <div class="float-right">
                                            <h5>Event Booked By:<br>{{ $model->processingBY->name }}</h5>
                                            <p class="border-top pt-2 user-signature text-right">&nbsp;</p>
                                        </div>
                                    </div>

                                    <div class="align-self-end" style="width: 15%;">
                                        <div class="float-right">
                                            <h5>Account Manager<br>&nbsp;</h5>
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
