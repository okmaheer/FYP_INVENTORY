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
                            <div class="penal-tilte  border-grey border-bottom">
                                <h4 class="p-3 text-success">Commission</h4>
                                </div>
                            <div class="card-body">

                                <div class="general-label">
                                    {!! Form::open(['route' => 'commission', 'files' => true] ) !!}
                                        {!! csrf_field() !!}


                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                            {!!  Html::decode(Form::label('customer_name' ,'Customer Name <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::select('customer_name',AccountHelper::commissionStatus(),null,['id'=>'product_model',
                                                        'class'=>'select2 form-control mb-3 custom-select float-right',
                                                        'placeholder'=>'Select Model/Option','required'])
                                                !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            <div class="col-sm-2">
                                             {!!  Form::label('product_model' ,'Product Model' ,['class'=>'col-form-label'])   !!}
                                            </div>
                                            <div class="col-sm-10">
                                             {!!  Form::select('product_model',AccountHelper::manualStatus(),null,['id'=>'product_model',
                                                        'class'=>'select2 form-control mb-3 custom-select float-right',
                                                        'placeholder'=>'Select Model/Option'])
                                                !!}

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                            {!!  Html::decode(Form::label('from' ,'From <i class="text-danger">*</i>' ,['class'=>'col-form-label ']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                            {{ Form::date('from', null, ['class' => 'form-control', 'id'=>'datetimepicker']) }}

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                            {!!  Html::decode(Form::label('to' ,'To  <i class="text-danger">*</i>' ,['class'=>'col-form-label ']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {{ Form::date('to', null, ['class' => 'form-control', 'id'=>'datetimepicker']) }}

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                            {!!  Html::decode(Form::label('commission_rate' ,'Commission Rate <i class="text-danger">*</i>' ,['class'=>'col-form-label ']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                              {!! Form::textarea('commission_rate',null,['class' => 'form-control', 'size' => '10x1','placeholder'=>'Address1']) !!}

                                            </div>
                                        </div>
                                        <div class="row mr-5">
                                            <div class="col-sm-12 text-center mr-5">
                                        {!! Form::submit('Enter', array('class' => 'btn btn-success')) !!}

                                            </div>
                                        </div>
                                  {!! Form::close() !!}
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <div class="card">
                            <div class="penal-tilte  border-grey border-bottom">
                                <h4 class="p-3 text-success">Commission</h4>
                                </div>
                            <div class="card-body">
                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table class="table table-striped mb-0 table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <td>Date</td>
                                                    <td>Product Model</td>
                                                    <td>Qnty</td>
                                                    <td>Per PCS Commission</td>
                                                    <td>Total Commission</td>
                                                </tr>
                                            </thead>
                                           </table>
                                    </div>

                                </div>



                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->

                </div><!-- container -->
                &nbsp;
                &nbsp;
                &nbsp;
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
