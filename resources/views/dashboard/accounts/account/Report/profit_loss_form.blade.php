@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
    @include('includes.dashboard-breadcrumbs')

@section('body')
            <div class="page-content">
                <div class="container-fluid">

                    {!! Form::open(['route' => 'profit.loss.report', 'files' => true] ) !!}
                    {!! csrf_field() !!}
                        <div class="card">
                            <div class="card-header bg-white">
                                <div class="row col-12">
                                    <h4 class="col-6">Search Record By</h4>
                                    <div class="col-lg-6 text-right">
                                        <div class="btn-group">
                                            {!! Form::submit('Search', ['class' => 'btn btn-primary w-sm']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row col-12">

                                        <div class="form-group col-4">
                                                {!!  Html::decode(Form::label('start_date' ,'From Date   <i class="text-danger">*</i>' ,['class'=>' col-form-label']))   !!}
                                            <div class="input-group">
                                                {!!  Form::text('start_date',\AccountHelper::date_format(\Carbon\Carbon::today()),['id'=>'start_date','class'=>'form-control datepicker','autocomplete'=>'off']) !!}
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                                {!!  Html::decode(Form::label('end_date' ,'To Date   <i class="text-danger">*</i>' ,['class'=>' col-form-label ']))   !!}
                                            <div class="input-group">
                                                {!!  Form::text('end_date',\AccountHelper::date_format(\Carbon\Carbon::today()),['id'=>'end_date','class'=>'form-control datepicker','autocomplete'=>'off']) !!}
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
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
