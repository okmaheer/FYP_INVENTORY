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
                                        <div class="col-lg-6">
                                            <h3 class="p-3 text-dark">Stage Creation Form</h3>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-body">
                                    {{-- {!! Form::open(['route' => 'products.store', 'files' => true] ) !!} --}}
                                     {!! csrf_field() !!}
                                        <div class="row">

                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        {!!  HTML::decode(Form::label('item_type' ,'Stage Type ' ,['class'=>'col-form-label text-right']))   !!}

                                                    </div>
                                                    <div class="col-sm-8">
                                                        {!!  Form::select('item_type', AccountHelper::stageType(),null,['id'=>'item_type',
                                                        'class'=>'select2 form-control mb-3 custom-select float-right',
                                                        'placeholder'=>'Select Stage Type'])
                                                         !!}

                                                    </div>
                                                    <div class="col-sm-1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        {!!  Form::label('article_no' ,'Article No' ,['class'=>'col-form-label text-right'])   !!}

                                                    </div>
                                                    <div class="col-sm-8">
                                                        {!!  Form::text('article_name',null,['id'=>'article_name','class'=>'form-control ','placeholder'=>'Article No']) !!}
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        {!!  Form::label('article_name' ,'Article Name' ,['class'=>'col-form-label text-right'])   !!}

                                                    </div>
                                                    <div class="col-sm-8">
                                                        {!!  Form::text('article_name',null,['id'=>'article_name','class'=>'form-control ','placeholder'=>'Article Name']) !!}

                                                    </div>
                                                    <div class="col-sm-1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        {!!  Form::label('available_colors' ,'Available Materials' ,['class'=>'col-form-label text-right'])   !!}

                                                    </div>
                                                    <div class="col-sm-8">
                                                        {!!  Form::text('available_colors',null,['id'=>'available_colors','class'=>'form-control ','placeholder'=>'Available Materials']) !!}

                                                    </div>

                                                </div>
                                            </div>



                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        {!!  Form::label('size' ,'Size' ,['class'=>'col-form-label text-right'])   !!}

                                                    </div>
                                                    <div class="col-sm-8">
                                                        {!!  Form::select('size', AccountHelper::Size(),null,['id'=>'size',
                                                        'class'=>'select2 form-control mb-3 custom-select float-right',
                                                        'placeholder'=>'Select Stage Size'])
                                                         !!}

                                                    </div>
                                                    <div class="col-sm-1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        {!!  Form::label('previous_balance' ,'Total Cost' ,['class'=>'col-form-label text-right'])   !!}

                                                    </div>
                                                    <div class="col-sm-8">
                                                        {!!  Form::number('previous_balance',null,['id'=>'previous_balance','class'=>'form-control ','placeholder'=>'Total Cost','readonly']) !!}

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="panel-title ">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <h4 class="p-3 text-dark">Including Items</h4>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">

                                            </div>

                                             <div class="col-lg-12 ml-5">
                                                <div class="form-group row ml-5">
                                                    {{-- <div class="col-sm-2">

                                                    </div> --}}
                                                    <div class="col-sm-1">
                                                        {!!  Form::label('floor' ,'Floor' ,['class'=>'col-form-label text-right'])   !!}

                                                    </div>
                                                    <div class="col-sm-1 mt-2">
                                                        {!!  Form::checkbox('floor',null,['id'=>'sole','class'=>'form-control ','placeholder'=>'Sole']) !!}

                                                    </div>
                                                    <div class="col-sm-2">
                                                        {!!  Form::label('base_material' ,'Base Material' ,['class'=>'col-form-label text-right'])   !!}

                                                        </div>
                                                    <div class="col-sm-1 mt-2">
                                                        {!!  Form::checkbox('base_material',null,['id'=>'base_material','class'=>'form-control ']) !!}

                                                    </div>
                                                    <div class="col-sm-2">
                                                        {!!  Form::label('back_wall' ,'Back-wall' ,['class'=>'col-form-label text-right'])   !!}

                                                        </div>
                                                        <div class="col-sm-1 mt-2">
                                                            {!!  Form::checkbox('back_wall',null,['id'=>'back_wall','class'=>'form-control ']) !!}

                                                        </div>
                                                        <div class="col-sm-1">
                                                            {!!  Form::label('decoration' ,'Decoration' ,['class'=>'col-form-label text-right'])   !!}

                                                            </div>
                                                        <div class="col-sm-1 mt-2">
                                                            {!!  Form::checkbox('decoration',null,['id'=>'decoration','class'=>'form-control ']) !!}

                                                        </div>
                                                        <div class="col-sm-2">

                                                        </div>

                                                </div>
                                            </div>

                                            <div class="col-lg-12 ml-5">
                                                <div class="form-group row ml-5">
                                                    {{-- <div class="col-sm-2">

                                                    </div> --}}
                                                    <div class="col-sm-1">
                                                        {!!  Form::label('furniture' ,'Furniture' ,['class'=>'col-form-label text-right'])   !!}

                                                    </div>
                                                    <div class="col-sm-1 mt-2">
                                                        {!!  Form::checkbox('furniture',null,['id'=>'furniture','class'=>'form-control ','placeholder'=>'Category Name']) !!}

                                                    </div>
                                                    <div class="col-sm-2">
                                                        {!!  Form::label('lights' ,'Lights' ,['class'=>'col-form-label text-right'])   !!}

                                                        </div>
                                                    <div class="col-sm-1 mt-2">
                                                        {!!  Form::checkbox('lights',null,['id'=>'lights','class'=>'form-control ']) !!}

                                                    </div>
                                                    <div class="col-sm-2">
                                                        {!!  Form::label('misc' ,'Misc' ,['class'=>'col-form-label text-right'])   !!}

                                                        </div>
                                                    <div class="col-sm-1 mt-2">
                                                        {!!  Form::checkbox('misc',null,['id'=>'misc','class'=>'form-control ']) !!}

                                                    </div>
                                                        <div class="col-sm-1">
                                                            {!!  Form::label('further' ,'Further' ,['class'=>'col-form-label text-right'])   !!}

                                                            </div>
                                                        <div class="col-sm-1 mt-2">
                                                            {!!  Form::checkbox('further',null,['id'=>'further','class'=>'form-control ']) !!}

                                                        </div>
                                                        <div class="col-sm-2">

                                                        </div>

                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="panel-title mr-4">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <h4 class="p-3 text-dark">Floor Material</h4>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">

                                            </div>

                                            <table class="table table-bordered table-hover" id="product_table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Wooden Table </th>
                                                        <th class="text-center">Joints</th>
                                                        <th class="text-center">Glass Slabs</th>
                                                        <th class="text-center">Supporting Meterails</th>
                                                        <th class="text-center">Misk</th>
                                                        <th class="text-center">Cost </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="test-body">
                                                    <tr id="row">
                                                        <td>
                                                            {!!  Form::text('product_name',null,['id'=>'product_name','class'=>'form-control product_name productSelection','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('bop',null,['id'=>'bop','class'=>'form-control stock_ctn_1','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('lead',null,['id'=>'lead','class'=>'form-control stock_ctn_1','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('titanium',null,['id'=>'titanium','class'=>'form-control stock_ctn_1','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('misk',null,['id'=>'misk','class'=>'form-control stock_ctn_1','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('other',null,['id'=>'other','class'=>'form-control stock_ctn_1','placeholder'=>'Category Name']) !!}

                                                        </td>

                                                    </tr>
                                                </tbody>


                                            </table>

                                            <div class="col-lg-6">
                                                <div class="panel-title mr-4">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <h4 class="p-3 text-dark">Base Material</h4>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">

                                            </div>

                                            <table class="table table-bordered table-hover" id="product_table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Base Material </th>
                                                        <th class="text-center">Solution</th>
                                                        <th class="text-center">Patawa</th>
                                                        <th class="text-center">Thread</th>
                                                        <th class="text-center">Ornament</th>
                                                        <th class="text-center">Cost </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="test-body">
                                                    <tr id="row">
                                                        <td>
                                                            {!!  Form::text('base_material',null,['id'=>'base_material','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('solution',null,['id'=>'solution','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('patawa',null,['id'=>'patawa','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('thread',null,['id'=>'thread','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('ornament',null,['id'=>'ornament','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('other',null,['id'=>'other','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>

                                                    </tr>
                                                </tbody>


                                            </table>

                                            <div class="col-lg-6">
                                                <div class="panel-title mr-4">

                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <h4 class="p-3 text-dark"> Back-wall</h4>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">

                                            </div>

                                            <table class="table table-bordered table-hover" id="product_table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Iron Stand </th>
                                                        <th class="text-center">Grill</th>
                                                        <th class="text-center">Artificail Flower</th>
                                                        <th class="text-center">Lights</th>
                                                        <th class="text-center">Curtons</th>
                                                        <th class="text-center">Cost</th>

                                                    </tr>
                                                </thead>
                                                <tbody id="test-body">
                                                    <tr id="row">
                                                        <td>
                                                            {!!  Form::text('fixed_charges',null,['id'=>'fixed_charges','class'=>'form-control ','placeholder'=>'Add Cost']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('fixed_charges',null,['id'=>'fixed_charges','class'=>'form-control ','placeholder'=>'Add Cost']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('labour_cost',null,['id'=>'labour_cost','class'=>'form-control ','placeholder'=>'Add Cost']) !!}

                                                      </td>
                                                        <td>
                                                            {!!  Form::text('fixed_charges',null,['id'=>'fixed_charges','class'=>'form-control ','placeholder'=>'Add Cost']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('misc_exp',null,['id'=>'misc_exp','class'=>'form-control ','placeholder'=>'Add Cost']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('other_charges',null,['id'=>'other_charges','class'=>'form-control ','placeholder'=>'Add Cost']) !!}

                                                        </td>

                                                    </tr>
                                                </tbody>
                                            </table>

                                             <div class="col-lg-6">
                                                <div class="panel-title mr-4">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <h4 class="p-3 text-dark">Decoration</h4>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">

                                            </div>

                                            <table class="table table-bordered table-hover" id="product_table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Natural Flower </th>
                                                        <th class="text-center">Lights</th>
                                                        <th class="text-center">Smoke Machine</th>
                                                        <th class="text-center">Petals Machine</th>
                                                        <th class="text-center">Ornament</th>
                                                        <th class="text-center">Cost </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="test-body">
                                                    <tr id="row">
                                                        <td>
                                                            {!!  Form::text('base_material',null,['id'=>'base_material','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('solution',null,['id'=>'solution','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('patawa',null,['id'=>'patawa','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('thread',null,['id'=>'thread','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('ornament',null,['id'=>'ornament','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('other',null,['id'=>'other','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>

                                                    </tr>
                                                </tbody>


                                            </table>

                                            <div class="col-lg-6">
                                                <div class="panel-title mr-4">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <h4 class="p-3 text-dark">Furniture</h4>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">

                                            </div>

                                            <table class="table table-bordered table-hover" id="product_table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Sofa Set</th>
                                                        <th class="text-center">Stands </th>
                                                        <th class="text-center">Sofa Cover</th>
                                                        <th class="text-center">Glass Table Set</th>
                                                        <th class="text-center">Ornament</th>
                                                        <th class="text-center">Cost </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="test-body">
                                                    <tr id="row">
                                                        <td>
                                                            {!!  Form::text('base_material',null,['id'=>'base_material','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('solution',null,['id'=>'solution','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('patawa',null,['id'=>'patawa','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('thread',null,['id'=>'thread','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('ornament',null,['id'=>'ornament','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('other',null,['id'=>'other','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>

                                                    </tr>
                                                </tbody>


                                            </table>

                                            <div class="col-lg-6">
                                                <div class="panel-title mr-4">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <h4 class="p-3 text-dark">Lights</h4>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">

                                            </div>

                                            <table class="table table-bordered table-hover" id="product_table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Basic Lights </th>
                                                        <th class="text-center">Fancy Lights</th>
                                                        <th class="text-center">Spot Lights</th>
                                                        <th class="text-center">Moveable Lights</th>

                                                        <th class="text-center">Cost </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="test-body">
                                                    <tr id="row">
                                                        <td>
                                                            {!!  Form::text('base_material',null,['id'=>'base_material','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('solution',null,['id'=>'solution','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>

                                                        <td>
                                                            {!!  Form::text('thread',null,['id'=>'thread','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('ornament',null,['id'=>'ornament','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('other',null,['id'=>'other','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>

                                                    </tr>
                                                </tbody>


                                            </table>

                                            <div class="col-lg-6">
                                                <div class="panel-title mr-4">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <h4 class="p-3 text-dark">Misc</h4>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">

                                            </div>

                                            <table class="table table-bordered table-hover" id="product_table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Labour Cost </th>
                                                        <th class="text-center">Fixed Charges</th>
                                                        <th class="text-center">Transportaion Charges</th>
                                                        <th class="text-center">Tax</th>

                                                        <th class="text-center">Cost </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="test-body">
                                                    <tr id="row">
                                                        <td>
                                                            {!!  Form::text('base_material',null,['id'=>'base_material','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>

                                                        <td>
                                                            {!!  Form::text('patawa',null,['id'=>'patawa','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('thread',null,['id'=>'thread','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('ornament',null,['id'=>'ornament','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('other',null,['id'=>'other','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>

                                                    </tr>
                                                </tbody>


                                            </table>

                                            <div class="col-lg-6">
                                                <div class="panel-title mr-4">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <h4 class="p-3 text-dark">Further</h4>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">

                                            </div>

                                            <table class="table table-bordered table-hover" id="product_table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Base Material </th>
                                                        <th class="text-center">Solution</th>
                                                        <th class="text-center">Patawa</th>
                                                        <th class="text-center">Thread</th>
                                                        <th class="text-center">Ornament</th>
                                                        <th class="text-center">Cost </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="test-body">
                                                    <tr id="row">
                                                        <td>
                                                            {!!  Form::text('base_material',null,['id'=>'base_material','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('solution',null,['id'=>'solution','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('patawa',null,['id'=>'patawa','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('thread',null,['id'=>'thread','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('ornament',null,['id'=>'ornament','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>
                                                        <td>
                                                            {!!  Form::text('other',null,['id'=>'other','class'=>'form-control ','placeholder'=>'Add Quantity']) !!}

                                                        </td>

                                                    </tr>
                                                </tbody>


                                            </table>






                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                {!! Form::submit('Save', array('class' => 'btn btn-success px-5 py-2')) !!}
                                                <button type="submit" class="btn btn-success px-5 py-2">Save</button>
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
            <!-- end page content -->

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
