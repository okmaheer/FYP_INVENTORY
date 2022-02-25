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

        <div class="card">
            @include('dashboard.marquee.filters.booking_reports_filter',['route'=>'booking.report'])
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                @include('includes.messages')  <!--ALert Message--->
                    <div class="card-body">
                        <section id="printHolder">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th class="no-sort"></th>
                                    <th class="text-center">Booking Id</th>
                                    <th>Person Name</th>
                                    <th>Event Date</th>
                                    <th>Event Area</th>
                                    <th>Status</th>
                                    <th>Booking Total</th>
                                    <th>Received Amount</th>
                                    <th>Due Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $net_total = 0;
                                $paid_total = 0;
                                $due_total = 0;
                            @endphp
                            @foreach($data as $d)
                                <tr @class(['bg-soft-danger' => ($d->status == 3)])>
                                    <td></td>
                                    <td class="text-center">
                                        @if ($d->status != 3)
                                            <a href="{{ route('marquee.booking.sheet.function', $d->id) }}" target="_blank">
                                                {{ $d->custom_booking_number }}
                                            </a>
                                        @else
                                            {{ $d->custom_booking_number }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $d->customer->customer_name }}
                                    </td>
                                    <td class="text-center">
                                        {{ \AccountHelper::date_format( $d->event_date ) }}
                                    </td>
                                    <td class="text-center">
                                        {{ AccountHelper::eventArea($d->event_area) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $d->status != 3 ? \MarqueeHelper::getBookingStatuses($d->status) : 'Cancelled' }}
                                    </td>
                                    <td class="text-right">
                                        {{ \AccountHelper::number_format( \MarqueeHelper::bookingTotalNetAmount( $d->id) ) }}
                                        @php $net_total += \MarqueeHelper::bookingTotalNetAmount( $d->id); @endphp
                                    </td>
                                    <td class="text-right">
                                        {{ \AccountHelper::number_format( \MarqueeHelper::bookingAmountClc( $d->id) ) }}
                                        @php $paid_total += \MarqueeHelper::bookingAmountClc( $d->id); @endphp
                                    </td>
                                    <td class="text-right">
                                        {{ \AccountHelper::number_format( (\MarqueeHelper::bookingTotalNetAmount( $d->id) - \MarqueeHelper::bookingAmountClc( $d->id) ) ) }}
                                        @php $due_total += (\MarqueeHelper::bookingTotalNetAmount( $d->id) - \MarqueeHelper::bookingAmountClc( $d->id) ); @endphp
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-soft-dark">
                                    <td colspan="6" class="text-right font-weight-bold">Total:</td>
                                    <td class="text-right font-weight-bold">{{ \AccountHelper::number_format( $net_total ) }}</td>
                                    <td class="text-right font-weight-bold">{{ \AccountHelper::number_format( $paid_total ) }}</td>
                                    <td class="text-right font-weight-bold">{{ \AccountHelper::number_format( $due_total ) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                        </section>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div><!-- container -->
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
            $(document).ready(function () {
                $('.select2').select2();
            });
        </script>
    @endsection
