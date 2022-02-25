@extends('layouts.dashboard')
@section('content')
@section('innerStyleSheet')
<link rel="stylesheet" type="text/css"
href="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css"
href="{{ asset('dashboard/plugins/datatables/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css"
href="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.css') }}">
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@include('includes.dashboard-breadcrumbs')
<style>



</style>
@section('body')
<div class="page-content">
    <div class="container-fluid">

        <div class="card">
            @include('dashboard.marquee.food-demand.comp.booking_no_filter',['route'=>'dashboard.marquee.booking.index'])
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                @include('includes.messages')  <!--ALert Message--->
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>

                                <th class="text-center no-sort">Booking Id</th>
                                <th>Person Name</th>
                                <th>Event Date</th>
                                <th>Event Area</th>
                                <th># of Persons</th>
                                <th>Seating Plan</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">

                                    </td>
                                    <td class="text-center">

                                    </td>
                                    <td class="text-center">

                                    </td>
                                    <td class="text-center">

                                    </td>
                                    <td class="text-center">

                                    </td>
                                    <td>
                                        <select class="form-control form-control-sm" width="200">

                                        </select>
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-xs btn-primary text-white tippy-btn" title="Creat Voucher!" data-tippy-duration="1000"><i class="fas fa-money-bill-alt"></i></a>
                                        <a href="" class="btn btn-xs btn-primary text-white  tippy-btn" title="Edit Record!"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="" class="btn btn-xs btn-primary text-white  tippy-btn" title="View Invoice!"><i class="fas fa-receipt"></i></a>
                                        <a href="" class="btn btn-xs btn-primary text-white  tippy-btn" title="Delete Record!"><i class="fas fa-trash"></i></a>
                                        <a href="" class="btn btn-xs btn-primary text-white tippy-btn" title="Auto Demand!" data-tippy-duration="1000"><i class="fas fa-money-bill-alt"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div><!-- container -->
    @include('includes.dashboard-footer')
</div>

        @endsection
        @endsection

        @section('innerScriptFiles')
            <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/datatables/dataTables.buttons.min.js') }}"></script>
{{--        <script src="{{ asset('dashboard/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>--}}
        <script src="{{ asset('dashboard/plugins/datatables/jszip.min.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/datatables/pdfmake.min.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/datatables/vfs_fonts.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/datatables/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('dashboard//plugins/datatables/buttons.print.min.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/datatables/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    @endsection
    @section('innerScript')
        <script>
            $(document).ready(function () {
                $('select').select2();

                $('#datatable').DataTable({
                    responsive: true,
                    "pageLength": 50,
                    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "columnDefs": [
                        {"orderable": false, "targets": [0, 1]}
                    ],
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Global Search....."
                    },
                    dom: 'Bfrtip',
                    "buttons": [
                        {
                            "extend": 'csv',
                            "text": '<i class="fa fa-file-excel"></i> Export',
                            "titleAttr": 'CSV',
                            className: 'btn btn-xs btn-primary text-white mx-1',
                            "filename": function () {
                                var d = new Date();
                                var n = d.getTime();
                                return 'bookings_' + n;
                            },
                            "footer": true,
                            exportOptions: {
                                columns: ':not(.noExport)'
                            }
                        }
                        , {
                            text: '<i class="fa fa-plus-circle"></i> Create',
                            className: 'btn btn-xs btn-primary text-white mx-1',
                            action: function (dt, node, config) {
                                window.location = '{{ route('dashboard.marquee.booking.create') }}';
                            }
                        }
                        , {
                            text: '<i class="fas fa-eye"></i> In Door Booking',
                            className: 'btn btn-xs btn-primary text-white mx-1',
                            action: function (dt, node, config) {
                                window.location = '{!! route('booking.type.show', 1) !!}';
                            }
                        }
                        , {
                            text: '<i class="fas fa-eye"></i> Out Door Booking',
                            className: 'btn btn-xs btn-primary text-white mx-1',
                            action: function (dt, node, config) {
                                window.location = '{!! route('booking.type.show', 2) !!}';
                            }
                        }
                        , {
                            text: '<i class="fas fa-eye"></i> Kasry Niyaz Booking',
                            className: 'btn btn-xs btn-primary text-white mx-1',
                            action: function (dt, node, config) {
                                window.location = '{!! route('booking.type.show', 3) !!}';
                            }
                        }
                    ],
                });
            });
        </script>
    @endsection
