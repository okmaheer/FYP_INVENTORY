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
                    @include('dashboard.marquee.filters.stage_manage_filter',['route'=>'dashboard.marquee.stage.booking.index'])
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
                                            <th>Type</th>
                                            <th>Stage Decorations</th>
                                            <th>Booking Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $d)
                                        @php $remainAmount = (\MarqueeHelper::stageTotalNetAmount($d->booking_id, $d->id) - \MarqueeHelper::stageAmountClc($d->booking_id, $d->id)); @endphp
                                        <tr>
                                            <td></td>
                                            <td class="text-center">
                                                <div class="dropdown d-inline-block">
                                                    <a class="nav-link dropdown-toggle arrow-none" id="dLabel8" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-left"
                                                         aria-labelledby="dLabel8" x-placement="top-end"
                                                         style="position: absolute; transform: translate3d(-121px, -72px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        @if ($remainAmount > 0)
                                                            @if($d->category ==  "WOB")
                                                                <a href="{{ route('stage.edit', $d->id) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                            @else
                                                            <a href="{{ route('dashboard.marquee.stage.booking.edit', $d->id) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                            @endif
                                                            <a href="javascript:void(0);" onclick="deleteRec({{$d->id}});" class="dropdown-item"><i class="fas fa-trash"></i> Delete Record</a>
                                                            <div class="dropdown-divider"></div>
                                                        @endif
                                                        @if($d->category ==  "WOB")
                                                            @if ($remainAmount > 0)
                                                                <a href="{{route('dashboard.marquee.payments.create',['stageid'=>$d->id])}}" class="dropdown-item"><i class="fas fa-money-bill-alt"></i> Create Payment Voucher</a>
                                                            @endif
                                                            <a href="{{route('stage.invoice',['id'=>$d->id])}}" class="dropdown-item" target="_blank"><i class="fas fa-receipt"></i> View Invoice</a>
                                                        @else
                                                            @if ($remainAmount > 0)
                                                                <a href="{{route('dashboard.marquee.payments.create',['bookingid'=>$d->booking_id])}}" class="dropdown-item"><i class="fas fa-money-bill-alt"></i> Create Payment Voucher</a>
                                                            @endif
                                                            <a href="{{route('marquee.booking.sheet.function',$d->booking_id)}}" class="dropdown-item" target="_blank"><i class="fas fa-receipt"></i> View Function Sheet</a>
                                                        @endif

                                                        <form action="{{ route('dashboard.marquee.stage.booking.destroy',$d->id) }}" method="POST" id="deleteForm{{$d->id}}" style="display: none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                {{ $d->custom_stage_number }}
                                            </td>
                                            <td class="text-center">
                                            @if($d->category ==  "WB")
                                                <a href="{{ route('marquee.booking.sheet.function',$d->booking_id) }}" data-toggle="tooltip" title="View Function Sheet" target="_blank">
                                                {{ $d->booking->custom_booking_number }}
                                                </a>
                                            @endif
                                            </td>
                                            <td class="text-center">
                                                {{ $d->customer->customer_name }}
                                            </td>
                                            <td class="text-center">
                                                {{ \AccountHelper::date_format( $d->event_date ) }}
                                            </td>
                                            <td class="text-center">
                                                @if($d->category  ==  "WOB")
                                                    Without Booking
                                                @else
                                                    With Booking
                                                @endif
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm" width="200">
                                                    @if(count($d->stageDecorations))
                                                        @foreach($d->stageDecorations as $stageDecoration)
                                                            <option>{{ $stageDecoration->name }} - [{{ $stageDecoration->pivot->quantity }}]</option>
                                                        @endforeach
                                                    @else
                                                        <option>No Stage Decoration</option>
                                                    @endif
                                                </select>
                                            </td>
                                            <td>{{ \AccountHelper::date_format( $d->created_at ) }}</td>
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
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.marquee.stage.booking.create'])
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
