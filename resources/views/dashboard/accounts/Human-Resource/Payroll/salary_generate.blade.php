@extends('layouts.dashboard')
@section('page_title')
@section('content')
@include('includes.dashboard-breadcrumbs')
<style>
   .col-sm-2::selection{
        color: #fff;
        background-color: #37a000;
    }
    .text-success::selection{
        color: #fff;
        background-color: #37a000;

    }

</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">

                        <div class="card text-center">

                            <div class="card-body">

                                <div class="general-label container">
                                    <form>
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                            <label for="horizontalInput2" class=" col-form-label">{{ __('accounts.payroll.s_month') }} <i class="text-danger"> *</i></label>
                                            </div>
                                            <div class="col-sm-10">

                                                 <input type="text" class="form-control"  id="horizontalInput1" >
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <button type="submit" class="btn btn-success">Reset</button>
                                                <button type="submit" class="btn btn-success">Save</button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->

                </div><!-- container -->

               @include('includes.dashboard-footer')
            </div>
            <!-- end page content -->
            </div>
            <!--end page-wrapper-inner -->

        </div>
        <!-- end page-wrapper -->
        @endsection

