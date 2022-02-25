@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@include('includes.dashboard-breadcrumbs')
<style>
  /* .col-sm-1{
      margin-left: -115px;
  } */
</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">
                            <div class="card">
                                <div class="panel-title ">
                                    <div class="row border-grey border-bottom">
                                        <div class="col-lg-12">
                                            <h3 class="p-3 text-dark">Add Quotation</h3>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body">

                                        {!! Form::open(['route' => 'dashboard.accounts.quotation.update', 'files' => true] ) !!}
                                         {!! csrf_field() !!}
                                        <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    {!!  Html::decode(Form::label('customer_id' ,'Customer  <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}

                                                </div>
                                                <div class="col-sm-8">
                                                    {!!  Form::select('customer_id', $customer,null,['id'=>'customer_id',
                                                        'class'=>'select2 form-control mb-3 custom-select float-right',
                                                        'placeholder'=>'Select Unit/Option','required'])
                                                    !!}


                                                </div>
                                            </div>
                                        </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                    {!!  Html::decode(Form::label('quotation_no' ,'Quotation No <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}

                                                    </div>
                                                    <div class="col-sm-8">
                                                        {!!  Form::text('quotation_no',null,['id'=>'quotation_no','class'=>'form-control ','placeholder'=>'1000','required']) !!}

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        {!!  Html::decode(Form::label('address' ,'Address <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}

                                                    </div>
                                                    <div class="col-sm-8">
                                                        {!!  Form::text('address',null,['id'=>'address','class'=>'form-control ','placeholder'=>'1008','required']) !!}

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        {!!  Html::decode(Form::label('qdate' ,'Quotation Date <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}

                                                    </div>
                                                    <div class="col-sm-8">
                                                        {!!  Form::date('qdate',null,['id'=>'qdate','class'=>'form-control ','placeholder'=>'1008','required']) !!}

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                    {!!  Html::decode(Form::label('mobile' ,'Mobile <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}

                                                    </div>
                                                    <div class="col-sm-8">
                                                        {!!  Form::text('mobile',null,['id'=>'mobile','class'=>'form-control ','placeholder'=>'1008']) !!}

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                    {!!  Html::decode(Form::label('expiry_date' ,'Expiry Date <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}

                                                    </div>
                                                    <div class="col-sm-8">
                                                        {!!  Form::date('expiry_date',null,['id'=>'expiry_date','class'=>'form-control ','placeholder'=>'Expiry Date','value'=>'2021-05-04','required']) !!}

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                    {!!  Form::label('details' ,'Details:' ,['class'=>'col-form-label text-right'])   !!}

                                                    </div>
                                                    <div class="col-sm-10">
                                                     {!! Form::textarea('details',null,['class' => 'form-control', 'size' => '30x2','placeholder'=>'Details']) !!}

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="table-responsive product-supplier">
                                                <table class="table table-bordered table-hover" id="product_table">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Item Information <i class="text-danger">*</i></th>
                                                            <th class="text-center">Desc</th>
                                                            <th class="text-center">SN</th>
                                                            <th class="text-center">Av. Qnty.</th>
                                                            <th class="text-center">Unit</th>
                                                            <th class="text-center">Qnty<i class="text-danger">*</i></th>
                                                            <th class="text-center">Rate<i class="text-danger">*</i></th>
                                                            <th class="text-center">Discount %</th>
                                                            <th class="text-center">Total</th>
                                                            <th class="text-center">Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="test-body">
                                                        <tr id="row">
                                                            <td>
                                                                <input type="text" placeholder="Product Name" name="product_name" class="form-control product_name productSelection">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="desc" id="available_quantity_1" class="form-control text-right stock_ctn_1" >
                                                            </td>
                                                            <td>
                                                                    <div class="col-sm-12">
                                                                        <select name="serial_no" class="select2 form-control mb-3 custom-select float-right" >
                                                                            <option>Select Option</option><option value="1">Data</option><option value="2">new Data</option>


                                                                        </select>
                                                                    </div>
                                                            </td>
                                                            <td>
                                                                {!!  Form::text('available_quantity',null,['id'=>'available_quantity','class'=>'form-control text-right stock_ctn_1 ','placeholder'=>'0.00','readonly']) !!}

                                                            </td>
                                                            <td>
                                                                {!!  Form::text('available_quantity_3',null,['id'=>'available_quantity_3','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00','readonly']) !!}

                                                            </td>
                                                            <td>
                                                                {!!  Form::text('product_quantity',null,['id'=>'product_quantity','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00','readonly']) !!}

                                                            </td>
                                                            <td>
                                                                {!!  Form::text('product_rate',null,['id'=>'product_rate','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00']) !!}

                                                            </td>
                                                            <td>
                                                                {!!  Form::text('discount',null,['id'=>'discount','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00','readonly']) !!}

                                                            </td>
                                                            <td>
                                                                {!!  Form::text('total_price',null,['id'=>'total_price','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00','readonly']) !!}

                                                            </td>
                                                            <td>

                                                             </td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="8"  class="text-right">
                                                                <b>Sale  Discount:	</b>
                                                            </td>

                                                            <td>
                                                                {!!  Form::text('invoice_discount',null,['id'=>'invoice_discount','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00','readonly']) !!}

                                                            </td>
                                                            <td>
                                                                <button type="button" id="add-row" class="btn btn-info" value="plus"  tabindex="8"><i class="fa fa-plus"></i></button>

                                                             </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="8"  class="text-right">
                                                                <b>Total Discount:</b>
                                                            </td>
                                                            <td>
                                                                {!!  Form::text('available_quantity_1',null,['id'=>'available_quantity_1','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00','readonly']) !!}

                                                            </td>
                                                            <td></td>
                                                        </tr>

                                                        <tr>
                                                            <td class="text-right" colspan="8">
                                                                <b>Total Tax:</b>
                                                            </td>
                                                            <td>
                                                                {!!  Form::text('available_quantity_1',null,['id'=>'available_quantity_1','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00','readonly']) !!}

                                                            </td>
                                                            <td>

                                                             </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="text-right" colspan="8">
                                                                <b>Grand Total:</b>
                                                            </td>
                                                            <td>
                                                                {!!  Form::text('available_quantity_1',null,['id'=>'available_quantity_1','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00','readonly']) !!}

                                                            </td>
                                                            <td>

                                                             </td>
                                                        </tr>
                                                    </tfoot>



                                                </table>
                                            </div>

                                        </div>
                                        <hr>
                                        <div class="ml-4">
                                            {!! Form::submit('Add Service Quotation', array('class' => 'btn btn-primary')) !!}

                                        </div>
                                        <div class="form-group row mr-5">
                                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                                            <div class="col-sm-6">
                                                {!! Form::submit('Save', array('class' => 'btn btn-success btn-large')) !!}

                                            </div>

                                        </div>
                                        {!! Form::close() !!}
                                </div>
                            </div>

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
        {{-- <script src="{{ asset('dashboard/plugins/jsgrid/script.js') }}"></script> --}}
        @endsection
        @section('innerScript')

        <script>
            (function (){
                $('select').select2();
            })();
        </script>


        @endsection

        {{-- @section('innerScript')

        <!-- Plugins js -->
        <script src="{{ asset('dashboard/plugins/jsgrid/script.js') }}"></script>

       @endsection --}}
