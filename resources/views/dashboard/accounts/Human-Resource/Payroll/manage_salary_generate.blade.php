@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    @include('includes.datatable-css')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')

    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-12">
                        <div class="card">
                        @include('includes.messages')  <!--ALert Message--->
                            <div class="panel-title">
                                <span class="p-3">
                                    <div class="penal-title  border-grey border-bottom text-center">
                                        <h4 class="p-3 text-dark">{{ __('accounts.salary.manage') }}</h4>
                                    </div>
                                </span>
                            </div>
                            <div class="card-body">
                                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>{{ __('accounts.payroll.sl') }}</th>
                                            <th>{{ __('accounts.general.employee') }}</th>
                                            <th>{{ __('accounts.payroll.s_month') }}</th>
                                            <th>{{ __('accounts.payroll.salary') }}</th>
                                            <th>{{ __('accounts.general.type') }}</th>
                                            <th>{{ __('accounts.payroll.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($salaries as $key => $data)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{ $data->employee->full_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->salary_month)->format('M-Y') }}</td>
                                            <td>{{ \AccountHelper::number_format( $data->paid_salary ) }}</td>
                                            <td>
                                                @switch($data->type)
                                                    @case(1)
                                                        Monthly Salary @break
                                                    @case(2)
                                                        Advance Salary @break
                                                    @case(3)
                                                        Daily Wage @break
                                                @endswitch
                                            </td>
                                            <td class="text-center">
                                                @if($data->status == "Pending")
                                                    @can('salaryPayment', \App\Models\Salary::class)
                                                        <button type="button" class="btn btn-success btn-sm w-xs"  data-toggle="modal" data-target="#received_by_modal" emp-id="{{ $data->employee_id }}" rec-id="{{ $data->id }}">Pay Now</button>
                                                    @endcan
                                                @endif
                                                @can('salaryPayslip', \App\Models\Salary::class)
                                                    <a href="{{ route('payroll.payslip',$data->id) }}" class="btn btn-sm btn-info w-xs" target="_blank">Pay Slip</a>
                                                @endcan
                                            </td>
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
        @include('dashboard.accounts.Human-Resource.Payroll.components.received_by_modal')
    @endsection

@endsection
@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    @include('includes.datatable-js')
    <script src="{{ asset('js/admin_js/payroll.js') }}"></script>
@endsection
@section('innerScript')
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'salary.employee'])
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
