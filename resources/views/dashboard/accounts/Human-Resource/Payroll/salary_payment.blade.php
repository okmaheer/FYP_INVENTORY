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
  .btn-secondary{
        background-color: #31B404 !important;
        color: #fff;

    }
    .btn-secondary:hover{
        background-color: #e4e7e3 !important;
    }
</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">

                    <div class="row ">

                        <div class="col-12">

                            <div class="card">
                                <div class="panel-title border-grey border-bottom">
                                    <div class="row">

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="datatable-buttons"
                                                   class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap">
                                                <thead>
                                                <tr>
                                                    <th >SL</th>
                                                    <th >Employee Name</th>
                                                    <th >Salary Month</th>
                                                    <th >Total Salary</th>
                                                    <th >Total working Hours</th>
                                                    <th >Working Period</th>
                                                    <th >Payement Type</th>
                                                    <th >Payement Date</th>
                                                    <th >Paid By</th>
                                                    <th >Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>

                                                    </tr>



                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>


                </div>
                <!-- container -->

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
