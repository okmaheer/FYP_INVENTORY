@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('content')
    @include('includes.dashboard-breadcrumbs')

    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                        <div class="card">
                            <div class="panel-title ">
                                <div class="row border-grey border-bottom">
                                    <div class="col-lg-12">
                                        <h3 class="p-3 text-dark text-center">{{ __('accounts.pettycash.edit') }}</h3>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body">
                                    {!! Form::model($pettycash , ['route' => ['dashboard.accounts.pettycash.update', $pettycash] , 'files' => true] ) !!}
                                    {!! csrf_field() !!}
                                    @method('PUT')
                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    {!!  Html::decode(Form::label('pettycash_name' ,__('accounts.pettycash.name') .'<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}

                                                </div>
                                                <div class="col-sm-8">
                                                    {!!  Form::text('pettycash_name',null,['id'=>'pettycash_name','class'=>'form-control ','placeholder'=>'Pettycash Name','required']) !!}

                                                </div>
                                                <div class="col-sm-1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    {!!  Html::decode(Form::label('pettycash_mobile' ,__('accounts.pettycash.mobile') .'<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}

                                                </div>
                                                <div class="col-sm-8">
                                                    {!!  Form::text('pettycash_mobile',null,['id'=>'pettycash_mobile','class'=>'form-control ','placeholder'=>'Mobile No', 'required']) !!}

                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    {!!  Form::label('pettycash_email' ,__('accounts.pettycash.email_1') ,['class'=>'col-form-label text-right'])   !!}

                                                </div>
                                                <div class="col-sm-8">
                                                    {!!  Form::email('pettycash_email',null,['id'=>'pettycash_email','class'=>'form-control ','placeholder'=>'Email']) !!}

                                                </div>
                                                <div class="col-sm-1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    {!!  Html::decode(Form::label('cnic' ,__('accounts.general.cnic') ,['class'=>'col-form-label text-right']))   !!}

                                                </div>
                                                <div class="col-sm-8">
                                                    {!!  Form::text('cnic',null,['id'=>'cnic','class'=>'form-control ','placeholder'=>__('accounts.general.cnic')]) !!}
                                                    @error('cnic')
                                                        <div class="error">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    {!!  Form::label('phone' ,__('accounts.pettycash.phone') ,['class'=>'col-form-label text-right'])   !!}

                                                </div>
                                                <div class="col-sm-8">
                                                    {!!  Form::number('phone',null,['id'=>'phone','class'=>'form-control ','placeholder'=>'Phone']) !!}

                                                </div>
                                                <div class="col-sm-1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    {!!  Form::label('contact' ,__('accounts.pettycash.contact') ,['class'=>'col-form-label text-right'])   !!}

                                                </div>
                                                <div class="col-sm-8">

                                                    {!!  Form::number('contact',null,['id'=>'contact','class'=>'form-control ','placeholder'=>'Contact']) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                {{-- <label for="example-email-input" class="col-form-label text-right"> Address1:</label> --}}
                                                {!!  Form::label('pettycash_address' ,__('accounts.pettycash.address_1') ,['class'=>'col-form-label text-right'])   !!}

                                                </div>
                                                <div class="col-sm-8">
                                                    {!! Form::textarea('pettycash_address',null,['id'=>'pettycash_address','class' => 'form-control', 'size' => '20x2','placeholder'=>'Address 1']) !!}
                                                </div>
                                                <div class="col-sm-1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                {{-- <label for="example-email-input" class="col-form-label text-right">Address2:</label> --}}
                                                {!!  Form::label('address2' ,__('accounts.pettycash.address_2') ,['class'=>'col-form-label text-right'])   !!}

                                                </div>
                                                <div class="col-sm-8">
                                                    {!! Form::textarea('address2',null,['id'=>'address2','class' => 'form-control', 'size' => '20x2','placeholder'=>'Address 2']) !!}

                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    {!!  Form::label('fax' ,__('accounts.pettycash.fax'),['class'=>'col-form-label text-right'])   !!}

                                                </div>
                                                <div class="col-sm-8">
                                                    {!!  Form::text('fax',null,['id'=>'fax','class'=>'form-control ','placeholder'=>'Fax']) !!}

                                                </div>
                                                <div class="col-sm-1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    {!!  Form::label('city' ,__('accounts.pettycash.city') ,['class'=>'col-form-label text-right'])   !!}

                                                </div>
                                                <div class="col-sm-8">
                                                    {!!  Form::text('city',null,['id'=>'city','class'=>'form-control ','placeholder'=>'City']) !!}

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    {!!  Form::label('state' ,__('accounts.pettycash.state') ,['class'=>'col-form-label text-right'])   !!}

                                                </div>
                                                <div class="col-sm-8">
                                                    {!!  Form::text('state',null,['id'=>'state','class'=>'form-control ','placeholder'=>'State']) !!}

                                                </div>
                                                <div class="col-sm-1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    {!!  Form::label('zip' ,__('accounts.pettycash.zip'),['class'=>'col-form-label text-right'])   !!}

                                                </div>
                                                <div class="col-sm-8">
                                                    {!!  Form::text('zip',null,['id'=>'zip','class'=>'form-control ','placeholder'=>'Zip code']) !!}

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    {!!  Form::label('country' ,__('accounts.pettycash.country') ,['class'=>'col-form-label text-right'])   !!}

                                                </div>
                                                <div class="col-sm-8">
                                                    {!!  Form::text('country',null,['id'=>'country','class'=>'form-control ','placeholder'=>'Country']) !!}

                                                </div>
                                                <div class="col-sm-1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    {!!  Form::label('previous_balance' ,__('accounts.pettycash.balance') ,['class'=>'col-form-label text-right'])   !!}

                                                </div>
                                                <div class="col-sm-8">
                                                    {!!  Form::number('previous_balance',null,['id'=>'previous_balance','class'=>'form-control ','placeholder'=>'Previous Balance']) !!}

                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 text-right">
                                            {{-- <button type="submit" class="btn btn-success px-5 py-2">Save</button> --}}
                                            {!! Form::submit('Update', array('class' => 'btn btn-success px-5 py-2')) !!}
                                        </div>
                                    </div>
                                {{-- </form> --}}
                                {!! Form::close() !!}
                            </div>
                        </div>

            </div><!-- container -->

            @include('includes.dashboard-footer')
        </div>

    @endsection
@endsection
