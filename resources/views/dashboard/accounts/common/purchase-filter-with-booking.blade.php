{!! Form::open(['method' => 'GET', 'route' => $route, 'files' => true]) !!}
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
                    {!! Form::button('Print', ['class' => 'dropdown-item', 'onclick' => "printDiv('printableArea')"]) !!}
                    <a href="{{ route($route) }}" class="dropdown-item">Clear</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <h6 class="input-title mt-0 md-3">Supplier Name</h6>
                {!!  Form::select('supplier',$suppliers,request()->has('supplier')?request()->get('supplier'):null,['id'=>'supplier',
                'class'=>'select2 form-control mb-3 custom-select float-right',
                'placeholder'=>'Select Supplier'])
               !!}
            </div>
        </div>
        <div class="col-md-3">
            {!!  Form::label('purchase_date' ,'Purchase Date' ,['class'=>''])   !!}
            <div class="input-group">
                {!!  Form::text('purchase_date',request()->has('purchase_date')?request()->get('purchase_date'):null,['id'=>'purchase_date','class'=>'form-control datepicker','autocomplete'=>'off']) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!!  Form::label('purchase_no' ,'Purchase No.' ,['class'=>''])   !!}
                {!!  Form::text('purchase_no',request()->has('purchase_no')?request()->get('purchase_no'):null,['id'=>'purchase_no','class'=>'form-control ','placeholder'=>'']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <h6 class="input-title mt-0 md-3">Booking</h6>
                {!!  Form::select('booking',$bookings,request()->has('booking')?request()->get('booking'):null,['id'=>'booking',
                'class'=>'select2 form-control mb-3 custom-select float-right',
                'placeholder'=>'Select Booking'])
               !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            {!!  Form::label('start_date' ,'Start Date' ,['class'=>''])   !!}
            <div class="input-group">
                {!!  Form::text('start_date',request()->has('start_date')?request()->get('start_date'):null,['id'=>'start_date','class'=>'form-control datepicker','autocomplete'=>'off']) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            {!!  Form::label('end_date' ,'End Date' ,['class'=>''])   !!}
            <div class="input-group">
                {!!  Form::text('end_date',request()->has('end_date')?request()->get('end_date'):null,['id'=>'end_date','class'=>'form-control datepicker','autocomplete'=>'off']) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>
        </div>

    </div>

</div>
{!! Form::close() !!}
