<div class="card-body">
    <h1 class="  header-title">
        Search Record By
          </h1>
    {!! Form::open(['method' => 'GET' ,'route' =>$route, 'files' => true] ) !!}
    <div class="row">
       <div class="col-md-4">
            <div class="form-group">
                <h6 class="input-title mt-0 md-3">Name</h6>
                {!!  Form::select('customer_id',$customer,request()->has('customer_id')?request()->get('customer_id'):null,['id'=>'q_id',
                    'class'=>'select2 form-control mb-3 custom-select float-right', 'style' => 'width: 100%',
                    'placeholder'=>'Select Customer'])
               !!}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {!!  Form::label('q_id' ,'Contact No.' ,['class'=>''])   !!}
                {!!  Form::select('q_id',$mobile,request()->has('q_id')?request()->get('q_id'):null,['id'=>'customer_id',
                    'class'=>'select2 form-control mb-3 custom-select float-right', 'style' => 'width: 100%',
                    'placeholder'=>'Select Contact'])
               !!}
            </div>
        </div>

        <div class="col-lg-4 mt-4 text-right">
            {!! Form::submit('Search', array('class' => 'btn btn-primary text-white w-sm')) !!}
            <a href="{{route('bookingquotation.report')}}" class="btn btn-primary text-white w-sm">Clear All</a>
        </div>
    </div>

    {!! Form::close() !!}
</div>
