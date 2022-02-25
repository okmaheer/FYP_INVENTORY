@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .col-sm-2::selection {
            color: #fff;
            background-color: #37a000;
        }

        .text-success::selection {
            color: #fff;
            background-color: #37a000;

        }

    </style>
@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')

@section('body')
    <div class="page-content">
        <div class="container-fluid">

            <div class="card">
                <div class="penal-title  border-grey border-bottom">
                    <h4 class="p-3 text-success">{{ $page_title }}</h4>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div id="invoice">
                                <div class="toolbar hidden-print">
                                    <div class="text-end">
                                        <button type="button" class="btn btn-info" onclick="printDiv('printableArea')"><i
                                                class="fa fa-print"></i> Print</button>
                                        <button type="button" class="btn btn-danger"><i
                                                class="fa fa-file-pdf-o"></i>Cancel</button>
                                    </div>
                                    <hr>
                                </div>
                                <div class="invoice" id="printableArea">
                                    <div width="100%" style="background: white">
                                        <header style="padding: 15px; margin-bottom: 20px; border-bottom: 1px solid #0d6efd">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="javascript:;">
                                                        <img src="{{ asset(\AccountHelper::CurrentCompany()->logo) }}" width="128"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="col company-details" style="text-align: right">
                                                    <h2 class="name" style="color: #0d6efd;">
                                                        {{ \AccountHelper::CurrentCompany()->company_name }}
                                                    </h2>
                                                    <div>{{ \AccountHelper::CurrentCompany()->address }}</div>
                                                    <div>{{ \AccountHelper::CurrentCompany()->phone }}</div>
                                                    <div>{{ \AccountHelper::CurrentCompany()->mobile }}</div>
                                                    <div>{{ \AccountHelper::CurrentCompany()->website }}</div>
                                                </div>
                                            </div>
                                        </header>
                                        <main>
                                            <div class="row contacts" style="padding: 15px">
                                                <div class="col invoice-to">
                                                    <div class="text-gray-light"></div>
                                                    <h2 class="to">
                                                        {{ $transactions[0]->accountHead->customer->customer_name }}</h2>
                                                    <div class="address"></div>
                                                    <div class="email">
                                                    </div>
                                                </div>
                                                <div class="col invoice-details" style="text-align: right">
                                                    <h1 class="invoice-id" style="margin-top: 0;
                                                    color: #0d6efd;">{{ $transactions[0]->VNo }}</h1>
                                                    <div class="date">Date: {{ $transactions[0]->VDate }}</div>
                                                </div>
                                            </div>
                                            <table width="100%">
                                                <thead>
                                                    <tr class="">
                                                        <th width="10%" style="padding: 15px; background: #eee;">#</th>
                                                        <th class="text-left " width="40%"
                                                            style="padding: 15px; background: #eee;">REMARKS</th>
                                                        <th class="text-right " width="20%"
                                                            style="padding: 15px; background: #eee;">PAYMENT TYPE</th>
                                                        <th class="text-right " width="20%"
                                                            style="padding: 15px; background: #eee;">AMOUNT</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="no" width="10%"
                                                            style="padding: 15px; text-align: right; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                            01</td>
                                                        <td class="text-left" width="40%"
                                                            style="padding: 15px; background: #eee; text-align: right; font-size: 1.2em">
                                                            {{ $transactions[0]->Narration }}</td>
                                                        <td class="unit" width="20%"
                                                            style="padding: 15px; background: #ddd; text-align: right; font-size: 1.2em">
                                                            Payment</td>
                                                        <td class="total" width="20%"
                                                            style="padding: 15px; text-align: right; font-size: 1.2em; background: #0d6efd; color: #fff;">
                                                            {{ $transactions[0]->Credit }}</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td style="text-align: right; padding: 10px 20px; font-size: 1.2em;">Paid By :</td>
                                                        <td style="text-align: right; padding: 10px 20px; font-size: 1.2em;">Admin User</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">Signature :</td>
                                                        <td style="text-align: right; padding: 60px 20px 10px 20px; font-size: 1.2em;">_________________</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </main>
                                    </div>
                                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->

                                    <div class="border-top text-center text-sm-left p-3 " style="background: white">
                                        &copy; {{ date('Y') }}
                                        {{ AccountHelper::CurrentCompany()->company_name }} <span
                                            class="d-sm-inline-block float-right">Crafted with <i
                                                class="mdi mdi-heart text-danger"></i> by Optimum Tech</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end card-->

    @include('includes.dashboard-footer')

@endsection
@endsection

@section('innerScriptFiles')
<!-- Plugins js -->
<script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
@endsection
@section('innerScript')

<script>
    (function() {
        $('.select2').select2();
    })();
</script>


@endsection
