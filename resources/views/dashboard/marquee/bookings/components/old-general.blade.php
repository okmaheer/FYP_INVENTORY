<div class="row">
    <div class="col-lg-6">

        {!!  Html::decode(Form::label('booking_number' ,'Booking No' ,['class'=>'col-form-label text-right ml-1']))   !!}
        <div class="input-group ">
            {!!  Form::text('booking_number',$booking_no,['id'=>'national_id_card','class'=>'form-control ','placeholder'=>'Enter Name','readonly']) !!}
        </div>
        {!!  Html::decode(Form::label('national_id_card' ,'Name' ,['class'=>'col-form-label text-right ml-1']))   !!}
        <div class="input-group ">
            {!!  Form::text('national_id_card',null,['id'=>'national_id_card','class'=>'form-control ','placeholder'=>'Enter Name']) !!}
        </div>
        {!!  Html::decode(Form::label('phone_number' ,'Contact Number' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::text('phone_number',null,['id'=>'phone_number','class'=>'form-control ','placeholder'=>'','required']) !!}

        </div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="text-danger">{{$error}}</div>
            @endforeach
        @endif
        {!!  Html::decode(Form::label('sec_contact_no' ,'SEC/Contact' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group">
            {!!  Form::text('sec_contact_no',null,['id'=>'sec_contact_no','class'=>'form-control ','placeholder'=>'']) !!}
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
            </div>
        </div>
        {!!  Html::decode(Form::label('event_area' ,'Event Site' ,['class'=>'col-form-label text-left']))   !!}
        <div class="input-group">
            {!!  Form::select('event_area', AccountHelper::eventArea(),null,['id'=>'event_area','class'=>'select2 form-control mb-3 custom-select float-right','placeholder'=>'Select Event Site','required'])
                !!}
        </div>
        {!!  Html::decode(Form::label('event_time' ,'Event Time' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::select('event_time', MarqueeHelper::eventTime(),null,['id'=>'event_time','class'=>'select2 form-control mb-3 custom-select float-right','placeholder'=>'Select Event Time','required'])
            !!}

        </div>
        {!!  Html::decode(Form::label('patition' ,'Partition Required' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::select('partition', AccountHelper::partitionRequire(),null,['id'=>'partition',
            'class'=>'select2 form-control mb-3 custom-select float-right',
            'placeholder'=>'Select Partition'])
                !!}

        </div>
    </div>
    <div class="col-lg-6">
        {!!  Html::decode(Form::label('booking_at' ,'Booking No' ,['class'=>'col-form-label text-right ml-1']))   !!}
        <div class="input-group ">
            {!!  Form::text('created_at',(isset($model)) ? $model->created_at:\Carbon\Carbon::now(),['id'=>'quot_date','class'=>'form-control','placeholder'=>'','readonly']) !!}
        </div>
        <div class="col-sm-3 float-right mt-4">
            {!! Form::open(['route' => 'dashboard.accounts.service_invoice.store','files' => true] ) !!}
            {!! csrf_field() !!}
            <div class=" text-center">
                <button type="button"   style="margin: 9px 0px 0px 36px" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target=".bd-example-modal-xl"> <i class="ti-plus m-r-2"></i></button>
            </div>
            <!-- sample modal content -->

            {{-- {!! Form::close() !!} --}}
        </div>
        {!!  Html::decode(Form::label('customer_option' ,'Customer C.N.I.C' ,['class'=>'col-form-label text-left']))   !!}
        <div class="input-group col-sm-9">
            {!!  Form::select('customer_option', $customer,null,['id'=>'customer_option',
            'class'=>'select2 form-control mb-3 custom-select float-right',
            'placeholder'=>'Select Customer/Option','onchange'=>'getCustomerInfo(this)','required'])
             !!}

        </div>
        {!!  Html::decode(Form::label('address' ,' Address' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::text('address',null,['id'=>'address','class'=>'form-control ','placeholder'=>'Address','required']) !!}

        </div>
        {!!  Html::decode(Form::label('event_date' ,'Event Date' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::date('event_date',null,['id'=>'event_date','class'=>'form-control ','placeholder'=>'1008','required']) !!}

        </div>

        {!!  Html::decode(Form::label('no_person' ,' Number of Person' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::text('no_person',null,['id'=>'no_person','class'=>'form-control ','placeholder'=>'Enter Person','required']) !!}

        </div>
        {{--        {!!  Html::decode(Form::label('rate_per_head' ,'Rate Per Hea' ,['class'=>'col-form-label text-right']))   !!}--}}
        {{--        <div class="input-group ">--}}

        {{--            {!!  Form::text('rate_per_head',null,['id'=>'rate_per_head','class'=>'form-control ','placeholder'=>'Enter Person']) !!}--}}

        {{--        </div>--}}

        {!!  Html::decode(Form::label('venue' ,'Event Area' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::select('venue', MarqueeHelper::getVenues(),null,['id'=>'venue',
            'class'=>'select2 form-control mb-3 custom-select float-right',
            'placeholder'=>'Select Event Area','required'])
                !!}

        </div>


        {!!  Form::hidden('quot_number',null ,['id'=>'quot_number','class'=>'form-control','placeholder'=>'']) !!}

    </div>
</div>