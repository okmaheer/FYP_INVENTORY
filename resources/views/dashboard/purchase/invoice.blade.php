@extends('layouts.dashboard')
@section('page_title', trans('accounts.purchase.purchase_invoice'))
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
                                        <h6 class="mb-0"><b>{{ trans('accounts.general.date') }} : </b>{{ \AccountHelper::date_format( $purchase->purchase_date ) }}</h6>
                                        <h6><b>{{ trans('accounts.general.invoice_no') }} : </b>{{ $purchase->chalan_no }}</h6>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="float-left">
                                            <address class="font-13">
                                                <strong class="font-14">{{ trans('accounts.general.supplier') }}</strong><br>
                                                {{ $supplier->supplier_name }}<br>
                                                {{ $supplier->supplier_address }}<br>
                                                <abbr title="">Mobile:</abbr> {{ $supplier->supplier_mobile }}
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
                                                        <th class="text-center">{{ trans('accounts.general.tax_percent') }}</th>
                                                        <th class="text-center">{{ trans('accounts.general.amount_total') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $total_tax = 0;
                                                    @endphp
                                                    @foreach($purchase->purchaseDetails as $index => $entry)
                                                    @php
                                                    $total_tax = $entry->tax_amount + $total_tax;
                                                    @endphp
                                                    <tr>
                                                        <th class="text-left">{{ $index+1 }}</th>
                                                        <th class="text-left">{{ $entry->product->product_name }}</th>
                                                        <td class="text-right">{{ number_format($entry->quantity) }}</td>
                                                        <td class="text-right">{{ number_format($entry->rate, 2) }}</td>
                                                        <td class="text-right">{{ number_format($entry->tax_p) }}</td>
                                                        <td class="text-right">{{ number_format($entry->total_amount, 2) }}</td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <th colspan="4"  style="border: 0!important;" class="border-0"></th>
                                                        <td  style="border: 0!important;" class="border-0 font-14 text-right"><b>{{ trans('accounts.general.grand_total') }}</b></td>
                                                        <td  style="border: 0!important;" class="border-0 font-14 text-right"><b>{{ number_format($purchase->grand_total_amount, 2) }}</b></td>
                                                    </tr>
                                                    @if($total_tax >0)
                                                    <tr>
                                                        <th colspan="4"  style="border: 0!important;" class="border-0"></th>
                                                        <td  style="border: 0!important;" class="border-0 font-14 text-right"><b>Total Tax</b></td>
                                                        <td  style="border: 0!important;" class="border-0 font-14 text-right"><b>{{ $total_tax }}</b></td>
                                                    </tr>
                                                    @endif
                                                    <tr>
                                                        <td colspan="4"  style="border: 0!important;" class="border-0"></td>
                                                        <td  style="border: 0!important;" class="border-0 font-14 text-right"><b>{{ trans('accounts.general.discount') }}</b></td>
                                                        <td  style="border: 0!important;" class="border-0 font-14 text-right"><b>{{ number_format($purchase->total_discount, 2) }}</b></td>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="4"  style="border: 0!important;" class="border-0"></th>
                                                        <td  style="border: 0!important;" class="border-0 font-14 text-right"><b>{{ trans('accounts.general.amount_paid') }}</b></td>
                                                        <td  style="border: 0!important;" class="border-0 font-14 text-right"><b>{{ number_format($purchase->paid_amount, 2) }}</b></td>
                                                    </tr>
                                                    <tr class="bg-dark text-white">
                                                        <th colspan="4"  style="background: #2f394e !important; color: #ffffff !important; border: 0!important;" class="border-0"></th>
                                                        <td  style="background: #2f394e !important; color: #ffffff !important; border: 0!important;" class="border-0 font-14 text-right"><b>{{ trans('accounts.general.due_amount') }}</b></td>
                                                        <td  style="background: #2f394e !important; color: #ffffff !important; border: 0!important;" class="border-0 font-14 text-right "><b>{{ number_format($purchase->due_amount, 2) }}</b></td>
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
                                        <div class="text-center text-muted"><small>Thank you very much for doing business with us. Thanks !</small></div>
                                    </div>
                                    <div class="col-lg-12 col-xl-4">
                                        <div class="float-right d-print-none">
                                            <a href="#" id= "printBtn" class="btn btn-info text-light"><i class="fa fa-print"></i></a>
                                            <a href="{{ route('dashboard.accounts.purchase.index') }}" class="btn btn-danger text-light">Cancel</a>
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
