@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
@endsection
@section('content')

@include('includes.dashboard-breadcrumbs')
@section('body')


            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                @include('includes.messages')
                                <div class="card-body">
                                    {!! Form::open(['route' => ['dashboard.marquee.add-on-features.store'], 'method' => 'POST', 'id' => 'addon_form', 'files' => true, 'class' => 'solid-validation'] ) !!}
                                    <div class="form-group">
                                        {!! Html::decode(Form::label('name', 'Name <i class="text-danger">*</i>')) !!}
                                        {!! Form::text('name', null, ['class' => 'form-control', 'required', 'id' => 'name']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Html::decode(Form::label('price', 'Price')) !!}
                                        {!! Form::number('price', null, ['step'=>'any','min'=>'0','class' => 'form-control', 'id' => 'price']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Html::decode(Form::label('barcode', 'Barcode')) !!}
                                        {!! Form::text('barcode', null, ['class' => 'form-control', 'id' => 'barcode']) !!}
                                    </div>
                                    @include('dashboard.accounts.common.buttons.buttons-crud', ['save' => true, 'save_new' => true, 'form_id' => 'addon_form', 'cancel' => true, 'cancel_route' => 'dashboard.marquee.add-on-features.index'])
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
