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

                                <div class="card-body">

                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                        <thead>
                                                <tr>
                                                    <th>{{ __('accounts.payroll.sl') }}</th>
                                                    <th>{{ __('accounts.payroll.name') }}</th>
                                                    <th>{{ __('accounts.payroll.s_type') }}</th>
                                                    <th>{{ __('accounts.payroll.date') }}</th>
                                                    <th>{{ __('accounts.payroll.action') }}</th>
                                                </tr>

                                        </thead>



                                    </table>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>


                </div><!-- container -->

               @include('includes.dashboard-footer')
            </div>
            <!-- end page content -->
            </div>
            <!--end page-wrapper-inner -->

        </div>
        <!-- end page-wrapper -->

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
