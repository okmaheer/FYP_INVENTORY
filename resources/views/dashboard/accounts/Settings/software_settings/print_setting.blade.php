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

                        <div class="card">
                            <div class="penal-tilte  border-grey border-bottom">
                            <h4 class="p-3 text-dark">Print Setting</h4>
                            </div>
                            <div class="card-body">

                                <div class="general-label">
                                    {{-- {!! Form::open(['route' => 'dashboard.accounts.supplier.store', 'files' => true] ) !!} --}}
                                    {!! csrf_field() !!}
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('header' ,'Header  <i class="text-danger">*</i>' ,['class'=>'col-form-label'])) !!}

                                            </div>
                                            <div class="col-sm-9">
                                                {!!  Form::number('header',null,['id'=>'header','class'=>'form-control ','placeholder'=>'200','required']) !!}

                                            </div>
                                            <div class="col-sm-1">
                                                {!!  Form::label('px' ,'PX' ,['class'=>'col-form-label'])   !!}

                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('footer' ,'Footer  <i class="text-danger">*</i>' ,['class'=>'col-form-label'])) !!}

                                            </div>
                                            <div class="col-sm-9">
                                                {!!  Form::number('footer',null,['id'=>'footer','class'=>'form-control ','placeholder'=>'100','required']) !!}

                                            </div>
                                            <div class="col-sm-1">
                                                {!!  Form::label('PX' ,'PX' ,['class'=>'col-form-label'])   !!}

                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                {!! Form::submit('Save Changes', array('class' => 'btn btn-success btn-large')) !!}


                                            </div>
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


