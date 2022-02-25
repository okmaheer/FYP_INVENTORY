@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    @include('includes.datatable-css')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')

   @section('body')
         <div class="page-content">

            <div class="container-fluid">
                <div class="card">
                    @include('dashboard.accounts.common.supplier-filter-by-start-end-date',['route'=>'supplier.ledger', 'printme'=>'ledger_table'])
                </div>

                <div class="row ">

                    <div class="col-12">

                        <div class="card" id="printArea">
                            <div class="panel-title border-grey border-bottom">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="p-3 text-dark">Supplier Ledger
                                            @if (request()->has('supplier_id') && request()->get('supplier_id') != '')
                                                - {{ $supplier_name }}
                                            @endif
                                        </h3>
                                    </div>
                                </div>



                                <span class="text-align-end d-flex justify-content-end">


                                </span>

                            </div>
                            <div class="card-body">
                                <table id="datatable" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Description</th>
                                            <th class="text-center">Voucher No</th>
                                            <th class="text-right">Debit</th>
                                            <th class="text-right">Credit</th>
                                            <th class="text-right">Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                           $debit = $credit = $balance = 0;
                                        @endphp
                                        @foreach($ledger as $data)
                                        @php
                                            $debit  += $data->Debit;
                                            $credit += $data->Credit;
                                            $balance = $debit - $credit;
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{ \AccountHelper::date_format( $data->VDate ) }}</td>
                                                <td>{{$data->Narration}}</td>
                                                <td>{{$data->VNo}}</td>
                                                <td class="text-right">{{AccountHelper::number_format($data->Debit). __('accounts.currency.pkr')}}</td>
                                                <td class="text-right">{{AccountHelper::number_format($data->Credit). __('accounts.currency.pkr')}}</td>
                                                <td class="text-right">{{AccountHelper::ledgerBalanceType($balance). __('accounts.currency.pkr')}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" align="right"><b>Grand Total:</b></td>
                                            <td align="right"><b>{{AccountHelper::number_format($debit). __('accounts.currency.pkr')}}</b></td>
                                            <td align="right"><b>{{AccountHelper::number_format($credit). __('accounts.currency.pkr')}}</b></td>
                                            <td align="right"><b>{{AccountHelper::ledgerBalanceType($balance). __('accounts.currency.pkr')}}</b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>


            </div><!-- container -->
            &nbsp;
            &nbsp;
            &nbsp;
            @include('includes.dashboard-footer')
        </div>
        <!-- end page content -->
        </div>
        <!--end page-wrapper-inner -->

    </div>
    <!-- end page-wrapper -->
@endsection
@endsection
@section('innerScriptFiles')
    @include('includes.datatable-js')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
@endsection
@section('innerScript')
    @include('includes.datatable-init', ['table' => 'datatable'])
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
