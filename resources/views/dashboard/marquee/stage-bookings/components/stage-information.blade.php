<div class="row">
    <div class="col-md-3">
        {!!  Html::decode(Form::label('stage_name' ,'Stage Name ' ,['class'=>'col-form-label text-left']))   !!}
        {!!  Form::text('stage_name',null,['id'=>'stage_name','class'=>'form-control ','placeholder'=>'Stage Name']) !!}
    </div>
    <div class="col-md-9">
        {!!  Html::decode(Form::label('stage_picture' ,'Stage Picture ' ,['class'=>'col-form-label text-left']))   !!}
                {!!  Form::file('logo',['id'=>'logo','class'=>'form-control ']) !!}
                {!! Form::hidden('id',null) !!}
    </div>
</div>
