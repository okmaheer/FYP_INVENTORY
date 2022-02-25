@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@include('includes.dashboard-breadcrumbs')
<style>


</style>
@section('body')
    <div class="page-content">
        <div class="container-fluid">

            <div class="card">
                <div class="row border-grey border-bottom ">
                    <div class="col-md-3 mt-4"><h4 class="ml-4">{{ __('accounts.attendance.check_in') }} </h4></div>
                    <div class="col-md-9 text-right mt-3 ">

                                    <span class="padding-lefttitle ">
                                        <a href="" class="btn btn-info  "><i class="ti-align-justify"></i>Bulk Check In </a> &nbsp;
                                        <a href="" class="btn btn-success  "><i class="ti-align-justify"></i>  Manage Attendance</a>&nbsp;&nbsp;


                                       </span>
                    </div>

                </div>
                <div class="card-body">

                    <div class="general-label">
                        {!! Form::model($attendance,['route' => ['dashboard.accounts.attendance.update',$attendance->id], 'files' => true] ) !!}
                        {!! csrf_field() !!}
                        @method('PATCH')

                        <div class="form-group row">
                            <div class="col-sm-2">
                                {!!  Html::decode(Form::label('date' , __('accounts.attendance.date').'<i class="text-danger">*</i>' ,['class'=>'col-form-label ']))   !!}

                            </div>
                            <div class="col-sm-10">
                                {{ Form::date('date', null, ['class' => 'form-control', 'id'=>'date']) }}

                            </div>
                        </div>

                        <div class="form-group row">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <th>Employee Name</th>
                                <th colspan="3">Attendance</th>

                                </thead>

                                    <tr>
                                        <td>
                                            {{$attendance->employee->first_name}}
                                            {!! Form::hidden('employee_id',$attendance->employee->id) !!}
                                        </td>
                                        <td>
                                            {!! Form::radio('attendance','present') !!}
                                            {!! Form::label('present','Present') !!}

                                        </td>
                                        <td>
                                            {!! Form::radio('attendance','absent') !!}
                                            {!! Form::label('absent','Absent') !!}
                                        </td>
                                        <td>
                                            {!! Form::radio('attendance','half day') !!}
                                            {!! Form::label('half_day','Half Day') !!}
                                        </td>
                                    </tr>

                            </table>
                        </div>



                        <div class="row">
                            <div class="col-sm-12 text-right">
                                {!! Form::submit('Chech In', array('class' => 'btn btn-success')) !!}


                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->


        </div><!-- container -->

        @include('includes.dashboard-footer')
    </div>
    <!-- end page content -->
    </div>
    <!--end page-wrapper-inner -->

    </div>
    <!-- end page-wrapper -->

@endsection
@endsection

@section('innerScriptFiles')
    <!-- Plugins js -->
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
@endsection
@section('innerScript')

    <script>
        (function (){
            $('select').select2();
        })();
    </script>


@endsection

