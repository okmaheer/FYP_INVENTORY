@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('content')
@section('innerStyleSheet')
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@include('includes.dashboard-breadcrumbs')
<style>


</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">


                        <div class="card">
                            <div class="penal-title  border-grey border-bottom">
                                <h4 class="p-3 text-dark">{{__('accounts.hrm.employee_modify')}}</h4>
                            </div>
                            <div class="card-body">

                                <div class="general-label">
                                    {!! Form::model($model , ['route' => ['dashboard.accounts.employee.update', $model->id], 'files' => true, 'id' => 'employee_form', 'class' => 'solid-validation'] ) !!}
                                    @method('PATCH')

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class=" col-sm-3">
                                                        {!!  Html::decode(Form::label('first_name' , __('accounts.hrm.fn').'<i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!!  Form::text('first_name',null,['id'=>'first_name','class'=>'form-control ','placeholder'=> __('accounts.hrm.fn'),'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class=" col-sm-3">
                                                        {!!  Html::decode(Form::label('last_name' ,__('accounts.hrm.ln').'<i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!!  Form::text('last_name',null,['id'=>'last_name','class'=>'form-control ','placeholder'=>'Last Name','required']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class=" col-sm-3">
                                                        {!!  Html::decode(Form::label('designation_id' ,__('accounts.hrm.desgination').'<i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!!  Form::select('designation_id', $designation,null,['id'=>'designation_id',
                                                            'class'=>'select2 form-control mb-3 custom-select float-right',
                                                            'placeholder'=>'Select Designation/Option','required'])
                                                        !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class=" col-sm-3">
                                                        {!!  Html::decode(Form::label('phone' ,__('accounts.hrm.phone').'<i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!!  Form::text('phone',null,['id'=>'phone','class'=>'form-control ','placeholder'=>'Phone','required']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class=" col-sm-3">
                                                        {!!  Html::decode(Form::label('rate_type',__('accounts.hrm.rate').'<i class="text-danger">*</i>',['class'=>'col-form-label']))   !!}
                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!!  Form::select('rate_type', AccountHelper::rateTypes(),null,['id'=>'rate_type',
                                                            'class'=>'select2 form-control mb-3 custom-select float-right',
                                                            'placeholder'=>'Select Option', 'required'])
                                                            !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        {!!  Html::decode(Form::label('hrate' ,__('accounts.hrm.salary').'<i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!!  Form::number('hrate',null,['step'=>'any', 'id'=>'hrate','class'=>'form-control ','placeholder'=>'0.00','required']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class=" col-sm-3">
                                                        {!!  Form::label('email' ,__('accounts.hrm.email') ,['class'=>'col-form-label'])   !!}
                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!!  Form::email('email',null,['id'=>'email','class'=>'form-control ','placeholder'=>'Email']) !!}

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class=" col-sm-3">
                                                        {!!  Form::label('blood_group' ,__('accounts.hrm.blood') ,['class'=>'col-form-label'])   !!}

                                                </div>
                                                    <div class="col-sm-9">
                                                        {!!  Form::text('blood_group',null,['id'=>'blood_group','class'=>'form-control ','placeholder'=>'Blood Group']) !!}

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class=" col-sm-3">
                                                        {!!  Form::label('address_line_1' ,__('accounts.hrm.address') ,['class'=>'col-form-label'])   !!}
                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!! Form::textarea('address_line_1',null,['class' => 'form-control', 'size' => '30x2','placeholder'=>'Address']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class=" col-sm-3">
                                                        {!!  Form::label('loan_percentage' ,__('accounts.hrm.loan_percentage'),['class'=>'col-form-label'])   !!}
                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!! Form::number('loan_percentage',null,['step'=>'any', 'class' => 'form-control','placeholder'=>'0.00']) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class=" col-sm-3">
                                                        {!!  Form::label('image' ,__('accounts.hrm.picture') ,['class'=>'col-form-label'])   !!}
                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!!  Form::file('image',null,['id'=>'image','class'=>'form-control ','placeholder'=>'Picture']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class=" col-sm-3">
                                                        {!!  Form::label('country' ,__('accounts.hrm.country') ,['class'=>'col-form-label'])   !!}
                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!!  Form::select('country', AccountHelper::CountryTypes(),null,['id'=>'country',
                                                            'class'=>'select2 form-control mb-3 custom-select float-right',
                                                            'placeholder'=>'Select Option'])
                                                        !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class=" col-sm-3">
                                                    {!!  Html::decode(Form::label('city' ,__('accounts.hrm.city').'<i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!!  Form::text('city',null,['id'=>'city','class'=>'form-control ','placeholder'=>'City', 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class=" col-sm-3">
                                                        {!!  Html::decode(Form::label('zip' ,__('accounts.hrm.zip') ,['class'=>'col-form-label']))   !!}
                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!!  Form::text('zip',null,['id'=>'zip','class'=>'form-control ','placeholder'=>'Zip Code']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class=" col-sm-3">
                                                        {!!  Form::label('document' ,__('accounts.hrm.document') ,['class'=>'col-form-label'])   !!}
                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!!  Form::file('document',null,['id'=>'document','class'=>'form-control ','placeholder'=>'']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        {!!  Form::label('working_hour' ,'Working Hours' ,['class'=>'col-form-label'])   !!}
                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!!  Form::number('working_hour',null,['step'=>'any','id'=>'working_hour','class'=>'form-control ','placeholder'=>'']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @include('dashboard.accounts.common.buttons.buttons-crud',
                                        ['update' => true, 'cancel' => true, 'cancel_route' => 'dashboard.accounts.employee.index'])

                                   {!! Form::close() !!}
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->

                </div><!-- container -->
               @include('includes.dashboard-footer')
            </div>
            <!-- end page content -->
            </div>
            <!--end page-wrapper-inner -->

        </div>
        <!-- end page-wrapper -->
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


