@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/dropify/css/dropify.min.css') }}">
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@include('includes.dashboard-breadcrumbs')

@section('body')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body mb-0">
                        <div class="row">
                            <div class="col-8 align-self-center">
                                <div class="">
                                    <h4 class="mt-0 header-title">Total Products</h4>
                                    <h2 class="mt-0 font-weight-bold text-dark">40</h2>
                                    <p class="mb-0 text-muted"><span class="text-success"><i class="mdi mdi-arrow-up"></i>14.5%</span> Up From Last Week</p>
                                </div>
                            </div><!--end col-->
                            <div class="col-4 align-self-center">
                                <div class="icon-info text-right">
                                    <i class="dripicons-jewel bg-soft-pink"></i>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end card-body-->
                    <div class="card-body overflow-hidden p-0">
                        <div class="d-flex mb-0 h-100 dash-info-box">
                            <div class="w-100">
                                <div class="apexchart-wrapper">
                                    <div id="dash_spark_1" class="chart-gutters"></div>
                                </div>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body mb-0">
                        <div class="row">
                            <div class="col-8 align-self-center">
                                <div class="">
                                    <h4 class="mt-0 header-title">Total Spendings</h4>
                                    <h2 class="mt-0 font-weight-bold text-dark">$909</h2>
                                    <p class="mb-0 text-muted"><span class="text-success"><i class="mdi mdi-arrow-up"></i>14.5%</span> Up from Last Month</p>
                                </div>
                            </div><!--end col-->
                            <div class="col-4 align-self-center">
                                <div class="icon-info text-right">
                                    <i class="dripicons-wallet bg-soft-success"></i>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end card-body-->
                    <div class="card-body overflow-hidden p-0">
                        <div class="d-flex mb-0 h-100 dash-info-box">
                            <div class="w-100">
                                <div class="apexchart-wrapper">
                                    <div id="apex_column1" class="chart-gutters"></div>
                                </div>
                            </div>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
            <div class="col-lg-4">
                <div class="card carousel-bg-img">
                    <div class="card-body dash-info-carousel mb-0">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-12 align-self-center">
                                            <div class="text-center">
                                                <h4 class="mt-0 header-title text-left">Total Purchase</h4>
                                                <div class="icon-info my-3">
                                                <i class="dripicons-cart bg-soft-warning"></i>
                                                </div>
                                                <h2 class="mt-0 font-weight-bold text-dark">500</h2>
                                                <p class="mb-1 text-muted"><span class="text-success"><i class="mdi mdi-arrow-up"></i>35.5%</span> More than Last Month</p>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div><!--end carousel-item-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-12 align-self-center">
                                            <div class="text-center">
                                                <h4 class="mt-0 header-title text-left">New Orders</h4>
                                                <div class="icon-info my-3">
                                                    <i class="dripicons-basket bg-soft-info"></i>
                                                </div>
                                                <h2 class="mt-0 font-weight-bold text-dark">182</h2>
                                                <p class="mb-1 text-muted"><span class="text-danger"><i class="mdi mdi-arrow-down"></i>1.5%</span> Down From Last week</p>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div><!--end carousel-item-->

                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-12 align-self-center">
                                            <div class="text-center">
                                                <h4 class="mt-0 header-title text-left">Total Units</h4>
                                                <div class="icon-info my-3">
                                                    <i class="dripicons-swap bg-soft-primary"></i>
                                                </div>
                                                <h2 class="mt-0 font-weight-bold text-dark">5</h2>
                                                <p class="mb-1 text-muted">Current Units Available</p>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div><!--end carousel-item-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-12 align-self-center">
                                            <div class="text-center">
                                                <h4 class="mt-0 header-title text-left">Total Categories</h4>
                                                <div class="icon-info my-3">
                                                    <i class="dripicons-store bg-soft-warning"></i>
                                                </div>
                                                <h2 class="mt-0 font-weight-bold text-dark">10</h2>
                                                <p class="mb-1 text-muted">Current Product Categories</p>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div><!--end carousel-item-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-12 align-self-center">
                                            <div class="text-center">
                                                <h4 class="mt-0 header-title text-left">Total Suppliers</h4>
                                                <div class="icon-info my-3">
                                                    <i class="dripicons-user-group bg-soft-success"></i>
                                                </div>
                                                <h2 class="mt-0 font-weight-bold text-dark">35</h2>
                                                <p class="mb-1 text-muted"><span class="text-success"><i class="mdi mdi-arrow-up"></i>11.1%</span> Up from yesterday</p>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div><!--end carousel-item-->
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body new-user order-list">
                        <h4 class="header-title mt-0 mb-3">Order List</h4>
                        <div class="table-responsive mb-0">
                            <table class="table table-striped table-hover mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="border-top-0">Product</th>
                                        <th class="border-top-0">Pro Name</th>
                                        <th class="border-top-0">Country</th>
                                        <th class="border-top-0">Order Date/Time</th>
                                        <th class="border-top-0">Pcs.</th>
                                        <th class="border-top-0">Amount ($)</th>
                                        <th class="border-top-0">Status</th>
                                    </tr><!--end tr-->
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img class="" src="{{ asset('dashboard/images/products/img-1.png') }}" alt="user"> </td>
                                        <td>
                                            Beg
                                        </td>
                                        <td>
                                            <img src="{{ asset('dashboard/images/flags/us_flag.jpg') }}" alt="" class="img-flag thumb-xxs rounded-circle">
                                        </td>
                                        <td>3/03/2019 4:29 PM</td>
                                        <td>200</td>
                                        <td> $750</td>
                                        <td>
                                            <span class="badge badge-boxed  badge-soft-success">Shipped</span>
                                        </td>
                                    </tr><!--end tr-->
                                    <tr>
                                        <td>
                                            <img class="" src="{{ asset('dashboard/images/products/img-2.png') }}" alt="user"> </td>
                                        <td>
                                            Watch
                                        </td>
                                        <td>
                                            <img src="{{ asset('dashboard/images/flags/french_flag.jpg') }}" alt="" class="img-flag thumb-xxs rounded-circle">
                                        </td>
                                        <td>13/03/2019 1:09 PM</td>
                                        <td>180</td>
                                        <td> $970</td>
                                        <td>
                                            <span class="badge badge-boxed  badge-soft-danger">Delivered</span>
                                        </td>
                                    </tr><!--end tr-->
                                    <tr>
                                        <td>
                                            <img class="" src="{{ asset('dashboard/images/products/img-3.png') }}" alt="user"> </td>
                                        <td>
                                            Headphone
                                        </td>
                                        <td>
                                            <img src="{{ asset('dashboard/images/flags/spain_flag.jpg') }}" alt="" class="img-flag thumb-xxs rounded-circle">
                                        </td>
                                        <td>22/03/2019 12:09 PM</td>
                                        <td>30</td>
                                        <td> $2800</td>
                                        <td>
                                            <span class="badge badge-boxed badge-soft-warning">Pending</span>
                                        </td>
                                    </tr><!--end tr-->
                                    <tr>
                                        <td>
                                            <img class="" src="{{ asset('dashboard/images/products/img-4.png') }}" alt="user"> </td>
                                        <td>
                                            Purse
                                        </td>
                                        <td>
                                            <img src="{{ asset('dashboard/images/flags/russia_flag.jpg') }}" alt="" class="img-flag thumb-xxs rounded-circle">
                                        </td>
                                        <td>14/03/2019 8:27 PM</td>
                                        <td>100</td>
                                        <td> $520</td>
                                        <td>
                                            <span class="badge badge-boxed  badge-soft-success">Shipped</span>
                                        </td>
                                    </tr><!--end tr-->
                                    <tr>
                                        <td>
                                            <img class="" src="{{ asset('dashboard/images/products/img-5.png') }}" alt="user"> </td>
                                        <td>
                                            Shoe
                                        </td>
                                        <td>
                                            <img src="{{ asset('dashboard/images/flags/italy_flag.jpg') }}" alt="" class="img-flag thumb-xxs rounded-circle">
                                        </td>
                                        <td>18/03/2019 5:09 PM</td>
                                        <td>100</td>
                                        <td> $1150</td>
                                        <td>
                                            <span class="badge badge-boxed badge-soft-warning">Pending</span>
                                        </td>
                                    </tr><!--end tr-->
                                    <tr>
                                        <td>
                                            <img class="" src="{{ asset('dashboard/images/products/img-6.png') }}" alt="user"> </td>
                                        <td>
                                            Boll
                                        </td>
                                        <td>
                                            <img src="{{ asset('dashboard/images/flags/us_flag.jpg') }}" alt="" class="img-flag thumb-xxs rounded-circle">
                                        </td>
                                        <td>30/03/2019 4:29 PM</td>
                                        <td>140</td>
                                        <td> $ 650</td>
                                        <td>
                                            <span class="badge badge-boxed  badge-soft-success">Shipped</span>
                                        </td>
                                    </tr><!--end tr-->
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
                    <div class="card-body bg-gradient1">
                        <div class="">
                            <div class="card-icon">
                                <i class="far fa-user"></i>
                            </div>
                            <h2 class="font-weight-bold text-white">10</h2>
                            <p class="text-white mb-0 font-16">Top 10 Best Saler This Month</p>
                        </div>
                    </div>
                    <div class="card-body dash-info-carousel">
                        <div id="carousel_best_saler" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="text-center">
                                        <img src="{{ asset('dashboard/images/users/user-4.jpg') }}" alt="user" class="rounded-circle thumb-xl img-thumbnail mb-1">
                                        <h5>Nancy Flanary</h5>
                                        <p class="font-12 text-muted"><i class="fas fa-globe mr-2"></i>USA Dealer</p>
                                        <p class="mb-0 text-muted">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin.</p>
                                        <div class="mt-2 align-item-center">
                                            <h5 class="font-20 d-inline-block mb-0 mr-3 align-self-center">$34800.00</h5>
                                            <a class="btn btn-sm btn-primary text-light mb-2"><i class="mdi mdi-email-outline mr-1"></i>Message</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="text-center">
                                        <img src="{{ asset('dashboard/images/users/user-2.jpg') }}" alt="user" class="rounded-circle thumb-xl img-thumbnail mb-1">
                                        <h5>Donald Gardner</h5>
                                        <p class="font-12 text-muted"><i class="fas fa-globe mr-2"></i>Russia Dealer</p>
                                        <p class="mb-0 text-muted">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin.</p>
                                        <div class="mt-2 align-item-center">
                                            <h5 class="font-20 d-inline-block mb-0 mr-3 align-self-center">$31200.00</h5>
                                            <a class="btn btn-sm btn-primary text-light mb-2"><i class="mdi mdi-email-outline mr-1"></i>Message</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="text-center">
                                        <img src="{{ asset('dashboard/images/users/user-1.jpg') }}" alt="user" class="rounded-circle thumb-xl img-thumbnail mb-1">
                                        <h5>Matt Rosales</h5>
                                        <p class="font-12 text-muted"><i class="fas fa-globe mr-2"></i>Spain Dealer</p>
                                        <p class="mb-0 text-muted">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin.</p>
                                        <div class="mt-2 align-item-center">
                                            <h5 class="font-20 d-inline-block mb-0 mr-3 align-self-center">$29200.00</h5>
                                            <a class="btn btn-sm btn-primary text-light mb-2"><i class="mdi mdi-email-outline mr-1"></i>Message</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carousel_best_saler" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel_best_saler" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->

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
                            <h2 class="font-weight-bold text-white">$85750.00</h2>
                            <p class="text-white mb-0 font-16">Total payments</p>
                        </div>
                    </div><!--end card-body-->
                    <div class="card-body">
                        <div class="">
                            <div id="d1_payment" class="apex-charts"></div>
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
