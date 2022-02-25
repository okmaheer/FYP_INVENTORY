@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    @include('includes.datatable-css')
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')
    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-12">
                        <div class="card">
                            @include('dashboard.accounts.Human-Resource.loan.components.report_filter', ['route' => 'employee.loan.report'])
                        </div>
                        <div class="card" id="printArea">
                            <div class="panel-title ">
                                <div class="row border-grey border-bottom">
                                    <div class="col-md-12">
                                        <h3 class="p-3 text-dark text-center">Loan Report</h3>
                                    </div>
                                </div>
                            </div>
                            @include('includes.messages')  <!--ALert Message--->
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Requested At</th>
                                            <th>Return Condition</th>
                                            <th>Loan Amount</th>
                                            <th>Received</th>
                                            <th>Remaining</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($report as $record)
                                        @php $remainAmount = \AccountHelper::employeeLoanRemainAmount($record->employee_id); @endphp
                                        <tr>
                                            <td>{{ $record->employee->full_name }}</td>
                                            <td>{{ \AccountHelper::date_format( $record->date ) }}</td>
                                            <td>
                                                {{ \AccountHelper::loanReturnTypes( $record->return_type ) }}<br>
                                                <small>
                                                @if ($record->return_type == 1)
                                                    Return Date: {{ \AccountHelper::date_format( $record->return_date ) }}
                                                @else
                                                    @if ($record->deduct_type == 1)
                                                        Fixed {{ \AccountHelper::number_format( $record->deduct_value ) }} Deduction
                                                    @else
                                                        {{ \AccountHelper::number_format( $record->deduct_value ) }}% Deduction
                                                    @endif
                                                @endif
                                                </small>
                                            </td>
                                            <td>{{ \AccountHelper::number_format( $record->loan_amount ) }}</td>
                                            <td>{{ \AccountHelper::number_format( ($record->loan_amount - $remainAmount['remaining']) ) }}</td>
                                            <td>{{ \AccountHelper::number_format( $remainAmount['remaining'] ) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('includes.dashboard-footer')
        </div>
    @endsection
@endsection
@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    @include('includes.datatable-js')
@endsection
@section('innerScript')
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.accounts.employee_loan.create'])
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
