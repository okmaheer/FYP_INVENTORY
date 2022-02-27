@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('content')
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@include('includes.dashboard-breadcrumbs')
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
@section('body')
    <div class="page-content">
        <div class="container-fluid">

            <div class="card">
                <div class="penal-title  border-grey border-bottom">
                    <h4 class="p-3 text-success">{{ __('accounts.supplier.voucher_receipt_title') }}</h4>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="panel panel-bd">
                                <div class="border p-5">
                                    <div class="panel-body" id="printableArea">
                                        <div bgcolor='#e4e4e4' text='#ff6633' link='#666666' vlink='#666666' alink='#ff6633'
                                            class="phdiv">
                                            <table border="0" width="100%">
                                                <tr>
                                                    <td>

                                                        <table border="0" width="100%">

                                                            <tr class="text-capitalize">
                                                                <td class="text-center">
                                                                    <span class="company-txt">
                                                                        <h3>company name</h3>
                                                                    </span>
                                                                    <p class="m-0">134-B People's Colony No. 1 Faisalabad
                                                                        Shah Faisalabad, Punjab, Pakistan-38000</p>
                                                                    <p class="m-0">234234</p>
                                                                    <p class="m-0">
                                                                        date: {{ $transactions[0]->VDate }}</p>
                                                                </td>
                                                            </tr>

                                                            <tr class="text-center">
                                                                <td>
                                                                    <h5>
                                                                        {{$transactions[0]->accountHead->supplier->supplier_name }}
                                                                    </h5>
                                                                </td>
                                                            </tr>

                                                            {{-- <tr>
                                                                <td>
                                                                    <nobr>
                                                                        <date>
                                                                            date
                                                                            : {{ $transactions[0]->VDate }}
                                                                        </date>
                                                                    </nobr>
                                                                </td>
                                                            </tr> --}}
                                                            <tr>
                                                                <td class="text-left">Voucher number
                                                                    : {{ $transactions[0]->VNo }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left">payment type
                                                                    : Payment</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left">Amount
                                                                    : {{ $transactions[0]->Debit }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left">remarks
                                                                    : {{ $transactions[0]->Narration }}</td>
                                                            </tr>
                                                        </table>


                                                    </td>
                                                <tr>

                                                    <td> Paid By
                                                        : Admin User

                                                        <div class="psigpart float-right">
                                                            Signature: ________________
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td>Powered By: <a href="javascript:void(0)">company name</a>
                                                    </td>

                                                </tr>
                                            </table>


                                        </div>

                                    </div>
                                    <div class="panel-footer mt-3">
                                        <a class="btn btn-danger" href="#">cancel</a>
                                        <a class="btn btn-info" href="#" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
                <!--end card-->


            </div><!-- container -->
            &nbsp;
            &nbsp;
            &nbsp;
            @include('includes.dashboard-footer')
        </div>

    @endsection
@endsection

@section('innerScriptFiles')
    <!-- Plugins js -->
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
@endsection
@section('innerScript')

    <script>
        (function() {
            $('select').select2();
        })();
    </script>


@endsection