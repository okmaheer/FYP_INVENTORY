@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link href="{{ url('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('dashboard/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')
@section('body')

            <div class="page-content">
                <div class="container-fluid">

                    <div class="card">
                        <div class="panel-title  border-grey border-bottom">
                            <h4 class="p-3 text-dark">{{ trans('accounts.products.edit_product') }}</h4>
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
                                                        'class'=>'select2 form-control', 'style'=>'width:100%;',
                                                        'placeholder'=>'Select Category','required'])
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
                                                        'class'=>'select2 form-control', 'style'=>'width:100%;',
                                                        'placeholder'=>'Select Unit','required'])
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
                                                {!! Form::file('image', ['id' => 'image','class' => 'form-control dropify', 'data-default-file' => url($product->image), 'data-height' => '105', 'data-allowed-file-extensions' => 'jpg jpeg bmp gif', 'data-max-file-size' => '1M']) !!}
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                {!!  Form::label('description' ,'Product Details:' ,['class'=>'col-form-label product-Large'])   !!}
                                            </div>
                                            <div class="col-sm-8">
                                                {!! Form::textarea('description',null,['class' => 'form-control', 'size' => '30x5','placeholder'=>'Product Details']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {!! Form::submit('Update', ['id' => 'btn_save', 'class' => 'btn btn-success waves-effect waves-light w-md float-right']) !!}


                                {!! Form::close() !!}

                        </div>
                    </div>

             </div>

                {{-- complete supplier list --}}

                <!-- container -->


            </div>

@endsection
        @endsection


@section('innerScriptFiles')
    <script src="{{ url('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ url('dashboard/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ url('js/admin_js/json/product.js') }}"></script>
 @endsection
@section('innerScript')
    <script>
        $(document).ready(function () {
            $('.select2').select2();
            $('.dropify').dropify();
        });
    </script>
@endsection
