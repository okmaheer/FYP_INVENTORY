@extends('layouts.dashboard')
@section('page_title')
@section('content')
@include('includes.dashboard-breadcrumbs')
<style>
  /* .col-sm-1{
      margin-left: -115px;
  } */
</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="card">

                    </div>

                        <div class="card">

                            <div class="card-body">

                                <div class="general-label">
                                    {{-- {!! Form::open(['route' => 'dashboard.accounts.supplier.store', 'files' => true] ) !!} --}}
                                    {!! csrf_field() !!}
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('f_name' ,'First Name <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('f_name',null,['id'=>'f_name','class'=>'form-control ','placeholder'=>'Phone','required']) !!}

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('l_name' ,'Last Name <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                            <label for="horizontalInput1" class="col-form-label">Last Name <i class="text-danger"> *</i></label>
                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('l_name',null,['id'=>'l_name','class'=>'form-control ','placeholder'=>'Phone','required']) !!}

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('email' ,'Email <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
                                            <label for="horizontalInput1" class=" col-form-label">Email <i class="text-danger"> *</i> </label>
                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('email',null,['id'=>'email','class'=>'form-control ','placeholder'=>'Phone','required']) !!}
                                                <input type="email" class="form-control" id="horizontalInput1" placeholder="Email ">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('password' ,'Password <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
                                            <label for="horizontalInput1" class=" col-form-label">Password <i class="text-danger"> *</i></label>
                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('password',null,['id'=>'password','class'=>'form-control ','placeholder'=>'Phone','required']) !!}

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Form::label(null ,'' ,['class'=>'col-form-label text-d'])   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                <img src="http://acc.theoptimumtech.com/assets/img/icons/default.jpg" class="img-thumbnail" width="125" height="100" alt="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Form::label('image' ,'Image' ,['class'=>'col-form-label text-d'])   !!}
                                            <label for="horizontalInput1" class=" col-form-label">Image </label>
                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('image',null,['id'=>'image','class'=>'form-control ','placeholder'=>'Phone']) !!}

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('user_type' ,'User Type <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
                                            <label for="horizontalInput1" class=" col-form-label text-d">User Type <i class="text-danger"> *</i></label>
                                            </div>
                                            <div class="col-sm-8 mt-2">
                                                <label for="" class="radio-inline">

                                                    <input type="radio" class="custom-input-file" checked="checked" value="0" id="user_type" >
                                                    User
                                                </label>
                                                <label for="" class="radio-inline ml-3">

                                                    <input type="radio" class="custom-input-file" checked="checked" value="1" id="user_type" >
                                                    Admin
                                                </label>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('status' ,'Status <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
                                            <label for="horizontalInput1" class=" col-form-label text-d">Status <i class="text-danger"> *</i></label>
                                            </div>
                                            <div class="col-sm-8 mt-2">
                                                <label for="" class="radio-inline">

                                                    <input type="radio" class="custom-input-file" checked="checked"  id="user_type" >
                                                    Active
                                                </label>
                                                <label for="" class="radio-inline ml-3">

                                                    <input type="radio" class="custom-input-file" checked="checked"  id="user_type" >
                                                    Inactive
                                                </label>

                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                {!! Form::submit('Reset', array('class' => 'btn btn-primary w-md m-b-5')) !!}
                                                {!! Form::submit('Save', array('class' => 'btn btn-success w-md m-b-5')) !!}


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

