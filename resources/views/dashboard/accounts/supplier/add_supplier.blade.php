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
                                <h3 class="p-3 text-dark text-center">{{ __('accounts.supplier.add') }}</h3>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">

                            {!! Form::open(['route' => 'dashboard.accounts.supplier.store', 'files' => true, 'class' => 'solid-validation'] ) !!}
                            {!! csrf_field() !!}
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            {!!  Html::decode(Form::label('supplier_name' ,__('accounts.supplier.name').'<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}

                                        </div>
                                        <div class="col-sm-8">
                                            {!!  Form::text('supplier_name',null,['id'=>'supplier_name','class'=>'form-control ','placeholder'=>'Supplier Name', 'required']) !!}

                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            {!!  Html::decode(Form::label('supplier_mobile' ,__('accounts.supplier.mobile').'<i class="text-danger">*</i>',['class'=>'col-form-label text-right']))   !!}

                                        </div>
                                        <div class="col-sm-8">
                                            {!!  Form::text('supplier_mobile',null,['id'=>'supplier_mobile','class'=>'form-control ','placeholder'=>'Mobile No', 'required']) !!}

                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            {!!  Form::label('supplier_email' ,__('accounts.supplier.email_1') ,['class'=>'col-form-label text-right'])   !!}

                                        </div>
                                        <div class="col-sm-8">
                                            {!!  Form::email('supplier_email',null,['id'=>'supplier_email','class'=>'form-control ','placeholder'=>'Email']) !!}

                                        </div>
                                        <div class="col-sm-1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            {!!  Html::decode(Form::label('cnic' ,__('accounts.general.cnic').'<i class="text-danger">*</i>',['class'=>'col-form-label text-right']))   !!}

                                        </div>
                                        <div class="col-sm-8">
                                            {!!  Form::text('cnic',null,['id'=>'cnic','class'=>'form-control ','placeholder'=>__('accounts.general.cnic'), 'required']) !!}
                                            @error('cnic')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            {!!  Form::label('phone' ,__('accounts.supplier.phone') ,['class'=>'col-form-label text-right'])   !!}

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
                                            {!!  Form::label('contact' ,__('accounts.supplier.contact') ,['class'=>'col-form-label text-right'])   !!}

                                        </div>
                                        <div class="col-sm-8">

                                            {!!  Form::number('contact',null,['id'=>'contact','class'=>'form-control ','placeholder'=>'Contact']) !!}
                                        </div>
                                    </div>
                                </div>

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                {!!  Form::label('supplier_address' ,__('accounts.supplier.address_1') ,['class'=>'col-form-label text-right'])   !!}

                                </div>
                                <div class="col-sm-8">
                                    {!! Form::textarea('supplier_address',null,['id'=>'supplier_address','class' => 'form-control', 'size' => '20x2','placeholder'=>'Address 1']) !!}
                                </div>
                                <div class="col-sm-1">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    {!!  Form::label('address2' ,__('accounts.supplier.address_2') ,['class'=>'col-form-label text-right'])   !!}
                                </div>
                                <div class="col-sm-8">
                                    {!! Form::textarea('address2',null,['id'=>'address2','class' => 'form-control', 'size' => '20x2','placeholder'=>'Address 2']) !!}
                                </div>

                            </div>
                        </div>

                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            {!!  Form::label('fax' ,__('accounts.supplier.fax') ,['class'=>'col-form-label text-right'])   !!}

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
                                            {!!  Form::label('city' ,__('accounts.supplier.city') ,['class'=>'col-form-label text-right'])   !!}

                                        </div>
                                        <div class="col-sm-8">
                                            {!!  Form::text('city',null,['id'=>'city','class'=>'form-control ','placeholder'=>'City']) !!}

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            {!!  Form::label('state' ,__('accounts.supplier.state') ,['class'=>'col-form-label text-right'])   !!}

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
                                            {!!  Form::label('zip' ,__('accounts.supplier.zip') ,['class'=>'col-form-label text-right'])   !!}

                                        </div>
                                        <div class="col-sm-8">
                                            {!!  Form::text('zip',null,['id'=>'zip','class'=>'form-control ','placeholder'=>'Zip code']) !!}

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            {!!  Form::label('country' ,__('accounts.supplier.country') ,['class'=>'col-form-label text-right'])   !!}

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
                                            {!!  Form::label('previous_balance' ,__('accounts.supplier.balance') ,['class'=>'col-form-label text-right'])   !!}

                                        </div>
                                        <div class="col-sm-8">
                                            {!!  Form::number('previous_balance',null,['id'=>'previous_balance','class'=>'form-control ','placeholder'=>'Previous Balance']) !!}

                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-sm-12 text-right">

                                    {!! Form::submit('Submit', array('class' => 'btn btn-success px-5 py-2')) !!}
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

