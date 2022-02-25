@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@include('includes.dashboard-breadcrumbs')
<style>
    .table td, .table th {
        padding: 4px;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }
</style>
@section('body')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card">
                        <div class="card-body invoice-head">
                            <div class="row">
                                <div class="col-sm-3 align-self-center">
                                    <img src="{{ asset('dashboard/images/logo-sm.png') }}" class="logo-sm mr-2" height="30">
                                    <img src="{{ asset('dashboard/images/logo-dark.png') }}" alt="logo-large" class="logo-lg" height="15">
                                </div>
                                <div class="col-md-5 align-self-center">
                                    <h4>Royal Palm Marquee </h4>

                                </div>
                                <div class="col-sm-2 align-self-center">
                                    <h5>Order </h5>

                                </div>
                                <div class="col-sm-2 align-self-center mt-3">
                                    <p>1,661</p>

                                </div>
                            </div>
                        </div><!--end card-body-->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <tbody>
                                            <tr>
                                                <th colspan="1" style="width: 80px ; height: 10px;">Name</th>
                                                <td colspan="2">M USMAN SHAFIQ </td>

                                                <th colspan="1" style="width: 100px ;">Date</th>
                                                <td colspan="2">Saturday, 21 August, 2021</td>

                                            </tr>


                                            <tr>
                                                <th colspan="1">c/o</th>
                                                <td colspan="2"></td>
                                                <th colspan="1">C/O Phone</th>
                                                <td colspan="2">There .</td>


                                            </tr>

                                            <tr>
                                                <th colspan="1">Function</th>
                                                <td colspan="2">Birthday</td>
                                                <th colspan="1">Guest</th>
                                                <td colspan="2">60</td>


                                            </tr>
                                            <tr>
                                                <th colspan="1">Phone #</th>
                                                <td colspan="2">032178966</td>
                                                <th colspan="1">Funstion Time</th>
                                                <td colspan="2">Lunch</td>


                                            </tr>
                                            <tr>
                                                <th colspan="1">NTN #</th>
                                                <td colspan="2"></td>
                                                <th colspan="1">Arival Time</th>
                                                <td colspan="2">12:00 pm To 4:00 pm </td>


                                            </tr>
                                            <tr>
                                                <th colspan="1">Location</th>
                                                <td colspan="2">MARQUEE 1 (A)/
                                                </td>
                                                <th colspan="1">Confirmation</th>
                                                <td colspan="2">Paid</td>


                                            </tr>
                                            <tr>
                                                <th colspan="1"></th>
                                                <td colspan="2"></td>
                                                <th colspan="1">Email</th>
                                                <td colspan="2">                                                           </td>


                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <tbody>
                                            <tr>
                                                <th colspan="1" style="width: 80px ; height: 10px;">Name</th>
                                                <th colspan="1" class="text-center">Menu </th>
                                            </tr>


                                            <tr>
                                                <th colspan="1">1</th>

                                                <td colspan="1"> JUICE TETRA PACK( )</td>
                                            </tr>

                                          


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <tbody>
                                            <tr>
                                                <th colspan="1" style="width: 80px ; height: 10px;">Receipt no</th>
                                                <th colspan="1" class="text-center">Date</th>
                                                <th colspan="1" class="text-center">Advance</th>
                                            </tr>


                                            <tr>
                                                <th colspan="1">2264</th>

                                                <td colspan="1">17-Aug-2021</td>

                                                <td colspan="1">15,000</td>
                                            </tr>

                                            <tr>
                                                <th colspan="1">2251</th>


                                                <td colspan="1">17-Aug-2021</td>
                                                <td colspan="1">12,000</td>


                                            </tr>
                                            <tr>
                                                <th colspan="1">Amount</th>

                                                <td colspan="1"></td>
                                                <td colspan="1">105,000</td>



                                            </tr>
                                            <tr>
                                                <th colspan="1">4</th>


                                                <td colspan="1"></td>
                                                <td colspan="1">  </td>


                                            </tr>
                                            <tr>
                                                <th colspan="1">5</th>

                                                <td colspan="1">  </td>

                                                <td colspan="1">  </td>


                                            </tr>
                                            <tr>
                                                <th colspan="1">6</th>

                                                <td colspan="1"> </td>
                                                <td colspan="1"> </td>
                                            </tr>
                                            <tr>
                                                <th colspan="1">7</th>

                                                <td colspan="1">  </td>
                                                <td colspan="1"> </td>
                                            </tr>
                                            <tr>
                                                <th colspan="1">8</th>

                                                <td colspan="1">  </td>

                                                <td colspan="1">  </td>
                                            </tr>
                                            <tr>
                                                <th colspan="1">9</th>

                                                <td colspan="1"> </td>

                                                <td colspan="1"> </td>
                                            </tr>
                                            <tr>
                                                <th colspan="1">10</th>

                                                <td colspan="1"> </td>
                                                <td colspan="1"> </td>
                                            </tr>
                                            <tr>
                                                <th colspan="1">11</th>

                                                <td colspan="1"> </td>
                                                <td colspan="1"> </td>
                                            </tr>
                                            <tr>
                                                <th colspan="1">11</th>

                                                <td colspan="1"> </td>
                                                <td colspan="1"> </td>
                                            </tr>
                                            <tr>
                                                <th colspan="1">13</th>

                                                <td colspan="1"> </td>
                                                <td colspan="1"> </td>
                                            </tr>
                                            <tr>
                                                <th colspan="1">14</th>

                                                <td colspan="1"> </td>
                                                <td colspan="1"> </td>
                                            </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                            <table class="table table-bordered mb-0">
                                <tbody>
                                <tr>
                                    <th colspan="3" style="width: 80px;">Rate</th>
                                    <td class=" font-14"><b>Total</b></td>
                                    <td class=" font-14"><b>$2359.00</b></td>
                                </tr>

                                </tbody>
                            </table>


                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <h5 class="mt-4">Terms And Condition :</h5>
                                    <ul class="pl-3">
                                        <li><small>All accounts are to be paid within 7 days from receipt of invoice. </small></li>
                                        <li><small>To be paid by cheque or credit card or direct payment online.</small></li>
                                        <li><small> If account is not paid within 7 days the credits details supplied as confirmation<br> of work undertaken will be charged the agreed quoted fee noted above.</small></li>
                                    </ul>
                                </div>
                                <div class="col-lg-6 align-self-end">
                                    <div class="w-25 float-right">
                                        <small>Account Manager</small>
                                        <img src="{{ asset('dashboard/images/signature.png')}}" alt="" class="" height="48">
                                        <p class="border-top">Signature</p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-6 ml-auto align-self-center">
                                    <div class="text-center text-muted"><small>Thank you very much for doing business with us. Thanks !</small></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="float-right d-print-none">
                                        <a href="javascript:window.print()" class="btn btn-info text-light"><i class="fa fa-print"></i></a>
                                        <a href="#" class="btn btn-primary text-light">Submit</a>
                                        <a href="#" class="btn btn-danger text-light">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end card-->
                </div><!--end col-->
            </div><!--end row-->

        </div><!-- container -->

        <footer class="footer text-center text-sm-left">
            &copy; 2019 Frogetor <span class="text-muted d-none d-sm-inline-block float-right">Crafted with <i class="mdi mdi-heart text-danger"></i> by Mannatthemes</span>
        </footer>
    </div>

@endsection
@endsection

@section('innerScript')

@endsection
