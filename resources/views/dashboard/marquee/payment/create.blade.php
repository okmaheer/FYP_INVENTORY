@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')

    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="penal-title border-grey border-bottom">
                        @if (!is_null($booking))
                            <h4 class="p-3 text-dark">Event Booking Payment Voucher</h4>
                        @elseif (!is_null($stage))
                            <h4 class="p-3 text-dark">Stage Booking Payment Voucher</h4>
                        @endif
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'dashboard.marquee.payments.store', 'method' => 'POST', 'files' => true, 'id'=>'payment_voucher_form', 'class' => 'solid-validation'] ) !!}

                        <div class="row">

                            <div class="col-md-5">
                                {!!  Form::label('voucher_no' ,'Voucher No' ,['class'=>'col-form-label text-left'])   !!}
                                <div class="input-group">
                                    {!!  Form::text('voucher_no',$vocherNo,['id'=>'voucher_no','class'=>'form-control ','placeholder'=>'CR-3','readonly']) !!}
                                </div>

                                {!!  Html::decode(Form::label('date' ,'Date<i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
                                <div class="input-group">
                                    {!!  Form::text('date', \AccountHelper::date_format(\Carbon\Carbon::today()),['id'=>'date','class'=>'form-control datepicker','required','autocomplete'=>'off', 'placeholder'=> \Carbon\Carbon::today()->format(\AccountHelper::settings()->date_format)]) !!}
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                </div>

                                {!!  Form::label('remarks' ,'Remarks' ,['class'=>'col-form-label text-left'])   !!}
                                <div class="input-group">
                                    {!! Form::textarea('remarks',null,['class' => 'form-control', 'size' => '50x2','placeholder'=>'Remarks']) !!}
                                </div>

                                {!!  Html::decode(Form::label('amount' ,'Amount<i class="text-danger">*</i>' ,['class'=>'col-form-label text-left']))   !!}
                                <div class="input-group">
                                    {!!  Form::number('amount',null,['id'=>'amount','class'=>'form-control','onkeyup'=>'applyCalculations();', 'required', 'placeholder' => '0.00', 'autocomplete' => 'off']) !!}
                                </div>
                                @if (!is_null($booking))
                                {!!  Html::decode(Form::label('discount' ,'Discount' ,['class'=>'col-form-label text-left']))   !!}
                                <div class="input-group">
                                    {!!  Form::number('discount',null,['id'=>'discount','class'=>'form-control','onkeyup'=>'applyCalculations();', 'placeholder' => '0.00']) !!}
                                </div>
                                @endif
                            </div>


                            <div class="col-md-1"></div>
                            @if (!is_null($booking))
                                {!!  Form::hidden('customer_id' , $booking->customer_option, ['id' => 'customer_id'])   !!}
                                {!!  Form::hidden('booking_id' , $booking->id)   !!}
                                {!!  Form::hidden('type' , 'booking')   !!}
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
                                                    {{ AccountHelper::number_format( MarqueeHelper::bookingAmountClc($booking->id) ) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light font-weight-bold col-3">Last Received Amount</td>
                                                <td class="col-5" id="last_received_cell">
                                                    0.00
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light font-weight-bold col-3">Remaining Balance</td>
                                                <td class="col-5">
                                                    {!!  Form::hidden('remaining', MarqueeHelper::bookingTotalNetAmount($booking->id, true) - MarqueeHelper::bookingAmountClc($booking->id), ['id'=>'remaining'])   !!}
                                                    {{ AccountHelper::number_format( MarqueeHelper::bookingTotalNetAmount($booking->id, true) - MarqueeHelper::bookingAmountClc($booking->id) )}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light font-weight-bold col-3">&nbsp;</td>
                                                <td class="col-5"></td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light font-weight-bold col-3">Current Payable</td>
                                                <td class="col-5" id="payable_cell">
                                                    {!!  Form::hidden('payable', MarqueeHelper::bookingTotalNetAmount($booking->id, true) - MarqueeHelper::bookingAmountClc($booking->id), ['id'=>'payable'])   !!}
                                                    {{ AccountHelper::number_format( MarqueeHelper::bookingTotalNetAmount($booking->id, true) - MarqueeHelper::bookingAmountClc($booking->id) )}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            @if (!is_null($stage))
                                {!!  Form::hidden('customer_id' , $stage->customer_id, ['id' => 'customer_id'])   !!}
                                {!!  Form::hidden('stage_id' , $stage->id)   !!}
                                {!!  Form::hidden('type' , 'stage')   !!}
                                <div class="col-md-6">
                                    <h5>Stage Booking Details</h5>
                                    <table class="table table-bordered table-sm" id="details">
                                        <tbody>
                                            <tr>
                                                <td class="bg-light font-weight-bold col-3">Booking No.</td>
                                                <td class="col-5">
                                                    {{ $stage->custom_stage_number }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light font-weight-bold col-3">Customer</td>
                                                <td class="col-5">
                                                    {{ $stage->customer->customer_name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light font-weight-bold col-3">&nbsp;</td>
                                                <td class="col-5"></td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light font-weight-bold col-3">Total Bill</td>
                                                <td class="col-5">
                                                    {{ AccountHelper::number_format( MarqueeHelper::stageTotalNetAmount($stage->booking_id,$stage->id) ) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light font-weight-bold col-3">Total Received</td>
                                                <td class="col-5">
                                                    {{ AccountHelper::number_format( MarqueeHelper::stageAmountClc($stage->booking_id,$stage->id) ) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light font-weight-bold col-3">Last Received Amount</td>
                                                <td class="col-5" id="last_received_cell">
                                                    0.00
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light font-weight-bold col-3">Remaining Balance</td>
                                                <td class="col-5">
                                                    {!!  Form::hidden('remaining', MarqueeHelper::stageTotalNetAmount($stage->booking_id,$stage->id) - MarqueeHelper::stageAmountClc($stage->booking_id,$stage->id), ['id'=>'remaining'])   !!}
                                                    {{ AccountHelper::number_format( MarqueeHelper::stageTotalNetAmount($stage->booking_id,$stage->id) - MarqueeHelper::stageAmountClc($stage->booking_id,$stage->id) )}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light font-weight-bold col-3">&nbsp;</td>
                                                <td class="col-5"></td>
                                            </tr>
                                            <tr>
                                                <td class="bg-light font-weight-bold col-3">Current Payable</td>
                                                <td class="col-5" id="payable_cell">
                                                    {!!  Form::hidden('payable', MarqueeHelper::stageTotalNetAmount($stage->booking_id,$stage->id) - MarqueeHelper::stageAmountClc($stage->booking_id,$stage->id), ['id'=>'payable'])   !!}
                                                    {{ AccountHelper::number_format( MarqueeHelper::stageTotalNetAmount($stage->booking_id,$stage->id) - MarqueeHelper::stageAmountClc($stage->booking_id,$stage->id) )}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>

                        @if (!is_null($booking))
                            @include('dashboard.accounts.common.buttons.buttons-crud', ['save' => true, 'save_print' => true, 'form_id' => 'payment_voucher_form', 'cancel' => true, 'cancel_route' => 'dashboard.marquee.booking.index'])
                        @endif
                        @if (!is_null($stage))
                            @include('dashboard.accounts.common.buttons.buttons-crud', ['save' => true, 'save_print' => true, 'form_id' => 'payment_voucher_form', 'cancel' => true, 'cancel_route' => 'dashboard.marquee.stage.booking.index'])
                        @endif

                        {!! Form::close() !!}
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->


            </div>
            <!-- container -->
            &nbsp;
            &nbsp;
            &nbsp;
            @include('includes.dashboard-footer')
        </div>

    @endsection
@endsection

@section('innerScriptFiles')
@endsection
@section('innerScript')

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            getCustomerBalance($('#customer_id'), "amount_balance", "last_received_cell", null)

            $('#amount').focus();
        });

        function applyCalculations() {
            let remainingBalance = 0;
            let remainingField = 0;
            let amount = 0;
            let discount = 0;

            remainingField = Number($('#remaining').val());
            amount = Number($('#amount').val());
            if ($('#discount').length) {
                discount = Number($('#discount').val());
            }
            remainingBalance = ((remainingField - amount) - discount);

            if(amount > remainingField){
                alert("Amount Always Less Than Remaining Balance");
                $('#amount').val("");
            } else {
                $('#payable').val(remainingBalance);
                $('#payable_cell').html(remainingBalance.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
            }
        }


    </script>


@endsection


