<div class="card-body">
    <h1 class="  header-title">
        Search Record By
          </h1>
    {!! Form::open(['method' => 'GET' ,'route' =>$route, 'files' => true] ) !!}
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                {!!  Form::label('customer_id' ,'Name' ,['class'=>''])   !!}
                {!!  Form::select('customer_id',$customer,request()->has('customer_id')?request()->get('customer_id'):null,['id'=>'customer_id',
                    'class'=>'select2 form-control', 'style'=>'width:100%',
                    'placeholder'=>'Select Customer'])
               !!}
            </div>
        </div>
        <div class="col-md-2">
            {!!  Form::label('event_date' ,'Event Date' ,['class'=>''])   !!}
            <div class="input-group">
                {!!  Form::text('event_date',request()->has('event_date')?request()->get('event_date'):null,['id'=>'event_date','class'=>'form-control datepicker','autocomplete'=>'off', 'placeholder'=> \Carbon\Carbon::today()->format(\AccountHelper::settings()->date_format)]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                {!!  Form::label('customer_id' ,'CNIC' ,['class'=>''])   !!}
                {!!  Form::select('customer_id',$cnic,request()->has('customer_id')?request()->get('customer_id'):null,['id'=>'customer_id',
                    'class'=>'select2 form-control mb-3 custom-select float-right', 'style'=>'width:100%',
                    'placeholder'=>'Select CNIC'])
               !!}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                {!!  Form::label('customer_id' ,'Contact No.' ,['class'=>''])   !!}
                {!!  Form::select('customer_id',$mobile,request()->has('customer_id')?request()->get('customer_id'):null,['id'=>'customer_id',
                    'class'=>'select2 form-control mb-3 custom-select float-right', 'style'=>'width:100%',
                    'placeholder'=>'Select Number'])
               !!}

            </div>
        </div>

        <div class="col-lg-4 mt-4 text-right">
            {!! Form::submit('Search', array('class' => 'btn btn-primary text-white w-sm')) !!}
            <a href="{{route('stage.report')}}" class="btn btn-primary text-white w-sm">Clear All</a>
        </div>
    </div>

    {!! Form::close() !!}
</div>
