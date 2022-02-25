<div class="card-body">
    <h1 class="  header-title">Search Record By</h1>
    {!! Form::open(['method' => 'GET' ,'route' =>$route, 'files' => true] ) !!}
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!!  Form::label('customer_name' ,'Name' ,['class'=>''])   !!}
                {!!  Form::select('customer_name',$customer,request()->has('customer_name')?request()->get('customer_name'):null,['id'=>'customer_name',
                    'class'=>'select2 form-control mb-3 custom-select float-right', 'style'=>'width:100%',
                    'placeholder'=>'Select Customer'])
               !!}
            </div>
        </div>
        <div class="col-md-3">
            {!!  Form::label('booking_date' ,'Booking Date' ,['class'=>''])   !!}
            <div class="input-group">
                {!!  Form::text('booking_date',request()->has('booking_date')?request()->get('booking_date'):null,['id'=>'booking_date','class'=>'form-control datepicker','autocomplete'=>'off', 'placeholder'=> \Carbon\Carbon::today()->format(\AccountHelper::settings()->date_format)]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">

                {!!  Form::label('customer_cnic' ,'CNIC' ,['class'=>''])   !!}
                {!!  Form::select('customer_cnic',$cnic,request()->has('customer_cnic')?request()->get('customer_cnic'):null,['id'=>'customer_cnic',
                    'class'=>'select2 form-control mb-3 custom-select float-right', 'style'=>'width:100%',
                    'placeholder'=>'Select CNIC'])
               !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!!  Form::label('customer_no' ,'Contact No.' ,['class'=>''])   !!}
                {!!  Form::select('customer_no',$mobile,request()->has('customer_no')?request()->get('customer_no'):null,['id'=>'customer_no',
                    'class'=>'select2 form-control mb-3 custom-select float-right', 'style'=>'width:100%',
                    'placeholder'=>'Select Number'])
               !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            {!!  Form::label('start_date' ,'Start Date' ,['class'=>''])   !!}
            <div class="input-group">
                {!!  Form::text('start_date',request()->has('start_date')?request()->get('start_date'):null,['id'=>'start_date','class'=>'form-control datepicker','autocomplete'=>'off', 'placeholder'=> \Carbon\Carbon::today()->format(\AccountHelper::settings()->date_format)]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            {!!  Form::label('end_date' ,'End Date' ,['class'=>''])   !!}
            <div class="input-group">
                {!!  Form::text('end_date',request()->has('end_date')?request()->get('end_date'):null,['id'=>'end_date','class'=>'form-control datepicker','autocomplete'=>'off', 'placeholder'=> \Carbon\Carbon::today()->format(\AccountHelper::settings()->date_format)]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!!  Form::label('event_area' ,'Event Site' ,['class'=>''])   !!}
                {!!  Form::select('event_area', \AccountHelper::eventArea(),request()->has('event_area')?request()->get('event_area'):null,['id'=>'event_area','class'=>'select2 form-control mb-3 custom-select float-right', 'style'=>'width:100%','placeholder'=>'Select Event Site']) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!!  Form::label('stage_booking' ,'Stage Bookings' ,['class'=>''])   !!}
                {!!  Form::select('stage_booking', [1 => 'With Stage Bookings', 2 => 'Without Stage Bookings'],request()->has('stage_booking')?request()->get('stage_booking'):null,['id'=>'stage_booking','class'=>'select2 form-control mb-3 custom-select float-right', 'style'=>'width:100%','placeholder'=>'Select Stage Booking']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!!  Form::label('show_cancelled' ,'Show Cancelled Events' ,['class'=>''])   !!}
                {!!  Form::select('show_cancelled', [1 => 'No', 2 => 'Yes'],request()->has('stage_booking')?request()->get('stage_booking'):1,['id'=>'show_cancelled','class'=>'select2 form-control mb-3 custom-select float-right', 'style'=>'width:100%']) !!}
            </div>
        </div>
        <div class="col-md-8 text-right mt-4">
            {!! Form::submit('Search', array('class' => 'btn btn-primary text-white w-sm')) !!}
            <a href="{{route($route)}}" class="btn btn-primary text-white w-sm">Clear All</a>
        </div>
    </div>

    {!! Form::close() !!}
</div>
