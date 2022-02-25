@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')

    @include('includes.dashboard-breadcrumbs')
    <style>
        .col-sm-2::selection {
            color: #fff;
            background-color: #37a000;
        }

        .text-success::selection {
            color: #fff;
            background-color: #37a000;

        }

    </style>
@section('body')
    <div class="page-content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">

                    <div class="general-label">
                        {{-- {!! Form::open(['route' => 'supplier.store', 'files' => true] ) !!} --}}
                        {!! csrf_field() !!}
                        <div class="row ">
                            <div class="col-5">
                                <div class="col-sm-12">
                                    {!! Html::decode(Form::label('from_date', 'FromDate   <i class="text-danger">*</i>', ['class' => ' col-form-label'])) !!}
                                    {!! Form::date('from_date', null, ['id' => 'from_date', 'class' => 'form-control ', 'placeholder' => '2021-04-03']) !!}
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="col-sm-12">
                                    {!! Html::decode(Form::label('date', 'To Date   <i class="text-danger">*</i>', ['class' => ' col-form-label'])) !!}
                                    {!! Form::date('to_date', null, ['id' => 'to_date', 'class' => 'form-control ', 'placeholder' => '2021-04-03']) !!}
                                </div>
                            </div>

                            <div class="col-2 text-right mt-4">
                                {!! Form::submit('Find', ['class' => 'btn btn-primary w-sm']) !!}
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
