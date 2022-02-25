@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@include('includes.dashboard-breadcrumbs')
<style>


</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">

                        <div class="card">
                            <div class="row">
                                <div class="col-md-3 mt-4"><h4 class="ml-4">Add Benefits </h4></div>
                                <div class="col-md-9 text-right mt-4 ">


                                </div>

                            </div>
                            <div class="card-body">

                                <div class="general-label">
                                    {{-- {!! Form::open(['route' => 'dashboard.accounts.supplier.store', 'files' => true] ) !!} --}}
                                        {!! csrf_field() !!}
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                            {!!  Html::decode(Form::label('salary_benefits' ,'Salary Benefits <i class="text-danger">*</i>' ,['class'=>'col-form-label ']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                 {{ Form::text('salary_benefits', null, ['class' => 'form-control', 'id'=>'salary_benefits', 'placeholder'=>'Salary Benefits','required']) }}
                                                 {{-- <input type="text" class="form-control"  id="horizontalInput1"  placeholder="Salary Benefits"> --}}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                            {!!  Html::decode(Form::label('employee_name' ,'From <i class="text-danger">*</i>' ,['class'=>'col-form-label ']))   !!}
                                            <label for="horizontalInput2" class=" col-form-label">Benefits Type<i class="text-danger"> *</i></label>
                                            </div>
                                            <div class="col-sm-10">
                                               {!!  Form::select('expense_type',AccountHelper::manualStatus(),null,['id'=>'expense_type',
                                                        'class'=>'select2 form-control mb-3 custom-select float-right',
                                                        'placeholder'=>'Select Model/Option'])
                                                !!}
                                            </div>
                                        </div>





                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                            {!! Form::submit('Reset', array('class' => 'btn btn-primary')) !!}
                                            {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}

                                            </div>
                                        </div>
                                   {!! Form::close() !!}
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->


                </div><!-- container -->

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
