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

                    <div class="card">
                        <div class="panel-title  border-grey border-bottom">
                            <h4 class="p-3 text-success">Add Product</h4>
                        </div>
                        <div class="card-body">

                                {!!  Form::model($product, ['route' => ['dashboard.accounts.products.update', $product->id] , 'files' => true , 'class' => 'solid-validation']) !!}
                                @csrf
                                @method('PATCH')
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
                                            {{-- <label for="productName" class="col-form-label text-right">Product Name <i class="text-danger">*</i></label> --}}
                                            {!!  HTML::decode(Form::label('product_name' ,'Product Name <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
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
                                                {!!  HTML::decode(Form::label('model' ,'Brand' ,['class'=>'col-form-label text-right']))   !!}
                                            </div>
                                            <div class="col-sm-8">
                                                {!!  Form::text('model',null,['id'=>'model','class'=>'form-control ','placeholder'=>'Brand']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                {!!  HTML::decode(Form::label('category_id' ,'Category <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
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
                                                {!!  Html::decode(Form::label('unit' ,'Unit <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-8">

                                                {!!  Form::select('unit', $units,null,['id'=>'unit',
                                                        'class'=>'select2 form-control mb-3 custom-select float-right',
                                                        'placeholder'=>'Select Unit/Option','required'])
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

                                @if(!$product->suppliers->isEmpty())
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table id="product_table" class="table  table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                    <thead>
                                                    <tr>
                                                        <th class="text-center">Supplier <i class="text-danger">*</i></th>
                                                        <th class="text-center">Supplier Price <i class="text-danger">*</i></th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="proudt_item">
                                                    @if(count($product->suppliers) > 0)
                                                        @foreach($product->suppliers as $data)
                                                            <tr id="row">
                                                                <td width="300">

                                                                    <div  class="col-sm-12">

                                                                        {!!  Form::select('supplier_id[]', $supplier,$data->supplier_id,['id'=>'supplier_id',
                                                                                'class'=>'select2 form-control mb-3 custom-select float-right',
                                                                                'placeholder'=>'Select Supplier/Option'])
                                                                        !!}


                                                                    </div>

                                                                </td>
                                                                <td>
                                                                    {!!  Form::text('supplier_price[]',$data->supplier_price,['id'=>'supplier_price','class'=>'form-control text-right','placeholder'=>'0.00']) !!}
                                                                </td>
                                                                <td>
                                                                    <button type="button"  class="btn btn-sm btn-success" onClick="addpruduct('proudt_item')"><i class="fa fa-plus-square"></i> </button>&nbsp;
                                                                    <button type="button" class=" delete-row btn btn-sm btn-danger" onclick="deleteRow(this)"><i class="fas fa-trash-alt"></i></button>


                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    @else
                                                        <tr id="row">
                                                            <td width="300">
                                                                <div class="col-sm-12">
                                                                    {!!  Form::select('supplier_id[]', $supplier,null,['id'=>'supplier_id',
                                                                            'class'=>'select2 form-control mb-3 custom-select float-right',
                                                                            'placeholder'=>'Select Supplier/Option','required'])
                                                                    !!}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {{-- <input name="supplier_price[]" type="text" class="form-control text-right"  placeholder="0.00"/> --}}
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
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                       <label for="description" class="col-form-label product-Large"><b> Product Details</b></label>
                                       <textarea name="description" class="form-control" id="description" cols="30" rows="2" placeholder="Product Details" tabindex="2"></textarea>
                                    </div>
                                </div>
                                &nbsp;@endif

                                @include('dashboard.accounts.common.buttons.buttons-crud', ['update' => true, 'cancel' => true, 'cancel_route' => 'dashboard.accounts.products.index'])
                                {!! Form::close() !!}

                        </div>
                    </div>

             </div>

                {{-- complete supplier list --}}
                <input type="hidden" id="supplier_list" value='<?php if ($supplier) { ?><?php foreach($supplier as $key => $value){?><option value="<?php echo $key ; ?>"><?php echo $value; ?></option><?php }}?>' name="">

                <!-- container -->


            </div>

@endsection
        @endsection


@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/admin_js/json/product.js') }}"></script>
 @endsection
@section('innerScript')
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
