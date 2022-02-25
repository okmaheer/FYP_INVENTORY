@if (isset($for))
    <div class="row">
        @if (isset($from))
        <div class="col-md-2">
            {!!  Html::decode(Form::label('quot_id_display' ,'Quotation No' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!!  Form::hidden('quot_id',isset($from) ? $model->id : '',['id'=>'quot_id', 'required']) !!}
                {!!  Form::text('quot_id_display',isset($from) ? $model->quot_number : '',['id'=>'quot_id_display','class'=>'form-control ','placeholder'=>'', 'required', 'readonly', 'tabindex' => -1 ]) !!}
            </div>
        </div>
        @endif

        <div @class(['col-md-2'=>isset($from), 'col-md-3'=>!isset($from)])>
            {!!  Html::decode(Form::label('booking_number' ,'Booking No' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!!  Form::text('booking_number',$booking_no,['id'=>'booking_number','class'=>'form-control ','readonly' ,'tabindex' => -1]) !!}
            </div>
        </div>
        <div @class(['col-md-2'=>isset($from), 'col-md-3'=>!isset($from)])>
            {!!  Html::decode(Form::label('created_at' ,'Booking Date' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!!  Form::text('created_at',\AccountHelper::date_format($bookingDate),['id'=>'created_at','class'=>'form-control','readonly','tabindex' => -1]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>
        </div>
        <div @class(['col-md-2'=>isset($from), 'col-md-3'=>!isset($from)])>
            {!!  Html::decode(Form::label('event_date' ,'Event Date<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::text('event_date',\AccountHelper::date_format($model->event_date),['id'=>'event_date','class'=>'form-control datepicker','required', 'autocomplete'=>'off']) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>
        </div>
        <div @class(['col-md-2'=>isset($from), 'col-md-3'=>!isset($from)])>
            {!!  Html::decode(Form::label('event_type' ,'Event Type<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::select('event_type', MarqueeHelper::EventType(),$model->event_type,['id'=>'event_type', 'style'=>'width:100%',
                'class'=>'select2 form-control', 'placeholder'=>'Select Event Type', 'required']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            {!!  Html::decode(Form::label('customer_option' ,'CNIC<i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
            @if(isset($from))
            <div class="input-group">
                {!!  Form::select('customer_option', $customer,$model->customer_option,['id'=>'customer_option',
                    'class'=>'select2 form-control', 'style' => 'width: calc(100% - 40px);',
                    'placeholder'=>'Select Customer','onchange'=>'getCustomerInfo(this)','required'])
                !!}
                <span class="input-group-append">
                    <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#customer_add_modal" style="width: 38px; height: 38px;"> <i class="ti-plus m-r-2"></i></button>

                </span>
            </div>
            @else
                <div class="input-group">
                    {!!  Form::select('customer_option', $customer,$model->customer_option,['id'=>'customer_option',
                        'class'=>'select2 form-control', 'style'=>'width:100%',
                        'placeholder'=>'Select Customer','onchange'=>'getCustomerInfo(this)','required'])
                    !!}
                </div>
            @endif
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('customer_name' ,'Name<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!!  Form::text('customer_name',isset($from) ? '' : $model->customer->customer_name,['id'=>'customer_name','class'=>'form-control ','placeholder'=>'Enter Name', 'required', 'readonly','tabindex' => -1]) !!}
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('phone_number' ,'Contact Number<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::text('phone_number',isset($from) ? '' : $model->customer->phone_number,['id'=>'phone_number','class'=>'form-control ','placeholder'=>'','required', 'readonly','tabindex' => -1]) !!}

            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('address' ,'Address<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::text('address',$model->address,['id'=>'address','class'=>'form-control ','placeholder'=>'Address','required', 'readonly','tabindex' => -1]) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            {!!  Html::decode(Form::label('no_person' ,'Number of Persons' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::number('no_person',$model->no_person,['id'=>'no_person','class'=>'form-control ','placeholder'=>'Enter Persons', 'onkeyup'=>'applyCalculations();']) !!}
                @error('no_person')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('rate_per_head' ,'Rate Per Person<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::number('rate_per_head',$model->rate_per_head,['id'=>'rate_per_head','class'=>'form-control','placeholder'=>'0.00', 'onkeyup'=>'applyCalculations();', 'required']) !!}
                @error('rate_per_head')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('event_area' ,'Event Site<i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
            <div class="input-group">
                {!!  Form::select('event_area', AccountHelper::eventArea(),$model->event_area,['id'=>'event_area','class'=>'select2 form-control', 'style'=>'width:100%','placeholder'=>'Select Event Site','required', 'onchange'=>'setOutdoorView();']) !!}
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('partition' ,'Partition Required<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::select('partition', AccountHelper::partitionRequire(),$model->partition,['id'=>'partition','style'=>'width:100%',
                'class'=>'select2 form-control', 'placeholder'=>'Select Partition', 'required']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            {!!  Html::decode(Form::label('venue' ,'Event Area/Venue' ,['class'=>'col-form-label text-left']))   !!}
            <div class="input-group">
                {!!  Form::select('venue[]', $event_areas, $model->venue,['id'=>'venue','class'=>'select2 form-control mb-3 custom-select float-right','multiple'=>true]) !!}
                @error('venue')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('event_time' ,'Event Time<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::select('event_time', MarqueeHelper::eventTime(),$model->event_time,['id'=>'event_time','class'=>'select2 form-control mb-3 custom-select float-right','placeholder'=>'Select Event Time','required']) !!}
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('start_time' ,'Start Time<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::time('start_time',$model->start_time,['id'=>'start_time','class'=>'form-control','required']) !!}
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('end_time' ,'End Time<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::time('end_time',$model->end_time,['id'=>'end_time','class'=>'form-control','required']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            {!!  Html::decode(Form::label('meal_time' ,'Meal Time<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::time('meal_time',$model->meal_time,['id'=>'meal_time','class'=>'form-control','required']) !!}
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('care_of' ,'Care Of' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('care_of',$model->care_of,['id'=>'care_of','class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row" id="outdoor_row" style="{{$model->event_area == 2 ? '' : 'display: none;'}}">
        <div class="col-md-3">
            {!!  Html::decode(Form::label('delivery_date' ,'Delivery Date' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::text('delivery_date',empty($model->delivery_date) ? null: \AccountHelper::date_format($model->delivery_date),['id'=>'delivery_date','class'=>'form-control datepicker', 'autocomplete'=>'off']) !!}
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
                {!!  Form::number('delivery_charges',null,['id'=>'delivery_charges','class'=>'form-control', 'placeholder'=>'0.00', 'onkeyup'=>'applyCalculations();']) !!}
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
@else
    <div class="row">
        <div class="col-md-3">
            {!!  Html::decode(Form::label('booking_number' ,'Booking No' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!!  Form::text('booking_number',$booking_no,['id'=>'booking_number','class'=>'form-control ','readonly','tabindex' => -1]) !!}
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('created_at' ,'Booking Date' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!!  Form::text('created_at', \AccountHelper::date_format( $bookingDate ),['id'=>'created_at','class'=>'form-control datepicker','readonly','tabindex' => -1]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('event_date' ,'Event Date<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::text('event_date',null,['id'=>'event_date','class'=>'form-control datepicker','required', 'autocomplete'=>'off']) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('event_type' ,'Event Type<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::select('event_type', MarqueeHelper::EventType(),null,['id'=>'event_type', 'style'=> 'width:100%',
                'class'=>'select2 form-control', 'placeholder'=>'Select Event Type', 'required',]) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            {!!  Html::decode(Form::label('customer_option' ,'CNIC<i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
            <div class="input-group">
                {!!  Form::select('customer_option', $customer,null,['id'=>'customer_option',
                'class'=>'select2 form-control custom-select',
                'placeholder'=>'Select Customer','onchange'=>'getCustomerInfo(this)','required'])
                !!}
                <span class="input-group-append">
                    <button type="button"  class="btn btn-success waves-effect waves-light"  data-toggle="modal" data-target="#customer_add_modal"> <i class="ti-plus m-r-2"></i></button>
                </span>
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('customer_name' ,'Name<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group">
                {!!  Form::text('customer_name',null,['id'=>'customer_name','class'=>'form-control ','placeholder'=>'', 'required', 'readonly','tabindex' => -1]) !!}
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('phone_number' ,'Contact Number<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::text('phone_number',null,['id'=>'phone_number','class'=>'form-control ','placeholder'=>'','required', 'readonly','tabindex' => -1]) !!}
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('address' ,'Address<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::text('address',null,['id'=>'address','class'=>'form-control ','placeholder'=>'Address','required', 'readonly','tabindex' => -1]) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            {!!  Html::decode(Form::label('no_person' ,'Number of Persons' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::number('no_person',null,['id'=>'no_person','class'=>'form-control ','placeholder'=>'Enter Persons', 'onkeyup'=>'applyCalculations();',]) !!}
                @error('no_person')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('rate_per_head' ,'Rate Per Person<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::number('rate_per_head',null,['id'=>'rate_per_head','class'=>'form-control ','placeholder'=>'0.00', 'onkeyup'=>'applyCalculations();', 'required']) !!}
                @error('rate_per_head')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('event_area' ,'Event Site<i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
            <div class="input-group">
                {!!  Form::select('event_area', AccountHelper::eventArea(),null,['id'=>'event_area','class'=>'select2 form-control', 'style'=>'width:100%','placeholder'=>'Select Event Site','required', 'onchange'=>'setOutdoorView();']) !!}
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('partition' ,'Partition Required<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::select('partition', AccountHelper::partitionRequire(),null,['id'=>'partition', 'style'=>'width:100%',
                'class'=>'select2 form-control', 'placeholder'=>'Select Partition', 'required']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            {!!  Html::decode(Form::label('venue' ,'Event Area/Venue' ,['class'=>'col-form-label text-left']))   !!}
            <div class="input-group">
                {!!  Form::select('venue[]', $event_areas,null,['id'=>'venue','class'=>'select2 form-control', 'multiple'=>true, 'style'=>'width:100%']) !!}
                @error('venue')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('event_time' ,'Event Time<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::select('event_time', MarqueeHelper::eventTime(),null,['id'=>'event_time','class'=>'select2 form-control','placeholder'=>'Select Event Time','required', 'style'=>'width:100%']) !!}
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
    </div>
    <div class="row">
        <div class="col-md-3">
            {!!  Html::decode(Form::label('meal_time' ,'Meal Time<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::time('meal_time',null,['id'=>'meal_time','class'=>'form-control','required']) !!}
            </div>
        </div>
        <div class="col-md-3">
            {!!  Html::decode(Form::label('care_of' ,'Care Of' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('care_of',null,['id'=>'care_of','class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row" id="outdoor_row" style="display: none;">
        <div class="col-md-3">
            {!!  Html::decode(Form::label('delivery_date' ,'Delivery Date' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::text('delivery_date',null,['id'=>'delivery_date','class'=>'form-control datepicker', 'autocomplete'=>'off']) !!}
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
                {!!  Form::number('delivery_charges',null,['id'=>'delivery_charges','class'=>'form-control', 'placeholder'=>'0.00', 'onkeyup'=>'applyCalculations();']) !!}
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
@endif
