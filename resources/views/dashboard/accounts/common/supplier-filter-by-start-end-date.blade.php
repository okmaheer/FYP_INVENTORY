<div class="card-body">
    {!! Form::open(['method' => 'GET' ,'route' =>$route, 'files' => true] ) !!}
    <div class="row">
        <div class="col-md-3 mr-2">
            <div class="form-group row">
                <h6 class="input-title mt-0 md-3">Supplier</h6>
            
               
                    {!!  Form::select('supplier_id',$supplier,null,['id'=>'supplier_id',
                    'class'=>'select2 form-control mb-3 custom-select float-right',
                    'placeholder'=>'Select Supplier'])
                   !!}
                </div>
    
        </div>
        <div class="col-lg-3 mr-2">
            <div class="form-group row">
                
                <h6 class="input-title mt-0 md-3">Start Date</h6>
               
                
                    {!!  Form::date('start_date',request()->has('start_date')?request()->get('start_date'):\Carbon\Carbon::now(),['id'=>'start_date','class'=>'form-control ','placeholder'=>'2021-04-03']) !!}
                </div>
           
        </div>
        <div class="col-lg-3 mr-2">
            <div class="form-group row">
                <h6 class="input-title mt-0 md-3">End Date</h6>
                    {!!  Form::date('end_date',request()->has('end_date')?request()->get('end_date'):\Carbon\Carbon::now(),['id'=>'end_date','class'=>'form-control ','placeholder'=>'2021-04-03']) !!}
            </div>
        </div>

        <div class="col-lg-1 mt-4 ml-4">
            <div class="form-group row">
                {!! Form::submit('Search', array('class' => 'btn btn-success')) !!}

            </div>
        </div>
        <div class="col-lg-1 mt-4 ml-2 ">
            <div class="form-group row">
                {!! Form::button('Print', array('class' => 'btn btn-warning', 'onclick'=>'printDiv("suplier_report")')) !!}

            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
