@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')
 @section('body')
            <div class="page-content">
                <div class="container-fluid">

                    <div class="card">
                        @include('includes.messages')
                        <div class="panel-title  border-grey border-bottom">
                            <h4 class="p-3 text-success">{{ trans('accounts.products.add_product') }}</h4>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['route' => 'dashboard.accounts.products.store', 'files' => true, 'id' => 'product_form', 'class' => 'solid-validation'] ) !!}
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            {!!  Form::label('barcode' ,'Barcode/QR-code' ,['class'=>'col-form-label text-right'])   !!}
                                        </div>
                                        <div class="col-sm-10">
                                            {!!  Form::text('barcode',null,['id'=>'barcode','class'=>'form-control ','placeholder'=>'Barcode/QR-code']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            {!!  Html::decode(Form::label('product_name' ,'Product Name <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
                                        </div>
                                        <div class="col-sm-8">
                                            {!!  Form::text('product_name',null,['id'=>'product_name','class'=>'form-control ','placeholder'=>'Product Name','required']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            {!!  Form::label('serial_no' ,'SN' ,['class'=>'col-form-label text-right'])   !!}
                                        </div>
                                        <div class="col-sm-8">
                                            {!!  Form::text('serial_no',null,['id'=>'serial_no','class'=>'form-control ','placeholder'=>'111,abc,xyz']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            {!!  Html::decode(Form::label('model' ,'Brand' ,['class'=>'col-form-label text-right']))   !!}
                                        </div>
                                        <div class="col-sm-8">
                                            {!!  Form::text('model',null,['id'=>'model','class'=>'form-control ','placeholder'=>'Brand']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            {!!  Html::decode(Form::label('category_id' ,'Category <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
                                        </div>
                                        <div class="col-sm-8">
                                            {!!  Form::select('category_id', $categories,null,['id'=>'category_id',
                                                    'class'=>'select2 form-control mb-3 custom-select float-right',
                                                    'placeholder'=>'Select Category/Option','required'])
                                            !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            {!!  Form::label('price' ,'Sale Price' ,['class'=>'col-form-label text-right'])   !!}
                                        </div>
                                        <div class="col-sm-8">
                                            {!!  Form::text('price',null,['id'=>'price','class'=>'form-control ','placeholder'=>'0.00']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            {!!  Html::decode(Form::label('unit_id' ,'Unit <i class="text-danger">*</i>' ,['class'=>'col-form-label']) )  !!}
                                        </div>
                                        <div class="col-sm-8">
                                            {!!  Form::select('unit_id', $units,null,['id'=>'unit_id',
                                                    'class'=>'select2 form-control mb-3 custom-select float-right',
                                                    'placeholder'=>'Select Unit/Option', 'required'])
                                            !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            {!!  Form::label('image' ,'Image' ,['class'=>'col-form-label text-right'])   !!}
                                        </div>
                                        <div class="col-sm-8">
                                            {!! Form::file('image', ['id' => 'image','class' => 'form-control text-right']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="product_table"
                                                   class="table  table-striped mb-0 table-striped table-bordered dt-responsive nowrap">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">Supplier </th>
                                                    <th class="text-center">Supplier Price</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="proudt_item">
                                                <tr id="row">
                                                    <td width="300">
                                                        <div class="col-sm-12">
                                                            {!!  Form::select('supplier_id[]', $supplier,null,['id'=>'supplier_id',
                                                                    'class'=>'select2 form-control mb-3 custom-select float-right',
                                                                    'placeholder'=>'Select Supplier/Option'])
                                                            !!}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {!!  Form::text('supplier_price[]',null,['id'=>'supplier_price','class'=>'form-control text-right','placeholder'=>'0.00']) !!}
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-success"
                                                                onClick="addpruduct('proudt_item')"><i
                                                                class="fa fa-plus-square"></i></button>&nbsp;
                                                        <button type="button" class=" delete-row btn btn-sm btn-danger"
                                                                onclick="deleteRow(this)"><i
                                                                class="fas fa-trash-alt"></i>
                                                        </button>


                                                    </td>
                                                </tr>


                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    {!!  Form::label('description' ,'Product Details:' ,['class'=>'col-form-label product-Large'])   !!}

                                    {!! Form::textarea('description',null,['class' => 'form-control', 'size' => '30x2','placeholder'=>'Product Details']) !!}

                                </div>
                            </div>
                            &nbsp;
                            @include('dashboard.accounts.common.buttons.buttons-crud', ['save' => true, 'save_new' => true, 'form_id' => 'product_form', 'cancel' => true, 'cancel_route' => 'dashboard.accounts.products.index'])
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <input type="hidden" id="supplier_list"
                       value='<?php if ($supplier) { ?><?php foreach($supplier as $key => $value){?><option value="<?php echo $key; ?>"><?php echo $value; ?></option><?php }}?>'
                       name="">
                @include('includes.dashboard-footer')
            </div>

@endsection
@endsection
@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/admin_js/json/product.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        (function () {
            $('.select2').select2();
        })();
    </script>
@endsection
