@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
@include('includes.dashboard-breadcrumbs')

@section('body')
            <div class="page-content">
                <div class="container-fluid">

                        <div class="card">
                            @include('includes.messages')
                            <div class="penal-title  border-grey border-bottom">
                                <h4 class="p-3 text-dark">{{__('accounts.hrm.add')}}</h4>
                            </div>
                            <div class="card-body">

                                    {!! Form::open(['route' => 'dashboard.accounts.designation.store', 'files' => true, 'id' => 'designation_form', 'class' => 'solid-validation'] ) !!}
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                            {!!  Html::decode(Form::label('designation' ,__('accounts.hrm.desgination').'<i class="text-danger">*</i>' ,['class'=>'col-form-label text-right']))   !!}
                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('name',null,['id'=>'designation','class'=>'form-control ','placeholder'=>'Designation','required']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('detail',__('accounts.hrm.detail'),['class'=>'col-form-label text-right']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('detail',null,['id'=>'detail','class'=>'form-control ','placeholder'=>'Details']) !!}

                                            </div>
                                        </div>
                                        @include('dashboard.accounts.common.buttons.buttons-crud',
                                            ['save' => true, 'save_new' => true, 'form_id' => 'designation_form',
                                            'cancel' => true, 'cancel_route' => 'dashboard.accounts.designation.index'])
                                    {!! Form::close() !!}
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->

                </div><!-- container -->

               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection