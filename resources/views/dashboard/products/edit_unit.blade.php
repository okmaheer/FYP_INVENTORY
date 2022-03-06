@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

@include('includes.dashboard-breadcrumbs')

@section('body')
            <div class="page-content">
                <div class="container-fluid">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="panel-title  border-grey border-bottom">
                                <h4 class="p-3 text-dark">Modify Unit</h4>
                            </div>
                            <div class="card-body">
                                            {!!  Form::model($unit, ['route' => ['dashboard.accounts.unit.update', $unit->id] , 'files' => true, 'class' => 'solid-validation' ]) !!}
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    {!!  Html::decode(Form::label('unit_name' ,'Unit Name <i class="text-danger">*</i>' ,['class'=>'col-form-label ']))   !!}

                                                </div>
                                                <div class="col-sm-10">
                                                    {!!  Form::text('unit_name',null,['id'=>'unit_name','class'=>'form-control ','placeholder'=>'Unit Name', 'required']) !!}

                                                </div>
                                            </div>


                                            {!! Form::submit('Update', ['id' => 'btn_save', 'class' => 'btn btn-success waves-effect waves-light w-md float-right']) !!}
                                            {!! Form::close() !!}
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                </div><!-- container -->

               @include('includes.dashboard-footer')
            </div>

@endsection
        @endsection

@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
 @endsection
@section('innerScript')
    <script>
        (function (){
            $('.select2').select2();
        })();
    </script>
@endsection
