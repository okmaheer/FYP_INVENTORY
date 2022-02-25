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
{{--            @include('dashboard.marquee.hr-resources-demand.comp.booking_no_filter',['route'=>'dashboard.marquee.booking.index'])--}}
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

                            <tr>
                                <th class="no-sort">SL</th>

                                <th class="text-center">Demand Type</th>
                                <th class="text-center">Category</th>
                                <th class="text-center no-sort">Action</th>
                            </tr>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key =>$d)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td class="text-center">

                                        {{MarqueeHelper::demand($d->demand_type)}}

                                    </td>
                                    <td>
                                        {{$d->belongs}}
                                    </td>



                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <a class="nav-link dropdown-toggle arrow-none" id="dLabel8"
                                               data-toggle="dropdown" href="#" role="button"
                                               aria-haspopup="false" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                                            </a>


                                            <div class="dropdown-menu dropdown-menu-left"
                                                 aria-labelledby="dLabel8" x-placement="top-end"
                                                 style="position: absolute; transform: translate3d(-121px, -72px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <form action="{{ route('dashboard.marquee.hr_demand.destroy',$d->id) }}"  method="POST">
                                                     {!! link_to_route('dashboard.marquee.hr_demand.edit', "Edit", $d->id, ['class' => 'dropdown-item']) !!}
{{--                                                    {!! link_to_route('demand.invoice',"Invoice",$d->id, ['class' => 'dropdown-item']) !!}--}}
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Are you sure you want to delete this item?');">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
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
