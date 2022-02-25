@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')

    @section('body')

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card" id="printArea">
                            <div class="card-body">
                                @include('includes.company-detail-header')
                            </div><!--end card-body-->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 bg-soft-dark">
                                        <h4 class="text-center"><b>{{ trans('accounts.general.employee_details') }}</b></h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h6><b>{{ trans('accounts.general.employee_name') }}:</b></h6>
                                        <h6><b>{{ trans('accounts.general.employee_contact') }}: </b></h6>
                                    </div>
                                    <div class="col-md-3">

                                        <h6 class="text-left">{{ $payslip->employee->full_name }}</h6>
                                        <h6 class="text-left">{{ $payslip->employee->phone }}</h6>

                                    </div>
                                    <div class="col-md-3">
                                        @if($payslip->employee->address_line_1)
                                        <h6 class="text-left"><b>{{ trans('accounts.general.address') }}:</b></h6>
                                        @endif
                                        <h6 class="text-left"><b>{{ trans('accounts.general.designation') }}: </b></h6>

                                    </div>
                                    <div class="col-md-3 float-right">
                                        @if($payslip->employee->address_line_1)
                                        <h6 class="text-left">{{ $payslip->employee->address_line_1 }}</h6>
                                        @endif
                                        <h6 class="text-$payslip->employee->full_name">{{ $payslip->employee->designation->name }}</h6>

                                    </div>


                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 bg-soft-dark">
                                        <h4 class="text-center"><b>{{ trans('accounts.general.salary_details') }}</b></h4>
                                    </div>
                                </div>

                                <div class="row ml-2">
                                    <div class="col-4">
                                        <h4 class=" "><b>{{ __('accounts.general.total_salary') }} :</b></h4>
                                        @if ($payslip->deduction > 0)
                                            <h4 class=" "><b>{{ __('accounts.general.deduction') }} :</b></h4>

                                            <h4 class=" "><b>{{trans('accounts.general.deduction_reason') }} :</b></h4>
                                            @if ($payslip->deduction_type == 1)
                                                <h4 class=" "><b>{{ __('accounts.general.remaining_loan') }} :</b></h4>
                                            @endif
                                        @endif
                                        <h4 class=" "><b>{{ __('accounts.general.paid_salary') }} :</b></h4>
                                        @if ($payslip->receivedBy()->exists())
                                            <h4 class=" "><b>{{ __('accounts.general.received_by') }} :</b></h4>
                                        @endif
                                    </div>
                                    <div class="col-4">
                                        <h4 class=" text-left">{{ \Accounthelper::number_format($payslip->total_salary) }} </h4>
                                        @if ($payslip->deduction > 0)
                                            <h4 class=" text-left">{{ \Accounthelper::number_format($payslip->deduction) }} </h4>
                                            @if ($payslip->deduction_type == 1)
                                                <h4 class=" text-left"> {{ __('accounts.general.loan_deduction') }} </h4>

                                                <h4 class=" text-left">{{ \Accounthelper::number_format(\Accounthelper::employeeLoanRemainAmount($payslip->employee_id)['remaining']) }}
                                                </h4>
                                            @endif
                                            @if ($payslip->deduction_type == 2)
                                                <h4 class=" text-left"> {{ __('accounts.general.deduction_from_salary') }} </h4>

                                            @endif
                                        @endif
                                        <h4 class=" text-left">{{ \Accounthelper::number_format($payslip->paid_salary) }} </h4>
                                        @if ($payslip->receivedBy()->exists())
                                            <h4 class=" text-left">{{ $payslip->receivedBy->full_name }} </h4>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-lg-6">

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="w-25 float-right">
                                            <small>Accounts Manager</small>
                                            <p class="border-top">&nbsp;</p>
                                        </div>
                                        <div class="w-25 float-right mr-4">
                                            <small>Employee ({{ $payslip->employee->full_name }})</small>
                                            <p class="border-top">&nbsp;</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row d-flex justify-content-center">
                                    <div class="col-lg-12 col-xl-4 ml-auto align-self-center">

                                    </div>
                                    <div class="col-lg-12 col-xl-4">
                                        <div class="float-right d-print-none">
                                            <a href="javascript:void(0);" id="printBtn" class="btn btn-info text-light"><i class="fa fa-print"></i></a>
                                            <a href="{{ route('dashboard.accounts.salary_generate.index') }}" class="btn btn-danger text-light">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
            </div><!-- container -->

            @include('includes.dashboard-footer')
        </div>
    @endsection
@endsection

@section('innerScript')

@endsection
