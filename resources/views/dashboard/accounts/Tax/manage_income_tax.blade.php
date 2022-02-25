@extends('layouts.dashboard')
@section('page_title')
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')
    <style>
        .btn-secondary {
            background-color: #31B404 !important;

        }

        .btn-secondary:hover {
            background-color: #e4e7e3 !important;
        }

    </style>
@section('body')
    <div class="page-content">
        <div class="container-fluid">


            <div class="row ">

                <div class="col-12">

                    <div class="card">
                        @include('includes.messages')
                        <!--ALert Message--->
                        <div class="card-body">
                            <div class="table-rep-plugin">
                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                    <table id="datatable"
                                               class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap">
                                        <thead>

                                            <tr>
                                                <th>Customer Name</th>
                                                <th>Address1</th>
                                                <th>Mobile No</th>
                                                <th>Email</th>
                                                <th>City</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Zip code</th>
                                                <th>Country</th>
                                                <th>Balance</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan='11' class="text-center">No Data</td>
                                            </tr>
                                        </tbody>



                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>


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
{{-- <script src="{{ asset('dashboard/plugins/datatables/buttons.bootstrap4.min.js') }}"></script> --}}
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
    function deleteRec(recID) {
        if (confirm('Are you sure you want to delete this record?')) {
            $('#deleteForm' + recID).submit();
        }
    }

    $(document).ready(function() {
        $('select').select2();

        $('#datatable').DataTable({
            responsive: true,
            "pageLength": 50,
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            "columnDefs": [{
                "orderable": false,
                "targets": [0, 1]
            }],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Global Search....."
            },
            dom: 'Bfrtip',
            "buttons": [{
                    // "extend": 'csv',
                    // "text": '<i class="fa fa-file-excel"></i> Export',
                    // "titleAttr": 'CSV',
                    // className: 'btn btn-xs btn-primary text-white mx-1',
                    "filename": function() {
                        var d = new Date();
                        var n = d.getTime();
                        return 'expenses_' + n;
                    },
                    "footer": true,
                    exportOptions: {
                        columns: ':not(.noExport)'
                    }
                }

            ],
        });
    });
</script>
@endsection
