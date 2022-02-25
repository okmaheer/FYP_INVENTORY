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
                <div class="card" style="width: 99%;">
                    @include('dashboard.marquee.filters.booking_no_filter',['route'=>'dashboard.marquee.booking.index'])
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="width: 99%;">
                        @include('includes.messages')  <!--ALert Message--->
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive "
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th class="no-sort"></th>
                                        <th class="no-sort text-center">Actions</th>
                                        <th class="text-center">Booking Id</th>
                                        <th>Person Name</th>
                                        <th>Event Date</th>
                                        <th>Event Site</th>
                                        <th># of Persons</th>
                                        <th>Food Items</th>
                                        <th>Booking Date</th>
                                        <th>Quotation #</th>
                                        <th>Addon Booking</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $d)
                                        <tr @class(['bg-soft-danger' => ($d->status == 3)])>
                                            <td></td>
                                            <td class="text-center">
                                                @if ($d->status != 3)
                                                    <div class="dropdown d-inline-block">
                                                    <a class="nav-link dropdown-toggle arrow-none" id="dLabel8" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-left"
                                                         aria-labelledby="dLabel8" x-placement="top-end"
                                                         style="position: absolute; transform: translate3d(-121px, -72px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        @if ( (\MarqueeHelper::bookingTotalNetAmount($d->id, true) - \MarqueeHelper::bookingAmountClc($d->id)) > 0 )
                                                            <a href="{{ route('dashboard.marquee.booking.edit', $d->id) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                            <a href="javascript:void(0);" onclick="DeleteEntry({{$d->id}});" class="dropdown-item"><i class="fas fa-trash"></i> Delete Record</a>
                                                            <div class="dropdown-divider"></div>
                                                        @endif
                                                        @if ($d->status == 2)
                                                            @if ( (\MarqueeHelper::bookingTotalNetAmount($d->id, true) - \MarqueeHelper::bookingAmountClc($d->id)) > 0 )
                                                                <a href="{{ route('marquee.booking.cancel', ['bookingID'=>$d->id]) }}" class="dropdown-item"><i class="fas fa-ban text-danger"></i> Cancel Event</a>
                                                                <div class="dropdown-divider"></div>
                                                                    <a href="{{route('dashboard.marquee.payments.create',['bookingid'=>$d->id])}}" class="dropdown-item"><i class="fas fa-money-bill-alt"></i> Create Payment Voucher</a>
                                                            @endif
                                                            <a href="{{route('marquee.booking.sheet.kitchen',$d->id)}}" class="dropdown-item" target="_blank"><i class="fas fa-receipt"></i> View Kitchen Sheet</a>
                                                                <a href="{{route('marquee.booking.sheet.customer',$d->id)}}" class="dropdown-item" target="_blank"><i class="fas fa-receipt"></i> View Customer Sheet</a>
                                                            <a href="{{route('marquee.booking.sheet.function',$d->id)}}" class="dropdown-item" target="_blank"><i class="fas fa-receipt"></i> View Function Sheet</a>
                                                            <a href="{{route('marquee.booking.final.invoice',$d->id)}}" class="dropdown-item" target="_blank"><i class="fas fa-receipt"></i> View Final Invoice</a>
                                                            @if ( (\MarqueeHelper::bookingTotalNetAmount($d->id, true) - \MarqueeHelper::bookingAmountClc($d->id)) > 0 )
                                                                <a href="{{route('dashboard.marquee.booking.demand.create',['id'=>$d->id])}}" class="dropdown-item"><i class="fas fa-money-bill-alt"></i> Create Demand</a>
                                                                @if (is_null($d->stage))
                                                                    <a href="{{route('dashboard.marquee.stage.booking.create',['id'=>$d->id])}}" class="dropdown-item"><i class="fas fa-plus"></i> Create Stage Booking</a>
                                                                @endif
                                                                <a href="{{route('dashboard.marquee.add-on-invoice.create',['id'=>$d->id])}}" class="dropdown-item"><i class="fas fa-receipt"></i> Create Addon Booking</a>
                                                            @endif
                                                            <form action="{{ route('dashboard.marquee.booking.destroy',$d->id) }}" method="POST" id="deleteForm{{$d->id}}" style="display: none">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                {{ $d->custom_booking_number }}
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
                                                {{ $d->no_person }}
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
                                            <td>{{ \AccountHelper::date_format($d->created_at) }}</td>
                                            <td>
                                                @if (!empty($d->quotation))
                                                    <a href="{{route('view.quotation.booking',$d->quotation->id)}}" target="_blank">{{ $d->quotation->quot_number }}</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if (!empty($d->addonBooking))
                                                    <a href="{{route('marquee.booking.sheet.function',$d->id)}}" target="_blank">{{ $d->addonBooking->custom_booking_number }}</a>
                                                @endif
                                            </td>
                                            {{--<td>
                                                <a href="{{route('dashboard.marquee.payments.create',['bookingid'=>$d->id])}}" class="btn btn-xs btn-primary text-white tippy-btn" title="Creat Voucher!" data-tippy-duration="1000"><i class="fas fa-money-bill-alt"></i></a>
                                                <a href="{{route('invoice.id.search',$d->id)}}" class="btn btn-xs btn-primary text-white  tippy-btn" title="View Invoice!"><i class="fas fa-receipt"></i></a>
                                                <a href="{{route('dashboard.marquee.booking.demand.create',['id'=>$d->id])}}" class="btn btn-xs btn-primary text-white tippy-btn" title="Auto Demand!" data-tippy-duration="1000"><i class="fas fa-money-bill-alt"></i></a>
                                                @if (is_null($d->stage))
                                                    <a href="{{route('dashboard.marquee.stage.booking.create',['id'=>$d->id])}}" class="btn btn-xs btn-primary text-white tippy-btn" title="Create Stage Booking"><i class="fas fa-plus"></i></a>
                                                @endif
                                                <a href="{{route('dashboard.marquee.add-on-invoice.create',['id'=>$d->id])}}" class="btn btn-xs btn-primary text-white  tippy-btn" title="Create Addon Booking"><i class="fas fa-receipt"></i></a>
                                                <a href="{{route('dashboard.marquee.booking.edit',$d->id)}}" class="btn btn-xs btn-primary text-white  tippy-btn" title="Edit Record!"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="javascript:void(0);" onclick="deleteRec({{$d->id}});" class="btn btn-xs btn-primary text-white tippy-btn" title="Delete Record!"><i class="fas fa-trash"></i></a>
                                                <form action="{{ route('dashboard.marquee.booking.destroy',$d->id) }}" method="POST" id="deleteForm{{$d->id}}" style="display: none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>--}}
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
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.marquee.booking.create'])
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
