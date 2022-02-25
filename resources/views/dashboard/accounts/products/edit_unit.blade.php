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
                                @if(isset($pageTittle) && $pageTittle != '')
                                    <h4 class="p-3 text-dark">{{ $pageTittle }}</h4>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="general-label">


                                            {!!  Form::model($unit, ['route' => ['dashboard.accounts.unit.update', $unit] , 'files' => true, 'class' => 'solid-validation' ]) !!}
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    {!!  Html::decode(Form::label('unit_name' ,'Unit Name <i class="text-danger">*</i>' ,['class'=>'col-form-label ']))   !!}

                                                </div>
                                                <div class="col-sm-10">
                                                    {!!  Form::text('unit_name',null,['id'=>'unit_name','class'=>'form-control ','placeholder'=>'Unit Name']) !!}

                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                <label for="horizontalInput2" class=" col-form-label">Status  <i class="text-danger"> *</i> :</label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <select class="select2 form-control mb-3 custom-select float-right" name="status">
                                                        <option>Select option</option>
                                                            <option value="1" {{ $unit->status == 1 ? 'selected' : '' }}>Active</option>
                                                            <option value="0" {{ $unit->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>

                                            @include('dashboard.accounts.common.buttons.buttons-crud', ['update' => true, 'cancel' => true, 'cancel_route' => 'dashboard.accounts.unit.index'])
                                            {!! Form::close() !!}
                                    </div>
                                </div>

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
