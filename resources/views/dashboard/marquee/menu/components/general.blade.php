@if(isset($for))
<div class="row">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-3">
                {!!  HTML::decode(Form::label('menu_no' ,'Menu No<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            </div>
            <div class="col-sm-9">
                {!!  Form::text('menu_no',$model->menu_no,['id'=>'menu_no','class'=>'form-control ','placeholder'=>'Menu No', 'required', 'readonly']) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-3">
                {!!  HTML::decode(Form::label('menu_name' ,'Menu Name<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            </div>
            <div class="col-sm-9">
                {!!  Form::text('menu_name',$model->menu_name,['id'=>'menu_name','class'=>'form-control ','placeholder'=>'Menu Name', 'required'=>'', 'readonly']) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-3">
                {!!  HTML::decode(Form::label('menu_type' ,'Menu Type' ,['class'=>'col-form-label text-right']))   !!}
            </div>
            <div class="col-sm-9">
                {!!  Form::text('menu_type',$model->menu_type,['id'=>'menu_type','class'=>'form-control ','placeholder'=>'Menu Type']) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-3">
                {!!  Form::label('menu_specific' ,'Specific Details' ,['class'=>'col-form-label text-right'])   !!}
            </div>
            <div class="col-sm-9">
                {!!  Form::text('menu_specific',$model->menu_specific,['id'=>'menu_specific','class'=>'form-control ','placeholder'=>'Specific Details']) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-3">
                {!!  Form::label('menu_add_on' ,'Add-on' ,['class'=>'col-form-label text-right'])   !!}
            </div>
            <div class="col-sm-9">
                {!!  Form::text('menu_add_on',$model->menu_add_on,['id'=>'menu_add_on','class'=>'form-control ','placeholder'=>'Menu Addon']) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-3">
                {!!  HTML::decode(Form::label('total_cost' ,'Total Cost<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            </div>
            <div class="col-sm-9">
                {!!  Form::number('total_cost',$model->total_cost,['step'=>'any','min'=>'0','id'=>'total_cost','class'=>'form-control ','required'=>'']) !!}
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-3">
                {!!  HTML::decode(Form::label('menu_no' ,'Menu No<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            </div>
            <div class="col-sm-9">
                {!!  Form::text('menu_no',null,['id'=>'menu_no','class'=>'form-control ','placeholder'=>'Menu No', 'required']) !!}
                @if ($errors->has('menu_no'))
                    <span class="text-danger">{{ $errors->first('menu_no') }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-3">
                {!!  HTML::decode(Form::label('menu_name' ,'Menu Name<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            </div>
            <div class="col-sm-9">
                {!!  Form::text('menu_name',null,['id'=>'menu_name','class'=>'form-control ','placeholder'=>'Menu Name', 'required'=>'']) !!}
                @if ($errors->has('menu_name'))
                    <span class="text-danger">{{ $errors->first('menu_name') }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-3">
                {!!  HTML::decode(Form::label('menu_type' ,'Menu Type' ,['class'=>'col-form-label text-right']))   !!}
            </div>
            <div class="col-sm-9">
                {!!  Form::text('menu_type',null,['id'=>'menu_type','class'=>'form-control ','placeholder'=>'Menu Type']) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-3">
                {!!  Form::label('menu_specific' ,'Specific Details' ,['class'=>'col-form-label text-right'])   !!}
            </div>
            <div class="col-sm-9">
                {!!  Form::text('menu_specific',null,['id'=>'menu_specific','class'=>'form-control ','placeholder'=>'Specific Details']) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-3">
                {!!  Form::label('menu_add_on' ,'Add-on' ,['class'=>'col-form-label text-right'])   !!}
            </div>
            <div class="col-sm-9">
                {!!  Form::text('menu_add_on',null,['id'=>'menu_add_on','class'=>'form-control ','placeholder'=>'Menu Addon']) !!}
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-3">
                {!!  HTML::decode(Form::label('total_cost' ,'Total Cost<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            </div>
            <div class="col-sm-9">
                {!!  Form::number('total_cost',null,['step'=>'any','min'=>'0','id'=>'total_cost','class'=>'form-control ','required'=>'']) !!}
            </div>
        </div>
    </div>
</div>
@endif
