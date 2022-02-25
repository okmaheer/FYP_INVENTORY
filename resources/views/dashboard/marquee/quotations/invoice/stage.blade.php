@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link rel="stylesheet" href="{{ asset('css/marquee-print-tables.css') }}">
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')

    @section('body')
        @php $company = \AccountHelper::CurrentCompany(); @endphp
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
                                            <a href="{{route('dashboard.marquee.quotation.stage.index')}}" class="btn btn-danger text-light">Back</a>
                                        </div>
                                    </div>
                                    <div class="col-md-12 bg-dark text-center">
                                        <h3 class="text-white">Stage Decoration Quotation</h3>
                                    </div>
                                    <div class="col-sm-12 align-self-center ml-3">
                                        <h5>Quotation No: {{$model->quot_number}}</h5>
                                    </div>
                                </div>
                            </div><!--end card-body-->

                            <div class="card-body">
                                <div class="row">
                                    <div style="width:48%">
                                        <h4>Customer Details</h4>
                                        <table style="width: 100%; border: 1px solid var(--table-border); border-collapse: collapse;">
                                            <tbody>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 25%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Name</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ $model->customer_name }}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 25%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Phone</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ $model->phone_number }}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 25%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);"></td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="width:4%"></div>
                                    <div style="width:48%">
                                        <h4>Quotation Details</h4>
                                        <table style="width: 100%; border: 1px solid var(--table-border); border-collapse: collapse;">
                                            <tbody>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 25%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Quotation Date</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ \AccountHelper::date_format( $model->created_at ) }}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 25%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Event Date</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">{{ \AccountHelper::date_format( $model->event_date ) }} ({{ \Carbon\Carbon::parse( $model->event_date)->format('l') }})</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <td style="width: 25%; background-color: var(--table-heading-color); font-weight:bold;padding: .3rem;border: 1px solid var(--table-border);">Event Time</td>
                                                    <td style="width: 75%;padding: .3rem;border: 1px solid var(--table-border); font-weight:bold;">
                                                        {{ \MarqueeHelper::eventTime($model->event_time) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div style="width:100%">
                                        <h4 class="text-center">Stage Items</h4>
                                        <table style="width: 100%; border: 1px solid var(--table-border);">
                                            <thead style="background-color: var(--table-header-color)">
                                                <tr style="border: 1px solid var(--table-border);">
                                                    <th style="width: 10%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">No.</th>
                                                    <th style="width: 30%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Name</th>
                                                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Qty</th>
                                                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Price</th>
                                                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Total</th>
                                                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Discount</th>
                                                    <th style="width: 12%; font-weight: bold; text-align: center; padding: .3rem;border: 1px solid var(--table-border);">Grand Total</th>
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
                                                <tr style="border: 1px solid var(--table-border);{{ ($key+1) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <td style="width: 10%; text-align: center; padding: .3rem;border: 1px solid var(--table-border);"> {{ $key+1 }}</td>
                                                    <td style="width: 30%; text-align: left; padding: .3rem;border: 1px solid var(--table-border);"><b>{{ strtoupper($d->name) }}</b></td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid var(--table-border);">{{ $d->pivot->quantity > 0 ? $d->pivot->quantity : ''}} </td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid var(--table-border);">{{ $d->pivot->price > 0 ? AccountHelper::number_format($d->pivot->price) : ''}}</td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid var(--table-border);">{{ $d->pivot->net_total > 0 ? AccountHelper::number_format($d->pivot->net_total) : '' }}</td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid var(--table-border);">{{ $d->pivot->discount > 0 ? AccountHelper::number_format($d->pivot->discount) : '' }}</td>
                                                    <td style="width: 12%; text-align: right; padding: .3rem;border: 1px solid var(--table-border);">{{ $d->pivot->total > 0 ? AccountHelper::number_format($d->pivot->total) : ''}}</td>
                                                </tr>
                                            @endforeach
                                                <tr style="border: 1px solid var(--table-border);{{ ($key+2) % 2 != 0 ? '' : 'background-color: rgba(248, 249, 250, 0.4);'}}">
                                                    <td style="font-weight:bold;padding: .3rem; text-align: right;border: 1px solid var(--table-border);" colspan="6">Total Items Price</td>
                                                    <td style="font-weight:bold;padding: .3rem; text-align: right;border: 1px solid var(--table-border);">{{ AccountHelper::number_format($totalItemsPrice) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- ALL TOTAL -->
                                <div class="row mt-3">
                                    <div style="width:100%">
                                        <table style="width: 100%; border: 1px solid var(--summary-row-border);">
                                            <tbody>
                                                <tr style="border: 1px solid var(--summary-row-border);background-color: var(--summary-row-bg);">
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">Total Bill</th>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">{{AccountHelper::number_format($model->grand_total)}}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--summary-row-border);background-color: var(--summary-row-bg);">
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">Total Discount</th>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">{{AccountHelper::number_format($model->total_discount)}}</td>
                                                </tr>
                                                <tr style="border: 1px solid var(--summary-row-border);background-color: var(--summary-row-bg);">
                                                    <td style="width: 88%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">Net Total</th>
                                                    <td style="width: 12%; font-weight:bold; text-align: right; padding: .3rem;border: 1px solid var(--summary-row-border);">{{AccountHelper::number_format($model->net_total)}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row justify-content-center mt-2 pr-3">
                                    <div style="width:60%">
<!--                                        <h5 class="mt-4">Terms And Condition :</h5>
                                        <ul class="pl-3">
                                            <li><small>All accounts are to be paid within 7 days from receipt of
                                                    invoice. </small></li>
                                            <li><small>To be paid by cheque or credit card or direct payment online.</small>
                                            </li>
                                            <li><small> If account is not paid within 7 days the credits details supplied as
                                                    confirmation<br> of work undertaken will be charged the agreed quoted
                                                    fee noted above.</small></li>
                                        </ul>-->
                                    </div>
                                    <div class="align-self-end" style="width: 20%;">
                                        <div class="pb-3 float-right">
                                            <h5>Quotation By: {{ $model->processingBY->name }}</h5>
                                            <p class="border-top pt-2 user-signature text-right">&nbsp;</p>
                                        </div>
                                    </div>

                                    <div class="align-self-end" style="width: 20%;">
                                        <div class="pb-4 float-right">
                                            <h5>Accounts Manager</h5>
                                            <p class="border-top text-right">&nbsp;</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h4>
                                            {{ auth()->user()->location->address_1 }}<br>
                                            Contact: {{ auth()->user()->location->phone_1 }}, {{ auth()->user()->location->mobile_1 }}
                                        </h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="text-muted">
                                            <small>
                                            <span class="text-muted">
                                                Software provided by Optimum Tech<br>www.theoptimumtech.com 0313-6650965
                                            </span>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right d-print-none">
                                            <a href="javascript:void(0);" class="btn btn-info print-page"><i
                                                    class="fa fa-print"></i></a>
                                            <a href="{{route('dashboard.marquee.quotation.stage.index')}}" class="btn btn-danger text-light">Back</a>
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
