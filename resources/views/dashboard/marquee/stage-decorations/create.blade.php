@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('content')
@section('innerStyleSheet')
@endsection
@include('includes.dashboard-breadcrumbs')
@section('body')

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                @include('includes.messages')
                                <div class="card-body">
                                    {!! Form::open(['route' => ['dashboard.marquee.stage-decorations.store'], 'method' => 'POST', 'files' => true, 'id' => 'stage_form', 'class' => 'solid-validation'] ) !!}
                                    <div class="form-group">
                                        {!! Html::decode(Form::label('name', 'Name <i class="text-danger">*</i>')) !!}
                                        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name','required']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('price', 'Price') !!}
                                        {!! Form::number('price', null, ['step'=>'any','min'=>'0','class' => 'form-control', 'id' => 'price']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('barcode', 'BarCode') !!}
                                        {!! Form::text('barcode', null, ['class' => 'form-control', 'id' => 'barcode']) !!}
                                    </div>
                                    @include('dashboard.accounts.common.buttons.buttons-crud', ['save' => true, 'save_new' => true, 'form_id' => 'stage_form', 'cancel' => true, 'cancel_route' => 'dashboard.marquee.stage-decorations.index'])
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection
@endsection
@section('innerScriptFiles')
@endsection
@section('innerScript')

@endsection
