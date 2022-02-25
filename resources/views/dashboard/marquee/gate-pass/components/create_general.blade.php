<div class="row">
    <div class="col-lg-6">
        {!!  Html::decode(Form::label('booking_no' ,'Bookin No. ' ,['class'=>'col-form-label text-left']))   !!}
        <div class="input-group">
            {!!  Form::text('booking_id',null,['id'=>'booking_no','class'=>'form-control ','placeholder'=>'1008']) !!}
            <div class="input-group-append" onClick="searchBooking()">
                <span class="btn btn-primary"><i class="fas fa-search"></i></span>
            </div>

        </div>
        {!!  Html::decode(Form::label('customer_name' ,'Customer Name' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group">
            {!!  Form::select('customer_name', AccountHelper::eventArea(),null,['id'=>'event_area','class'=>'select2 form-control mb-3 custom-select float-right','placeholder'=>'Select Customer','readonly'])
                !!}
        </div>

        {!!  Html::decode(Form::label('event_area' ,'Event Area' ,['class'=>'col-form-label text-left']))   !!}
        <div class="input-group">
            {!!  Form::select('event_area', AccountHelper::eventArea(),null,['id'=>'event_area','class'=>'select2 form-control mb-3 custom-select float-right','placeholder'=>'Select Event Area','readonly'])
                !!}
        </div>


        {!!  Html::decode(Form::label('event_date' ,'Event Date ' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::date('event_date',null,['id'=>'event_date','class'=>'form-control ','placeholder'=>'1008','readonly']) !!}
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
            </div>
        </div>
        {!!  Html::decode(Form::label('issue_by' ,'Items/Issue By' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::select('issue_by', AccountHelper::eventArea(),null,['id'=>'issue_by','class'=>'select2 form-control mb-3 custom-select float-right','placeholder'=>'Select Event Area','readonly'])
                !!}

        </div>
        {!!  Html::decode(Form::label('issue_date' ,'Issue  Date' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::date('issue_date',null,['id'=>'issue_date','class'=>'form-control ','placeholder'=>'1008','readonly']) !!}

        </div>
    </div>
    <div class="col-lg-6">
        {!!  Html::decode(Form::label('gatepass_no' ,'Gate Pass No ' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::text('gatepass_no',null,['id'=>'phone_number','class'=>'form-control ','placeholder'=>'']) !!}
        </div>
        {!!  Html::decode(Form::label('phone_number' ,'Phone ' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::text('phone_number',null,['id'=>'phone_number','class'=>'form-control ','placeholder'=>'1008','readonly']) !!}
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-headphones"></i></span>
            </div>
        </div>
        {!!  Html::decode(Form::label('national_id_card' ,'C.N.I.C ' ,['class'=>'col-form-label text-right ml-1']))   !!}
        <div class="input-group ">
            {!!  Form::text('national_id_card',null,['id'=>'national_id_card','class'=>'form-control ','placeholder'=>'33100-1106497-4','readonly']) !!}
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
            </div>
        </div>
        {!!  Html::decode(Form::label('event_time' ,'Event Time' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::time('event_time',null,['id'=>'address','class'=>'form-control ','placeholder'=>'']) !!}

        </div>
        {!!  Html::decode(Form::label('address' ,'Adress' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::text('address',null,['id'=>'address','class'=>'form-control ','placeholder'=>'']) !!}

        </div>
        {!!  Html::decode(Form::label('receive_date' ,'Expected Receive Date' ,['class'=>'col-form-label text-right']))   !!}
        <div class="input-group ">
            {!!  Form::date('receive_date',null,['id'=>'event_date','class'=>'form-control ','placeholder'=>'','readonly']) !!}

        </div>
    </div>
</div>

<script>
    function searchBooking(){
        var booking_no = $('#booking_no').val();
        if ( booking_no == 0) {
            alert('Please select Booking No !');
            return false;
        }
        // console.log('booking number is :'+ booking_no);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'GET',
            url: "/autocomplete/booking?d=" + booking_no,
            success: function (data) {
                if($.trim(data)){
                    document.getElementById('phone_number').value = data.phone_number;
                    document.getElementById('sec_contact_no').value = data.sec_contact_no;
                    document.getElementById('national_id_card').value = data.national_id_card;
                    document.getElementById('event_area').value = data.event_area;
                    document.getElementById('address').value = data.address;
                    document.getElementById('event_date').value = data.event_date;
                    document.getElementById('event_time').value = data.event_time;
                    document.getElementById('booking_detail').value = data.booking_detail;
                    // console.log(data);
                }

            }
        });

    }
</script>
