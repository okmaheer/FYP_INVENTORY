@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
@section('innerStyleSheet')
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@include('includes.dashboard-breadcrumbs')
<style>

    .company-txt{
        font-size: 24px;
        font-weight: bold;
    }




</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row  mb-2">
                        <div class="col-sm-12">
                            <a href="{{route('dashboard.accounts.bank.create')}}" class="btn btn-primary m-b-5 m-r-2">
                                <i class="ti-align-justify"></i> &nbsp;Add New Bank
                            </a>
                            <a href="{{route('bank.transaction')}}" class="btn btn-primary m-b-5 m-r-2">
                                <i class="ti-align-justify"></i> &nbsp;Bank Transaction
                            </a>
                            <a href="{{route('dashboard.accounts.bank.index')}}" class="btn btn-primary m-b-5 m-r-2">
                                <i class="ti-align-justify"></i> &nbsp;Manage Bank
                            </a>

                        </div>
                    </div>
                    <div class="card">
                        @include('dashboard.accounts.common.filter-by-start-end-date',['route'=>'bank.ledger'])
                    </div>
                    <div class="card" id="printArea">
                        <div class="row ">
                            <div class="col-lg-12 ">

                                        <div class="penal-title border-grey border-bottom ">
                                            <h4 class="p-3 text-dark">Bank Ledger</h4>
                                        </div>

                                    <table class="table table-bordered mb-0 table-centered" cellpadding="6" cellspacing="1" width="100%">
                                        <div class="table-title">

                                            <tbody>

                                                <tr>
                                                    <td class="text-center">Date</td>
                                                    <td class="text-center">Bank Name</td>
                                                    <td class="text-center">Description</td>
                                                    <td class="text-center">Withdraw / Deposite ID</td>
                                                    <td class="text-center">Debit (+)</td>
                                                    <td class="text-center">Credit (-) </td>
                                                    <td class="text-center">Balance</td>

                                                </tr>
                                                @php $balance = $credit = $debit = 0; @endphp
                                                @forelse($ledger as $key => $data)
                                                    @php
                                                        $debit  += $data->Debit;
                                                        $credit += $data->Credit;
                                                        $balance = $debit - $credit;
                                                    @endphp
                                                    <tr>
                                                        <td class="text-center">{{$data->VDate}}</td>
                                                        <td></td>
                                                        <td>{{$data->Narration}}</td>
                                                        <td>{{$data->VNo}}</td>
                                                        <td class="text-right">{{$data->Debit}}</td>
                                                        <td class="text-right">{{$data->Credit}}</td>
                                                        <td class="text-right">{{$balance}}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6"> No Record Found</td>
                                                    </tr>
                                            @endforelse

                                                <tfoot>
                                                    <tr>
                                                        <td colspan="4" class="text-right"><b>Grand Total</b></td>
                                                        <td class="text-right" ><b>{{$debit}}</b></td>
                                                        <td class="text-right" ><b>{{$credit}}</b></td>
                                                        <td class="text-right" ><b>{{$balance}}</b></td>
                                                    </tr>
                                                </tfoot>

                                            </tbody>



                                        </div>

                                    </table>
                                </div>
                        </div>

                    </div>

                <!-- container -->

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
            (function (){
                $('select').select2();
            })();
        </script>


        @endsection
