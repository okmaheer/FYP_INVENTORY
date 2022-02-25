@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

@include('includes.dashboard-breadcrumbs')

     @section('body')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="card">
                        @include('dashboard.accounts.common.filter-by-start-end-date',['route'=>'user_wise.sales_report'])
                    </div>

                    <div class="card">
                        @include('includes.report-header')
                        <div class="card-body">
                            @include('includes.company-detail-header')
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped  table-bordered mb-3 table-centered" cellpadding="6" cellspacing="1" width="100%">
                                        <thead>
                                            <tr>
                                                <td class="text-left">SL.</td>
                                                <td class="text-left">User Name</td>
                                                <td class="text-left">Total Sale</td>
                                                <td class="text-left">Total Amount</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php $balance = 0; @endphp
                                        @forelse($report as $key => $data)
                                            @php
                                                $debit  += $data->Debit;
                                                $credit += $data->Credit;
                                                $balance = $debit - $credit;
                                            @endphp
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$data->user->name}}</td>
                                                <td>{{$data->count_invoices}}</td>
                                                <td>{{$data->grand_total_price}}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6"> No Record Found</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right"><b>Total Sale</b></td>
                                            <td class="text-right" ><b>{{$balance}}</b></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            @include('includes.report-footer')
                        </div>
                    </div>
                </div>
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




