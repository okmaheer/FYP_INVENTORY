@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')

@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')

    @section('body')
        <div class="page-content">
            <div class="container-fluid">

                <div class="card">
                    <div class="panel-title ">
                        <div class="row border-grey border-bottom">
                            <div class="col-lg-12">
                                <h3 class="p-3 text-dark text-center">Manual Attendance</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($attendance->count() > 0)
                            <div class="alert alert-success border-0" role="alert">
                                <h4 class="alert-heading font-18">Attendance Already Done!</h4>
                                <p>Attendance for today has already been taken. Please check attendance report to review.</p>
                            </div>
                        @else
                        <div class="general-label">
                             {!! Form::open(['route' => 'dashboard.accounts.attendance.store', 'files' => true, 'class' => 'solid-validation'] ) !!}

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <h5>Date: {{\AccountHelper::date_format(\Carbon\Carbon::today()->toDateString()) }} </h5>
                                    </div>
                                </div>

                                <div class="form-group row">
                                   <table class="table table-bordered table-hover">
                                       <thead>
                                       <tr>
                                           <th>Employee Name</th>
                                           <th colspan="3">Attendance</th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                           @forelse($employees as $key => $employee)
                                               <tr>
                                                   <td>
                                                       {{ $employee }}
                                                       {!! Form::hidden('employee_id[]',$key) !!}
                                                   </td>
                                                   <td>
                                                       <div class="radio radio-success">
                                                           {!! Form::radio('attendance_'.$key, 'present', true ,['id'=> 'present_'.$key]) !!}
                                                           {!! Form::label('present_'.$key,'Present') !!}
                                                       </div>
                                                   </td>
                                                   <td>
                                                       <div class="radio radio-danger">
                                                           {!! Form::radio('attendance_'.$key, 'absent', false ,['id'=> 'absent_'.$key]) !!}
                                                           {!! Form::label('absent_'.$key,'Absent') !!}
                                                       </div>
                                                   </td>
                                                   <td>
                                                       <div class="radio radio-warning">
                                                           {!! Form::radio('attendance_'.$key, 'half', false ,['id'=> 'half_'.$key]) !!}
                                                           {!! Form::label('half_'.$key,'Half Day') !!}
                                                       </div>
                                                   </td>
                                               </tr>
                                           @empty
                                           @endforelse
                                       </tbody>
                                   </table>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 text-right">
                                        {!! Form::submit('Check In', ['class' => 'btn btn-success w-md']) !!}
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
           @include('includes.dashboard-footer')
        </div>
    @endsection
@endsection

@section('innerScriptFiles')

@endsection
@section('innerScript')

@endsection

