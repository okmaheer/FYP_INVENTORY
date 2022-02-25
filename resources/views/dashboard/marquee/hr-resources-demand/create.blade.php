@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css"/>

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
            {!! Form::open([ 'route' => 'dashboard.marquee.hr_demand.store','files' => true] ) !!}
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-5">
                                <div class="panel-title col-12  border-bottom">
                                    <h4>HR & Resources Demand</h4>
                                </div>
                            </div>
                                    @include('dashboard.marquee.hr-resources-demand.comp.general')
                                <div class="row mt-3">
                                    <div class="panel-title col-12">
                                        <h4>Booking Info.</h4>
                                    </div>
                                </div>
                                    @include('dashboard.marquee.hr-resources-demand.comp.booking_info')
                            </div>
                    </div>
                </div>
                    <!--end card-->


                <!-- end col -->
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-5">
                                <div class="panel-title col-12  border-bottom">
                                    <h4>HR Demand</h4>
                                </div>
                            </div>
                                    @include('dashboard.marquee.hr-resources-demand.comp.hr')
                            </div>
                    </div>
                </div>
                    <!--end card-->


                <!-- end col -->
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-5">
                                <div class="panel-title col-12  border-bottom">
                                    <h4>Additoinal Resources Demand</h4>
                                </div>
                            </div>
                                    @include('dashboard.marquee.hr-resources-demand.comp.resources')
                                    <div class="text-right mt-3">
                                        <button class="btn btn-info">Print</button>
                                        {!! Form::submit('Submit', array('class' => 'btn btn-success')) !!}
                                        <button class="btn btn-danger">Cancel</button>
                                    </div>
                            </div>
                    </div>
                </div>
                    <!--end card-->


                <!-- end col -->
            </div>


            {!! Form::close() !!}
        </div><!-- container -->

        @include('includes.dashboard-footer')
    </div>

@endsection
@endsection


@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
@endsection
@section('innerScript')
@include('dashboard.marquee.hr-resources-demand.comn_script')
@endsection
