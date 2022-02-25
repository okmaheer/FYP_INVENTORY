@extends('layouts.dashboard')
@section('page_title', $page_title)
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
                                <div class="panel-title border-grey border-bottom">
                                    <h4 class="p-3 text-success">Tax Settings</h4>
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                    {{-- {!! Form::open([ 'files' => true] ) !!} --}}
                                    {!! csrf_field() !!}
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-4">
                                                            {!!  Html::decode(Form::label('number_of_tax' ,'Number of Tax <i class="text-danger">*</i>' ,['class'=>'col-form-label text-left ']))   !!}

                                                        </div>
                                                        <div class="col-sm-8">
                                                            {!!  Form::text('number_of_tax',null,['id'=>'rate','class'=>'form-control','placeholder'=>'Number of Tax ','required']) !!}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            &nbsp;
                                            <div class="row">
                                                <div class="col-sm-12 text-center">
                                                            {!! Form::submit('Submit', array('class' => 'btn btn-success px-5 py-2')) !!}

                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                    </div>

                                </div>
                            </div>

                </div><!-- container -->

               @include('includes.dashboard-footer')
            </div>

    @endsection
        @endsection
