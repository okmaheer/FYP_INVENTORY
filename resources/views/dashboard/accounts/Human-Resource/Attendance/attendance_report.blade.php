@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .table th, .table td {
            padding: 0.50rem !important;
        }
        .table th{
            color:#fff !important;
            background-color:#343a40 !important;
            border-color:#454d55 !important;
        }
        .circle {
            height: 15px;
            width: 15px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')

    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            @include('dashboard.accounts.Human-Resource.Attendance.common.attendance_report_filters', ['route' => 'attendance.report'])
                        </div>
                    </div>
                </div>
                @if (request()->filled('attendance_month'))
                <div class="row" id="printArea">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="panel-title">
                                <div class="row border-grey border-bottom">
                                    <div class="col-md-12">
                                        <h3 class="p-3 text-dark">Attendance Report - [{{ request()->get('attendance_month') }}]</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                    @php
                                        $currMonth = \Carbon\Carbon::parse(request()->get('attendance_month'))->month;
                                        $currYear = \Carbon\Carbon::parse(request()->get('attendance_month'))->year;
                                    @endphp
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-left">
                                                Date <i class="small fas fa-arrow-right"></i><br>
                                                Employee <i class="small fas fa-arrow-down"></i>
                                            </th>
                                            @for($i = 1; $i <= \Carbon\Carbon::parse($currYear . '-' . $currMonth)->endOfMonth()->day; $i++)
                                            <th class="text-center">{{ $i }}<br>{{ \Carbon\Carbon::parse($currYear . '-' . $currMonth . '-' . $i)->format('D') }}</th>
                                            @endfor
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employees as $employee)
                                            <tr>
                                                <td class="font-weight-bold">{{ $employee->full_name }}</td>
                                                @for($i = 1; $i <= \Carbon\Carbon::parse($currYear . '-' . $currMonth)->endOfMonth()->day; $i++)
                                                <td class="text-center">
                                                    @if ( \Carbon\Carbon::isDayOff(\Carbon\Carbon::parse($currYear . '-' . $currMonth . '-' . $i)) )
                                                        <span data-toggle="tooltip" data-placement="top" title="Weekend">
                                                            <span class="circle bg-dark"></span>
                                                        </span>
                                                    @else
                                                        @php $presentHours = \AccountHelper::getAttendanceHours($employee->id, ($currYear . '-' . $currMonth . '-' . $i)) @endphp
                                                        <span data-toggle="tooltip" data-placement="top" title="Working Hours: {{ $employee->working_hour }}</br>Present Hours: {{ $presentHours }}">
                                                        @if ($presentHours > 0)
                                                            @if($presentHours >= $employee->working_hour)
                                                                <span class="circle bg-success"></span>
                                                            @elseif($presentHours >= ($employee->working_hour / 2) && $presentHours < $employee->working_hour)
                                                                <span class="circle bg-warning"></span>
                                                            @else
                                                                <span class="circle bg-danger"></span>
                                                            @endif
                                                        @else
                                                            <span class="circle bg-danger"></span>
                                                        @endif
                                                        </span>
                                                    @endif
                                                </td>
                                                @endfor
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
           @include('includes.dashboard-footer')
        </div>
    @endsection
@endsection
@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        $(document).ready(function () {
            $('.select2').select2();

            $("#btnSync").click(function(){
                swal.fire({
                    html: 'Please wait!<br>Synchronizing attendance from attendance machine.',
                    allowOutsideClick: () => !swal.isLoading()
                });
                swal.showLoading();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('sync.attendance') }}',
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
                    },timeout: 5000
                });
            });
        });
    </script>
@endsection
