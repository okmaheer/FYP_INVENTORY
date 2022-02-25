@extends('layouts.dashboard')
@section('page_title')
@section('content')
@include('includes.dashboard-breadcrumbs')
<style>

</style>
@section('body')

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row  mb-2">
                        <div class="col-sm-12">
                            <a href="#" class="btn btn-info m-b-5 m-r-2">
                                <i class="ti-plus"></i> &nbsp;Add Person
                            </a>
                            <a href="#" class="btn btn-success m-b-5 m-r-2">
                                <i class="ti-plus"></i> &nbsp;Add Payement
                            </a>
                            <a href="#" class="btn btn-primary m-b-5 m-r-2">
                                <i class="ti-plus"></i> &nbsp;Manage Person
                            </a>


                        </div>
                    </div>


                        <div class="card">
                            <h4 class="p-3 text-success">{{__('accounts.office.add')}}</h4>
                            <div class="card-body">

                                <div class="general-label">
                                   {!! Form::open(['route' => 'dashboard.accounts.person.store', 'files' => true] ) !!}
                                   {!! csrf_field() !!}
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Form::label('person_name' ,__('accounts.office.name') ,['class'=>'col-form-label text-right'])   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('person_name',null,['id'=>'person_name','class'=>'form-control ','placeholder'=>'Name']) !!}

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('person_phone' ,__('accounts.office.phone').'<i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('person_phone',null,['id'=>'person_phone','class'=>'form-control ','placeholder'=>'Phone','required']) !!}

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Form::label('person_address' ,__('accounts.office.address') ,['class'=>'col-form-label text-right'])   !!}
                                            <label for="horizontalInput2" class=" col-form-label">Address</label>
                                            </div>
                                            <div class="col-sm-10">
                                                {!! Form::textarea('person_address',null,['class' => 'form-control', 'size' => '50x2','placeholder'=>'person_address']) !!}

                                        </div>
                                        </div>
                                        <div class="form-group row">



                                            <div class="col-sm-12 text-center">
                    {{--      {!! Form::submit('Reset', array('class' => 'btn btn-primary')) !!}--}}
                                                {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}

                                            </div>

                                        {!! Form::close() !!}
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>

               <!-- container -->


            </div>
            <!-- end page content -->
            </div>


        @endsection
        @endsection

