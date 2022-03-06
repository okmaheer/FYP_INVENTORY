@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/dropify/css/dropify.min.css') }}">
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@include('includes.dashboard-breadcrumbs')

@section('body')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::model($model, ['route' => ['dashboard.accounts.users.update', $model->id], 'method' => 'PUT', 'files' => true] ) !!}
                        {!! csrf_field() !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'required', 'id' => 'name','placeholder'=>'first last name']) !!}
                            @error('name')
                            <span class="invalid-feedback d-block"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'Email/UserName') !!}
                            {!! Form::text('email', null, ['class' => 'form-control', 'required', 'id' => 'email','placeholder'=>'test@gmail.com']) !!}
                            @error('email')
                            <span class="invalid-feedback d-block"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'Password') !!}
                            {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
                            @error('password')
                            <span class="invalid-feedback d-block"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('avatar', 'Avatar') !!}
                            {!! Form::file('avatar', array('id' => 'avatar','class' => 'dropify','data-default-file'=>asset($model->avatar))) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('roles', 'Roles') !!}
                            {!! Form::select('roles[]', $roles, null, array('id' => 'roles',
                            'class' => 'form-control selectpicker show-menu-arrow', 'data-live-search' => 'true', 'data-selected-text-format' => 'count > 3',
                            'data-size' => '10', 'data-actions-box' => 'true','data-placeholder'=>'Select Roles','required','multiple')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::checkbox('active',$model->active?1:null,$model->active?"1":"0",['id'=>'active']) !!}
                            {!! Form::label('active','Is Active') !!}
                        </div>
                        <div class="form-group text-right">
                            {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
                            <button type="button" class="btn btn-danger">Cancel</button>
                        </div>
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
    <script src="{{ asset('dashboard/plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        (function () {
            $('.dropify').dropify();
            $('select').select2();
        })();
    </script>
@endsection