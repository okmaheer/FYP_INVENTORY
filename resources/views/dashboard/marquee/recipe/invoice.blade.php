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
            <div class="col-lg-12 mx-auto">
                <div class="card">

                    <div class="card-body">
                       
                        <div class="row">
                            <div class="col-md-7">

                                   
                            </div>


                        </div>
                        
                            <div class="row">
                                <div class="col-md-7">
                                   
                                </div>


                            </div>
                     



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <h4 class="font-14">Rcipe Name :  {{ $model->recipe_name }} </h4><br>
                                        <thead>
                                            <tr>
                                                <th class="text-center">SL</th>
                                                <th class="text-center">Ingredients Name</th>
                                                <th class="text-center">Quantity(Kg)</th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($model->recipeDetails as $key => $item)
                                   
                                            <tr>
                                               <td class="text-center">{{ $key+1 }}</td>
                                               <td class="text-center">{{ $item->product->product_name }}</td>
                                                <td class="text-center">{{ $item->final_quantity}}</td> 


                                            </tr>
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                        
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

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
                                    <img src="assets/images/signature.png" alt="" class="" height="48">
                                    <p class="border-top">Signature</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-12 col-xl-4 ml-auto align-self-center">
                                <div class="text-center text-muted"><small>Thank you very much for doing business with us. Thanks !</small></div>
                            </div>
                            <div class="col-lg-12 col-xl-4">
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
