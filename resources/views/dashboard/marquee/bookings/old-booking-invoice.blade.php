@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')

    @section('body')

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-12 mx-auto">
                        <div class="card">
                            <div class="card-body invoice-head">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="float-right d-print-none">
                                            <a href="javascript:window.print()" class="btn btn-info text-light"><i
                                                    class="fa fa-print"></i></a>
                                            <a href="{{route('dashboard.marquee.payments.create',['bookingid'=>$model->id])}}"
                                            class="btn btn-primary text-light">Add Voucher</a>
                                            <a href="{{route('dashboard.marquee.booking.index')}}" class="btn btn-danger text-light">Back</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 align-self-center ml-3">
                                        <h4>Booking No.: 
                                            @if (!is_null($model->parent_booking_id))
                                                {{$model->parentBooking->custom_booking_number}} - 
                                            @endif
                                            {{$model->custom_booking_number}}
                                        </h4>
                                    </div>
                                </div>

                            </div><!--end card-body-->

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Customer Details</h4>
                                        <table class="table table-bordered table-sm">
                                            <tbody>
                                                <tr>
                                                    <td class="bg-light font-weight-bold col-2">Name</td>
                                                    <td class="col-4">{{ $model->customer->customer_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-light font-weight-bold col-2">Phone</td>
                                                    <td class="col-4">{{ $model->customer->customer_mobile }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-light font-weight-bold col-2">Other Phone</td>
                                                    <td class="col-4">{{ $model->customer->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-light font-weight-bold col-2">CNIC</td>
                                                    <td class="col-4">{{ $model->customer->cnic }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-light font-weight-bold col-2">Address</td>
                                                    <td class="col-4">{{ $model->customer->customer_address }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Booking Details</h4>
                                        <table class="table table-bordered table-sm">
                                            <tbody>
                                                <tr>
                                                    <td class="bg-light font-weight-bold col-2">Booking Date</td>
                                                    <td class="col-4">{{ $model->created_at }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-light font-weight-bold col-2">Event Date</td>
                                                    <td class="col-4">{{ $model->event_date }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-light font-weight-bold col-2">Event Time</td>
                                                    <td class="col-4">{{ MarqueeHelper::eventTime($model->event_time) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-light font-weight-bold col-2">Venue</td>
                                                    <td class="col-4">{{ MarqueeHelper::getVenues($model->venue) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-light font-weight-bold col-2">No. of Guests</td>
                                                    <td class="col-2">{{ $model->no_person }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-light font-weight-bold col-2">Partition</td>
                                                    <td class="col-2">{{ MarqueeHelper::isPartition($model->partition) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @if(!$model->foodItems->isEmpty())
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="text-center">Food Items</h4>
                                        <table class="table table-bordered table-striped table-sm">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="col-1">No.</th>
                                                    <th class="text-center col-3">Menu</th>
                                                    <th class="text-center col-1">Quantity</th>
                                                    <th class="text-center col-1">Rate</th>
                                                    <th class="text-center col-1">Total</th>
                                                    <th class="text-center col-1">Discount</th>
                                                    <th class="text-center col-2">Grand Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $totalFoodPrice = 0;
                                                $currentPrice = 0;
                                            @endphp
                                            @foreach($model->foodItems as $key => $menu)
                                                @php
                                                    $currentPrice = ($menu->pivot->price * $menu->pivot->quantity) - ( ($menu->pivot->discount) ? $menu->pivot->discount : 0  );
                                                    $totalFoodPrice += $currentPrice;
                                                @endphp

                                                <tr>
                                                    <td class="col-1">{{ $key+1 }}</td>
                                                    <td class="text-center col-3">{{ $menu->product_name }}</td>
                                                    <td class="text-right col-1">{{ $menu->pivot->quantity }}</td>
                                                    <td class="text-right col-1">{{ AccountHelper::number_format($menu->pivot->price) }}</td>
                                                    <td class="text-right col-1">{{ AccountHelper::number_format(($menu->pivot->price * $menu->pivot->quantity)) }}</td>
                                                    <td class="text-right col-1">{{ AccountHelper::number_format($menu->pivot->discount) }}</td>
                                                    <td class="text-right col-2">{{ AccountHelper::number_format($currentPrice) }}</td>
                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <td class="text-right font-weight-bold" colspan="6">Total Food Price</td>
                                                    <td class="text-right font-weight-bold">{{ AccountHelper::number_format($totalFoodPrice) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif

                                @if(!$model->addOnFeatures->isEmpty())
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="text-center">Addon Services</h4>
                                        <table class="table table-bordered table-striped table-sm">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="col-1">No.</th>
                                                    <th class="text-center col-3">Addon</th>
                                                    <th class="text-center col-1">Quantity</th>
                                                    <th class="text-center col-1">Rate</th>
                                                    <th class="text-center col-1"># of Hour</th>
                                                    <th class="text-center col-1">Total</th>
                                                    <th class="text-center col-1">Discount</th>
                                                    <th class="text-center col-2">Grand Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $totalAddonPrice = 0;
                                            @endphp
                                            @foreach($model->addOnFeatures as $key => $menu)
                                                @php
                                                    $currentPrice = $menu->pivot->total;
                                                    $totalAddonPrice += $currentPrice;
                                                @endphp

                                                <tr>
                                                    <td class="col-1">{{ $key+1 }}</td>
                                                    <td class="text-center col-3">{{ $menu->name }}</td>
                                                    <td class="text-right col-1">{{ $menu->pivot->quantity }}</td>
                                                    <td class="text-right col-1">{{ AccountHelper::number_format($menu->pivot->price) }}</td>
                                                    <td class="text-right col-1">{{ $menu->pivot->hourly }}</td>
                                                    <td class="text-right col-1">{{ AccountHelper::number_format($menu->pivot->net_total) }}</td>
                                                    <td class="text-right col-1">{{ AccountHelper::number_format($menu->pivot->discount) }}</td>
                                                    <td class="text-right col-2">{{ AccountHelper::number_format($currentPrice) }}</td>
                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <td class="text-right font-weight-bold" colspan="7">Total Addon Price</td>
                                                    <td class="text-right font-weight-bold">{{ AccountHelper::number_format($totalAddonPrice) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif

                                @if(!$model->seatPlannings->isEmpty())
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="text-center">Sitting Plan</h4>
                                        <table class="table table-bordered table-striped table-sm">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="col-1">No.</th>
                                                    <th class="text-center col-3">Package</th>
                                                    <th class="text-center col-1">Persons</th>
                                                    <th class="text-center col-1">Rate/Head</th>
                                                    <th class="text-center col-1">Total</th>
                                                    <th class="text-center col-1">Discount</th>
                                                    <th class="text-center col-2">Grand Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $totalSittingPrice = 0;
                                            @endphp
                                            @foreach($model->seatPlannings as $key => $menu)
                                                @php
                                                    $currentPrice = ($menu->pivot->price * $menu->pivot->quantity) - ( ($menu->pivot->discount) ? $menu->pivot->discount :0 );
                                                    $totalSittingPrice += $currentPrice;
                                                @endphp

                                                <tr>
                                                    <td class="col-1">{{ $key+1 }}</td>
                                                    <td class="text-center col-3">{{ $menu->name }}</td>
                                                    <td class="text-right col-1">{{ $menu->pivot->quantity }}</td>
                                                    <td class="text-right col-1">{{ AccountHelper::number_format($menu->pivot->price) }}</td>
                                                    <td class="text-right col-1">{{ AccountHelper::number_format(($menu->pivot->price * $menu->pivot->quantity)) }}</td>
                                                    <td class="text-right col-1">{{ AccountHelper::number_format($menu->pivot->discount) }}</td>
                                                    <td class="text-right col-2">{{ AccountHelper::number_format($currentPrice) }}</td>
                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <td class="text-right font-weight-bold" colspan="6">Total Sitting Price</td>
                                                    <td class="text-right font-weight-bold">{{ AccountHelper::number_format($totalSittingPrice) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif
                                
                                @php
                                    $i = 0;
                                    $totalPayment = 0;
                                    $transactionData = \MarqueeHelper::bookingTransactions($model->id);
                                @endphp
                                @if(!$transactionData->isEmpty())
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="text-center">Payments</h4>
                                        <table class="table table-bordered table-striped table-sm">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="col-1">No.</th>
                                                    <th class="text-center col-2">Date</th>
                                                    <th class="text-center col-6">Remarks</th>
                                                    <th class="text-center col-2">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($transactionData as $key => $data)
                                                @if($data->Credit > 0)
                                                @php
                                                    $totalPayment += $data->Credit;
                                                    $i++;
                                                @endphp
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td class="text-center">{{ $data->VDate }}</td>
                                                    <td>{{ $data->Narration }}</td>
                                                    <td class="text-right font-weight-bold">{{ AccountHelper::number_format($data->Credit) }}</td>
                                                </tr>
                                                @endif
                                            @empty
                                            @endforelse
                                                <tr>
                                                    <th colspan="3" class="text-right font-weight-bold">Total Payment</th>
                                                    <td colspan="1" class="text-right font-weight-bold">{{AccountHelper::number_format($totalPayment)}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif

                                <!-- ALL TOTAL -->
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-secondary table-sm">
                                            <tbody>
                                                <tr>
                                                    <th class="text-right font-weight-bold col-9">Total Bill</th>
                                                    <td class="text-right font-weight-bold col-2">{{AccountHelper::number_format(MarqueeHelper::bookingTotalNetAmount($model->id))}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-right font-weight-bold col-9">Total Payment Received</th>
                                                    <td class="text-right font-weight-bold col-2">{{AccountHelper::number_format($totalPayment)}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-right font-weight-bold col-9">Remaining Balance</th>
                                                    <td class="text-right font-weight-bold col-2">{{AccountHelper::number_format(MarqueeHelper::bookingTotalNetAmount($model->id) - MarqueeHelper::bookingAmountClc($model->id))}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <h5 class="mt-4">Terms And Condition :</h5>
                                        <ul class="pl-3">
                                            <li><small>All accounts are to be paid within 7 days from receipt of
                                                    invoice. </small></li>
                                            <li><small>To be paid by cheque or credit card or direct payment online.</small>
                                            </li>
                                            <li><small> If account is not paid within 7 days the credits details supplied as
                                                    confirmation<br> of work undertaken will be charged the agreed quoted
                                                    fee noted above.</small></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 align-self-end">
                                        <div class="w-25 float-right">
                                            <small>Account Manager</small>


                                            <p class="border-top">Signature</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row d-flex justify-content-center">
                                    <div class="col-lg-12 ml-auto align-self-center">
                                        <div class="text-center text-muted"><small>Thank you very much for doing business
                                                with us. Thanks !</small></div>
                                    </div>

                                </div>
                            </div>
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->

            </div><!-- container -->

            <footer class="footer text-center text-sm-left">
                &copy; 2019 Frogetor <span class="text-muted d-none d-sm-inline-block float-right">Crafted with <i
                        class="mdi mdi-heart text-danger"></i> by Mannatthemes</span>
            </footer>
        </div>

    @endsection
@endsection

@section('innerScript')

@endsection
