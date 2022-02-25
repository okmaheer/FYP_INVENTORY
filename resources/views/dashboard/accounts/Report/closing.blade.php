@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('content')
@include('includes.dashboard-breadcrumbs')
@section('body')
            <div class="page-content">
<!--                <div class="row ml-1 mb-1 ">
                    <div class="col-sm-12">
                        <a href="#" class="btn btn-primary m-b-5 m-r-2">
                            <i class="ti-align-justify"></i> &nbsp;Closing Date

                        </a>

                    </div>
                </div>-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="penal-title  border-dark border-bottom">
                                        <h4 class=" header-title">Closing Account</h4>
                                    </div>
                                    <div class="table-responsive">
                                       <div class="text-center mt-3">
                                        <h4>Day Cash Closing</h4>
                                        <h4>Date: {{ \AccountHelper::date_format(\Carbon\Carbon::today()) }} </h4>
                                       </div>

                                        <div class="card">
                                            <div class="card-body">

                                                <div class="general-label">
                                                    {!! Form::open(['route' => 'dashboard.accounts.closing.report.store', 'files' => true, 'class' => 'solid-validation'] ) !!}
                                                    {!! csrf_field() !!}

                                                        <div class="form-group row">
                                                            <div class="col-sm-2">
                                                                {!!  Form::label('last_day_closing' ,'Last Day Closing' ,['class'=>'col-form-label '])   !!}

                                                            </div>
                                                            <div class="col-sm-10">
                                                                {!!  Form::text('last_day_closing', $accountsClosingData['last_day_closing'],['id'=>'last_day_closing','class'=>'form-control ','placeholder'=>'0.00','readonly']) !!}

                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-2">
                                                                {!!  Form::label('cash_in' ,'Receive' ,['class'=>'col-form-label '])   !!}

                                                            </div>
                                                            <div class="col-sm-10">
                                                                {!!  Form::text('cash_in',$accountsClosingData['cash_in'],['id'=>'cash_in','class'=>'form-control ','placeholder'=>'0.00','readonly']) !!}

                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-2">
                                                                {!!  Form::label('cash_out' ,'Payment' ,['class'=>'col-form-label '])   !!}

                                                            </div>
                                                            <div class="col-sm-10">
                                                                {!!  Form::text('cash_out',$accountsClosingData['cash_out'],['id'=>'cash_out','class'=>'form-control ','placeholder'=>'0.00','readonly']) !!}

                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-2">
                                                                {!!  Form::label('cash_in_hand' ,'Balance' ,['class'=>'col-form-label '])   !!}

                                                            </div>
                                                            <div class="col-sm-10">
                                                                {!!  Form::text('cash_in_hand',$accountsClosingData['cash_in_hand'],['id'=>'cash_in_hand','class'=>'form-control ','placeholder'=>'0.00','readonly']) !!}

                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-10 ml-auto">
                                                                {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}

                                                            </div>
                                                        </div>
                                                        {!! Form::close() !!}
                                                </div>
                                            </div>
                                            <!--end card-body-->
                                        </div>
                                        <!--end card-->

                                    </div>
                                    <!--end /tableresponsive-->
                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                        <!-- end col -->

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="penal-tilte  border-dark border-bottom">
                                        <h4 class="mt-1  header-title">Cash In Hand</h4>
                                    </div>



                                    <div class="table-responsive mt-3">
                                        <table class="table table-bordered mb-0 table-centered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Note Name</th>
                                                    <th class="text-center">Pcs.</th>
                                                    <th class="text-center">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>2000</td>
                                                    <td>{!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control']) !!}</td>
                                                    <td> {!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control','readonly']) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td>1000</td>
                                                    <td>{!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control']) !!}</td>
                                                    <td> {!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control','readonly']) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td>500</td>
                                                    <td>{!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control ']) !!}</td>
                                                    <td> {!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control ','readonly']) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td>100</td>
                                                    <td>{!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control ']) !!}</td>
                                                    <td> {!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control ','readonly']) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td>50</td>
                                                    <td>{!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control ']) !!}</td>
                                                    <td> {!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control ','readonly']) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td>20</td>
                                                    <td>{!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control ','readonly']) !!}</td>
                                                    <td> {!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control ','readonly']) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td>10</td>
                                                    <td>{!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control ']) !!}</td>
                                                    <td> {!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control ','readonly']) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>{!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control ']) !!}</td>
                                                    <td> {!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control ','readonly']) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>{!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control ']) !!}</td>
                                                    <td> {!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control ','readonly']) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>{!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control ']) !!}</td>
                                                    <td> {!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control ','readonly']) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="text-right">Grand Total</td>
                                                    <td> {!!  Form::text('balance',null,['id'=>'alance','class'=>'form-control ','readonly']) !!}</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                        <!--end /table-->
                                    </div>
                                    <!--end /tableresponsive-->
                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                        <!-- end col -->

                    </div>

                </div><!-- container -->

               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection

