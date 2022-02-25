@extends('layouts.dashboard')
@section('page_title')
@section('content')
@include('includes.dashboard-breadcrumbs')
<style>
  /* .col-sm-1{
      margin-left: -115px;
  } */
  #myModalLabel{
    margin-left: 44%;
  }
  .modal-dialog {
      margin-left: 32%;
  }
  .product_field{
      width: 220px;
  }
</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">
                            <div class="card">
                                <div class="panel-title ">
                                    <div class="row border-grey border-bottom">
                                        <div class="col-lg-6">
                                            <h3 class="p-3 text-dark">Service Invoice</h3>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body">
                                {!! Form::open(['route' => 'dashboard.accounts.service_invoice.store','files' => true] ) !!}
                                {!! csrf_field() !!}
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                    {!!  HTML::decode(Form::label('supplier_id' ,'Customer <br> Name/Phone <i class="text-danger">*</i>' ,['class'=>' col-form-label text-left']))   !!}

                                                    </div>
                                                    <div class="col-sm-8">
                                                    {!!  Form::text('phone',null,['id'=>'supplier_id','class'=>'form-control','placeholder'=>'Customer Name/Phone','required']) !!}

                                                    </div>
                                                    <div class="col-sm-1">
                                                    {{-- {!! Form::open(['route' => 'dashboard.accounts.service_invoice.store','files' => true] ) !!} --}}
                                                     {{-- {!! csrf_field() !!} --}}
                                                                <div class=" text-center">
                                                                    <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target=".bd-example-modal-xl"> <i class="ti-plus m-r-2"></i></button>
                                                                </div>
                                                                <!-- sample modal content -->
                                                                <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-xl ">
                                                                        <div class="modal-content w-50 " >
                                                                            <div class="modal-header bg-success">
                                                                                <h5 class="modal-title mt-0 text-light" id="myModalLabel">Add New Customer</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="general-label">

                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-4">
                                                                                            {!!  Form::label('purchase_details' ,'Customer Name' ,['class'=>'col-form-label '])   !!}

                                                                                            </div>
                                                                                            <div class="col-sm-8">
                                                                                            {!!  Form::text('phone',null,['id'=>'phone','class'=>'form-control','placeholder'=>'Customer Name/Phone']) !!}

                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-4">
                                                                                            {!!  Form::label('purchase_details' ,'Customer Name' ,['class'=>'col-form-label '])   !!}

                                                                                            </div>
                                                                                            <div class="col-sm-8">
                                                                                            {!!  Form::email('email',null,['id'=>'email','class'=>'form-control','placeholder'=>'Customer Email']) !!}

                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-4">
                                                                                            {!!  Form::label('purchase_details' ,'Customer Mobile' ,['class'=>'col-form-label '])   !!}

                                                                                            </div>
                                                                                            <div class="col-sm-8">
                                                                                            {!!  Form::text('number',null,['id'=>'email','class'=>'form-control','placeholder'=>'Customer Number']) !!}

                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group row">
                                                                                            <div class="col-sm-4">
                                                                                            {!!  Form::label('purchase_details' ,'Customer Address' ,['class'=>'col-form-label '])   !!}

                                                                                            </div>
                                                                                            <div class="col-sm-8">
                                                                                            {!!  Form::text('number',null,['id'=>'email','class'=>'form-control','placeholder'=>'Customer Adress']) !!}

                                                                                            </div>
                                                                                        </div>



                                                                                </div>

                                                                            </div>
                                                                            <div class="modal-footer">

                                                                                {!! Form::submit('Submit', array('class' => 'btn btn-success waves-effect waves-light')) !!}

                                                                            </div>
                                                                        </div>
                                                                        <!-- /.modal-content -->
                                                                    </div>
                                                                    <!-- /.modal-dialog -->
                                                                </div>

                                                                {{-- {!! Form::close() !!} --}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                    </div>
                                                    <div class="col-sm-2">

                                                    {!!  HTML::decode(Form::label('employee' ,'Employee<i class="text-danger">*</i>' ,['class'=>' col-form-label text-right']))   !!}

                                                        </div>
                                                        <div class="col-sm-8">
                                                        {!!  Form::text('employee',null,['id'=>'employee','class'=>'form-control','placeholder'=>'Select Option','required']) !!}

                                                        </div>


                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                    {!!  HTML::decode(Form::label('etd' ,'ETD<i class="text-danger">*</i>' ,['class'=>' col-form-label text-right']))   !!}

                                                    </div>
                                                    <div class="col-sm-8">
                                                    {!!  Form::date('etd',null,['id'=>'employee','class'=>'form-control','placeholder'=>'','required']) !!}

                                                    </div>
                                                    <div class="col-sm-1">
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="table-responsive product-supplier">
                                                <table class="table table-bordered table-hover" id="product_table">
                                                    <thead>
                                                        <tr>

                                                            <th class="text-center">Service Name<i class="text-danger">*</i></th>
                                                            <th class="text-center">Qnty<i class="text-danger">*</i></th>
                                                            <th class="text-center">Charge <i class="text-danger">*</i></th>
                                                            <th class="text-center">Discount %</th>
                                                            <th class="text-center">Total </th>
                                                            <th class="text-center">Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="test-body">
                                                        <tr id="row" class="test">
                                                            <td>
                                                            {!!  Form::text('product_name',null,['id'=>'employee','class'=>'form-control product_name productSelection','placeholder'=>'Service Name']) !!}

                                                            </td>
                                                            <td>
                                                            {!!  Form::text('available_quantity_1',null,['id'=>'available_quantity_1','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00']) !!}


                                                            </td>
                                                            <td>
                                                            {!!  Form::text('available_quantity_1',null,['id'=>'available_quantity_1','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00']) !!}

                                                            </td>
                                                            <td>
                                                            {!!  Form::text('available_quantity_2',null,['id'=>'available_quantity_2','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00']) !!}

                                                            </td>
                                                            <td>
                                                            {!!  Form::text('available_quantity_3',null,['id'=>'available_quantity_3','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00']) !!}

                                                            </td>

                                                            <td>


                                                             </td>

                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="3" rowspan="2" class="text-center">
                                                            {!!  Form::label('etd' ,'Service Discount:' ,['class'=>' col-form-label text-center'])   !!}


                                                                <textarea class="form-control" name="inva_details" id="details" cols="30" rows="2" tabindex="19" placeholder="Sale Details"></textarea>
                                                            </td>
                                                            <td>
                                                                <b>Sale Discount:	</b>
                                                            </td>
                                                            <td>
                                                            {!!  Form::text('available_quantity_1',null,['id'=>'available_quantity_1','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00']) !!}

                                                            </td>
                                                            <td>
                                                                <button type="button" id="add-row" class="btn btn-info" value="Delete" aria-invalid="false" tabindex="8"><i class="fa fa-plus"></i></button>

                                                             </td>
                                                        </tr>


                                                        <tr>
                                                            <td>
                                                                <b>Total <br>Discount:</b>
                                                            </td>
                                                            <td>
                                                            {!!  Form::text('available_quantity_1',null,['id'=>'available_quantity_1','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00']) !!}

                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right" colspan="4">
                                                                <b>Total Tax:</b>
                                                            </td>
                                                            <td>
                                                            {!!  Form::text('available_quantity_1',null,['id'=>'available_quantity_1','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00']) !!}

                                                            </td>
                                                            <td>
                                                                <button type="button" class="toggle btn-warning"><i class="fa fa-angle-double-down"></i></button>
                                                             </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right" colspan="4">
                                                                <b>Shipping Cost:</b>
                                                            </td>
                                                            <td>
                                                            {!!  Form::text('available_quantity_1',null,['id'=>'available_quantity_1','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00']) !!}

                                                            </td>
                                                            <td>

                                                             </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right" colspan="4">
                                                                <b>Grand Total:</b>
                                                            </td>
                                                            <td>
                                                            {!!  Form::text('available_quantity_1',null,['id'=>'available_quantity_1','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00']) !!}

                                                            </td>
                                                            <td>

                                                             </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right" colspan="4">
                                                                <b>Previous:</b>
                                                            </td>
                                                            <td>
                                                            {!!  Form::text('available_quantity_1',null,['id'=>'available_quantity_1','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00']) !!}

                                                            </td>
                                                            <td>

                                                             </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right" colspan="4">
                                                                <b>Net Total:	</b>
                                                            </td>
                                                            <td>
                                                            {!!  Form::text('available_quantity_1',null,['id'=>'available_quantity_1','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00']) !!}

                                                            </td>
                                                            <td>

                                                             </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right" colspan="4">
                                                                <b>Paid Amount:</b>
                                                            </td>
                                                            <td>
                                                            {!!  Form::text('available_quantity_1',null,['id'=>'available_quantity_1','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00']) !!}

                                                            </td>
                                                            <td>

                                                             </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right" colspan="4">
                                                                <b>Due:</b>
                                                            </td>
                                                            <td>
                                                            {!!  Form::text('available_quantity_1',null,['id'=>'available_quantity_1','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00']) !!}

                                                            </td>
                                                            <td class="border-top-0">

                                                             </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="float-left product_field" >
                                                                <a href="" id="full_paid_tab" class="btn btn-warning" tabindex="16">Full Paid</a>
                                                                <a href="" id="add_invoice" class="btn btn-success" tabindex="17">Submit</a>

                                                            </td>
                                                            <td class="text-right" colspan="4">
                                                                <b>Change:	</b>
                                                            </td>
                                                            <td>
                                                            {!!  Form::text('available_quantity_1',null,['id'=>'available_quantity_1','class'=>'form-control text-right stock_ctn_1','placeholder'=>'0.00']) !!}

                                                            </td>


                                                        </tr>
                                                    </tfoot>
                                                </table>

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
