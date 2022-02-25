{!! Form::open(['method' => 'GET' ,'route' => $route, 'files' => true] ) !!}
<div class="card-header bg-white">
    <div class="row col-12">
        <h4 class="col-6">Search Record By</h4>
        <div class="col-lg-6 text-right">
            @can('syncAttendance', \App\Models\Attendance::class)
            <button type="button" class="btn btn-primary w-sm" id="btnSync"><i class="fas fa-sync"></i> Sync Attendance From Machine</button>
            @endcan
            <div class="btn-group">
                {!! Form::submit('Search', ['class' => 'btn btn-primary w-sm']) !!}
                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span> <i class="mdi mdi-chevron-down"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    {!! Form::button('Print', ['class' => 'dropdown-item', 'id' => "printBtn"]) !!}
                    <a href="{{ route($route) }}" class="dropdown-item">Clear</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!!  Form::label('attendance_month' ,'Attendance Month' ,['class'=>'col-form-label text-right'])   !!}
                <div class="input-group">
                    {!!  Form::text('attendance_month',request()->has('attendance_month')?request()->get('attendance_month'):\Carbon\Carbon::today()->format('F-Y'),['id'=>'attendance_month','class'=>'form-control monthpicker','autocomplete'=>'off']) !!}
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!!  Form::label('employee_id', 'Employee Name', ['class'=>'col-form-label text-right'])   !!}
                {!!  Form::select('employee_id',$employeesFilter,request()->has('employee_id')?request()->get('employee_id'):null,['id'=>'employee_id',
                    'class'=>'select2 form-control', 'style'=>'width:100%',
                    'placeholder'=>'Select Employee'])
                !!}
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
