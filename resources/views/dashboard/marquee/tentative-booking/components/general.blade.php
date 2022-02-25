<div class="row">
    <div class="col-md-3">
        {!!  Html::decode(Form::label('tentative_number' ,'Booking No.' ,['class'=>'col-form-label text-left']))   !!}
        <div class="input-group">
            {!!  Form::text('tentative_number',(isset($model->tentative_number)) ? $model->tentative_number:$bookingNumber ,['id'=>'tentative_number','class'=>'form-control','placeholder'=>'','readonly','tabindex' => -1]) !!}
        </div>
    </div>
    <div class="col-md-3">
        {!!  Html::decode(Form::label('created_at' ,'Booking Date' ,['class'=>'col-form-label text-left']))   !!}
        <div class="input-group">
            {!!  Form::text('created_at',(isset($model)) ? \AccountHelper::date_format($model->created_at):\AccountHelper::date_format(\Carbon\Carbon::today()),['id'=>'created_at','class'=>'form-control','placeholder'=>'','readonly','tabindex' => -1]) !!}
        </div>
    </div>
    <div class="col-md-3">
        {!!  Html::decode(Form::label('event_date' ,'Event Date<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::text('event_date',isset($model) ? \AccountHelper::date_format( $model->event_date) : null,['id'=>'event_date','class'=>'form-control datepicker','required','autocomplete'=>'off']) !!}
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        {!!  Html::decode(Form::label('no_person' ,'Number of Persons' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::number('no_person',null,['id'=>'no_person','class'=>'form-control ','placeholder'=>'']) !!}
            @error('no_person')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        {!!  Html::decode(Form::label('customer_name' ,'Customer Name<i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
        <div class="input-group">
            {!!  Form::text('customer_name',null,['id'=>'customer_name','class'=>'form-control','placeholder'=>'']) !!}
        </div>
    </div>
    <div class="col-md-3">
        {!!  Html::decode(Form::label('phone_number' ,'Phone<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::text('phone_number',null,['id'=>'phone_number','class'=>'form-control ','placeholder'=>'','required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        {!!  Html::decode(Form::label('customer_address' ,'Address' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::text('customer_address',null,['id'=>'customer_address','class'=>'form-control ','placeholder'=>'']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        {!!  Html::decode(Form::label('event_time' ,'Event Time<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::select('event_time', MarqueeHelper::eventTime(),null,['id'=>'event_time','class'=>'select2 form-control','placeholder'=>'Select Event Time','required'])
            !!}
        </div>
    </div>

    <div class="col-md-3">
        {!!  Html::decode(Form::label('start_time' ,'Start Time<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::time('start_time',null,['id'=>'start_time','class'=>'form-control','required']) !!}
        </div>
    </div>
    <div class="col-md-3">
        {!!  Html::decode(Form::label('end_time' ,'End Time<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::time('end_time',null,['id'=>'end_time','class'=>'form-control','required']) !!}
        </div>
    </div>
    <div class="col-md-3">
        {!!  Html::decode(Form::label('event_type' ,'Event Type<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group">
            {!!  Form::select('event_type', MarqueeHelper::EventType(),null,['id'=>'event_type',
            'class'=>'select2 form-control mb-3 custom-select float-right', 'placeholder'=>'Select Event Type', 'required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        {!!  Html::decode(Form::label('partition' ,'Partition Required' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::select('partition', AccountHelper::partitionRequire(),null,['id'=>'partition',
                'class'=>'select2 form-control mb-3 custom-select float-right',
                'placeholder'=>'Select Partition' ])
            !!}
        </div>
    </div>
    <div class="col-md-3">
        {!!  Html::decode(Form::label('event_area' ,'Event Site<i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
        <div class="input-group">
            {!!  Form::select('event_area', [1 => 'Indoor'],1,['id'=>'event_area','class'=>'select2 form-control','placeholder'=>'Select Event Area','required'])
                !!}
        </div>
    </div>
    <div class="col-md-3">
        {!!  Html::decode(Form::label('venue' ,'Event Area/Venue<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::select('venue[]', $event_areas,null,['id'=>'venue',
                'class'=>'select2 form-control mb-3 custom-select float-right',
                'multiple' => true, 'required' ])
            !!}
            @error('venue')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-3">
        {!!  Html::decode(Form::label('rate_per_head' ,'Rate Per Person' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group">
            {!!  Form::number('rate_per_head',null,['id'=>'rate_per_head','class'=>'form-control ','placeholder'=>'0.00']) !!}
            @error('rate_per_head')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
