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
                    @include('dashboard.marquee.filters.childbooking_no_filter',['route'=>'dashboard.marquee.add-on-invoice.index'])
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        @include('includes.messages')  <!--ALert Message--->
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th class="no-sort"></th>
                                        <th class="no-sort text-center">Action</th>
                                        <th>ID</th>
                                        <th>Booking ID</th>
                                        <th>Person Name</th>
                                        <th>Event Date</th>
                                        <th>Event Area</th>
                                        <th>Food Items</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $d)
                                        <tr>
                                            <td></td>
                                            <td class="text-center">
                                                @if ( (\MarqueeHelper::bookingTotalNetAmount($d->parent_booking_id, true) - \MarqueeHelper::bookingAmountClc($d->parent_booking_id)) > 0 )
                                                <div class="dropdown d-inline-block">
                                                    <a class="nav-link dropdown-toggle arrow-none" id="dLabel8" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-left"
                                                         aria-labelledby="dLabel8" x-placement="top-end"
                                                         style="position: absolute; transform: translate3d(-121px, -72px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                        <a href="{{ route('dashboard.marquee.add-on-invoice.edit', $d->id) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                        <a href="javascript:void(0);" onclick="DeleteEntry({{$d->id}});" class="dropdown-item"><i class="fas fa-trash"></i> Delete Record</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="{{route('dashboard.marquee.payments.create',['bookingid'=>$d->parent_booking_id])}}" class="dropdown-item"><i class="fas fa-money-bill-alt"></i> Create Payment Voucher</a>
                                                        <a href="{{route('marquee.booking.sheet.kitchen',$d->parent_booking_id)}}" class="dropdown-item" target="_blank"><i class="fas fa-receipt"></i> View Kitchen Sheet</a>
                                                        <a href="{{route('marquee.booking.sheet.function',$d->parent_booking_id)}}" class="dropdown-item" target="_blank"><i class="fas fa-receipt"></i> View Function Sheet</a>

                                                        <form action="{{ route('dashboard.marquee.add-on-invoice.destroy',$d->id) }}" method="POST" id="deleteForm{{$d->id}}" style="display: none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                {{ $d->custom_booking_number }}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('marquee.booking.sheet.function',$d->parent_booking_id) }}" title="View Function Sheet" target="_blank">
                                                {{ $d->parentBooking->custom_booking_number }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $d->customer->customer_name }}
                                            </td>
                                            <td>
                                                {{ \AccountHelper::date_format( $d->event_date ) }}
                                            </td>
                                            <td>
                                                {{ AccountHelper::eventArea($d->event_area) }}
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm" width="200">
                                                    @if(count($d->foodItems))
                                                        @foreach($d->foodItems as $foodItem)
                                                            <option>{{ $foodItem->product_name }}</option>
                                                        @endforeach
                                                    @else
                                                        <option>No Food Item</option>
                                                    @endif
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
