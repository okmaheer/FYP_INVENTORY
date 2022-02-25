@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')

    @section('body')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-4">
                    <div class="card text-white bg-gradient3">
                        <div class="card-body ">
                            <blockquote class="card-bodyquote mb-0 ">
                                <h4 class="mt-0 text-white header-title">Total Confirm Events :</h4>
                                <h3 class="mt-0 font-weight-bold ">{{$confirmBooking}}</h3>
                            </blockquote>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div>
                <div class="col-lg-4">
                    <div class="card text-white bg-gradient2 ">
                        <div class="card-body">
                            <blockquote class="card-bodyquote mb-0">
                                <h4 class="mt-0  text-white header-title">Total Booked Quotations :</h4>
                                <h3 class="mt-0 font-weight-bold ">{{$bookingQuotations}}</h3>
                            </blockquote>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div>
                <div class="col-lg-4">
                    <div class="card text-white bg-gradient1 ">
                        <div class="card-body">
                            <blockquote class="card-bodyquote mb-0">
                                <h4 class="mt-0  text-white header-title">Cash In Hand :</h4>
                                <h3 class="mt-0 font-weight-bold ">{{\AccountHelper::number_format($cih->balance, 0)}}</h3>
                            </blockquote>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div>
             
            
                </div>
        


        
               
            <div class="row">

               
                <div class="col-lg-4">
                    <div class="card text-white bg-gradient4 ">
                        <div class="card-body">
                            <blockquote class="card-bodyquote mb-0">
                                <h4 class="mt-0  text-white header-title">Total Customer Dues :</h4>
                                <h3 class="mt-0 font-weight-bold ">{{\AccountHelper::number_format($due_total, 0)}}</h3>
                            </blockquote>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div>
                <div class="col-lg-4">
                    <div class="card text-white bg-gradient5 ">
                        <div class="card-body">
                            <blockquote class="card-bodyquote mb-0">
                                <h4 class="mt-0  text-white header-title">Total Supplier Dues :</h4>
                                <h3 class="mt-0 font-weight-bold ">{{\AccountHelper::number_format($supplierDue, 0)}}</h3>
                            </blockquote>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div>
                <div class="col-lg-4">
                    <div class="card text-white bg-gradient6 ">
                        <div class="card-body">
                            <blockquote class="card-bodyquote mb-0">
                                <h4 class="mt-0  text-white header-title">Total Expense This Month :</h4>
                                <h3 class="mt-0 font-weight-bold ">{{\AccountHelper::number_format($expense->balance, 0)}}</h3>
                            </blockquote>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div>

                
             
            
                </div>
        


        
                <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body new-user order-list">
                            <h4 class="header-title mt-0 mb-3">Upcoming Events List</h4>
                            <div class="table-responsive mb-0">
                                <table class="table table-striped table-hover mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="border-top-0">Booking ID</th>
                                            <th class="border-top-0">Event Site</th>
                                            <th class="border-top-0">Event Area/Hall</th>
                                            <th class="border-top-0">Event Date & Time</th>
                                            <th class="border-top-0">Persons</th>
                                            <th class="border-top-0">Total Amount</th>
                                            <th class="border-top-0">Status</th>
                                        </tr><!--end tr-->
                                    </thead>
                                    <tbody>

                                    @php $upcomingEvents = MarqueeHelper::getUpcomingEvents(); @endphp
                                    @forelse($upcomingEvents as $key => $data)
                                        <tr>
                                            <td>
                                                <a href="{{route('marquee.booking.sheet.function',$data->id)}}" target="_blank">
                                                    {{$data->custom_booking_number}}
                                                </a>
                                            <td>
                                                {{ \AccountHelper::eventArea($data->event_area) }}
                                            </td>
                                            <td>
                                                @if ($data->event_area == 1)
                                                    @foreach ($data->venue as $ven)
                                                        {{ $data->eventAreaName($ven) }}@if (!$loop->last), @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{ \AccountHelper::date_format( $data->event_date ) .' '. \MarqueeHelper::eventTime( $data->event_time ) }}</td>
                                            <td>{{$data->no_person}}</td>
                                            <td> {{ \AccountHelper::number_format($data->net_total) }}</td>
                                            <td>
                                                <span
                                                    @class([
                                                        'badge',
                                                        'badge-boxed',
                                                        'badge-soft-info' => ($data->status === 1) ,
                                                        'badge-soft-success' => ($data->status === 2),
                                                    ])
                                                >{{ \MarqueeHelper::getBookingStatuses( $data->status ) }}</span>
                                            </td>
                                        </tr><!--end tr-->

                                    @empty
                                    @endforelse
                                    </tbody>
                                </table> <!--end table-->
                            </div><!--end /div-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div><!--end row-->
            <div class="row">
              
                <div class="col-lg-4">
                    <div class="card overflow-hidden">
                        <div class="card-body bg-gradient3">
                            <div class="">
                                <div class="card-icon">
                                    <i class="far fa-smile"></i>
                                </div>
                                <h2 class="font-weight-bold text-white">58</h2>
                                <p class="text-white mb-0 font-16">Stores Very Good Review</p>
                            </div>
                        </div><!--end card-body-->
                        <div class="card-body dash-info-carousel">
                            <div id="carousel_review" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="media">
                                            <img src="{{ asset('dashboard/images/flags/us_flag.jpg') }}" class="mr-2 thumb-xs rounded-circle" alt="...">
                                            <div class="media-body align-self-center">
                                                <h6 class="m-0">USA Store</h6>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <p class="review-data mb-0">4.8<span>/ 5.0</span></p>
                                            <p class="px-4 py-1 bg-soft-success d-inline-block rounded">Very Good</p>
                                            <ul class="list-inline mb-1">
                                                <li class="list-inline-item mr-0"><i class="mdi mdi-star text-warning font-16"></i></li>
                                                <li class="list-inline-item mr-0"><i class="mdi mdi-star text-warning font-16"></i></li>
                                                <li class="list-inline-item mr-0"><i class="mdi mdi-star text-warning font-16"></i></li>
                                                <li class="list-inline-item mr-0"><i class="mdi mdi-star text-warning font-16"></i></li>
                                                <li class="list-inline-item mr-0"><i class="mdi mdi-star text-warning font-16"></i></li>
                                            </ul>
                                            <p class="mb-1 text-muted">There are many variations of passages of Lorem Ipsum available,
                                                but the majority have suffered alteration in some form, by injected humour, or randomised
                                                variations of passages of Lorem Ipsum available.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="media">
                                            <img src="{{ asset('dashboard/images/flags/spain_flag.jpg') }}" class="mr-2 thumb-xs rounded-circle" alt="...">
                                            <div class="media-body align-self-center">
                                                <h6 class="m-0">Spain Store</h6>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <p class="review-data mb-0">4.6<span>/ 5.0</span></p>
                                            <p class="px-4 py-1 bg-soft-success d-inline-block rounded">Very Good</p>
                                            <ul class="list-inline mb-1">
                                                <li class="list-inline-item mr-0"><i class="mdi mdi-star text-warning font-16"></i></li>
                                                <li class="list-inline-item mr-0"><i class="mdi mdi-star text-warning font-16"></i></li>
                                                <li class="list-inline-item mr-0"><i class="mdi mdi-star text-warning font-16"></i></li>
                                                <li class="list-inline-item mr-0"><i class="mdi mdi-star text-warning font-16"></i></li>
                                                <li class="list-inline-item mr-0"><i class="mdi mdi-star text-warning font-16"></i></li>
                                            </ul>
                                            <p class="mb-1 text-muted">There are many variations of passages of Lorem Ipsum available,
                                                but the majority have suffered alteration in some form, by injected humour, or randomised
                                                variations of passages of Lorem Ipsum available.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="media">
                                            <img src="{{ asset('dashboard/images/flags/russia_flag.jpg') }}" class="mr-2 thumb-xs rounded-circle" alt="...">
                                            <div class="media-body align-self-center">
                                                <h6 class="m-0">Russia Store</h6>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <p class="review-data mb-0">5.0<span>/ 5.0</span></p>
                                            <p class="px-4 py-1 bg-soft-success d-inline-block rounded">Exellent</p>
                                            <ul class="list-inline mb-1">
                                                <li class="list-inline-item mr-0"><i class="mdi mdi-star text-warning font-16"></i></li>
                                                <li class="list-inline-item mr-0"><i class="mdi mdi-star text-warning font-16"></i></li>
                                                <li class="list-inline-item mr-0"><i class="mdi mdi-star text-warning font-16"></i></li>
                                                <li class="list-inline-item mr-0"><i class="mdi mdi-star text-warning font-16"></i></li>
                                                <li class="list-inline-item mr-0"><i class="mdi mdi-star text-warning font-16"></i></li>
                                            </ul>
                                            <p class="mb-1 text-muted">There are many variations of passages of Lorem Ipsum available,
                                                but the majority have suffered alteration in some form, by injected humour, or randomised
                                                variations of passages of Lorem Ipsum available.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carousel_review" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel_review" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->

                <div class="col-lg-4">
                    <div class="card overflow-hidden">
                        <div class="card-body bg-gradient2">
                            <div class="">
                                <div class="card-icon">
                                    <i class="fas fa-coins"></i>
                                </div>
                                <h2 class="font-weight-bold text-white">{{ $todayClosing['balance'] }}</h2>
                                <p class="text-white mb-0 font-16">Today's Cash in Hand</p>
                            </div>
                        </div><!--end card-body-->
                        <div class="card-body">
                            <div style="min-height: 310px;">
                                <div id="today_cash_chart" class="apex-charts"></div>
                            </div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div><!--end row-->

        </div><!-- container -->

        @include('includes.dashboard-footer')
    </div>
    @endsection
@endsection
@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endsection
@section('innerScript')
<script>

    var options = {
        chart: {
            height: 250,
            type: 'donut',
        },
        series: {{ $todayClosing['chart_data'] }},
        legend: {
            show: true,
            position: 'bottom',
            horizontalAlign: 'center',
            verticalAlign: 'middle',
            floating: false,
            fontSize: '14px',
            offsetX: 0,
            offsetY: -13
        },
        labels: [ "Cash In", "Cash Out", "Cash In Hand"],
        colors: ["#f8bc60", "#f65f4d", "#00dd9f"],
        responsive: [{
            breakpoint: 600,
            options: {
                chart: {
                    height: 240
                },
                legend: {
                    show: false
                },
            }
        }],

    }

    var chart = new ApexCharts(
        document.querySelector("#today_cash_chart"), options
    );

    chart.render();
</script>
@endsection
