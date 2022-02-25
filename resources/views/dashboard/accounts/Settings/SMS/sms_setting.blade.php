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

                    </div>

                        <div class="card">
                            <div class="panel-title border-grey border-bottom">
                                <h4 class="p-3 text-dark">SMS Configure</h4>
                            </div>
                            <div class="card-body">

                                <div class="general-label">
                                    {{-- {!! Form::open(['route' => 'dashboard.accounts.supplier.store', 'files' => true] ) !!} --}}
                                    {!! csrf_field() !!}
                                        <div class="form-group row">
                                            <div class="col-sm-2 ">
                                                {!!  Html::decode(Form::label('nexmo_api_key' ,'Nexmo Api Key   <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10 ">
                                                {!!  Form::text('phone',null,['id'=>'phone','class'=>'form-control ','placeholder'=>'Phone','required']) !!}

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2 ">
                                                {!!  Html::decode(Form::label('nexmo_api_key' ,'Nexmo Api Key   <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('phone',null,['id'=>'phone','class'=>'form-control ','placeholder'=>'Phone','required']) !!}

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2 ">
                                                {!!  Html::decode(Form::label('sender_number' ,'Sender Number   <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('phone',null,['id'=>'phone','class'=>'form-control ','placeholder'=>'Phone','required']) !!}

                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-2 ">
                                                {!!  Form::label('Sale' ,'Sale' ,['class'=>'col-form-label text-d'])   !!}

                                            </div>
                                            <div class="col-sm-8 mt-2">
                                                <label for="" class="radio-inline">
                                                    {!!  Form::radio('phone',null,['id'=>'phone','class'=>'form-control ','placeholder'=>'Phone']) !!}

                                                    Yes
                                                </label>
                                                <label for="" class="radio-inline ml-3">
                                                    {!!  Form::radio('phone',null,['id'=>'phone','class'=>'custom-input-file ','placeholder'=>'Phone']) !!}
                                                    {{-- <input type="radio" class="custom-input-file" checked="checked" value="1" id="user_type" > --}}
                                                    No
                                                </label>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2 ">
                                                {!!  Form::label('service' ,'Service' ,['class'=>'col-form-label text-d'])   !!}

                                            </div>
                                            <div class="col-sm-8 mt-2">
                                                <label for="" class="radio-inline">
                                                    {!!  Form::radio('phone',null,['id'=>'phone','class'=>'custom-input-file ','placeholder'=>'Phone']) !!}
                                                    {{-- <input type="radio" class="custom-input-file" checked="checked"  id="user_type" > --}}
                                                    Yes
                                                </label>
                                                <label for="" class="radio-inline ml-3">
                                                    {!!  Form::radio('phone',null,['id'=>'phone','class'=>'custom-input-file ','placeholder'=>'Phone']) !!}
                                                    {{-- <input type="radio" class="custom-input-file" checked="checked"  id="user_type" > --}}
                                                    No
                                                </label>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2 ">
                                                {!!  Form::label(null ,'Customer Receive' ,['class'=>'col-form-label text-right'])   !!}

                                            </div>
                                            <div class="col-sm-8 mt-2">
                                                <label for="" class="radio-inline">
                                                    {!!  Form::radio('phone',null,['id'=>'phone','class'=>'custom-input-file ','placeholder'=>'Phone']) !!}
                                                    {{-- <input type="radio" class="custom-input-file" checked="checked"  id="user_type" > --}}
                                                    Yes
                                                </label>
                                                <label for="" class="radio-inline ml-3">
                                                    {!!  Form::radio('phone',null,['id'=>'phone','class'=>'custom-input-file ','placeholder'=>'Phone']) !!}
                                                    {{-- <input type="radio" class="custom-input-file" checked="checked"  id="user_type" > --}}
                                                    No
                                                </label>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-4 ">
                                                {!!  Form::label('' ,'' ,['class'=>'col-form-label '])   !!}
                                            {{-- <label for="example-text-input" class=" col-form-label"></label> --}}
                                            </div>
                                            <div class="col-sm-6">
                                                {!! Form::submit('Save Changes', array('class' => 'btn btn-primary btn-large')) !!}

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



