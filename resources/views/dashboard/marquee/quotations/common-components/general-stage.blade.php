<div class="row">
    <div class="col-lg-6">

        {!!  Html::decode(Form::label('quot_number' ,'Quotation No.' ,['class'=>'col-form-label text-left']))   !!}
        <div class="input-group">
            {!!  Form::text('quot_number',(isset($model->quot_number)) ? $model->quot_number:$quot_no ,['id'=>'quot_number','class'=>'form-control','placeholder'=>'','readonly','tabindex' => -1]) !!}
        </div>
        {!!  Html::decode(Form::label('customer_name' ,'Customer Name<i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
        <div class="input-group">
            {!!  Form::text('customer_name',null,['id'=>'customer_name','class'=>'form-control','placeholder'=>'', 'required']) !!}
        </div>
        {!!  Html::decode(Form::label('event_date' ,'Event Date<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group">
            {!!  Form::text('event_date',(isset($model)) ? \AccountHelper::date_format( $model->event_date):null,['id'=>'event_date','class'=>'form-control datepicker','required','autocomplete'=>'off']) !!}
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        {!!  Html::decode(Form::label('quot_date' ,'Quotation Date' ,['class'=>'col-form-label text-left']))   !!}
        <div class="input-group">
            {!!  Form::text('created_at',(isset($model)) ? \AccountHelper::date_format( $model->created_at):\AccountHelper::date_format( \Carbon\Carbon::today()),['id'=>'quot_date','class'=>'form-control','placeholder'=>'','readonly','tabindex' => -1]) !!}
        </div>
        {!!  Html::decode(Form::label('phone_number' ,'Phone<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::text('phone_number',null,['id'=>'phone_number','class'=>'form-control ','placeholder'=>'','required']) !!}
        </div>
        {!!  Html::decode(Form::label('event_time' ,'Event Time<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::select('event_time', MarqueeHelper::eventTime(),null,['id'=>'event_time','class'=>'form-control select2','placeholder'=>'Select Event Time','required', 'style'=>'width:100%']) !!}
        </div>
    </div>
</div>
