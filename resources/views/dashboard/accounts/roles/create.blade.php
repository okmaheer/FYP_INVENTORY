@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
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
                        {!! Form::open(['route' => ['dashboard.accounts.roles.store'], 'method' => 'POST', 'files' => true] ) !!}
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {!! Form::label('name', 'Name') !!}
                                    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'id' => 'name','placeholder'=>'Enter Unique Name in Lower Case']) !!}
                                    @error('name')
                                    <span class="invalid-feedback d-block"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {!! Form::label('label', 'Label') !!}
                                    {!! Form::text('label', null, ['class' => 'form-control', 'required', 'id' => 'name','placeholder'=>'Enter Label In Camel Case']) !!}
                                    @error('label')
                                    <span class="invalid-feedback d-block"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('users', 'Users') !!}
                            {!! Form::select('users[]', $users, null, array('id' => 'users',
                            'class' => 'form-control selectpicker show-menu-arrow', 'data-live-search' => 'true', 'data-selected-text-format' => 'count > 3',
                            'data-size' => '10', 'data-actions-box' => 'true','data-placeholder'=>'Select Users','required','multiple')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('permissions', 'Permissions') !!}
                            {!! Form::select('permissions[]', $permissions, null, array('id' => 'permissions',
                            'class' => 'form-control selectpicker show-menu-arrow', 'data-live-search' => 'true', 'data-selected-text-format' => 'count > 3',
                            'data-size' => '10', 'data-actions-box' => 'true','data-placeholder'=>'Select Permissions','required','multiple')) !!}
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
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        (function () {
            $('select').select2();
        })();
    </script>
@endsection