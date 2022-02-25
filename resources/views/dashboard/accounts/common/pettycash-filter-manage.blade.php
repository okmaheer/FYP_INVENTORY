<div class="card-body">
    <h1 class="header-title">Search Record By</h1>
    {!! Form::open(['method' => 'GET' ,'route' =>$route, 'files' => true] ) !!}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!!  Form::label('pettycash_name' ,'Pettycash Name' ,['class'=>'col-form-label'])   !!}
                {!!  Form::select('pettycash_name',$filter_pettycash_name,request()->has('pettycash_name')?request()->get('pettycash_name'):null,
                    ['class'=>'select2 form-control mb-3 custom-select float-right','style'=>'width: 100%',
                    'placeholder'=>'Select PettyCash Account'])
                !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!!  Form::label('pettycash_mobile' ,'PettyCash Mobile' ,['class'=>'col-form-label'])   !!}
                {!!  Form::select('pettycash_mobile',$filter_pettycash_mobile,request()->has('pettycash_mobile')?request()->get('pettycash_mobile'):null,
                    ['class'=>'select2 form-control mb-3 custom-select float-right','style'=>'width: 100%',
                    'placeholder'=>'Select Mobile No.'])
                !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!!  Form::label('pettycash_cnic' ,'PettyCash CNIC' ,['class'=>'col-form-label'])   !!}
                {!!  Form::select('pettycash_cnic',$filter_pettycash_cnic,request()->has('pettycash_cnic')?request()->get('pettycash_cnic'):null,
                    ['class'=>'select2 form-control mb-3 custom-select float-right','style'=>'width: 100%',
                    'placeholder'=>'Select CNIC'])
                !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group text-right">
                {!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
                {!! Form::button('Print', array('class' => 'btn btn-primary', 'onclick'=>'printDiv("suplier_list")')) !!}
                <a href="{{route($route)}}" class="btn btn-primary text-white mx-1">Clear All</a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
