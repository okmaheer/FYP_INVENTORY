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

                            <div class="card-body invoice-head">
                                @include('dashboard.marquee.common.report-header', ['page_title' => 'Stage Booking'])
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="float-right d-print-none">
                                            <a href="javascript:void(0);" class="btn btn-info print-page"><i
                                                    class="fa fa-print"></i></a>
                                            @if ($model->category == 'WOB')
                                            <a href="{{route('dashboard.marquee.payments.create',['stageid'=>$model->id])}}"
                                            class="btn btn-primary text-light">Add Voucher</a>
                                            @else
                                            <a href="{{route('dashboard.marquee.payments.create',['bookingid'=>$model->id])}}"
                                            class="btn btn-primary text-light">Add Voucher</a>
                                            @endif
                                            <a href="{{route('dashboard.marquee.stage.booking.index')}}" class="btn btn-danger text-light">Back</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 align-self-center ml-3">
                                        <h5>Stage Booking No: {{$model->custom_stage_number}}</h5>
                                    </div>
                                </div>
                            </div><!--end card-body-->

                            <div class="card-body">
                                <div class="row">
                                    <div style="width:48%">
                                        <h4>Customer Details</h4>
                                        <table class="details-table" style="width: 100%; border: 1px solid #dee2e6; border-collapse: collapse;">
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
                                        <table class="details-table" style="width: 100%; border: 1px solid #dee2e6; border-collapse: collapse;">
                                            <tbody>
                                                @if ($model->category == 'WB')
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 25%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">Booking No.</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid #dee2e6;">
                                                        {{ $model->custom_booking_number }}
                                                    </td>
                                                </tr>
                                                @endif
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 25%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">Booking Date</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid #dee2e6;">{{ \AccountHelper::date_format( $model->created_at ) }}</td>
                                                </tr>
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 25%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">Event Date</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid #dee2e6;">{{ \AccountHelper::date_format( $model->event_date ) }} ({{ \Carbon\Carbon::parse( $model->event_date)->format('l') }})</td>
                                                </tr>
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 25%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">Event Time</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid #dee2e6;">
                                                        {{ MarqueeHelper::eventTime($model->event_time) }} ({{ date('h:i A', strtotime($model->start_time)) }} - {{ date('h:i A', strtotime($model->end_time)) }})
                                                    </td>
                                                </tr>
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <td style="width: 25%; background-color: #f8f9fa; font-weight:bold;padding: .3rem;border: 1px solid #dee2e6;">Care Of</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid #dee2e6;">{{ $model->care_of }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div style="width:100%">
                                        <h4 class="text-center">Stage Items</h4>
                                        <table style="width: 100%; border: 1px solid #dee2e6;">
                                            <thead style="background-color: #f8f9fa">
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <th style="width: 10%; font-weight: bold; text-align: left; padding: .3rem;border: 1px solid #dee2e6;">No.</th>
                                                    <th style="width: 30%; font-weight: bold; text-align: left; padding: .3rem;border: 1px solid #dee2e6;">Name</th>
                                                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">Qty</th>
                                                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">Price</th>
                                                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">Total</th>
                                                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">Discount</th>
                                                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">Grand Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $totalItemsPrice = 0;
                                                $currentPrice = 0;
                                            @endphp
                                            @foreach($model->stageDecorations as $key => $d)
                                                @php
                                                    $currentPrice = $d->pivot->total;
                                                    $totalItemsPrice += $currentPrice;
                                                @endphp
                                                <tr style="border: 1px solid #dee2e6;{{ ($key+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <td style="width: 10%; text-align: left; padding: .3rem;border: 1px solid #dee2e6;"> {{ $key+1 }}</td>
                                                    <td style="width: 30%; text-align: left; padding: .3rem;border: 1px solid #dee2e6;"><b>{{ strtoupper($d->name) }}</b></td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid #dee2e6;">{{ $d->pivot->quantity }} </td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid #dee2e6;">{{ AccountHelper::number_format($d->pivot->price) }}</td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid #dee2e6;">{{ AccountHelper::number_format($d->pivot->net_total) }}</td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid #dee2e6;">{{ AccountHelper::number_format($d->pivot->discount) }}</td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid #dee2e6;">{{ AccountHelper::number_format($d->pivot->total) }}</td>
                                                </tr>
                                            @endforeach
                                                <tr style="border: 1px solid #dee2e6;{{ ($key+2) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <td style="font-weight:bold;padding: .3rem; text-align: right;border: 1px solid #dee2e6;" colspan="6">Total Items Price</td>
                                                    <td style="font-weight:bold;padding: .3rem; text-align: right;border: 1px solid #dee2e6;">{{ AccountHelper::number_format($totalItemsPrice) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                @php
                                    $i = 0;
                                    $totalPayment = 0;
                                    $transactionData = \MarqueeHelper::stageTransactions($model->id);
                                @endphp
                                @if(!$transactionData->isEmpty())
                                <div class="row">
                                    <div style="width:100%">
                                        <h4 class="text-center">Payments</h4>
                                        <table style="width: 100%; border: 1px solid #dee2e6;">
                                            <thead style="background-color: #f8f9fa">
                                                <tr style="border: 1px solid #dee2e6;">
                                                    <th style="width: 10%; font-weight: bold; text-align: left; padding: .3rem;border: 1px solid #dee2e6;">No.</th>
                                                    <th style="width: 20%; font-weight: bold; text-align: left; padding: .3rem;border: 1px solid #dee2e6;">Date</th>
                                                    <th style="width: 58%; font-weight: bold; text-align: left; padding: .3rem;border: 1px solid #dee2e6;">Remarks</th>
                                                    <th style="width: 12%; font-weight: bold; text-align: left; padding: .3rem;border: 1px solid #dee2e6;">Amount</th>
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
                                                    <td style="width: 20%; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">{{ \AccountHelper::date_format( $data->VDate ) }}</td>
                                                    <td style="width: 58%; text-align: center; padding: .3rem;border: 1px solid #dee2e6;">{{ $data->Narration }}</td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid #dee2e6;">{{ AccountHelper::number_format($data->Credit) }}</td>
                                                </tr>
                                                @endif
                                            @empty
                                            @endforelse
                                                <tr style="border: 1px solid #dee2e6;{{ ($i+2) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <th colspan="3" style="font-weight: bold;text-align: right; padding: .3rem;border: 1px solid #dee2e6;">Total Payment</th>
                                                    <td style="font-weight: bold;text-align: right; padding: .3rem;border: 1px solid #dee2e6;">{{AccountHelper::number_format($totalPayment)}}</td>
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
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">Total Bill</td>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">{{AccountHelper::number_format($model->grand_total)}}</td>
                                                </tr>
                                                @if ($model->discount_total > 0)
                                                    <tr style="border: 1px solid #b3b7bb;background-color: #d6d8db;">
                                                        <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">Discount</td>
                                                        <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">(-){{AccountHelper::number_format($model->discount_total)}}</td>
                                                    </tr>
                                                    <tr style="border: 1px solid #b3b7bb;background-color: #d6d8db;">
                                                        <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">Net Total</td>
                                                        <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">{{AccountHelper::number_format($model->net_total)}}</td>
                                                    </tr>
                                                @endif

                                                @if ($model->category == 'WOB')
                                                <tr style="border: 1px solid #b3b7bb;background-color: #d6d8db;">
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">Total Payment Received</td>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">{{AccountHelper::number_format($totalPayment)}}</td>
                                                </tr>
                                                <tr style="border: 1px solid #b3b7bb;background-color: #d6d8db;">
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">Remaining Balance</td>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid #b3b7bb;">{{AccountHelper::number_format(MarqueeHelper::stageTotalNetAmount($model->booking_id, $model->id) - MarqueeHelper::stageAmountClc($model->booking_id, $model->id))}}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>



                                <div class="row justify-content-center pr-1">
                                    <div style="width:55%">
                                        <h5 class="mt-4">Terms And Condition :</h5>
                                        <div @class(['urdu-font' => $terms->is_urdu ])>
                                            {!! $terms->stage_terms !!}
                                        </div>
                                    </div>
                                    <div class="align-self-end" style="width: 15%;">
                                        <div class="pb-3 float-right">
                                            <small>Customer: {{ $model->customer->customer_name }}</small>
                                            <p class="border-top text-right">&nbsp;</p>
                                        </div>
                                    </div>
                                    <div class="align-self-end" style="width: 15%;">
                                        <div class="pb-3 float-right">
                                            <small>Booked By: {{ $model->processingBY->name }}</small>
                                            <p class="border-top user-signature text-right">&nbsp;</p>
                                        </div>
                                    </div>
                                    <div class="align-self-end" style="width: 15%;">
                                        <div class="pb-3 float-right">
                                            <small>Accounts Manager</small>
                                            <p class="border-top text-right">&nbsp;</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row d-flex justify-content-center">
                                    <div class="text-center text-muted"><small><span class="text-muted text-center">Deskbook ERP - Crafted with <i
                                        class="mdi mdi-heart text-danger"></i> by Optimum Tech www.optimumtech.org 0313-6650965</span></small>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="float-right d-print-none">
                                            <a href="javascript:void(0);" class="btn btn-info print-page"><i
                                                    class="fa fa-print"></i></a>
                                            @if ($model->category == 'WOB')
                                            <a href="{{route('dashboard.marquee.payments.create',['stageid'=>$model->id])}}"
                                            class="btn btn-primary text-light">Add Voucher</a>
                                            @else
                                            <a href="{{route('dashboard.marquee.payments.create',['bookingid'=>$model->id])}}"
                                            class="btn btn-primary text-light">Add Voucher</a>
                                            @endif
                                            <a href="{{route('dashboard.marquee.stage.booking.index')}}" class="btn btn-danger text-light">Back</a>
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
