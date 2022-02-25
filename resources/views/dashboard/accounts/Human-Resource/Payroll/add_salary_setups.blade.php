@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@include('includes.dashboard-breadcrumbs')
<style>

</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">


                        <div class="card">

                            <div class="card-body">

                                <div class="general-label">
                                    <form>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                            <label for="horizontalInput2" class=" col-form-label">{{ __('accounts.payroll.name') }}<i class="text-danger"> *</i></label>
                                            </div>
                                            <div class="col-sm-10">
                                                <select class="select2 form-control mb-3 custom-select float-right" >
                                                    <option>Select Option</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                            <label for="horizontalInput1" class=" col-form-label">{{ __('accounts.payroll.s_type') }}<i class="text-danger"> *</i></label>
                                            </div>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"  id="horizontalInput1" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-lg-6">
                                            <table class="border" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td class=" text-center">
                                                            <h4 class="payrolladditiondeduction paddingtop30">{{ __('accounts.payroll.addition') }}</h4>
                                                            <br>
                                                            <table id="add">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="padding10">{{ __('accounts.payroll.basic') }}</td>
                                                                        <td><input type="text" name="basic" id="basic" class="fomr-control" disabled></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-lg-6">
                                            <table class="border" width="100%">
                                                <tbody>
                                                        <tr>
                                                            <td class="text-center">
                                                                <h4 class="payrolladditiondeduction paddingtop30">{{ __('accounts.payroll.addition') }}</h4>
                                                                <br>
                                                                <table id="add">
                                                                <tbody>
                                                                        <tr>
                                                                            <td class="padding10">{{ __('accounts.payroll.basic') }}</td>
                                                                            <td><input type="text" name="basic" id="basic" class="fomr-control" disabled></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        </div>

                                        <div class="form-group row mt-4">
                                            <label for="horizontalInput1" class="col-sm-2 col-form-label">{{ __('accounts.payroll.g_salary') }}</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"  id="horizontalInput1" readonly>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-sm-12 text-right">

                                                <button type="submit" class="btn btn-primary w-md m-b-5">Reset</button>

                                                <button type="submit" class="btn btn-success w-md m-b-5">Set</button>


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

        @section('innerScriptFiles')
        <!-- Plugins js -->
        <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
        @endsection
        @section('innerScript')

        <script>
            (function (){
                $('select').select2();
            })();
        </script>


        @endsection

