@extends('layouts.dashboard')
@section('page_title', $page_title)
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
                                <div class="penal-title  border-grey border-bottom">
                                    <h4 class="p-3 text-dark">{{ __('accounts.customers.advance') }}</h4>
                                </div>
                                <div class="card-body">

                                    <div class="general-label">
                                    {!! Form::open([ 'route' => 'add.customer.advance','files' => true] ) !!}

                                        {!! csrf_field() !!}
                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('customer_id' ,__('accounts.customers.name').'<i class="text-danger"> *</i>' ,['class'=>'col-form-label']))   !!}

                                                </div>
                                                <div class="col-sm-10">
                                                    {!!  Form::select('customer_id', $customers,null,['id'=>'customer_id',
                                                    'class'=>'select2 form-control mb-3 custom-select float-right',
                                                    'placeholder'=>'Select Customer','required'])
                                                    !!}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('advance_type' ,__('accounts.customers.type').'<i class="text-danger"> *</i>' ,['class'=>'col-form-label']))   !!}

                                                </div>
                                                <div class="col-sm-10">
                                                    {!!  Form::select('advance_type', AccountHelper::advanceTypes(),null,['id'=>'number_of_tax',
                                                    'class'=>'select2 form-control mb-3 custom-select float-right',
                                                    'placeholder'=>'Select Status/Option','required'])
                                                    !!}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    {!!  Html::decode(Form::label('amount' ,__('accounts.customers.amount').'<i class="text-danger"> *</i>' ,['class'=>'col-form-label ']))   !!}

                                                </div>
                                                <div class="col-sm-10">
                                                {!!  Form::number('amount',null,['id'=>'amount','class'=>'form-control ', 'required']) !!}

                                                </div>
                                            </div>


                                            <div class="row ml-5">
                                                <div class="col-sm-10 ml-auto">
                                                {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}


                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->

                    </div>

                    <!-- container -->


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


