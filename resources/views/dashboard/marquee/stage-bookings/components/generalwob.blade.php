@if(isset($for))
    <div class="row">
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('customer_option' ,'Customer C.N.I.C<i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
            <div class="input-group">
                {!!  Form::select('customer_option', $customer,$model->customer_id,['id'=>'customer_option_wob',
                    'class'=>'select2 form-control selCustom', 'width'=>'100%',
                    'placeholder'=>'Select Customer','onchange'=>'getCustomerInfo(this)','required'])
                !!}
            </div>
        </div>
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('customer_name' ,'Customer<i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
            <div class="input-group">
                {!!  Form::text('customer_name',$model->customer->customer_name,['id'=>'customer_name_wob','class'=>'form-control ','placeholder'=>'','required', 'readonly','tabindex' => -1]) !!}
                {!!  Form::hidden('category','WOB') !!}
                {!!  Form::hidden('customer_id',$model->customer->id,['id'=>'customer_id_wob','class'=>'form-control ','placeholder'=>'','required']) !!}

            </div>
        </div>
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('phone_number' ,'Phone ' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('phone_number',$model->customer->customer_mobile,['id'=>'phone_number_wob','class'=>'form-control ','placeholder'=>'', 'readonly','tabindex' => -1]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-headphones"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('sec_contact_no' ,'SEC/Contact' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::text('sec_contact_no',$model->customer->phone,['id'=>'sec_contact_no_wob','class'=>'form-control ','placeholder'=>'', 'readonly','tabindex' => -1]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('address' ,' Address ' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('address',$model->customer->customer_address,['id'=>'address_wob','class'=>'form-control ','placeholder'=>'Address', 'readonly','tabindex' => -1]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="far fa-address-book"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('care_of' ,'Care Of' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('care_of', null, ['id'=>'care_of_wob','class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            {!!  Html::decode(Form::label('event_date' ,'Event Date<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('event_date',\AccountHelper::date_format($model->event_date),['id'=>'event_date','class'=>'form-control datepicker', 'required', 'autocomplete'=>'off']) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            {!!  Html::decode(Form::label('event_time' ,'Event Time<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::select('event_time', MarqueeHelper::eventTime(),$model->event_time,['id'=>'event_time_wob','class'=>'form-control select2','placeholder'=>'Select Event Time','required', 'style'=>'width:100%']) !!}
            </div>
        </div>
        <div class="col-lg-3">
            {!!  Html::decode(Form::label('start_time' ,'Start Time' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::time('start_time', $model->start_time, ['id'=>'start_time_wob','class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-3">
            {!!  Html::decode(Form::label('end_time' ,'End Time' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::time('end_time', $model->end_time, ['id'=>'end_time_wob','class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('booking_detail' ,' Booking Details ' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!! Form::textarea('booking_detail',$model->booking_details,['id'=>'booking_detail','class' => 'form-control', 'rows' => '2','placeholder'=>'Details']) !!}
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('customer_option' ,'Customer C.N.I.C<i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
            <div class="input-group">
                {!!  Form::select('customer_option_wob', $customer,null,['id'=>'customer_option_wob',
                    'class'=>'select2 form-control selCustom',
                    'placeholder'=>'Select Customer','onchange'=>'getCustomerInfo(this);','required',
                    'style'=>'width: 90%', 'tabindex' => 1])
                 !!}
                <div class="input-group-append">
                    <button type="button"  class="btn btn-success waves-effect waves-light"  data-toggle="modal" data-target="#customer_add_modal"> <i class="ti-plus m-r-2"></i></button>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('customer_name' ,'Customer<i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
            <div class="input-group">
                {!!  Form::text('customer_name',null,['id'=>'customer_name_wob','class'=>'form-control ','placeholder'=>'','required', 'readonly','tabindex' => -1]) !!}
                {!!  Form::hidden('category','WOB') !!}
                {!!  Form::hidden('customer_id',null,['id'=>'customer_id_wob','class'=>'form-control ','placeholder'=>'']) !!}
            </div>
        </div>
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('phone_number' ,'Phone ' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('phone_number',null,['id'=>'phone_number_wob','class'=>'form-control ','placeholder'=>'', 'readonly','tabindex' => -1]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-headphones"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('sec_contact_no' ,'SEC/Contact' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::text('sec_contact_no',null,['id'=>'sec_contact_no_wob','class'=>'form-control ','placeholder'=>'', 'readonly','tabindex' => -1]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('address' ,' Address ' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('address',null,['id'=>'address_wob','class'=>'form-control ','placeholder'=>'Address', 'readonly','tabindex' => -1]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="far fa-address-book"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('care_of' ,'Care Of' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('care_of', null, ['id'=>'care_of_wob','class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            {!!  Html::decode(Form::label('event_date' ,'Event Date<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('event_date',null,['id'=>'event_date','class'=>'form-control datepicker', 'required', 'autocomplete'=>'off']) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            {!!  Html::decode(Form::label('event_time' ,'Event Time<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::select('event_time', MarqueeHelper::eventTime(),null,['id'=>'event_time_wob','class'=>'form-control select2','placeholder'=>'Select Event Time','required', 'style'=>'width:100%']) !!}
            </div>
        </div>
        <div class="col-lg-3">
            {!!  Html::decode(Form::label('start_time' ,'Start Time' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::time('start_time', null, ['id'=>'start_time_wob','class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-3">
            {!!  Html::decode(Form::label('end_time' ,'End Time' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::time('end_time', null, ['id'=>'end_time_wob','class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            {!!  Html::decode(Form::label('booking_detail' ,' Booking Details ' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!! Form::textarea('booking_detail',null,['id'=>'booking_detail','class' => 'form-control', 'rows' => '2','placeholder'=>'Details']) !!}
            </div>
        </div>
    </div>
@endif



