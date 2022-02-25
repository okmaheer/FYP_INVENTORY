@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@include('includes.dashboard-breadcrumbs')
@section('body')
    <div class="page-content">
        <div class="container-fluid">
            {!! Form::open(['route' => 'dashboard.marquee.stage.booking.store', 'files' => true] ) !!}
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <div class="card-body">
                            @include('dashboard.marquee.stage-bookings.components.generalwob')
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-white bg-transparent py-0">
                            <h4 class="mt-1 ml-2 header-title">
                                {!!  Html::decode(Form::label('stage_decoration' ,'Stage Decorations ' ,['class'=>'col-form-label text-right']))   !!}
                            </h4>
                        </div>
                        <div class="card-body">
                            @include('dashboard.marquee.stage-bookings.components.stage-decorations')
                        </div>
                    </div>
                </div>
            </div>
            @include('dashboard.marquee.stage-bookings.components.totals')
            <div class="row">
                <div class="col-12 text-right">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::submit('Submit', array('id' => 'submitbtn','class' => 'btn btn-success ')) !!}
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

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
                                {!!  Form::label('name' ,__('accounts.customers.name') ,['class'=>'col-form-label text-right'])   !!}


                            </div>
                            <div class="col-sm-8">
                                {!!  Form::text('name',null,['id'=>'name','class'=>'form-control ','placeholder'=>'Enter Name']) !!}

                            </div>
                        </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    {!!  Html::decode(Form::label('cnic' ,__('accounts.customers.cnic').' ' ,['class'=>'col-form-label text-right']))   !!}

                                </div>
                                <div class="col-sm-8">
                                    {!!  Form::text('cnic',null,['id'=>'cnic','class'=>'form-control ','placeholder'=>'Customer CNIC']) !!}

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    {!!  Form::label('customer_mobile' ,__('accounts.customers.mobile'),['class'=>'col-form-label text-right'])   !!}

                                </div>
                                <div class="col-sm-8">
                                    {!!  Form::number('customer_mobile',null,['id'=>'customer_mobile','class'=>'form-control ','placeholder'=>'Mobile No']) !!}

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    {!!  Form::label('phone' ,__('accounts.customers.phone') ,['class'=>'col-form-label text-right'])   !!}

                                </div>
                                <div class="col-sm-8">
                                    {!!  Form::number('phone',null,['id'=>'phone','class'=>'form-control ','placeholder'=>'Phone']) !!}

                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-4">
                                    {!!  Form::label('customer_address' ,__('accounts.customers.address_1') ,['class'=>'col-form-label text-right'])   !!}

                                </div>
                                <div class="col-sm-8">
                                    {!! Form::textarea('customer_address',null,['class' => 'form-control','id' => 'customer_address', 'size' => '20x2','placeholder'=>'Address1']) !!}

                                </div>
                            </div>





                    </div>

                </div>
                <div class="modal-footer">
                    <a class="btn btn-success close " data-dismiss="modal" onclick="customer()">Add Customer</a>


                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
@endsection
@include('dashboard.marquee.stage-bookings.common-script')

