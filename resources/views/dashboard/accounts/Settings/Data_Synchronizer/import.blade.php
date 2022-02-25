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
                            <div class="penal-title  border-grey border-bottom">
                                <h1 class="mt-4"></h1>
                            </div>
                            <div class="card-body">

                                <div class="general-label">
                                {{-- {!! Form::open(['route' => 'dashboard.accounts.supplier.store', 'files' => true] ) !!} --}}
                                {!! csrf_field() !!}


                                <div class="row">
                                    <div class="col-lg-4">
                                        {!!  Form::label('image' ,'Import' ,['class'=>'col-form-div'])   !!}

                                    </div>
                                <div class="col-lg-4">
                                    {!! Form::file('image', ['id' => 'image','class' => 'form-control text-right']) !!}
                                </div>
                                {!! Form::submit('Import', array('class' => 'btn btn-primary col-sm-2')) !!}



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

