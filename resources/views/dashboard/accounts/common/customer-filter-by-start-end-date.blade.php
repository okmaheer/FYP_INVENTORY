{!! Form::open(['method' => 'GET' ,'route' =>$route, 'files' => true] ) !!}
<div class="card-header bg-white">
    <div class="row col-12">
        <h4 class="col-6">Search Record By</h4>
        <div class="col-lg-6 text-right">
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
    <div class="row col-12">
        <div class="col-md-4">
            <div class="form-group">
                {!!  Form::label('customer_id' ,'Customer' ,['class'=>'col-form-label text-right'])   !!}
                {!!  Form::select('customer_id',$customer,request()->has('customer_id')?request()->get('customer_id'):null,['id'=>'customer_id',
                    'class'=>'select2 form-control', 'style'=>'width:100%',
                    'placeholder'=>'Select Customer'])
               !!}
                </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!!  Form::label('start_date' ,'Start Date' ,['class'=>'col-form-label text-right'])   !!}
                <div class="input-group">
                    {!!  Form::text('start_date',request()->has('start_date')?request()->get('start_date'):null,['id'=>'start_date','class'=>'form-control datepicker','autocomplete'=>'off']) !!}
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!!  Form::label('end_date' ,'End Date' ,['class'=>'col-form-label text-right'])   !!}
                <div class="input-group">
                    {!!  Form::text('end_date',request()->has('end_date')?request()->get('end_date'):null,['id'=>'end_date','class'=>'form-control datepicker','autocomplete'=>'off']) !!}
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
