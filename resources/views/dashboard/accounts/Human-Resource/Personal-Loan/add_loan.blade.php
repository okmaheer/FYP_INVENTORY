@extends('layouts.dashboard')
@section('page_title')
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
    .text-success::selection{
        color: #fff;
        background-color: #37a000;

    }

</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <a href="#" class="btn btn-info m-b-5 m-r-2">
                                <i class="ti-plus"></i> &nbsp;Add Loan
                            </a>
                            <a href="#" class="btn btn-success m-b-5 m-r-2">
                                <i class="ti-plus"></i> &nbsp;Add Payement
                            </a>
                            <a href="#" class="btn btn-primary m-b-5 m-r-2">
                                <i class="ti-plus"></i> &nbsp;Manage Loan
                            </a>

                        </div>
                    </div>

                        <div class="card">
                            <h4 class="p-3 text-success">{{__('accounts.personal.add')}}</h4>
                            <div class="card-body">

                                <div class="general-label">
                                     {{-- {!! Form::open(['route' => 'dashboard.accounts.supplier.store', 'files' => true] ) !!} --}}
                                     {!! csrf_field() !!}

                                     <div class="form-group row">
                                         <div class="col-sm-2">
                                             {!!  Html::decode(Form::label('name' ,__('accounts.personal.name').'<i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

                                         </div>
                                         <div class="col-sm-10">
                                             {!!  Form::select('name',AccountHelper::manualStatus(),null,['id'=>'name',
                                             'class'=>'select2 form-control mb-3 custom-select float-right',
                                             'placeholder'=>'Select One','required'])
                                             !!}

                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <div class="col-sm-2">
                                             {!!  Form::label('phone' ,__('accounts.personal.phone'),['class'=>'col-form-label text-right'])   !!}

                                         </div>
                                         <div class="col-sm-10">
                                             {!!  Form::text('phone',null,['id'=>'phone','class'=>'form-control ','placeholder'=>'Phone','readonly']) !!}

                                         </div>
                                     </div>

                                     <div class="form-group row">
                                         <div class="col-sm-2">
                                             {!!  Html::decode(Form::label('amount' ,__('accounts.personal.amount').'<i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

                                         </div>
                                         <div class="col-sm-10">
                                             {!!  Form::text('amount',null,['id'=>'amount','class'=>'form-control ','placeholder'=>'0.00','required']) !!}

                                         </div>
                                     </div>

                                     <div class="form-group row">
                                         <div class="col-sm-2">
                                             {!!  Html::decode(Form::label('payment_type' ,__('accounts.personal.p_type').'<i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

                                         </div>
                                         <div class="col-sm-10">
                                             {!!  Form::select('payeme_type',AccountHelper::manualStatus(),null,['id'=>'payeme_type',
                                             'class'=>'select2 form-control mb-3 custom-select float-right',
                                             'placeholder'=>'Cash Payement','required'])
                                            !!}

                                         </div>
                                     </div>

                                     <div class="form-group row">
                                         <div class="col-sm-2">
                                             {!!  Html::decode(Form::label('date' ,__('accounts.personal.date').'<i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

                                         </div>
                                         <div class="col-sm-10">
                                             {!!  Form::date('date',null,['id'=>'date','class'=>'form-control ','placeholder'=>'Date','required']) !!}

                                         </div>
                                     </div>


                                     <div class="form-group row">
                                         <div class="col-sm-2">
                                             {!!  Form::label('detail' ,__('accounts.personal.detail') ,['class'=>'col-form-label text-right'])   !!}

                                         </div>
                                         <div class="col-sm-10">
                                             {!! Form::textarea('detail',null,['class' => 'form-control', 'size' => '50x2','placeholder'=>'Details']) !!}

                                         </div>
                                     </div>



                                     <div class="row">
                                         <div class="col-sm-12 text-center">
                                             {!! Form::submit('Reset', array('class' => 'btn btn-primary')) !!}
                                             {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}


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



