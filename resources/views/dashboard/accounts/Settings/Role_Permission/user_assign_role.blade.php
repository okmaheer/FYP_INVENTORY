@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
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
                            <div class="panel-title border-grey border-bottom">
                                <h4 class="p-3 text-dark">User Assign Role</h4>
                            </div>
                            <div class="card-body">

                                <div class="general-label">
                                   {{-- {!! Form::open(['route' => 'dashboard.accounts.supplier.store', 'files' => true] ) !!} --}}
                                   {!! csrf_field() !!}


                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('user' ,'User   <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::select('user',AccountHelper::manualStatus(),null,['id'=>'user',
                                             'class'=>'select2 form-control mb-3 custom-select float-right',
                                             'placeholder'=>'Admin User','required'])
                                            !!}

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('role_name' ,'Role Name   <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::select('role_name',AccountHelper::manualStatus(),null,['id'=>'role_name',
                                             'class'=>'select2 form-control mb-3 custom-select float-right',
                                             'placeholder'=>'Select Option','required'])
                                            !!}

                                            </div>
                                        </div>

                                        <div class="col-md-4 text-grey">
                                            <h3 class="text-grey">Existing Role</h3>
                                        </div>

                                        <div class="row text-right">
                                            <div class="col-sm-10 ml-auto">
                                                {!! Form::submit('Reset', array('class' => 'btn btn-primary')) !!}
                                                {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}

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

        @section('innerScriptFiles')
        <!-- Plugins js -->
        <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
        @endsection
        @section('innerScript')

        <script>
            (function (){
                $('select').select2();
            })();
        </script>


        @endsection
