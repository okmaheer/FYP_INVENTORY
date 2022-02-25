@extends('layouts.dashboard')
@section('page_title')
@section('content')
    @include('includes.dashboard-breadcrumbs')
<style>
    .form-control{
        width: 70% !important;

    }
    .form-group{
        margin-bottom: 2%;
    }
    .playstorelink{
        border: 1px solid #e4e5e7;
        height: 1%;
    }
    .mask:hover{
        color: #337ab7;
    }
    .image{
        height: 62%;
    }
</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="card">

                    </div>

                            <div class="card">
                                <div class="panel-title border-grey border-bottom">
                                    <h4 class="p-3 text-success">App Settings</h4>
                                </div>
                                <div class="card-body">

                                        <div class="row text-center border-grey border-bottom pb-3">

                                            <div class="col-lg-4">
                                                <img class="image" src="http://acc.theoptimumtech.com/my-assets/image/qr/1643977733.png" alt="">
                                                <br>
                                                <span class="appsettingqrtxt">Localhost Server QR Code</span>
                                            </div>
                                            <div class="col-lg-4">
                                                <img class="image" src="http://acc.theoptimumtech.com/my-assets/image/qr/1643977733.png" alt="">
                                                   <br>
                                                 <span class="appsettingqrtxt">Online Server QR Code</span>
                                            </div>
                                            <div class="col-lg-4">
                                                <img class="image" src="http://acc.theoptimumtech.com/my-assets/image/qr/1643977733.png" alt="">
                                                <br>
                                                <span class="appsettingqrtxt">Hotspot Ip/Url QR Code</span>
                                            </div>

                                        </div>
                                <div class="row mt-3">
                                    <div class="col-sm-8">
                                        <form action="" class="form-vertical">
                                            <div class="form-group row">
                                                <label for="local_server_url" class="col-sm-4 col-form-label">
                                                    Local Server Url
                                                    <i class="text-danger"></i>
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" placeholder="Local Server Url" value="https://192.168.1.153/saleserp_9.7" name="" id="">
                                                    <span class="text-danger">http://localhost/saleserp</span>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="local_server_url" class="col-sm-4 col-form-label">
                                                    Online Server Url
                                                    <i class="text-danger"></i>
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" placeholder="Online Server Url" value="https://saleserpnew.bdtask.com/saleserp_v9.3-demo" name="" id="">
                                                    <span class="text-danger">http://bdtask.com/saleserp</span>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="local_server_url" class="col-sm-4 col-form-label">
                                                    Connected Hotspot Ip/url
                                                    <i class="text-danger"></i>
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" placeholder="Connected Hotspot Ip/url" value="https://192.168.1.167/saleserp" name="" id="">
                                                    <span class="text-danger">http://localhost/saleserp</span>

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="local_server_url" class="col-sm-4 col-form-label">

                                                </label>
                                                <div class="col-sm-6">
                                                    <input type="submit" class="btn btn-success btn-large" placeholder="Connected Hotspot Ip/url" value="Generate QR" name="" id="add-customer" tabindex="13">
                                                </div>
                                            </div>

                                        </form>

                                    </div>
                                    <div class="col-sm-4 playstorelink text-center mask">
                                        <a href="" target="blank">
                                            <h3 class="text-success">
                                                <b>Check our Sales ERP App Demo From </b>
                                                <br>
                                                <b class="text-center text-hover">Google Playstore </b>
                                            </h3>
                                        </a>
                                        <h1 class="text-center">
                                            <a href="" class="text-center text-success">
                                                <i class="fab fa-android" aria-hidden="true"></i>

                                            </a>
                                        </h1>
                                    </div>
                                </div>

                                </div>

                            </div>

                </div><!-- container -->


            </div>

        @endsection
        @endsection

