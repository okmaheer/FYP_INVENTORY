@extends('layouts.dashboard')
@section('page_title')
@section('content')
@include('includes.dashboard-breadcrumbs')
<style>
   .col-sm-2::selection{
        color: #fff;
        background-color: #37a000;
    }
    .text-dark::selection{
        color: #fff;
        background-color: #37a000;

    }

</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">


                        <div class="card">
                            <div class="panel-title border-grey border-bottom">
                                <h4 class="p-3 text-dark">Restore</h4>
                            </div>
                            <div class="card-body">

                                <div class="general-label">
                                  {{-- {!! Form::open(['route' => 'dashboard.accounts.supplier.store', 'files' => true] ) !!} --}}
                                {!! csrf_field() !!}
                                        <div class="form-group">
                                            <div class="col-sm-12 text-center">
                                                <h3> If You want to Restore your database . Please click on confirm button.</h3>
                                                <p class="text-danger"> It will delete all your data from your database !!</p>
                                            </div>
                                        </div>
                                        <div class="form-group text-center">

                                            <a href="" class="btn btn-danger w-md m-b-5">Cancel</a>
                                            {!! Form::submit('Confirm', array('class' => 'btn btn-success w-md m-b-5')) !!}
                                        </div>
                                        {!! Form::close() !!}
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->

                </div><!-- container -->

               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection


