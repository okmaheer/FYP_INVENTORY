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
                    {!! Form::button('Print', ['class' => 'dropdown-item', 'id' => 'printBtn']) !!}
                    <a href="{{ route($route) }}" class="dropdown-item">Clear</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row col-12">
        <div class="col-md-3">
            <div class="form-group">
                {!!  Form::label('customer_name' ,'Customer Name' ,['class'=>'col-form-label'])   !!}
                {!!  Form::select('customer_name',$filter_customer_name,request()->has('customer_name')?request()->get('customer_name'):null,
                    ['class'=>'select2 form-control mb-3 custom-select float-right','style'=>'width: 100%',
                    'placeholder'=>'Select Customer'])
                !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!!  Form::label('customer_mobile' ,'Customer Mobile' ,['class'=>'col-form-label'])   !!}
                {!!  Form::select('customer_mobile',$filter_customer_mobile,request()->has('customer_mobile')?request()->get('customer_mobile'):null,
                    ['class'=>'select2 form-control mb-3 custom-select float-right','style'=>'width: 100%',
                    'placeholder'=>'Select Mobile No.'])
                !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!!  Form::label('customer_cnic' ,'Customer CNIC' ,['class'=>'col-form-label'])   !!}
                {!!  Form::select('customer_cnic',$filter_customer_cnic,request()->has('customer_cnic')?request()->get('customer_cnic'):null,
                    ['class'=>'select2 form-control mb-3 custom-select float-right','style'=>'width: 100%',
                    'placeholder'=>'Select CNIC'])
                !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!!  Form::label('customer_city' ,'Customer City' ,['class'=>'col-form-label'])   !!}
                {!!  Form::select('customer_city',$filter_customer_city,request()->has('customer_city')?request()->get('customer_city'):null,
                    ['class'=>'select2 form-control mb-3 custom-select float-right','style'=>'width: 100%',
                    'placeholder'=>'Select City'])
                !!}
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
