@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')
    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    @include('includes.messages')
                    <div class="penal-title border-grey border-bottom">
                        <h4 class="p-3 text-dark">Event Booking Cancellation</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'marquee.booking.cancel.save', 'method' => 'POST', 'files' => true, 'id' => 'cancel_form'] ) !!}
                        <div class="row">
                            <div class="col-md-5">
                                {!!  Form::hidden('customer_id' , $booking->customer_option, ['id' => 'customer_id'])   !!}
                                {!!  Form::hidden('booking_id' , $booking->id)   !!}

                                {!!  Html::decode(Form::label('cancel_date' ,'Date<i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
                                <div class="input-group">
                                    {!!  Form::text('cancel_date', \AccountHelper::date_format(\Carbon\Carbon::today()),['class'=>'form-control', 'readonly', 'tabindex'=>'-1']) !!}
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                </div>

                                {!!  Html::decode(Form::label('cancel_type' ,'Cancellation Type<i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
                                <div class="form-group">
                                    {!!  Form::select('cancel_type',\MarqueeHelper::EventCancelType() ,null,['id'=>'cancel_type','class'=>'form-control select2', 'width'=>'100%','placeholder'=>'Select Cancellation Type', 'required', 'onchange'=>'ChangeCancelType();']) !!}
                                </div>

                                <div id="refund_options" style="display: none;">
                                    {!!  Html::decode(Form::label('refund_type' ,'Refund Type' ,['class'=>'col-form-label text-left']))   !!}
                                    <div class="form-group">
                                        {!!  Form::select('refund_type',\MarqueeHelper::EventRefundType() ,null,['id'=>'refund_type','class'=>'form-control select2', 'width'=>'100%','placeholder'=>'Select Refund Type', 'onchange'=>'applyCalculation();']) !!}
                                    </div>

                                    {!!  Html::decode(Form::label('refund_value' ,'Refund Value' ,['class'=>'col-form-label text-left']))   !!}
                                    <div class="form-group">
                                        {!!  Form::number('refund_value',null,['id'=>'refund_value', 'min'=>'1', 'step'=>'any', 'class'=>'form-control', 'placeholder'=>'0.00', 'onkeyup'=>'applyCalculation();']) !!}
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            {!!  Html::decode(Form::label('refund_amount' ,'Amount Refundable' ,['class'=>'col-form-label']))   !!}
                                            <div class="form-group">
                                                {!!  Form::number('refund_amount',null,['id'=>'refund_amount','class'=>'form-control text-right', 'placeholder'=>'0.00', 'readonly', 'tabindex'=>'-1']) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-5">
                                            {!!  Html::decode(Form::label('refund_remain' ,'Amount Non-Refundable' ,['class'=>'col-form-label']))   !!}
                                            <div class="form-group">
                                                {!!  Form::number('refund_remain',null,['id'=>'refund_remain','class'=>'form-control text-right', 'placeholder'=>'0.00', 'readonly', 'tabindex'=>'-1']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!!  Form::label('canceled_remarks' ,'Remarks' ,['class'=>'col-form-label text-left'])   !!}
                                <div class="input-group">
                                    {!! Form::textarea('canceled_remarks',null,['class' => 'form-control', 'size' => '50x2','placeholder'=>'Remarks']) !!}
                                </div>

                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-6">
                                <h5>Booking Details</h5>
                                <table class="table table-bordered table-sm" id="details">
                                    <tbody>
                                        <tr>
                                            <td class="bg-light font-weight-bold col-3">Booking No.</td>
                                            <td class="col-5">
                                                {{ $booking->custom_booking_number }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light font-weight-bold col-3">Customer</td>
                                            <td class="col-5">
                                                {{ $booking->customer->customer_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light font-weight-bold col-3">&nbsp;</td>
                                            <td class="col-5"></td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light font-weight-bold col-3">Total Bill</td>
                                            <td class="col-5">
                                                {{ AccountHelper::number_format( MarqueeHelper::bookingTotalNetAmount($booking->id, true) ) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light font-weight-bold col-3">Total Received</td>
                                            <td class="col-5">
                                                {!!  Form::hidden('refund_total', MarqueeHelper::bookingAmountClc($booking->id), ['id'=>'refund_total'])   !!}
                                                {{ AccountHelper::number_format( MarqueeHelper::bookingAmountClc($booking->id) ) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bg-light font-weight-bold col-3">Remaining Balance</td>
                                            <td class="col-5">
                                                {!!  Form::hidden('remaining', MarqueeHelper::bookingTotalNetAmount($booking->id, true) - MarqueeHelper::bookingAmountClc($booking->id), ['id'=>'remaining'])   !!}
                                                {{ AccountHelper::number_format( MarqueeHelper::bookingTotalNetAmount($booking->id, true) - MarqueeHelper::bookingAmountClc($booking->id) )}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @include('dashboard.accounts.common.buttons.buttons-crud', ['save'=>true, 'save_print'=> true, 'form_id'=>'cancel_form', 'cancel'=>true, 'cancel_route'=>'dashboard.marquee.booking.index'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            @include('includes.dashboard-footer')
        </div>
    @endsection
@endsection

@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        $(document).ready(function () {
            $('.select2').select2();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            getCustomerBalance($('#customer_id'), "amount_balance", "last_received_cell", null)
        });

        function ChangeCancelType() {
            let cancel_type = $('#cancel_type').val();
            if (cancel_type == '1') {
                $('#refund_options').hide();

                $('#refund_type').attr('required', false);
                $('#refund_value').attr('required', false);

            } else {
                $('#refund_type').attr('required', true);
                $('#refund_value').attr('required', true);

                $('#refund_options').show();
                $('#refund_type').select2('destroy');
                $('#refund_type').select2();

            }
        }

        function applyCalculation() {
            let received_amount = Number($('#refund_total').val());
            let refund_type = $('#refund_type').val();
            let refund_value = Number($('#refund_value').val());
            let refund_amount = 0;
            let non_refund_amount = 0;

            if (refund_type == '1') { //Fixed
                refund_amount = refund_value;
                non_refund_amount = received_amount - refund_amount;
            } else {
                refund_amount = (received_amount * refund_value) / 100;
                non_refund_amount = received_amount - refund_amount;
            }
            $('#refund_amount').val(refund_amount);
            $('#refund_remain').val(non_refund_amount);
        }
    </script>
@endsection
