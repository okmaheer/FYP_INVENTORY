@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')

    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                    <div class="card">
                        <div class="panel-title ">
                            <div class="row border-grey border-bottom">
                                <div class="col-lg-12">
                                    <h3 class="p-3 text-dark text-center">{{__('accounts.income.edit_head')}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="general-label">
                                {!! Form::model($model , ['route' => ['dashboard.accounts.incomehead.update', $model->id], 'files' => true, 'id' => 'income_head_form', 'class' => 'solid-validation'] ) !!}
                                @method('PATCH')

                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            {!!  Html::decode(Form::label('income_head_name' ,__('accounts.income.name_head').'<i class="text-danger">*</i>' ,['class'=>' text-right col-form-label']))   !!}
                                        </div>
                                        <div class="col-md-5">
                                            {!!  Form::text('income_head_name',null,['id'=>'income_head_name','class'=>'form-control ', 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            {!!  Html::decode(Form::label('parent_id' ,__('accounts.income.name_parent'),['class'=>' text-right col-form-label']))   !!}
                                        </div>
                                        <div class="col-md-5">
                                            {!!  Form::select('parent_id', $parentHeads,null,['id'=>'parent_id',
                                                'class'=>'select2 form-control mb-3 custom-select float-right',
                                                'placeholder'=>'Select Parent Income Head', 'disabled'])
                                            !!}
                                        </div>
                                    </div>
                                    @include('dashboard.accounts.common.buttons.buttons-crud', ['update' => true, 'cancel' => true, 'cancel_route' => 'dashboard.accounts.incomehead.index'])

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
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        (function () {
            $('.select2').select2();
        })();
    </script>
@endsection
