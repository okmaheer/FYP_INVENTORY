@extends('layouts.dashboard')
@section('page_title', trans('accounts.sale.sale_invoice'))
@section('innerStyleSheet')
    <style>
        .table td, .table th {
            padding: 4px;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
    </style>
@endsection
@section('content')
@include('includes.dashboard-breadcrumbs')
@section('body')

<div class="page-content">
    <div class="container-fluid">
        <div class="row" id="printArea">
            <div class="col-12">
                <div class="card">
                    <div class="card-body invoice-head">
                        @include('includes.company-detail-header')
                    </div><!--end card-body-->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="">
                                    <h6 class="mb-0"><b>{{ trans('accounts.general.date') }}:</b> {{ \AccountHelper::date_format( $invoice->date ) }}</h6>
                                    <h6><b>{{ trans('accounts.general.invoice_no') }}:</b> {{ $invoice->invoice_no }}</h6>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="float-left">
                                    <address class="font-13">
                                        <strong class="font-14">{{ trans('accounts.general.customer_details') }}:</strong><br>
                                        {{ $customer->customer_name}}<br>
                                        <abbr title="">Phone:</abbr> {{ $customer->customer_mobile}}
                                    </address>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-left">{{ trans('accounts.general.sr') }}</th>
                                                <th class="text-center">{{ trans('accounts.general.product_name') }}</th>
                                                <th class="text-center">{{ trans('accounts.general.qty') }}</th>
                                                <th class="text-center">{{ trans('accounts.general.price') }}</th>
                                                <th class="text-center">{{ trans('accounts.general.discount_percent') }}</th>
                                                <th class="text-center"> GST</th>
                                                <th class="text-center">{{ trans('accounts.general.amount_total') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $total_tax = 0;
                                            @endphp
                                            @foreach($invoice->invoiceDetails as $index => $entry)

                                            @php
                                            $total_tax = $entry->tax_amount + $total_tax;
                                            @endphp
                                                <tr>
                                                    <td>{{ $index+1 }}</td>
                                                    <td>{{ $entry->product->product_name }}</td>
                                                    <td class="text-right">{{ number_format($entry->quantity) }}</td>
                                                    <td class="text-right">{{ number_format($entry->rate, 2) }}</td>
                                                    <td class="text-right">{{ number_format($entry->discount) }}</td>

                                                    <td class="text-right">{{ number_format($entry->tax_p) }}</td>

                                                    <td class="text-right">{{ number_format($entry->total_price, 2) }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th colspan="5"   style="border: 0!important;" class="border-0"></th>
                                                <td  style="border: 0!important;"  class="border-0 font-14 text-right"><b>{{ trans('accounts.general.grand_total') }}</b></td>
                                                <td   style="border: 0!important;" class="border-0 font-14 text-right"><b>{{ number_format($invoice->grand_total_price, 2) }}</b></td>
                                            </tr>
                                            @if($total_tax >0)
                                            <tr>
                                                <th colspan="5"  style="border: 0!important;" class="border-0"></th>
                                                <td   style="border: 0!important;" class="border-0 font-14 text-right"><b>Total GST</b></td>
                                                <td  style="border: 0!important;"  class="border-0 font-14 text-right"><b>{{ $total_tax }}</b></td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td colspan="5"   style="border: 0!important;" class="border-0"></td>
                                                <td   style="border: 0!important;" class="border-0 font-14 text-right"><b>{{ trans('accounts.general.discount') }}</b></td>
                                                <td   style="border: 0!important;" class="border-0 font-14 text-right"><b>{{ number_format($invoice->total_discount, 2) }}</b></td>
                                            </tr>
                                            <tr >
                                                <th colspan="5"  style="border: 0!important;" class="border-0"></th>
                                                <td  style="border: 0!important;" class="border-0 font-14 text-right"><b>{{ trans('accounts.general.amount_paid') }}</b></td>
                                                <td  style="border: 0!important;" class="border-0 font-14 text-right "><b>{{ number_format($invoice->paid_amount, 2) }}</b></td>
                                            </tr>
                                            <tr>
                                                <th   style="background: #2f394e !important; color: #ffffff !important; border: 0!important;" colspan="5" class="border-0"></th>
                                                <td  style=" background: #2f394e !important; color: #ffffff !important; border: 0!important;" class="border-0 font-14 text-right"><b>{{ trans('accounts.general.due_amount') }}</b></td>
                                                <td  style=" background: #2f394e !important; color: #ffffff !important; border: 0!important;" class="border-0  font-14 text-right "><b>{{ number_format($invoice->due_amount, 2) }}</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-6">

                            </div>
                            <div class="col-lg-6 align-self-end">
                                <div class="w-25 float-right">
                                    <small>Account Manager</small>

                                    <p class="border-top">Signature</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-12 col-xl-4 ml-auto align-self-center">
                                <div class="text-center text-muted"><small>Thank you very much for doing business with us.</small></div>
                            </div>
                            <div class="col-lg-12 col-xl-4">
                                <div class="float-right d-print-none">
                                    <a href="#" id= "printBtn" class="btn btn-info text-light"><i class="fa fa-print"></i></a>
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

@section('innerScript')

@endsection
