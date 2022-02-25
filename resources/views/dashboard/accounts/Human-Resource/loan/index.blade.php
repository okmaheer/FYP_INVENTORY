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
                        @include('includes.messages')  <!--ALert Message--->
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('accounts.general.employee') }}</th>
                                            <th class="text-center">{{ __('accounts.employee_loan.request_date') }}</th>
                                            <th class="text-center">{{ __('accounts.employee_loan.loan_amount') }}</th>
                                            <th class="text-center">{{ __('accounts.employee_loan.return_type') }}</th>
                                            <th class="text-center">{{ __('accounts.general.status') }}</th>
                                            <th class="text-center">{{ __('accounts.general.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($records as $record)
                                        <tr>
                                            <td>{{ $record->employee->getFullNameAttribute() }}</td>
                                            <td>{{ \AccountHelper::date_format( $record->date ) }}</td>
                                            <td>{{ \AccountHelper::number_format( $record->loan_amount ) }}</td>
                                            <td>{{ \AccountHelper::loanReturnTypes( $record->return_type ) }}</td>
                                            <td class="text-center">
                                                <h4>
                                                <span @class([
                                                        'badge',
                                                        'badge-warning text-dark' => $record->status == 1, //in process
                                                        'badge-info' => $record->status == 2, //approved
                                                        'badge-danger' => $record->status == 3, //rejected
                                                        'badge-primary' => $record->status == 4, // semi received
                                                        'badge-success' => $record->status == 5, // received
                                                        ])
                                                >
                                                @if ($record->status == 4)
                                                    In Receiving
                                                @elseif ($record->status == 5)
                                                    Returned
                                                @else
                                                    {{  \AccountHelper::loanStatus( $record->status ) }}
                                                @endif
                                                </span></h4>
                                            </td>
                                            <td class="text-center">
                                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="{{ __('accounts.general.view') }}">
                                                    <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#loan_details_modal" rec-id="{{ $record->id }}"><i class="fas fa-info-circle"></i></button>
                                                </a>
                                                @if ($record->status == 2)
                                                    @can('loanPayment', \App\Models\EmployeeLoan::class)
                                                    <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="{{ __('accounts.employee_loan.pay_loan') }}">
                                                        <button type="button" class="btn btn-success btn-xs" onclick="payLoan({{ $record->id }});"><i class="fas fa-hand-holding-usd"></i></button>
                                                    </a>
                                                    @endcan
                                                @endif
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
        <div id="loan_details_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                </div>
            </div>
        </div>
    @endsection
@endsection
@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    @include('includes.datatable-js')
    <script src="{{ asset('js/admin_js/employee_loan.js') }}"></script>
@endsection
@section('innerScript')
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.accounts.employee_loan.create'])
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
