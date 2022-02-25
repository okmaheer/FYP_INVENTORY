@extends('layouts.dashboard')
@section('page_title')
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
                                <div class="panel-title  border-grey border-bottom">
                                    <h4 class="p-3 text-dark">Add Receipe</h4>
                                </div>
                                <div class="card-body">
                                {!! Form::open([ 'files' => true] ) !!}
                                {!! csrf_field() !!}
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                    {!!  HTML::decode(Form::label('menu_Name' ,'Menu Name<i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                                    </div>
                                                    <div class="col-sm-8">
                                                    {!!  Form::text('menu_Name',null,['id'=>'purchase_date','class'=>'form-control ','placeholder'=>'Menu Name','required']) !!}
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                            <div class="form-group row">
                                                    <div class="col-sm-4">
                                                    {!!  HTML::decode(Form::label('Expected_Weight' ,'Menu Price' ,['class'=>'col-form-label']))   !!}
                                                    </div>
                                                    <div class="col-sm-8">
                                                    {!!  Form::text('Expected_Weight',null,['id'=>'','class'=>'form-control ','placeholder'=>'Menu Price']) !!}
                                                    </div>

                                                </div>
                                            </div>




                                            <div class="table-responsive product-supplier">
                                                <table class="table table-bordered table-hover" id="product_table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center col-4">Product Name <i class="text-danger">*</i></th>

                                                            <th class="text-center">Quantity<i class="text-danger">*</i></th>


                                                            <th class="text-center">Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="test-body">
                                                        <tr id="row">
                                                            <td width="300">
                                                            {!!  Form::text('product_name',null,['id'=>'product_name','class'=>'form-control product_name productSelection','placeholder'=>'Product Name']) !!}
                                                            </td>


                                                            <td>
                                                            {!!  Form::text('available_quantity_4',null,['id'=>'','class'=>'form-control  stock_ctn_1','placeholder'=>'Quantity']) !!}

                                                            </td>
                                                            <td>
                                                                <button type="button" class="delete-row btn btn btn-danger  red valid float-right" value="Delete" aria-invalid="false" tabindex="8"><i class="fas fa-times"></i></button>

                                                             </td>

                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr >
                                                            <td class="text-right" colspan="6">






                                                                <button type="button" id="add-row" class="btn btn-info" value="plus" aria-invalid="false" tabindex="8"><i class="fa fa-plus"></i></button>

                                                             </td>
                                                        </tr>



                                                    </tfoot>

                                                </table>
                                            </div>
                                        </div>

                                        &nbsp;
                                        <div class="row">
                                            <div class="col-sm-12 text-left">
                                            {!! Form::submit('Submit', array('class' => 'btn btn-primary btn-large')) !!}
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                </div>
                            </div>

                </div><!-- container -->

               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection
        
        @section('innerScript')

        <!-- Plugins js -->
        <script src="{{ asset('dashboard/plugins/nestable/script.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/moment/moment.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/timepicker/bootstrap-material-datetimepicker.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/clockpicker/jquery-clockpicker.min.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/colorpicker/jquery-asColorPicker.min.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
       <script src="{{ asset('dashboard/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"></script>
        <script src="{{ asset('dashboard/pages/jquery.forms-advanced.js') }}"></script>

         @endsection
