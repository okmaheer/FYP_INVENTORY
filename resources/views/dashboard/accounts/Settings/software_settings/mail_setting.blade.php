@extends('layouts.dashboard')
@section('page_title')
@section('content')
    @include('includes.dashboard-breadcrumbs')
<style>
    .form-control{
        width: 70% !important;

    }
    .form-group{
        margin-bottom: 60px;
    }
</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="card">

                    </div>

                            <div class="card">
                                <div class="card-body">
                                   {{-- {!! Form::open(['route' => 'dashboard.accounts.supplier.store', 'files' => true] ) !!} --}}
                                   {!! csrf_field() !!}
                                        <div class="panel-title ">
                                            <div class="row border-grey border-bottom">
                                                <div class="col-lg-6">
                                                    <h4 class="p-3 text-success">Mail Configuration</h4>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        {!!  Html::decode(Form::label('protocol' ,'Protocol  <i class="text-danger">*</i>' ,['class'=>'col-form-label text-left'])) !!}

                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!!  Form::text('protocol',null,['id'=>'protocol','class'=>'form-control ','placeholder'=>'ssmtp','required']) !!}

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        {!!  Html::decode(Form::label('username' ,'SMTP Host <i class="text-danger">*</i>' ,['class'=>'col-form-label text-left'])) !!}

                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!!  Form::text('username',null,['id'=>'username','class'=>'form-control ','placeholder'=>'ssl://ssmtp.gmail.com','required']) !!}

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        {!!  Html::decode(Form::label('sender_mail' ,'Sender Mail <i class="text-danger">*</i>' ,['class'=>'col-form-label text-left'])) !!}
                                                    <label for="example-text-input" class=" col-form-label text-left">Sender Mail<i class="text-danger"> *</i></label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!!  Form::text('sender_mail',null,['id'=>'sender_mail','class'=>'form-control ','placeholder'=>'Sender Mail','required']) !!}

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        {!!  Html::decode(Form::label('password' ,'Password <i class="text-danger">*</i>' ,['class'=>'col-form-label text-left'])) !!}

                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!!  Form::text('password',null,['id'=>'password','class'=>'form-control ','placeholder'=>'Password','required']) !!}

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        {!!  Html::decode(Form::label('username' ,'SMTP Host <i class="text-danger">*</i>' ,['class'=>'col-form-label text-left'])) !!}
                                                    </div>
                                                    <div class="col-sm-9">
                                                        {!!  Form::text('username',null,['id'=>'username','class'=>'form-control ','placeholder'=>'ssl://ssmtp.gmail.com','required']) !!}
                                                    </div>
                                                </div>


                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        {!!  Form::label('sale' ,'Sales' ,['class'=>'col-form-label text-right'])   !!}

                                                    </div>
                                                    <div class="col-sm-10 mt-2">
                                                        <label for="" class="radio-inline mr-3">
                                                            {{-- {!!  Form::text('currency_name',null,['id'=>'currency_name','class'=>'form-control ','placeholder'=>'Currency Name']) !!} --}}
                                                            <input class="form-check-input custom-input-file" type="radio" value="0" id="user_type" name="flexRadioDefault" id="flexRadioDefault1">

                                                            Yes
                                                        </label>
                                                        <label for="" class="radio-inline ml-3">
                                                            {{-- {!!  Form::text('currency_name',null,['id'=>'currency_name','class'=>'form-control ','placeholder'=>'Currency Name']) !!} --}}
                                                            <input class="form-check-input custom-input-file" type="radio" value="0" id="user_type" name="flexRadioDefault" id="flexRadioDefault1">

                                                            No
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        {!!  Form::label('services' ,'Servicess' ,['class'=>'col-form-label text-right'])   !!}

                                                    </div>
                                                    <div class="col-sm-10 mt-2">
                                                        <label for="" class="radio-inline mr-3">
                                                            {{-- {!!  Form::radio('currency_name',null,['id'=>'currency_name','class'=>'form-control ','placeholder'=>'Currency Name']) !!} --}}
                                                            <input class="form-check-input custom-input-file" type="radio" value="0" id="user_type" name="flexRadioDefault" id="flexRadioDefault1">

                                                            Yes
                                                        </label>
                                                        <label for="" class="radio-inline ml-3">
                                                            {{-- {!!  Form::radio('currency_name',null,['id'=>'currency_name','class'=>'form-control ','placeholder'=>'Currency Name']) !!} --}}
                                                            <input class="form-check-input custom-input-file" type="radio" value="0" id="user_type" name="flexRadioDefault" id="flexRadioDefault1">

                                                            No
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        {!!  Form::label('quotation' ,'Quotations' ,['class'=>'col-form-label text-right'])   !!}

                                                    </div>
                                                    <div class="col-sm-10 mt-2">
                                                        <label for="" class="radio-inline mr-3">
                                                            {{-- {!!  Form::radio('currency_name',null,['id'=>'currency_name','class'=>'form-control ','placeholder'=>'Currency Name']) !!} --}}
                                                            <input class="form-check-input custom-input-file" type="radio" value="0" id="user_type" name="flexRadioDefault" id="flexRadioDefault1">

                                                            Yes
                                                        </label>
                                                        <label for="" class="radio-inline ml-3">
                                                            {{-- {!!  Form::radio('currency_name',null,['id'=>'currency_name','class'=>'form-control ','placeholder'=>'Currency Name']) !!} --}}
                                                            <input class="form-check-input custom-input-file" type="radio" value="0" id="user_type" name="flexRadioDefault" id="flexRadioDefault1">

                                                            No
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        &nbsp;
                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                {!! Form::submit('Save Changes', array('class' => 'btn btn-success px-5 py-2')) !!}

                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                </div>
                            </div>

                </div><!-- container -->
                &nbsp;
                &nbsp;
                &nbsp;
                &nbsp;
               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection

