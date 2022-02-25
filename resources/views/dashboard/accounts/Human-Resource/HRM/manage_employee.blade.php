@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    @include('includes.datatable-css')
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')

    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="penal-title  border-grey border-bottom">
                                <h4 class="p-3 text-dark">{{ __('accounts.hrm.manage_employees') }}</h4>
                            </div>
                            @include('includes.messages')
                            <!--ALert Message--->
                            <div class="card-body" style="width: 99%">
                                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('accounts.hrm.sl') }}</th>
                                            <th class="text-center">{{ __('accounts.hrm.fn') }}</th>
                                            <th class="text-center">{{ __('accounts.hrm.desgination') }}</th>
                                            <th class="text-center">{{ __('accounts.hrm.rate') }}</th>
                                            <th class="text-center">{{ __('accounts.hrm.address') }}</th>
                                            <th class="text-center">{{ __('accounts.hrm.picture') }}</th>
                                            <th class="text-center">{{ __('accounts.hrm.document') }}</th>
                                            <th class="text-center">{{ __('accounts.hrm.city') }}</th>
                                            <th class="text-center">{{ __('accounts.hrm.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 0; @endphp
                                        @foreach($employee as $data)
                                            @php $i++; @endphp
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $data->first_name }}</td>
                                                <td>{{ $data->designation->name }}</td>
                                                <td>{{ AccountHelper::rateTypes($data->rate_type) }}</td>
                                                <td>{{ $data->address_line_1 }}</td>
                                                <td>@if (file_exists(asset($data->image)))<a href="{{ asset($data->image) }}" class="btn btn-info btn-xs" target="_blank">{{ __('accounts.general.view_pic') }}</a>@endif</td>
                                                <td>@if (file_exists(asset($data->document)))<a href="{{ asset($data->document) }}" class="btn btn-info btn-xs" target="_blank">{{ __('accounts.general.view_doc') }}</a>@endif</td>
                                                <td>{{ $data->city }}</td>
                                                <td>
                                                    <form action="{{ route('dashboard.accounts.employee.destroy',$data->id) }}" method="POST" id="deleteForm{{$data->id}}" style="display: none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    @can('edit', \App\Models\Employee::class)
                                                    <a href="{{ route('dashboard.accounts.employee.edit', $data->id) }}"
                                                                class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                    @endcan
                                                    @can('delete', \App\Models\Employee::class)
                                                    <a href="javascript:void(0);" onclick="DeleteEntry({{$data->id}});" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
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
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    @include('includes.datatable-js')
@endsection
@section('innerScript')
    <script>
        $(document).ready(function() {
            $('.select2').select2();

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
                dom: "<'row'<'col-md-4 col-sm-12'l><'col-md-4 col-sm-12 text-center'<'btn-group'B>><'col-md-4 col-sm-12'f>>tip",
                "buttons": [
                    {
                        text: '<i class="fa fa-plus-circle"></i>',
                        "titleAttr": 'Create',
                        className: 'btn btn-sm btn-primary text-white',
                        action: function (dt, node, config) {
                            window.location = '{{ route("dashboard.accounts.employee.create") }}';
                        }
                    },
                    {
                        "extend": 'csv',
                        "text": '<i class="far fa-file-excel"></i>',
                        "titleAttr": 'Export to CSV',
                        className: 'btn btn-sm btn-primary text-white',
                        exportOptions: {
                            columns: ':not(.noExport)'
                        }
                    },
                    {
                        "extend": 'excel',
                        "text": '<i class="fas fa-file-excel"></i>',
                        "titleAttr": 'Export to Excel',
                        className: 'btn btn-sm btn-primary text-white',
                        exportOptions: {
                            columns: ':not(.noExport)'
                        }
                    },
                    {
                        "extend": 'pdf',
                        "text": '<i class="fas fa-file-pdf"></i>',
                        "titleAttr": 'Export to PDF',
                        className: 'btn btn-sm btn-primary text-white',
                        exportOptions: {
                            columns: ':not(.noExport)'
                        }
                    },
                    {
                        "extend": 'print',
                        "titleAttr": 'Print Table',
                        "text": '<i class="fa fa-print"></i>',
                        className: 'btn btn-sm btn-primary text-white',
                        exportOptions: {
                            columns: ':not(.noExport)'
                        }
                    },
                {
                    text: '<i class="fas fa-sync"></i>',
                    className: 'btn btn-sm btn-primary text-white',
                    "titleAttr": 'Sync Employees with Attendance Machine',
                    action: function(dt, node, config) {
                        swal.fire({
                            html: 'Please wait!<br>Synchronizing employees with attendance machine.',
                            allowOutsideClick: () => !swal.isLoading()
                        });
                        swal.showLoading();

                        $.ajax({
                            type: 'POST',
                            url: '{{ route('sync.hrm') }}',
                            error: function(){
                                swal.close();
                                toastr.error('Timeout reached. It seems attendance machine is offline', 'Error');
                            },
                            success: function (result) {
                                swal.close();
                                if (result.success === true) {
                                    toastr.success(result.msg, 'Success');
                                } else {
                                    toastr.error(result.msg, 'Error');
                                }
                            },timeout: 3000
                        });

                    }
                }],
            });

            $('.dt-button').each(function () {
                $(this).attr('data-toggle', 'tooltip');
            });
            $('[data-toggle="tooltip"]').tooltip({html: true});
        });
    </script>
@endsection
