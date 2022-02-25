@extends('layouts.dashboard')
@section('page_title')
@section('content')
@include('includes.dashboard-breadcrumbs')
<style>

    .text-center{
        margin-left: 110%;
        position: relative;
    }
    .alert-success {
        font-size:18px;
        line-height: 28px;
    }

</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">

                        <div class="card">

                            <div class="card-body">
                                        <div class="form-group col-lg-4 col-sm-offset-4 text-right">
                                                <div class="col-lg-12 text-center">
                                                    <div class="alert alert-success " >
                                                       Current Version
                                                       <br>
                                                       V-9.8
                                                    </div>
                                                </div>
                                        </div>
                            </div>
                        </div>

                        <!-- container -->

               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection

