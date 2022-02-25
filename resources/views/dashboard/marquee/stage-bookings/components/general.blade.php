@if(isset($for))
    <div class="row">
        <div class="col-lg-6">
            {!!  Html::decode(Form::label('custom_booking_number' ,'Booking No. <i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
            <div class="input-group">
                {!!  Form::hidden('booking_id', is_null($booking) ? null : $booking->id, ['id'=>'booking_id']) !!}
                {!!  Form::text('custom_booking_number',$model->custom_booking_number,['id'=>'booking_no','class'=>'form-control ','placeholder'=>'','autocomplete'=>'off','required', 'readonly']) !!}
                <div class="input-group-append" onClick="searchBooking();">
                    <span class="btn btn-primary"><i class="fas fa-search"></i></span>
                </div>

            </div>

            {!!  Html::decode(Form::label('customer_option' ,'Customer' ,['class'=>'col-form-label text-left']))   !!}
            <div class="input-group">
                {!!  Form::text('customer_option',$model->booking->customer->customer_name,['id'=>'customer_option','class'=>'form-control ','placeholder'=>'','readonly','required']) !!}
                {!!  Form::hidden('customer_id',$model->booking->customer->id,['id'=>'customer_id','class'=>'form-control ','placeholder'=>'','readonly','required']) !!}
                {!!  Form::hidden('category','WB') !!}
            </div>
            {!!  Html::decode(Form::label('sec_contact_no' ,'SEC/Contact' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::text('sec_contact_no',$model->booking->customer->phone,['id'=>'sec_contact_no','class'=>'form-control ','placeholder'=>'','readonly']) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
            </div>

            {!!  Html::decode(Form::label('event_date' ,'Event Date' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('event_date',\AccountHelper::date_format( $model->booking->event_date),['id'=>'event_date','class'=>'form-control ','placeholder'=>'','readonly']) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
            </div>
            {!!  Html::decode(Form::label('event_time' ,'Event Time ' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::select('event_time', MarqueeHelper::eventTime(),$model->booking->event_time,['id'=>'event_time','class'=>'form-control','placeholder'=>'Select Event Time','required', 'readonly', 'style'=>'width:100%']) !!}
            </div>
            {!!  Html::decode(Form::label('start_time' ,'Start Time' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::time('start_time',is_null($booking) ? null : $booking->start_time,['id'=>'start_time','class'=>'form-control ','placeholder'=>'','readonly', 'tabindex' => -1]) !!}
            </div>
        </div>
        <div class="col-lg-6">
            {!!  Html::decode(Form::label('phone_number' ,'Phone ' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('phone_number',$model->booking->customer->customer_mobile,['id'=>'phone_number','class'=>'form-control ','placeholder'=>'','readonly', 'tabindex' => -1]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-headphones"></i></span>
                </div>
            </div>
            {!!  Html::decode(Form::label('national_id_card' ,'Name ' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group ">
                {!!  Form::text('national_id_card',$model->booking->customer->cnic,['id'=>'national_id_card','class'=>'form-control ','placeholder'=>'33100-1106497-4','readonly', 'tabindex' => -1]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                </div>
            </div>
            {!!  Html::decode(Form::label('address' ,' Address ' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('address',$model->booking->address,['id'=>'address','class'=>'form-control ','placeholder'=>'Address','readonly', 'tabindex' => -1]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="far fa-address-book"></i></span>
                </div>
            </div>
            {!!  Html::decode(Form::label('booking_detail' ,' Booking Details ' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!! Form::textarea('booking_detail',$model->booking->booking_details,['id'=>'booking_detail','class' => 'form-control', 'size' => '20x5','placeholder'=>'Details','readonly', 'tabindex' => -1]) !!}
            </div>
            {!!  Html::decode(Form::label('end_time' ,'End Time' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::time('end_time',is_null($booking) ? null : $booking->end_time,['id'=>'end_time','class'=>'form-control ','placeholder'=>'','readonly', 'tabindex' => -1]) !!}
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-lg-6">
            {!!  Html::decode(Form::label('custom_booking_number' ,'Booking No. <i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
            <div class="input-group">
                {!!  Form::hidden('booking_id', is_null($booking) ? null : $booking->id, ['id'=>'booking_id'] ) !!}
                {!!  Form::text('custom_booking_number',(is_null($booking) ? null : $booking->custom_booking_number),['id'=>'booking_no','class'=>'form-control ','placeholder'=>'','autocomplete'=>'off','required', 'tabindex' => 1]) !!}
                <div class="input-group-append" onClick="searchBooking()">
                    <span class="btn btn-primary"><i class="fas fa-search"></i></span>
                </div>
            </div>

            {!!  Html::decode(Form::label('customer_option' ,'Customer ' ,['class'=>'col-form-label text-left']))   !!}
            <div class="input-group">
                {!!  Form::text('customer_option',is_null($booking) ? null : $booking->customer->customer_name,['id'=>'customer_option','class'=>'form-control ','placeholder'=>'','readonly', 'tabindex' => -1]) !!}
                {!!  Form::hidden('customer_id',is_null($booking) ? null : $booking->customer->id,['id'=>'customer_id','class'=>'form-control ','placeholder'=>'','readonly']) !!}
                {!!  Form::hidden('category','WB') !!}
            </div>
            {!!  Html::decode(Form::label('sec_contact_no' ,'SEC/Contact' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group">
                {!!  Form::text('sec_contact_no',is_null($booking) ? null : $booking->customer->phone,['id'=>'sec_contact_no','class'=>'form-control ','placeholder'=>'','readonly', 'tabindex' => -1]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
            </div>

            {!!  Html::decode(Form::label('event_date' ,'Event Date ' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('event_date',is_null($booking) ? null : \AccountHelper::date_format( $booking->event_date ),['id'=>'event_date','class'=>'form-control ','placeholder'=>'','readonly', 'tabindex' => -1]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
            </div>
            {!!  Html::decode(Form::label('event_time' ,'Event Time ' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::select('event_time', MarqueeHelper::eventTime(),is_null($booking) ? null : $booking->event_time,['id'=>'event_time','class'=>'form-control','placeholder'=>'Select Event Time','required', 'readonly', 'style'=>'width:100%', 'tabindex' => -1]) !!}
            </div>
            {!!  Html::decode(Form::label('start_time' ,'Start Time' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::time('start_time',is_null($booking) ? null : $booking->start_time,['id'=>'start_time','class'=>'form-control ','placeholder'=>'','readonly', 'tabindex' => -1]) !!}
            </div>
        </div>
        <div class="col-lg-6">
            {!!  Html::decode(Form::label('phone_number' ,'Phone ' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('phone_number',is_null($booking) ? null : $booking->customer->customer_mobile,['id'=>'phone_number','class'=>'form-control ','placeholder'=>'','readonly', 'tabindex' => -1]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-headphones"></i></span>
                </div>
            </div>
            {!!  Html::decode(Form::label('national_id_card' ,'C.N.I.C ' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group ">
                {!!  Form::text('national_id_card',null,['id'=>'national_id_card','class'=>'form-control ','placeholder'=>'33100-1106497-4','readonly', 'tabindex' => -1]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                </div>
            </div>
            {!!  Html::decode(Form::label('address' ,' Address ' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('address',is_null($booking) ? null : $booking->customer->customer_address,['id'=>'address','class'=>'form-control ','placeholder'=>'Address','readonly', 'tabindex' => -1]) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="far fa-address-book"></i></span>
                </div>
            </div>
            {!!  Html::decode(Form::label('booking_detail' ,' Booking Details ' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!! Form::textarea('booking_detail',is_null($booking) ? null : $booking->booking_detail,['id'=>'booking_detail','class' => 'form-control', 'size' => '20x5','placeholder'=>'Details','readonly', 'tabindex' => -1]) !!}
            </div>
            {!!  Html::decode(Form::label('end_time' ,'End Time' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::time('end_time',is_null($booking) ? null : $booking->end_time,['id'=>'end_time','class'=>'form-control ','placeholder'=>'','readonly', 'tabindex' => -1]) !!}
            </div>
        </div>
    </div>
@endif



