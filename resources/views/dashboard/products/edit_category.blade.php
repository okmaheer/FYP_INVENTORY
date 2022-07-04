@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link href="{{ url('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

@include('includes.dashboard-breadcrumbs')

@section('body')
            <div class="page-content">
                <div class="container-fluid">

                        <div class="card">
                            <div class="panel-title border-grey border-bottom">
                                <h4 class="p-3 text-dark">Modify Category</h4>
                            </div>
                            <div class="card-body">
                                <div class="general-label pt-4">

                                    {!!  Form::model($category, ['route' => ['dashboard.accounts.category.update', $category->id] , 'files' => true, 'class' => 'solid-validation' ]) !!}
                                    @csrf
                                    @method('PUT')   
                                    <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('name' ,'Category Name <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('name',null,['id'=>'name','class'=>'form-control ','placeholder'=>'Category Name', 'required']) !!}

                                            </div>
                                        </div>

                                        {{-- <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('status' ,'Status <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::select('status', AccountHelper::manualStatus(),null,['id'=>'status',
                                                    'class'=>'select2 form-control', 'style'=>'width:100%;',
                                                    'placeholder'=>'Select Status', 'required'])
                                                !!}
                                            </div>
                                        </div> --}}

                                 
                                        {!! Form::submit('Update', ['id' => 'btn_save', 'class' => 'btn btn-success waves-effect waves-light w-md float-right']) !!}
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
    <script src="{{ url('dashboard/plugins/select2/select2.min.js') }}"></script>
 @endsection

@section('innerScript')
    <script>
        (function (){
            $('.select2').select2();
        })();
    </script>
@endsection

