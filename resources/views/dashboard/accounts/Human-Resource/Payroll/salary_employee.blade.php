@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .table th {
            padding: 6px !important;
        }
        .table td {
            padding: 3px !important;
        }
    </style>
@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')
    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-12">
                        <div class="card">
                            <div class="penal-title border-grey border-bottom">
                                <h4 class="p-3 text-dark">Employee Salary</h4>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-pills" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-toggle="tab" href="#daily-staff" role="tab">Daily Wage Staff</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-toggle="tab" href="#salary-staff" role="tab">Salaried Staff</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <!--DAILY WAGE SALARY TAB START-->
                                    <div class="tab-pane active p-3" id="daily-staff" role="tabpanel">
                                        <div class="form-div">
                                            {!! Form::open( [ 'route' => 'add.salary.employee' ,'files' => true, 'class' => 'solid-validation'] ) !!}
                                            <div class="form-group row">
                                                {!!  Html::decode(Form::label('salary_month' ,'Salary Date <i class="text-danger">*</i>' ,['class'=>'col-sm-2 col-form-label']))   !!}
                                                <div class="input-group col-sm-4">
                                                    {!!  Form::text('salary_month',null,['id'=>'salary_month','class'=>'form-control datepicker','autocomplete'=>'off','required']) !!}
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                    </div>
                                                </div>
                                                {!!  Html::decode(Form::label('total_salary' ,__('accounts.payroll.salary').'<i class="text-danger">*</i>' ,['class'=>'col-sm-2 col-form-label']))   !!}
                                                <div class="col-sm-4">
                                                    {!! Form::text('total_salary',null, ['id'=>'total_salary','class'=>'form-control text-right','placeholder'=>'0.00', 'readonly' => true]) !!}
                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                {!!  Html::decode(Form::label('employee_id' ,__('accounts.payroll.name').'<i class="text-danger">*</i>' ,['class'=>'col-sm-2 col-form-label']))   !!}
                                                <div class="col-sm-4" id="employee_id">
                                                    {!!  Form::select('employee_id', $employee_id ,null,[
                                                        'id'=>'employee_id', 'class'=>'select2 form-control', 'placeholder'=>'Select Employee',
                                                        'onchange' => 'getDailyWage(this.value)' ,'required'])
                                                    !!}
                                                </div>

                                                {!!  Html::decode(Form::label('deduction' ,'Deduction' ,['class'=>'col-sm-2 col-form-label']))   !!}
                                                <div class="col-sm-4">
                                                    {!! Form::number('deduction',null, ['step'=>'any','id'=>'deduction', 'class'=>'form-control ', 'placeholder'=>'0.00', 'onkeyup'=> 'calculateDailyWage();', 'onchange'=> 'calculateDailyWage();']) !!}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                {!!  Html::decode(Form::label('deduction_reason' ,'Deduction Reason' ,['class'=>'col-sm-2 col-form-label']))   !!}
                                                <div class="col-sm-4">
                                                    {!! Form::text('deduction_reason',null, ['id'=>'deduction_reason', 'class'=>'form-control']) !!}
                                                </div>
                                                {!!  Html::decode(Form::label('paid_salary' ,'Remaining Salary' ,['class'=>'col-sm-2 col-form-label']))   !!}
                                                <div class="col-sm-4">
                                                    {!! Form::text('paid_salary',null, ['id'=>'paid_salary', 'class'=>'form-control text-right', 'placeholder'=>'0.00', 'readonly']) !!}
                                                </div>
                                            </div>
                                            @include('dashboard.accounts.common.buttons.buttons-crud', ['save' => true, 'reset' => true])
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <!--DAILY WAGE SALARY TAB END-->

                                    <!--AUTO SALARY TAB START-->
                                    <div class="tab-pane p-3" id="salary-staff" role="tabpanel">
                                        {!! Form::open( [ 'route' => 'add.salary.employee' ,'files' => true, 'id' => 'auto_salary_form'] ) !!}
                                        {!! Form::hidden('autoSalary', true) !!}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    {!! Html::decode(Form::label('salary_month' ,__('accounts.payroll.s_month').'<i class="text-danger">*</i>' ,['class'=>'col-md-3 col-form-label']))   !!}
                                                    <div class="input-group col-md-9">
                                                        {!! Form::text('salary_month',\Carbon\Carbon::today()->format('F-Y'), ['id'=>'all_salary_month','class'=>'form-control', 'autocomplete'=>'off', 'required', 'readonly']) !!}
                                                        <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="generated_salaries" style="display: none;">
                                            <div class="col-md-6">
                                                <h5>Already Generated for <span class="gen_month"></span></h5>
                                                <table class="table table-bordered table-striped">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Employee</th>
                                                            <th>Generated At</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="body_already">

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <h5>Currently Generated for <span class="gen_month"></span></h5>
                                                <table class="table table-bordered table-striped">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>Employee</th>
                                                        <th>Generated At</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="body_current">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                {!! Form::submit('Generate Salary', ['class' => 'btn btn-success w-md']) !!}
                                                @can('salaryPayslip', \App\Models\Salary::class)
                                                <a id="view_pay_slips" href="{{ route('dashboard.accounts.salary_generate.index', ['salary_month' => \Carbon\Carbon::today()->format('F-Y')]) }}" class="btn btn-primary w-md" style="display: none;">View Pay Slips</a>
                                                @endcan
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <!--AUTO SALARY TAB END-->
                                </div>

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
    <script src="{{ asset('js/admin_js/payroll.js') }}"></script>
@endsection

@section('innerScript')
    <script>
        (function (){
            $('.select2').select2();
        })();
    </script>
@endsection

