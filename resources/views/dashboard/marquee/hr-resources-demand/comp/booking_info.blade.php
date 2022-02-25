
    <div class="row">
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('event_date' ,'Event Date' ,['class'=>'col-form-label text-left']))   !!}
                <div class="input-group">
                {!!  Form::text('event_date',(isset($model->custom_booking_number)) ? $model->booking->event_date: null,['id'=>'event_date','class'=>'form-control mb-3 float-right', 'readonly'])!!}
                </div>
        </div>
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('event_time' ,'Time' ,['class'=>'col-form-label text-left']))   !!}
                <div class="input-group">
                {!!  Form::text('event_time',(isset($model->custom_booking_number)) ? MarqueeHelper::eventTime($model->booking->event_time): null,['id'=>'event_time','class'=>'form-control mb-3 float-right', 'readonly'])!!}
                </div>
        </div>
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('no_of_persons' ,'No. of Persons' ,['class'=>'col-form-label text-left']))   !!}
                <div class="input-group">
                {!!  Form::text('no_of_persons',(isset($model->custom_booking_number)) ? $model->booking->no_person: null,['id'=>'no_of_persons','class'=>'form-control mb-3 float-right', 'readonly'])!!}
                </div>
        </div>

    </div>



