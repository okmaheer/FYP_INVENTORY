@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
    @include('includes.dashboard-breadcrumbs')

@section('body')
    <div class="page-content">

        <div class="container-fluid mb-5 ">
            <div class="card">
                <div class="panel-title ">
                    <div class="row border-grey border-bottom">
                        <div class="col-lg-12">
                            <h3 class="p-3 text-dark text-center">{{ __('accounts.customers.edit') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! Form::model($customer,['route' => ['dashboard.accounts.customer.update',$customer->id], 'class' => 'solid-validation', 'files' => true] ) !!}
                    @method('PATCH')

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    {!!  Html::decode(Form::label('customer_name' ,__('accounts.customers.name') . ' <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}

                                </div>
                                <div class="col-sm-8">
                                    {!!  Form::text('customer_name',null,['id'=>'customer_name,validationCustomUsername','class'=>'form-control ','placeholder'=>'Customer Name','required']) !!}

                                </div>
                                <div class="invalid-feedback">
                                    Please choose a Name
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    {!!  Html::decode(Form::label('customer_mobile' ,__('accounts.customers.mobile').' <i class="text-danger">*</i>',['class'=>'col-form-label text-right']))   !!}

                                </div>
                                <div class="col-sm-8">
                                    {!!  Form::number('customer_mobile',null,['id'=>'customer_mobile','class'=>'form-control ','placeholder'=>'Mobile No','required']) !!}

                                </div>

                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    {!!  Form::label('customer_email' ,__('accounts.customers.email_1') ,['class'=>'col-form-label text-right'])   !!}

                                </div>
                                <div class="col-sm-8">
                                    {!!  Form::email('customer_email',null,['id'=>'customer_email','class'=>'form-control ','placeholder'=>'Email']) !!}

                                </div>
                                <div class="col-sm-1">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    {!!  Html::decode(Form::label('cnic' ,__('accounts.general.cnic').' <i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}

                                </div>
                                <div class="col-sm-8">
                                    {!!  Form::text('cnic',null,['id'=>'cnic','class'=>'form-control ','placeholder'=>'', 'required']) !!}

                                </div>

                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    {!!  Form::label('phone' ,__('accounts.customers.phone') ,['class'=>'col-form-label text-right'])   !!}

                                </div>
                                <div class="col-sm-8">
                                    {!!  Form::number('phone',null,['id'=>'phone','class'=>'form-control ','placeholder'=>'Phone']) !!}

                                </div>
                                <div class="col-sm-1">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">

                        </div>

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    {!!  Form::label('customer_address' ,__('accounts.customers.address_1') ,['class'=>'col-form-label text-right'])   !!}

                                </div>
                                <div class="col-sm-8">
                                    {!! Form::textarea('customer_address',null,['class' => 'form-control', 'size' => '20x2','placeholder'=>'Address1']) !!}


                                </div>
                                <div class="col-sm-1">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    {!!  Form::label('address2' ,__('accounts.customers.address_2') ,['class'=>'col-form-label text-right'])   !!}

                                </div>
                                <div class="col-sm-8">
                                    {!! Form::textarea('address2',null,['class' => 'form-control', 'size' => '20x2','placeholder'=>'Address1']) !!}


                                </div>

                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    {!!  Form::label('fax' ,__('accounts.customers.fax') ,['class'=>'col-form-label text-right'])   !!}

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
                                    {!!  Form::label('city' ,__('accounts.customers.city') ,['class'=>'col-form-label text-right'])   !!}

                                </div>
                                <div class="col-sm-8">
                                    {!!  Form::text('city',null,['id'=>'city','class'=>'form-control ','placeholder'=>'City']) !!}

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    {!!  Form::label('state' ,__('accounts.customers.state') ,['class'=>'col-form-label text-right'])   !!}

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
                                    {!!  Form::label('zip' ,__('accounts.customers.zip') ,['class'=>'col-form-label text-right'])   !!}

                                </div>
                                <div class="col-sm-8">
                                    {!!  Form::text('zip',null,['id'=>'zip','class'=>'form-control ','placeholder'=>'Zip code']) !!}

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    {!!  Form::label('country' ,__('accounts.customers.country') ,['class'=>'col-form-label text-right'])   !!}

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
                                    {!!  Form::label('previous_balance' ,__('accounts.customers.balance') ,['class'=>'col-form-label text-right'])   !!}

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
                            {!! Form::submit('Submit', array('class' => 'btn btn-success px-5 py-2')) !!}
                        </div>
                    </div>
                    {{-- </form> --}}
                    {!! Form::close() !!}
                </div>
            </div>


        </div>
        @include('includes.dashboard-footer')
    </div>
    <!--end page-wrapper-inner -->

@endsection

@endsection

@section('innerScript')


    <script src="{{ asset('dashboard/plugins/parsleyjs/parsley.min.js')}}"></script>
    <script src="{{ asset('dashboard/pages/jquery.validation.init.js') }}"></script>

@endsection


