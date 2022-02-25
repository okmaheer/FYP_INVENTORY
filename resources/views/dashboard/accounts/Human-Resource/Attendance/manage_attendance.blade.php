@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
@section('content')
@include('includes.dashboard-breadcrumbs')
@section('body')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @include('includes.messages')
                        <!--ALert Message--->
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                            @foreach($employees as $key => $employee)
                                <div class="card border mb-0 shadow-none">
                                        <div class="card-header p-0" id="heading_{{ $employee->id }}">
                                            <h5 class="my-1">
                                                <button class="btn btn-link text-dark" type="button" data-toggle="collapse" data-target="#collapse_{{ $employee->id }}" aria-expanded="true" aria-controls="collapse_{{ $employee->id }}">
                                                    {{ $employee->full_name }}
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="collapse_{{ $employee->id }}" class="collapse{{ $loop->first ? ' show' : '' }}" aria-labelledby="heading_{{ $employee->id }}" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <table id="datatable_{{ $key }}" class="table table-bordered dt-responsive nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Clock In</th>
                                                            <th>Clock Out</th>
                                                            <th>{{ __('accounts.attendance.action') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($employee->attendance as $attendance)
                                                            <tr>
                                                                <td>{{ \Carbon\Carbon::parse( $attendance->clock_in )->format('d-M-Y h:i A') }}</td>
                                                                <td>{{ \Carbon\Carbon::parse( $attendance->clock_out )->format('d-M-Y h:i A') }}</td>
                                                                <td class="text-center">
                                                                    @can('edit', \App\Models\Attendance::class)
                                                                        <a href="{{ route('dashboard.accounts.attendance.edit', $attendance->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                                    @endcan
                                                                    @can('delete', \App\Models\Attendance::class)
                                                                        <button type="button" onclick="DeleteEntry({{ $attendance->id }});" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                                        <form action="{{ route('dashboard.accounts.attendance.destroy', $attendance->id) }}" method="POST" id="deleteForm{{ $attendance->id }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                        </form>
                                                                    @endcan
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="3" class="text-center">No Record Found</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                </div>
                            @endforeach
                            </div>
                           {{--<table id="datatable" class="table table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>{{ __('accounts.attendance.name') }}</th>
                                        <th>{{ __('accounts.attendance.date') }}</th>
                                        <th>Clock In</th>
                                        <th>Clock Out</th>
                                        <th>{{ __('accounts.attendance.action') }}</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @php $i = 0; @endphp
                                    @foreach($attendance as $data)
                                        @php $i++; @endphp
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $data->employee->full_name }}</td>
                                            <td>{{ \AccountHelper::date_format( $data->date ) }}</td>
                                            <td>{{ $data->sign_in }}</td>
                                            <td class="text-center">
                                                <form
                                                    action="{{ route('dashboard.accounts.attendance.destroy', $data->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('dashboard.accounts.attendance.edit', $data->id) }}"
                                                        class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                                        class="btn btn-sm btn-danger"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>--}}

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

        $('#datatable_0').DataTable({
            responsive: true,
            "pageLength": 10,
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
                "extend": 'csv',
                "text": '<i class="fa fa-file-excel"></i> Export',
                "titleAttr": 'CSV',
                className: 'btn btn-xs btn-primary text-white mx-1',
                "filename": function() {
                    var d = new Date();
                    var n = d.getTime();
                    return 'attendance_' + n;
                },
                "footer": true,
                exportOptions: {
                    columns: ':not(.noExport)'
                },
            }
            ,{
                text: '<i class="fa fa-plus-circle"></i> Create',
                className: 'btn btn-xs btn-primary text-white mx-1',
                action: function(dt, node, config) {
                    window.location =
                        '{{ route('dashboard.accounts.attendance.create') }}';
                }
            }
            ],
        });
    });
</script>
@endsection
