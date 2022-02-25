<div class="card-body">
    <h1 class="  header-title">
        Search Record By
          </h1>
    {!! Form::open(['method' => 'GET' ,'route' =>$route, 'files' => true] ) !!}
    <div class="row">
        <div class="col-md-3">
            <div class="form-group row">
                {!!  Form::label('from' ,'Product Name' ,['class'=>''])   !!}
                {!!  Form::select('product_id',$product,request()->has('product_id')?request()->get('product_id'):null,['id'=>'product_id',
                'class'=>'select2 form-control mb-3 ml-3 custom-select float-right',
                'placeholder'=>'Select Prodcuct'])
               !!}
            </div>


        </div>
        <div class="col-md-2 mr-1">
            <div class="form-group row">

                {!!  Form::label('from' ,'From' ,['class'=>''])   !!}
                {!!  Form::date('from',request()->has('from')?request()->get('from'):\Carbon\Carbon::now(),['id'=>'from','class'=>'form-control ','placeholder'=>'2021-04-03']) !!}

            </div>
        </div>
        <div class="col-md-2 mr-1">
            <div class="form-group row">

                {!!  Form::label('to' ,'To' ,['class'=>''])   !!}
                {!!  Form::date('to',request()->has('to')?request()->get('to'):\Carbon\Carbon::now(),['id'=>'to','class'=>'form-control ','placeholder'=>'2021-04-03']) !!}

            </div>
        </div>
       
       

        <div class="col-md-1 mt-4">
            <div class="form-group row">
                {!! Form::submit('Search', array('class' => 'btn btn-primary text-white mx-1')) !!}

            </div>
        </div>
        <div class="col-md-2 mt-4 ml-3 ">
            <div class="form-group row">
                <a href="{{route('stock.quantity_report')}}" class="btn btn-primary text-white mx-1">Clear All</a>
            </div>
        </div>
        <div class="col-md-1 mt-4 ml-3">
            <div class="form-group row">
                <button class="btn btn-primary" onclick="printPersonForm();">Print</button>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
</div>
