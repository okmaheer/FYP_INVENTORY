@extends('layouts.dashboard')
@section('page_title',$page_title)
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
            @include('dashboard.marquee.filters.food_demand_reports_filter',['route'=>'food.report'])
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                @include('includes.messages')  <!--ALert Message--->
                    <div class="card-body">
                        <section id="printHolder">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>

                                <th class="text-center no-sort">Booking Id</th>
                                <th>Person Name</th>
                                <th>Event Date</th>
                                <th>Event Area</th>
                                <th>Status</th>
                                <th>Grand Total</th>
                                <th>Paid Amount</th>    
                                <th>Due Amount</th>

                               
                               
                            </tr>
                            </thead>
                            <tbody>
                            {{-- @foreach($data as $d)
                                <tr>
                                    <td class="text-center">
                                        {{ $d->custom_booking_number }}
                                    </td>
                                    <td class="text-center">
                                        {{ $d->customer->customer_name }}
                                    </td>
                                    <td class="text-center">
                                        {{ $d->event_date }}
                                    </td>
                                    <td class="text-center">
                                        {{ AccountHelper::eventArea($d->event_area) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $d->status }}
                                    </td>
                                  
                                    <td class="text-center">
                                        {{ $d->grand_total }}
                                    </td>
                                    <td class="text-center">
                                        {{ $d->total_paid_amount }}
                                    </td>
                                    <td class="text-center">
                                        {{ $d->total_dues_amount }}
                                    </td>
                                  
                                  
                                   
                                </tr>
                            @endforeach --}}
                            </tbody>
                        </table>
                        </section>
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
                        }  , {
                            text: '<i class="fa fa-print"></i> Print',
                            className: 'btn btn-xs btn-primary text-white mx-1',
                            action: function () {
                                $(':input').removeAttr('placeholder');
            $('textarea').removeAttr('placeholder');
            $('input[type=number]').removeAttr('placeholder');
    
            let printContents = document.getElementById("printHolder").innerHTML;
            let originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
                            }
                        }
                      
                    ],
                });
            });
        </script>
    @endsection
