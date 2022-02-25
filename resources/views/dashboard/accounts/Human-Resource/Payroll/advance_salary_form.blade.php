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

            <div class="row ">

                <div class="col-12">

                    <div class="card">
                        @include('includes.messages')
                        <div class="card-body">
                            <h3>Advance Salary Form</h3>
                            <hr>

                            <div class="form-div">
                                {!! Form::open( [ 'route' => 'gen.advance.salary' ,'files' => true] ) !!}
                                <div class="form-group row">
                                    {!!  Html::decode(Form::label('salary_month' ,'Salary Month <i class="text-danger">*</i>' ,['class'=>'col-sm-2 col-form-label']))   !!}
                                    <div class=" input-group col-sm-4">
                                        {!! Form::text('salary_month',\Carbon\Carbon::today()->format('F-Y'), ['id'=>'salary_month','class'=>'form-control monthpicker', 'autocomplete'=>'off', 'required']) !!}
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                    </div>

                                    {!!  Html::decode(Form::label('total_salary' , 'Salary' ,['class'=>'col-sm-2 col-form-label']))   !!}
                                    <div class="col-sm-4">
                                        {!! Form::text('total_salary',null, ['id'=>'basic','class'=>'form-control text-right','placeholder'=>'0.00','readonly' => true]) !!}
                                    </div>

                                </div>

                                <div class="form-group row">
                                    {!!  Html::decode(Form::label('employee_id' ,__('accounts.payroll.name').'<i class="text-danger">*</i>' ,['class'=>'col-sm-2 col-form-label']))   !!}
                                    <div class="col-sm-4" id="employee_id">
                                        {!!  Form::select('employee_id', $employees ,null,[
                                            'id'=>'select_employ', 'class'=>'select2 form-control',
                                            'placeholder'=>'Select Employee',
                                            'onchange' => 'employechange_emp_adv_sal(this.value)','required'])
                                        !!}
                                    </div>
                                    {!!  Html::decode(Form::label('advance_taken' , 'Advance Taken' ,['class'=>'col-sm-2 col-form-label']))   !!}
                                    <div class="col-sm-4">
                                        {!! Form::text('advance_taken',null, ['id'=>'advance_taken','class'=>'form-control text-right','placeholder'=>'0.00','readonly']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    {!!  Html::decode(Form::label('advance' ,__('accounts.payroll.advance').'<i class="text-danger">*</i>' ,['class'=>'col-sm-2 col-form-label']))   !!}
                                    <div class="col-sm-4">
                                        {!! Form::number('advance',null, ['id'=>'advance','class'=>'form-control ','placeholder'=>'0.00','onkeyup'=> 'calc_advc();','onfocusout'=> 'calc_advc();', 'required']) !!}
                                    </div>
                                    {!!  Html::decode(Form::label('loan' , 'Loan Deduction' ,['class'=>'col-sm-2 col-form-label']))   !!}
                                    <div class="col-sm-4">
                                        {!! Form::number('loan',null, ['step'=>'any','id'=>'loan','class'=>'form-control text-right','placeholder'=>'0.00', 'onkeyup'=>'calculateAfterLoan();', 'onchange'=>'calculateAfterLoan();']) !!}
                                    </div>


                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6"></div>
                                    {!!  Html::decode(Form::label('remaining_salary' , 'Remaining Salary' ,['class'=>'col-sm-2 col-form-label']))   !!}
                                    <div class="col-sm-4">
                                        {!! Form::text('remaining_salary',null, ['id'=>'rem_sal','class'=>'form-control text-right','placeholder'=>'0.00','readonly' => true]) !!}
                                        {!! Form::hidden('temp_remaining_salary',null, ['id'=>'temp_rem_sal','readonly' => true]) !!}
                                    </div>
                                </div>

                                <div class="form-group text-right">
                                    {{-- <button type="reset" class="btn btn-primary w-md m-b-5">Reset</button>
                                    <button type="submit" class="btn btn-success w-md m-b-5">Save</button> --}}
                                    {!! Form::submit('Reset', array('class' => 'btn btn-primary w-md m-b-5')) !!}
                                    {!! Form::submit('Save', array('class' => 'btn btn-success w-md m-b-5')) !!}
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>


        </div>
        <!-- container -->

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
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>

@endsection

