<div class="row">
    <div class="col-md-3">
        {!!  Html::decode(Form::label('quot_number' ,'Quotation No.' ,['class'=>'col-form-label text-left']))   !!}
        <div class="input-group">
            {!!  Form::text('quot_number',(isset($model->quot_number)) ? $model->quot_number:$quot_no ,['id'=>'quot_number','class'=>'form-control','placeholder'=>'','readonly','tabindex' => -1]) !!}
        </div>
    </div>
    <div class="col-md-3">
        {!!  Html::decode(Form::label('quot_date' ,'Quotation Date' ,['class'=>'col-form-label text-left']))   !!}
        <div class="input-group">
            {!!  Form::text('created_at',(isset($model)) ? \AccountHelper::date_format($model->created_at):\AccountHelper::date_format(\Carbon\Carbon::today()),['id'=>'quot_date','class'=>'form-control','placeholder'=>'','readonly','tabindex' => -1]) !!}
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
            {!!  Form::number('no_person',null,['id'=>'no_person','class'=>'form-control ','placeholder'=>'Enter Person', 'onkeyup'=>'applyCalculations();', 'onchange'=>'applyCalculations();']) !!}
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
        {!!  Html::decode(Form::label('customer_address' ,'Address<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::text('customer_address',null,['id'=>'customer_address','class'=>'form-control ','placeholder'=>'','required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        {!!  Html::decode(Form::label('event_time' ,'Event Time<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::select('event_time', MarqueeHelper::eventTime(),null,['id'=>'event_time','class'=>'select2 form-control mb-3 custom-select float-right','placeholder'=>'Select Event Time','required'])
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
        {!!  Html::decode(Form::label('partition' ,'Partition Required<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::select('partition', AccountHelper::partitionRequire(),null,['id'=>'partition',
            'class'=>'select2 form-control mb-3 custom-select float-right',
            'placeholder'=>'Select Partition', 'required' ])
                !!}
        </div>
    </div>
    <div class="col-md-3">
        {!!  Html::decode(Form::label('event_area' ,'Event Site<i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
        <div class="input-group">
            {!!  Form::select('event_area', AccountHelper::eventArea(),null,['id'=>'event_area','class'=>'select2 form-control mb-3 custom-select float-right','placeholder'=>'Select Event Area','required', 'onchange'=>'setOutdoorView();'])
                !!}
        </div>
    </div>
    <div class="col-md-3">
        {!!  Html::decode(Form::label('venue' ,'Event Area/Venue' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::select('venue[]', $event_areas,null,['id'=>'venue',
            'class'=>'select2 form-control mb-3 custom-select float-right',
            'multiple' => true ])
                !!}
            @error('venue')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-3">
        {!!  Html::decode(Form::label('rate_per_head' ,'Rate Per Person<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group">
            {!!  Form::number('rate_per_head',null,['id'=>'rate_per_head','class'=>'form-control ','placeholder'=>'0.00', 'onkeyup'=>'applyCalculations();', 'onchange'=>'applyCalculations();', 'required']) !!}
            @error('rate_per_head')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
<div class="row" id="outdoor_row" style="{{isset($model) ? ($model->event_area == 2 ? '' : 'display: none;') : 'display:none;'}}">
    <div class="col-md-3">
        {!!  Html::decode(Form::label('delivery_date' ,'Delivery Date' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group">
            {!!  Form::text('delivery_date',(isset($model) && !empty($model->delivery_date)) ? \AccountHelper::date_format( $model->delivery_date) : null,['id'=>'delivery_date','class'=>'form-control datepicker','autocomplete'=>'off']) !!}
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
            </div>
            @error('delivery_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-3">
        {!!  Html::decode(Form::label('delivery_time' ,'Delivery Time' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group">
            {!!  Form::time('delivery_time',null,['id'=>'delivery_time','class'=>'form-control']) !!}
            @error('delivery_time')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-3">
        {!!  Html::decode(Form::label('delivery_charges' ,'Delivery Charges' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group">
            {!!  Form::number('delivery_charges',null,['id'=>'delivery_charges','class'=>'form-control', 'placeholder'=>'0.00']) !!}
            @error('delivery_charges')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-3">
        {!!  Html::decode(Form::label('delivery_address' ,'Delivery Address' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group">
            {!!  Form::text('delivery_address',null,['id'=>'delivery_address','class'=>'form-control']) !!}
            @error('delivery_address')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
