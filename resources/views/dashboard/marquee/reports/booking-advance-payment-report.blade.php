@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    @include('includes.datatable-css')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')

    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                {!! Form::open(['method' => 'GET' ,'route' => 'booking.advance.payment.report', 'files' => true] ) !!}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                {!!  Form::label('event_type' ,'Type' ,['class'=>'col-form-label'])   !!}
                                            </div>
                                            <div class="col-md-10">
                                                {!!  Form::select('event_type',['1'=>'Events', '2'=>'Stage/Decor'],request()->has('event_type')?request()->get('event_type'):null,['id'=>'event_type',
                                                    'class'=>'select2 form-control mb-3 custom-select float-right',
                                                    'placeholder'=>'Select Type', 'onchange'=>'GeCustomersOfBookingType();'])
                                                !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                {!!  Form::label('customer' ,'Customer' ,['class'=>'col-form-label'])   !!}
                                            </div>
                                            <div class="col-md-10">
                                                <select id="customer_sel" name="customer" class="form-control select2" style="width:100%"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <div class="col-md-12 text-right">
                                                {!! Form::submit('Search', array('class' => 'btn btn-primary text-white mx-1 w-sm')) !!}
                                                <a href="{{route('booking.advance.payment.report')}}" class="btn btn-primary text-white mx-1 w-sm">Clear All</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                        @include('includes.messages')  <!--ALert Message--->
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="no-sort"></th>
                                            <th class="text-center no-sort">Booking Id</th>
                                            <th>Person Name</th>
                                            <th>Booking Date</th>
                                            <th>Event Date</th>
                                            <th>Event Time</th>
                                            <th>Amount Received</th>
                                            <th>Grand Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $TotalReceive = 0; @endphp
                                    @foreach($records as $d)
                                    @php
                                        if(request()->has('event_type') && request()->get('event_type') == 2) {
                                            $TotalReceive += \MarqueeHelper::stageAmountClc(null, $d->id);
                                        } else {
                                            $TotalReceive += \MarqueeHelper::bookingAmountClc($d->id);
                                        }
                                    @endphp
                                        <tr>
                                            <td></td>
                                            <td class="text-center">
                                                @if(request()->has('event_type') && request()->get('event_type') == 2)
                                                    {{ $d->custom_stage_number }}
                                                @else
                                                    {{ $d->custom_booking_number }}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                {{ $d->customer->customer_name }}
                                            </td>
                                            <td class="text-center">
                                                {{ \AccountHelper::date_format( $d->created_at ) }}
                                            </td>
                                            <td class="text-center">
                                                {{ \AccountHelper::date_format( $d->event_date ) }}
                                            </td>
                                            <td class="text-center">
                                                @if(request()->has('event_type') && request()->get('event_type') == 2)
                                                    {{ $d->event_time }}
                                                @else
                                                    {{ \MarqueeHelper::eventTime($d->event_time) }}
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                @if(request()->has('event_type') && request()->get('event_type') == 2)
                                                    {{ \AccountHelper::number_format( \MarqueeHelper::stageAmountClc(null, $d->id) ) }}
                                                @else
                                                    {{ \AccountHelper::number_format( \MarqueeHelper::bookingAmountClc($d->id) ) }}
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                @if(request()->has('event_type') && request()->get('event_type') == 2)
                                                    {{ \AccountHelper::number_format( \MarqueeHelper::stageTotalNetAmount(null,$d->id) ) }}
                                                @else
                                                    {{ \AccountHelper::number_format( \MarqueeHelper::bookingTotalNetAmount($d->id) )}}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6"></td>
                                            <td class="text-right">
                                                <h4>Total Amount Received:</h4>
                                            </td>
                                            <td class="text-right">
                                                {{ \AccountHelper::number_format( $TotalReceive ) }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                {!! Form::close() !!}
            </div>
            @include('includes.dashboard-footer')
        </div>

    @endsection
@endsection

@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    @include('includes.datatable-js')
@endsection
@section('innerScript')
    @include('includes.datatable-init', ['table' => 'datatable'])
    <script>
        function GeCustomersOfBookingType() {
            var e_type = $('#event_type').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/autocomplete/customer_of_booking/',
                type: 'GET',
                data: {
                    event_type: e_type
                },
                success: function (data) {
                    $("#customer_sel").html(data);
                    $('#customer_row').show();
                },
                error: function (data) {
                    console.log(data);
                    $('#customer_row').hide();
                }
            });
        }

        function printPersonForm() {

            $(':input').removeAttr('placeholder');
            $('textarea').removeAttr('placeholder');
            $('input[type=number]').removeAttr('placeholder');

            let printContents = document.getElementById("printHolder").innerHTML;
            let originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
    <script>
        $(document).ready(function () {
            $('select').select2();
        });
    </script>
@endsection
