@extends('layouts.dashboard')
@section('page_title')
@section('content')
@include('includes.dashboard-breadcrumbs')
<style>
  .ml-5{
    margin-left: 100px;
}
</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="card">


                        <div class="row">
                            <div class="col-lg-9 mt-3">
                                <div class="panel-body ml-3">
                                    <span class="text-warning">
                                        The first line in downloaded csv file should remain as it is. Please do not change the order of columns.
                                    </span>
                                    <br>
                                    The correct column order is
                                    <span class="text-info">
                                        (Serial No,Supplier Name, Product Name, Product Model,Category Name ,Sale Price,Supplier Price  Product <br> Variants separated by vertical bar)

                                    </span>
                                    & you must follow this.
                                    <br>
                                    Please make sure the csv file is UTF-8 encoded and not saved with byte order mark (BOM).
                                    <p>The images should be uploaded in
                                        <strong>uploads</strong>
                                        folder.
                                    </p>
                                </div>

                            </div>
                            <div class="col-lg-3 mt-3">
                                <div class="panel-body">
                                    <a href="" class="btn btn-primary pull-right"><i class="fa fa-download"></i> Download Sample File </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="container-fluid">
                    <div class="card">
                        <div class="panel-title border-grey border-bottom">
                            <h4 class="p-3 text-success">Import product (CSV)</h4>
                        </div>
                        {!! Form::open(['route' => 'dashboard.accounts.supplier.store', 'files' => true] ) !!}
                                {!! csrf_field() !!}
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6 ">
                                        <div class="form-group row ml-2 mt-3">
                                            <div class="col-sm-3">
                                                {!!  Html::decode(Form::label('add-product"' ,'Upload CSV File <i class="text-danger">*</i>' ,['class'=>'col-form-label ']))   !!}

                                            </div>
                                            <div class="col-sm-9">
                                                {!!  Form::file('upload_csv_file',null,['id'=>'upload_csv_file','class'=>'form-control ','placeholder'=>'Upload CSV File','required']) !!}

                                            </div>

                                        </div>
                                        <div class="form-group row ml-2">
                                           <div class="col-sm-12 mb-5">
                                               <div class="row">
                                                {!! Form::submit('Submit', array('class' => 'btn btn-primary btn-large')) !!} &nbsp;

                                                {!! Form::submit('Submit And Add Another One', array('class' => 'btn btn-large btn-success')) !!}


                                               </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- </form> --}}
                        {!! Form::close() !!}
                    </div>
                </div><!-- container -->

               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection

