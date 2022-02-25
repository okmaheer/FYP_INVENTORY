@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
@section('innerStyleSheet')
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
    @include('includes.dashboard-breadcrumbs')
<style>

    .company-txt{
        font-size: 24px;
        font-weight: bold;
    }




</style>
@section('body')
            <div class="page-content">

                <div class="container-fluid">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">


                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group row">
                                                    <div class="col-sm-5">
                                                        <label for="example-text-input" class=" col-form-label text-right">Start Date</label>
                                                    </div>

                                                    <div class="col-sm-7">
                                                        <input class="form-control" type="date" value="2020-03-15" id="example-text-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group row">
                                                    <div class="col-sm-5">
                                                    <label for="example-search-input" class="col-form-label text-right">End Date</label>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <input class="form-control" type="date" value="2021-04-12" id="example-search-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group row">
                                                    <div class="col-sm-7">
                                                    <label for="example-search-input" class="col-form-label text-right">Invoice No/Service Id</label>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <input class="form-control" type="text"  id="example-search-input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 text-right">
                                                <div class="form-group row">
                                                    <button class="btn btn-primary">Search</button>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 text-right">
                                                <div class="form-group row">
                                                    <button class="btn btn-primary">Print</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--end card-body-->

                                <!--end card-->
                            </div>
                        </div>
                        <div class="col-lg-12">

                            <div class="card">
                                <div class="penal-tilte  border-grey border-bottom">
                                    <h4 class="p-3 text-success">Tax Report</h4>
                                    </div>
                                    <div class="container">
                                        <table class="table table-bordered mt-3" cellpadding="6" cellspacing="1" width="100%">
                                            <div class="table-title">

                                                <tbody>

                                                    <tr>
                                                        <td class="text-center"><b>SL.</b> </td>
                                                        <td class="text-center"><b>Invoice No/Service Id</b></td>
                                                        <td class="text-center"><b>Date</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="text-center">No Result Found</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="text-right"><b>Total</b></td>
                                                    </tr>

                                                </tbody>



                                            </div>

                                        </table>
                                    </div>

                            </div>
                        </div>
                    </div>



                </div><!-- container -->

               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection



