@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')
    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @include('dashboard.accounts.common.pettycash-filter-manage',['route'=>'dashboard.accounts.pettycash.index'])
                        </div>
                        <div class="card" id="suplier_list">
                        @include('includes.messages')
                            <div class="panel-title border-grey border-bottom">
                                <h4 class="p-3 text-dark text-center">{{ __('accounts.pettycash.list') }}</h4>
                            </div>

                            <div class="card-body">

                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                    <thead>
                                        <tr>
                                            <th>{{__('accounts.pettycash.sl')}}</th>
                                            <th>{{__('accounts.pettycash.name')}}</th>
                                            <th>{{__('accounts.pettycash.mobile')}}</th>
                                            <th>{{__('accounts.general.cnic')}}</th>
                                            <th>{{__('accounts.pettycash.city')}}</th>
                                            <th>{{__('accounts.pettycash.balance')}}</th>
                                            <th>{{__('accounts.pettycash.action')}}</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @php $i = 0; @endphp
                                        @forelse($pettycash as $data)
                                        @php $i++; @endphp
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$data->pettycash_name}}</td>
                                            <td>{{$data->pettycash_mobile}}</td>
                                            <td>{{$data->cnic}}</td>
                                            <td>{{$data->city}}</td>
                                            <td>{{$data->previous_balance}}</td>
                                            <td class="text-center">
                                                <form action="{{ route('dashboard.accounts.pettycash.destroy', $data->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('dashboard.accounts.pettycash.edit',$data->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td class="text-right" colspan="3" align="right">no data found</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>

            </div><!-- container -->

            @include('includes.dashboard-footer')
        </div>

    @endsection
@endsection
@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    {{--<script src="{{ asset('dashboard/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>--}}
    <script src="{{ asset('dashboard/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
@endsection

@section('innerScript')
    <script>
        function deleteRec(recID) {
            if( confirm('Are you sure you want to delete this record?') ) {
                $('#deleteForm'+recID).submit();
            }
        }

        $(document).ready(function () {
            $('.select2').select2();

            $('#datatable').DataTable({
                responsive: true,
                "pageLength": 25,
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
                            return 'pettycash_list_' + n;
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
                            window.location = '{{ route('dashboard.accounts.pettycash.create') }}';
                        }
                    }
                ],
            });
        });
    </script>
@endsection
