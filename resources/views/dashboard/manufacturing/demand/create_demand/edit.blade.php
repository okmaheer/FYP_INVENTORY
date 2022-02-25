@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
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
            {!! Form::open([ 'route' => 'dashboard.marquee.demand.store','files' => true,'id' => 'booking_form'] ) !!}
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="panel-title border-grey border-bottom">
                            <h4 class="p-3 text-dark">Create Demand</h4>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-12 text-center mb-4">
                                    <h2>Order Details</h2>
                                </div>



                            </div>

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group row">
                                    {!!  Html::decode(Form::label('order_no' ,'Order No' ,['class'=>'col-sm-3 col-form-label text-left']))   !!}

                                        <div class="col-sm-9">
                                        {!!  Form::text('booking_id',1,['id'=>'order_no','class'=>'form-control ','placeholder'=>'Order No','required']) !!}

                                            {!! Form::hidden('type','booking') !!}
                                            {{-- <input class="form-control" type="text" value="" id="example-text-input"> --}}
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group row">
                                    {!!  Html::decode(Form::label('booking_date' ,'Booking Date' ,['class'=>'col-sm-3 col-form-label text-left']))   !!}

                                        <!-- <label for="example-text-input" class="col-sm-3 col-form-label text-left">Booking
                                            Date</label> -->
                                        <div class="col-sm-9">
                                        {!!  Form::text('booking_date',null,['id'=>'booking_date','class'=>'form-control ','placeholder'=>'04/03/2021','readonly']) !!}


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                    {!!  Html::decode(Form::label('booking_time' ,'Booking Time' ,['class'=>'col-sm-3 col-form-label text-left']))   !!}

                                        <div class="col-sm-9">
                                        {!!  Form::text('booking_time',null,['id'=>'booking_time','class'=>'form-control ','placeholder'=>'12:30:00 PM','readonly']) !!}

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                    {!!  Html::decode(Form::label('booking_no' ,'Booking No' ,['class'=>'col-sm-3 col-form-label text-left']))   !!}

                                        <div class="col-sm-9">
                                        {!!  Form::text('booking_no',null,['id'=>'booking_no','class'=>'form-control ','placeholder'=>'6544-651-5','readonly']) !!}

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">

                                    {!!  Html::decode(Form::label('fun_type' ,'Function Type' ,['class'=>'col-sm-3 col-form-label text-left']))   !!}

                                        <div class="col-sm-9">
                                        {!!  Form::text('fun_type',null,['id'=>'fun_type','class'=>'form-control ','placeholder'=>'Birthday','readonly']) !!}

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                    {!!  Html::decode(Form::label('venue' ,'Venue' ,['class'=>'col-sm-3 col-form-label text-left']))   !!}

                                        <div class="col-sm-9">
                                        {!!  Form::text('venue',null,['id'=>'venue','class'=>'form-control ','placeholder'=>'MARQUEE 1 (A)','readonly']) !!}

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->


                    <div class="card">
                        <div class="panel-title border-grey border-bottom">
                            <h4 class="p-3 text-dark"> Demand Items </h4>
                        </div>
                        <div class="card-body">

                            <div class="table-rep-plugin">
                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                    <div class="container-fluid">


                                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">


                                            <thead>
                                                <tr>
                                                    <td>SL.</td>
                                                    <th>Name</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                </tr>

                                            </thead>
                                            <tbody>



                                            @forelse($category->products as $key => $data)

                                                    <tr>
                                                        <td>
                                                            {{$key+1}}
                                                        </td>
                                                        <td>
                                                            {{$data->product_name}}
                                                            {!! Form::hidden('product_id['.$data->id.'][]',$data->id) !!}
                                                            {!! Form::checkbox('mark_product['.$data->id.'][]',1,null,['class'=>'float-right']) !!}
                                                        </td>
                                                        <td>{!! Form::number('quantity['.$data->id.'][]',null,['class'=>'form-control']) !!}</td>
                                                        <td>{!! Form::number('price['.$data->id.'][]',$data->price,['class'=>'form-control']) !!}</td>

                                                    </tr>
                                            @empty
                                            @endforelse

                                            </tbody>



                                        </table>



                                    </div>

                                </div>

                            </div>




                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>

            {!! Form::submit('Submit', array('class' => 'btn btn-success ')) !!}
            {!! Form::close() !!}
        </div><!-- container -->

        @include('includes.dashboard-footer')
    </div>

@endsection
@endsection
@section('innerScript')
<script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Buttons examples -->
<script src="{{ asset('dashboard/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables/buttons.colVis.min.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ asset('dashboard/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dashboard/pages/jquery.datatable.init.js') }}"></script>

@endsection
