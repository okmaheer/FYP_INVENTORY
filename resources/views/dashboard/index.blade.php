@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
<link rel="stylesheet" href="{{ url('dashboard/plugins/dropify/css/dropify.min.css') }}">
<link href="{{ url('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
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
                                    <h5 class="mt-0 font-weight-bold text-dark">{{ $product }}</h5>
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
                                    <h5 class="mt-0 font-weight-bold text-dark">{{ $purchase }} Rs</h5>
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
                                                <h5 class="mt-0 font-weight-bold text-dark">{{ $purchase }} Rs</h5>
                                                <p class="mb-1 text-muted"><span class="text-success"><i class="mdi mdi-arrow-up"></i>35.5%</span> More than Last Month</p>
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
                                                <h5 class="mt-0 font-weight-bold text-dark">{{ $unit }}</h5>
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
                                                <h5 class="mt-0 font-weight-bold text-dark">{{ $category }}</h5>
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
                                                <h5 class="mt-0 font-weight-bold text-dark">{{ $supplier }}</h5>
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

        
    </div><!-- container -->

   @include('includes.dashboard-footer')
</div>
@endsection 
@endsection
