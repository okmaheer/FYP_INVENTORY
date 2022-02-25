
    <div class="row">
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('event_date' ,'Event Date' ,['class'=>'col-form-label text-left']))   !!}
                <div class="input-group">
                {!!  Form::text('event_date',null,['id'=>'event_date','class'=>'form-control mb-3 float-right', 'readonly'])!!}
                </div>
        </div>
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('event_time' ,'Time' ,['class'=>'col-form-label text-left']))   !!}
                <div class="input-group">
                {!!  Form::text('event_time',null,['id'=>'event_time','class'=>'form-control mb-3 float-right', 'readonly'])!!}
                </div>
        </div>
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('no_person' ,'No. of Persons' ,['class'=>'col-form-label text-left']))   !!}
                <div class="input-group">
                {!!  Form::text('no_person',null,['id'=>'no_person','class'=>'form-control mb-3 float-right', 'readonly'])!!}
                </div>
        </div>

    </div>



