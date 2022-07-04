@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
<link rel="stylesheet" href="{{ url('dashboard/plugins/dropify/css/dropify.min.css') }}">
<link href="{{ url('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@include('includes.dashboard-breadcrumbs')

@section('body')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route' => ['dashboard.accounts.admins.store'], 'method' => 'POST', 'files' => true] ) !!}
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
                            {!! Form::file('avatar', array('id' => 'avatar','class' => 'dropify')) !!}
                        </div>
                        <div class="form-group">
                            {{-- {!! Form::label('roles', 'Roles') !!} --}}
                            {!! Form::hidden('roles',$roles[0], ['class' => 'form-control', 'required', 'id' => 'roles']) !!}
                            {{-- {!! Form::hidden('roles',roles,array('id' => 'avatar','class' => 'dropify')) !!} --}}
                            {{-- {!! Form::select('roles[]', $roles, null, array('id' => 'roles',
                            'class' => 'form-control selectpicker show-menu-arrow', 'data-live-search' => 'true', 'data-selected-text-format' => 'count > 3',
                            'data-size' => '10', 'data-actions-box' => 'true','data-placeholder'=>'Select Roles','required','multiple')) !!} --}}
                        </div>
                        <div class="form-group custom-control custom-checkbox">
                            {!! Form::hidden('active',1, ['class' => 'form-control', 'required', 'id' => 'roles']) !!}
                            {{-- {!! Form::checkbox('active',null,false,['id'=>'active']) !!} --}}
                            {{-- {!! Form::label('active','Is Active') !!} --}}
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
    <script src="{{ url('dashboard/plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ url('dashboard/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ url('dashboard/plugins/select2/select2.min.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        (function () {
            $('.dropify').dropify();
            $('select').select2();
        })();
    </script>
@endsection