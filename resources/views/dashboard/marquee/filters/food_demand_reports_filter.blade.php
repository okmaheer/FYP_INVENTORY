<div class="card-body">
    <h1 class="  header-title">
        Search Record By
          </h1>
    {!! Form::open(['method' => 'GET' ,'route' =>$route, 'files' => true] ) !!}
    <div class="row">
        <div class="col-md-2 mr-1">
            <div class="form-group row">
                {{-- <h6 class="input-title mt-0 md-3">Name<i class="text-danger">*</i></h6>
                {!!  Form::select('customer_id',$customer,request()->has('customer_id')?request()->get('customer_id'):null,['id'=>'customer_id',
                'class'=>'select2 form-control mb-3 custom-select float-right',
                'placeholder'=>'Select Customer'])
               !!} --}}
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

                {{-- {!!  Form::label('customer_id' ,'Cnic' ,['class'=>''])   !!}
                {!!  Form::select('customer_id',$cnic,request()->has('customer_id')?request()->get('customer_id'):null,['id'=>'customer_id',
                'class'=>'select2 form-control mb-3 custom-select float-right',
                'placeholder'=>'Select Cnic'])
               !!} --}}
            </div>
        </div>
        <div class="col-md-2 mr-1">
            <div class="form-group row">
{{-- 
                {!!  Form::label('customer_id' ,'Contact No!' ,['class'=>''])   !!}
                {!!  Form::select('customer_id',$mobile,request()->has('customer_id')?request()->get('customer_id'):null,['id'=>'customer_id',
                'class'=>'select2 form-control mb-3 custom-select float-right',
                'placeholder'=>'Select Number'])
               !!} --}}

            </div>
        </div>

        <div class="col-lg-1 mt-4 ml-4">
            <div class="form-group row">
                {!! Form::submit('Search', array('class' => 'btn btn-primary text-white mx-1')) !!}

            </div>
        </div>
        <div class="col-lg-2 mt-4 ml-2">
            <div class="form-group row">
                <a href="{{route('food.report')}}" class="btn btn-primary text-white mx-1">Clear All</a>

            </div>
        </div>
    </div>

    {!! Form::close() !!}
</div>
