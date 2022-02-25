@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('content')
@section('innerStyleSheet')
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@include('includes.dashboard-breadcrumbs')
<style>
   .col-sm-2::selection{
        color: #fff;
        background-color: #37a000;
    }
    .text-dark::selection{
        color: #fff;
        background-color: #37a000;

    }

</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">

                        <div class="card">
                            <div class="penal-title  border-grey border-bottom">
                                <h4 class="p-3 text-dark">{{__('accounts.supplier.advance')}}</h4>
                            </div>
                            <div class="card-body">

                                <div class="general-label">
                                {!! Form::open([ 'route' => 'add.supplier.advance','files' => true] ) !!}
                                {!! csrf_field() !!}
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                            {!!  HTML::decode(Form::label('supplier_id' ,__('accounts.supplier.name').'<i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::select('supplier_id', $suppliers,null,['id'=>'supplier_id',
                                                        'class'=>'select2 form-control mb-3 custom-select float-right',
                                                        'placeholder'=>'Select Supplier',
                                                        'required'
                                                        ])
                                                     !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                            {!!  HTML::decode(Form::label('advance_type' ,__('accounts.supplier.type').'<i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::select('advance_type', AccountHelper::advanceTypes(),null,['id'=>'advance_type',
                                                'class'=>'select2 form-control mb-3 custom-select float-right',
                                                'placeholder'=>'Select Status/Option','required'])
                                             !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                            {!!  HTML::decode(Form::label('amount' ,__('accounts.supplier.amount').'<i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}


                                            </div>
                                            <div class="col-sm-10">
                                            {!!  Form::number('amount',null,['id'=>'amount','class'=>'form-control','placeholder'=>'0.00','required']) !!}

                                            </div>
                                        </div>


                                        <div class="row ml-5">
                                            <div class="col-sm-10 ml-auto">
                                            {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}


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
            <!-- end page content -->
            </div>
            <!--end page-wrapper-inner -->

        </div>
        <!-- end page-wrapper -->
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


