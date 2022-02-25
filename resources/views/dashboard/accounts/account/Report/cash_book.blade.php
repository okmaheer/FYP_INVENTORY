@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    @include('includes.datatable-css')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/rowgroup/1.1.4/css/rowGroup.dataTables.min.css">
    <link href="https://cdn.datatables.net/fixedheader/3.2.0/css/fixedHeader.dataTables.min.css"/>

    <style>
        table.dataTable tr.dtrg-group.dtrg-start td {
            background-color: rgba(87, 102, 218, 0.15) !important;
            color: #5766da !important;
        }

        table.dataTable tr.dtrg-group.dtrg-end td {
            background-color: #5766da !important;
            color: #ffffff !important;
        }
    </style>
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')
    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            @include('dashboard.accounts.common.filter-by-start-end-date',['route'=>'cash.book'])
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" id="printArea">
                            <div class="card-body">
                                @include('includes.company-detail-header')
                                <div class="row">
                                    <div class="col-12">
                                        <table id="datatable" class="table table-bordered"
                                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                            <thead>
                                            <tr>
                                                <th class="text-center">SL.</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Voucher No</th>
                                                <th class="text-center">Voucher Type</th>
                                                <th class="text-center">Remark</th>
                                                <th class="text-right">Debit</th>
                                                <th class="text-right">Credit</th>
                                                <th class="text-right">Balance</th>
                                            </tr>
                                            </thead>
                                            <tbody>


                                            @php
                                                $totalCredit=0;
                                                $totalDebit=0;
                                                $VNo="";
                                                $balance=0;
                                            @endphp
                                            @forelse($report2 as $key => $report)
                                                @php
                                                    $totalDebit += $report->Debit;
                                                    $totalCredit += $report->Credit;
                                                    $balance += $report->Debit - $report->Credit;
                                                @endphp
                                                <tr>
                                                    <td class="text-center">{{$key+1}}</td>
                                                    <td><span class="float-left"><strong>Date: </strong>{{ \AccountHelper::date_format($report->VDate)}}</span> <span class="float-right"><strong>Opening Balance: </strong>{{AccountHelper::ledgerBalanceType( \QueryHelper::getPreviousBalance($report->VDate))}}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ AccountHelper::getRouteForVoucher($report->Vtype,$report->VNo) }}"
                                                           target="_blank">
                                                            {{$report->VNo}}
                                                        </a></td>
                                                    <td class="text-center">{{$report->Vtype}}</td>
                                                    <td class="text-center"><strong>{{$report->Narration}}</strong></td>
                                                    <td class="text-right">{{$report->Debit}}</td>
                                                    <td class="text-right">{{$report->Credit}}</td>
                                                    <td class="text-right">{{AccountHelper::ledgerBalanceType($balance). __('accounts.currency.pkr')}}</td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-center" colspan="8"> No Record Found</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                @include('includes.report-footer')
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- container -->
            @include('includes.dashboard-footer')
        </div>
    @endsection
@endsection
@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.1.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
@endsection
@section('innerScript')
            <script>
                $(document).ready(function () {
                    let total_debit = 0;
                    let total_credit = 0;

                    $('#datatable').DataTable({
                        "order": [],
                        "aaSorting": [],

                        fixedHeader: {
                            header: true,
                        },
                        paging: false,
                        columnDefs: [
                            {targets: [1], visible: false},
                        ],
                        rowGroup: {
                            startRender: function (rows, group) {
                                return group;
                            },
                            endRender: function (rows, group, level) {
                                total_debit += rows
                                    .data()
                                    .pluck(5)
                                    .reduce(function (a, b) {
                                        return Number(a) + Number(b);
                                    }, 0);

                                total_credit += rows
                                    .data()
                                    .pluck(6)
                                    .reduce(function (a, b) {
                                        return Number(a) + Number(b);
                                    }, 0);

                                if ((total_debit - total_credit) < 0) {
                                    var closing_balance = ((total_debit - total_credit) * -1);
                                    closing_balance = $.fn.dataTable.render.number(',', '.', 2, 'CR ', ' Pkr').display(closing_balance);
                                } else {
                                    var closing_balance = (total_debit - total_credit);
                                    closing_balance = $.fn.dataTable.render.number(',', '.', 2, 'DR  ', ' Pkr').display(closing_balance);
                                }

                                let new_row = $('<tr/>')
                                    .append('<td colspan="7" class="text-right"><strong>Closing Balance: </strong>' + closing_balance + '</td>');
                                // new_row.append('<br>');
                                // new_row.append( '<td class="text-center">SL.</td>' )
                                //     .append( '<td class="text-center">Date</td>' )
                                //     .append( '<td class="text-center">Voucher No</td>' )
                                //     .append( '<td class="text-center">Voucher Type</td>' )
                                //     .append( '<td class="text-center">Remark</td>' )
                                //     .append( '<td class="text-right">Debit</td>' )
                                //     .append( '<td class="text-right">Credit</td>' )
                                //     .append( '<td class="text-right">Balance</td>' );
                                return $(new_row);

                            },
                            dataSrc: [1]
                        },
                    });

                });


            </script>
@endsection

