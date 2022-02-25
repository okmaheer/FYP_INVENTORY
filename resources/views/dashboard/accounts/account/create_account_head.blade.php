@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

@include('includes.dashboard-breadcrumbs')

    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    @include('includes.messages')
                    <div class="penal-title  border-grey border-bottom">
                        <h4 class="p-3 text-dark">{{ $page_title }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                    {!! Form::open(['route' => 'add.account', 'files' => true, 'id'=>'voucher_form', 'class' => 'solid-validation'] ) !!}
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            {!!  Html::decode( Form::label('parent_head' ,'Parent Head <i class="text-danger">*</i>' ,['class'=>'col-form-label']) )  !!}
                                        </div>
                                        <div class="col-sm-9">
                                            {!!  Form::select('parent_head',$parentHead,null,['id'=>'parent_head',
                                            'class'=>'select2 form-control mb-3 custom-select float-right','style'=>'width:100%',
                                            'placeholder'=>'Select Parent Head', 'required'])
                                        !!}

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            {!!  Html::decode(Form::label('child_account' ,'Child Account <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                        </div>
                                        <div class="col-sm-9">
                                            {!!  Form::text('child_account',null,['id'=>'child_account','class'=>'form-control ','required', 'autocomplete'=>'off']) !!}
                                        </div>
                                    </div>
                                    @include('dashboard.accounts.common.buttons.buttons-crud', ['save'=>true])

                                    {!! Form::close() !!}
                            </div>

                        </div>
                    </div>
                    <!--end card-body-->
                </div>
            </div>
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


