<div class="card-body">
    {!! Form::open(['method' => 'POST' ,'route' =>$route, 'files' => true] ) !!}
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group row">
                <div class="col-sm-4">
                    {!!  Form::label('cnic' ,'Cnic' ,['class'=>'col-form-label text-right'])   !!}
                </div>
                <div class="col-sm-8">
                    {!!  Form::number('cnic',null,['id'=>'cnic','class'=>'form-control ','placeholder'=>'33048-2584433815-1']) !!}
                </div>
            </div>
        </div>

        <div class="col-lg-2">
            <div class="form-group">
                {!! Form::submit('Search', array('class' => 'btn btn-success')) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
