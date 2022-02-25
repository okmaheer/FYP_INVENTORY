<div class="card-body">
    <h1 class="  header-title">
        Search Record By
          </h1>
    {!! Form::open(['method' => 'GET' ,'route' =>$route, 'files' => true] ) !!}
    <div class="row">
        <div class="col-md-2 mr-1">
            <div class="form-group row">
                <h6 class="input-title mt-0 md-3">Name<i class="text-danger">*</i></h6>
                {!!  Form::text('customer_id',null,['id'=>'customer_id',
                'class'=>'form-control mb-3 float-right',
                'placeholder'=>'Select Customer'])
               !!}
            </div>

        </div>
        <div class="col-md-2 mr-1">
            <div class="form-group row">

                {!!  Form::label('event_date' ,'Booking Date' ,['class'=>''])   !!}
                {!!  Form::date('event_date',request()->has('event_date')?request()->get('event_date'):\Carbon\Carbon::now(),['id'=>'event_date','class'=>'form-control ','placeholder'=>'2021-04-03']) !!}

            </div>
        </div>
        <div class="col-md-2 mr-1">
            <div class="form-group row">

                {!!  Form::label('cnic' ,'Cnic' ,['class'=>''])   !!}
                {!!  Form::number('cnic',null,['id'=>'cnic','class'=>'form-control ','placeholder'=>'33048-2584433815-1']) !!}

            </div>
        </div>
        <div class="col-md-2 mr-1">
            <div class="form-group row">

                {!!  Form::label('contact' ,'Contact' ,['class'=>''])   !!}
                {!!  Form::number('contact',null,['id'=>'contact','class'=>'form-control ','placeholder'=>'0300-******']) !!}

            </div>
        </div>

        <div class="col-lg-1 mt-4 ml-4">
            <div class="form-group row">
                {!! Form::submit('Search', array('class' => 'btn btn-primary text-white mx-1')) !!}

            </div>
        </div>
        <div class="col-lg-2 mt-4 ml-2">
            <div class="form-group row">
                <a href="{{route('dashboard.marquee.booking.index')}}" class="btn btn-primary text-white mx-1">Clear All</a>

            </div>
        </div>
    </div>

    {!! Form::close() !!}
</div>
