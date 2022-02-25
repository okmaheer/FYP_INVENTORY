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
                    @include('dashboard.accounts.common.supplier-filter-by-start-end-date',['route'=>'supplier.due.report', 'printme'=>'printableArea'])

                </div>
                <div class="card">
                    @include('includes.report-header')
                    <div class="card-body" id="printArea">
                        @include('includes.company-detail-header')
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-striped mb-3 table-bordered mb-0 table-centered" cellpadding="6" cellspacing="1" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="text-left">Sr.</th>
                                                <th class="text-center">Supplier Name</th>
                                                <th class="text-right">Total Amount</th>
                                                <th class="text-right">Paid Amount</th>
                                                <th class="text-right">Due Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $total = $paidAmount = $dueAmount =0;
                                                $startDate = request()->has('start_date') ? request()->get('start_date') : null;
                                                $endDate = request()->has('end_date') ? request()->get('end_date') : null;
                                            @endphp
                                            @forelse($report as $key => $report)
                                                @php
                                                    $curr_paid = \AccountHelper::supplierPaid($report->id, $startDate, $endDate);
                                                    $curr_due = \AccountHelper::supplierDue($report->id, $startDate, $endDate);
                                                    $curr_total = ( $curr_paid + $curr_due );

                                                    $paidAmount += $curr_paid;
                                                    $dueAmount += $curr_due;
                                                    $total += $curr_total;
                                                @endphp
                                                <tr>
                                                    <td>{{$key + 1}}</td>
                                                    <td>{{$report->supplier_name}}</td>
                                                    <td class="text-right">{{ \AccountHelper::number_format( $curr_total ) }}</td>
                                                    <td class="text-right">{{ \AccountHelper::number_format( $curr_paid ) }}</td>
                                                    <td class="text-right">{{ \AccountHelper::number_format( $curr_due ) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5"> No Record Found</td>
                                                </tr>
                                            @endforelse

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-right"><b>Total:</b></td>
                                                <td class="text-right"><b>{{ \AccountHelper::number_format( $total ) }}</b></td>
                                                <td class="text-right"><b>{{ \AccountHelper::number_format( $paidAmount ) }}</b></td>
                                                <td class="text-right"><b>{{ \AccountHelper::number_format( $dueAmount ) }}</b></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                            </div>
                        </div>
                        @include('includes.report-footer')
                    </div>
                </div>

            </div><!-- container -->

           @include('includes.dashboard-footer')
        </div>

    @endsection
@endsection
@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        (function() {
            $('.select2').select2();
        })();
    </script>
@endsection
