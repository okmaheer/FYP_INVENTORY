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
                {!!  Form::label('supplier_name' ,'Supplier Name' ,['class'=>'col-form-label'])   !!}
                {!!  Form::select('supplier_name',$filter_supplier_name,request()->has('supplier_name')?request()->get('supplier_name'):null,
                    ['class'=>'select2 form-control mb-3 custom-select float-right','style'=>'width: 100%',
                    'placeholder'=>'Select Supplier'])
                !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!!  Form::label('supplier_mobile' ,'Supplier Mobile' ,['class'=>'col-form-label'])   !!}
                {!!  Form::select('supplier_mobile',$filter_supplier_mobile,request()->has('supplier_mobile')?request()->get('supplier_mobile'):null,
                    ['class'=>'select2 form-control mb-3 custom-select float-right','style'=>'width: 100%',
                    'placeholder'=>'Select Mobile No.'])
                !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!!  Form::label('supplier_cnic' ,'Supplier CNIC' ,['class'=>'col-form-label'])   !!}
                {!!  Form::select('supplier_cnic',$filter_supplier_cnic,request()->has('supplier_cnic')?request()->get('supplier_cnic'):null,
                    ['class'=>'select2 form-control mb-3 custom-select float-right','style'=>'width: 100%',
                    'placeholder'=>'Select CNIC'])
                !!}
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
