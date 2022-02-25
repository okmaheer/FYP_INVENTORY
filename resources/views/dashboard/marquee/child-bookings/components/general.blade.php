@if (isset($for))
    {!! Form::hidden('event_type',$model->event_type) !!}
    <div class="row">
        <div class="col-lg-6">
            {!!  Html::decode(Form::label('customer_name' ,'Customer' ,['class'=>'col-form-label text-left']))   !!}
            <div class="input-group">
                {!!  Form::text('customer_name',$model->customer->customer_name,['id'=>'customer_name','class'=>'form-control ','placeholder'=>'','readonly']) !!}
                {!!  Form::hidden('customer_option',$model->customer_option,['id'=>'customer_option','class'=>'form-control ','placeholder'=>'','readonly']) !!}
            </div>
            {!!  Html::decode(Form::label('address' ,' Address' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('address',$model->customer->customer_address,['id'=>'address','class'=>'form-control ','placeholder'=>'Address','readonly']) !!}

            </div>
            {!!  Html::decode(Form::label('event_area_display' ,'Event Area' ,['class'=>'col-form-label text-left']))   !!}
            <div class="input-group">
                @if($model->event_area == 1)
                    @foreach ($model->venue as $ven)
                        {!!  Form::hidden('venue[]',$ven,['class'=>'form-control']) !!}
                    @endforeach
                @endif
                {!!  Form::hidden('event_area',$model->event_area,['id'=>'event_area','class'=>'form-control ','placeholder'=>'','readonly']) !!}
                {!!  Form::text('event_area_display',AccountHelper::eventArea($model->event_area),['id'=>'event_area_display','class'=>'form-control ','placeholder'=>'','readonly']) !!}
            </div>
            {!!  Html::decode(Form::label('event_date' ,'Event Date' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('event_date',\AccountHelper::date_format($model->event_date),['id'=>'event_date','class'=>'form-control ','placeholder'=>'','readonly']) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>
            {!!  Html::decode(Form::label('event_time_display' ,'Event Time' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::hidden('event_time',$model->event_time,['id'=>'event_time','class'=>'form-control ','placeholder'=>'','readonly']) !!}
                {!!  Form::text('event_time_display',MarqueeHelper::eventTime($model->event_time),['id'=>'event_time_display','class'=>'form-control ','placeholder'=>'','readonly']) !!}

            </div>
        </div>
        <div class="col-lg-6">
            {!!  Html::decode(Form::label('phone_number' ,'Phone' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('phone_number',$model->customer->customer_mobile,['id'=>'phone_number','class'=>'form-control ','placeholder'=>'','readonly']) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-headphones"></i></span>
                </div>
            </div>
            {!!  Html::decode(Form::label('national_id_card' ,'C.N.I.C' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group ">
                {!!  Form::text('national_id_card',$model->customer->cnic,['id'=>'national_id_card','class'=>'form-control ','placeholder'=>'','readonly']) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                </div>
            </div>

            {!!  Html::decode(Form::label('no_person' ,' Number of Persons' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::number('no_person',$model->no_person,['id'=>'no_person','class'=>'form-control ','placeholder'=>'','onkeyup'=>'applyCalculations();']) !!}
            </div>
            {!!  Html::decode(Form::label('rate_per_head' ,'Rate Per Person' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('rate_per_head',$model->rate_per_head,['id'=>'rate_per_head','class'=>'form-control ','placeholder'=>'','readonly']) !!}
            </div>
            {!!  Html::decode(Form::label('partition_dis' ,'Partition Require' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::hidden('partition',$model->partition,['id'=>'partition','class'=>'form-control ','placeholder'=>'','readonly']) !!}
                {!!  Form::text('partition_dis',MarqueeHelper::isPartition($model->partition),['id'=>'partition_dis','class'=>'form-control ','placeholder'=>'','readonly']) !!}
            </div>
        </div>
    </div>
@else
    {!! Form::hidden('event_type',$parent_booking->event_type) !!}
    <div class="row">
        <div class="col-lg-6">
            {!!  Html::decode(Form::label('customer_name' ,'Customer' ,['class'=>'col-form-label text-left']))   !!}
            <div class="input-group">
                {!!  Form::text('customer_name',$parent_booking->customer->customer_name,['id'=>'customer_name','class'=>'form-control ','placeholder'=>'','readonly']) !!}
                {!!  Form::hidden('customer_option',$parent_booking->customer_option,['id'=>'customer_option','class'=>'form-control ','placeholder'=>'','readonly']) !!}
            </div>
            {!!  Html::decode(Form::label('address' ,' Address' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('address',$parent_booking->customer->customer_address,['id'=>'address','class'=>'form-control ','placeholder'=>'Address','readonly']) !!}

            </div>
            {!!  Html::decode(Form::label('event_area_display' ,'Event Area' ,['class'=>'col-form-label text-left']))   !!}
            <div class="input-group">
                {!!  Form::hidden('event_area',$parent_booking->event_area,['id'=>'event_area','class'=>'form-control ','placeholder'=>'','readonly']) !!}
                @if($parent_booking->event_area == 1)
                    @foreach ($parent_booking->venue as $ven)
                        {!!  Form::hidden('venue[]',$ven,['class'=>'form-control']) !!}
                    @endforeach
                @endif
                {!!  Form::text('event_area_display',AccountHelper::eventArea($parent_booking->event_area),['id'=>'event_area_display','class'=>'form-control ','placeholder'=>'','readonly']) !!}
            </div>
            {!!  Html::decode(Form::label('event_date' ,'Event Date' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('event_date',\AccountHelper::date_format($parent_booking->event_date),['id'=>'event_date','class'=>'form-control ','placeholder'=>'','readonly']) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                </div>
            </div>
            {!!  Html::decode(Form::label('event_time_display' ,'Event Time' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::hidden('event_time',$parent_booking->event_time,['id'=>'event_time','class'=>'form-control ','placeholder'=>'','readonly']) !!}
                {!!  Form::text('event_time_display',MarqueeHelper::eventTime($parent_booking->event_time),['id'=>'event_time_display','class'=>'form-control ','placeholder'=>'','readonly']) !!}

            </div>
        </div>
        <div class="col-lg-6">
            {!!  Html::decode(Form::label('phone_number' ,'Phone' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('phone_number',$parent_booking->customer->customer_mobile,['id'=>'phone_number','class'=>'form-control ','placeholder'=>'','readonly']) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-headphones"></i></span>
                </div>
            </div>
            {!!  Html::decode(Form::label('national_id_card' ,'C.N.I.C' ,['class'=>'col-form-label text-right ml-1']))   !!}
            <div class="input-group ">
                {!!  Form::text('national_id_card',$parent_booking->customer->cnic,['id'=>'national_id_card','class'=>'form-control ','placeholder'=>'','readonly']) !!}
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                </div>
            </div>

            {!!  Html::decode(Form::label('no_person' ,' Number of Persons<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::number('no_person',null,['id'=>'no_person','class'=>'form-control ','placeholder'=>'','onkeyup'=>'applyCalculations();', 'required']) !!}
            </div>
            {!!  Html::decode(Form::label('rate_per_head' ,'Rate Per Person' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::text('rate_per_head',$parent_booking->rate_per_head,['id'=>'rate_per_head','class'=>'form-control ','placeholder'=>'','readonly']) !!}
            </div>
            {!!  Html::decode(Form::label('partition_dis' ,'Partition Require' ,['class'=>'col-form-label text-right']))   !!}
            <div class="input-group ">
                {!!  Form::hidden('partition',$parent_booking->partition,['id'=>'partition','class'=>'form-control ','placeholder'=>'','readonly']) !!}
                {!!  Form::text('partition_dis',MarqueeHelper::isPartition($parent_booking->partition),['id'=>'partition_dis','class'=>'form-control ','placeholder'=>'','readonly']) !!}
            </div>
        </div>
    </div>
@endif
