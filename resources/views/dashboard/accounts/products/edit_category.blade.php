@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

@include('includes.dashboard-breadcrumbs')

@section('body')
            <div class="page-content">
                <div class="container">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="penal-title  border-grey border-bottom">
                                    @if(isset($pageTittle) && $pageTittle != '')
                                        <h4 class="p-3 text-dark">{{ $pageTittle }}</h4>
                                    @endif
                                </div>
                                <div class="general-label pt-4">

                                    {!!  Form::model($category, ['route' => ['dashboard.accounts.category.update', $category] , 'files' => true, 'class' => 'solid-validation' ]) !!}
                                        @csrf
                                        <input name="_method" type="hidden" value="PATCH">
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('name' ,'Category Name <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('name',null,['id'=>'name','class'=>'form-control ','placeholder'=>'Category Name']) !!}

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                            <label for="horizontalInput2" class=" col-form-label">Status  <i class="text-danger">*</i> :</label>
                                            </div>
                                            <div class="col-sm-10">
                                                <select name="status" class="select2 form-control mb-3 custom-select float-right" >
                                                    <option>Select option</option>
                                                            <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                                                            <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>

                                    @include('dashboard.accounts.common.buttons.buttons-crud', ['update' => true, 'cancel' => true, 'cancel_route' => 'dashboard.accounts.category.index'])
                                        {!! Form::close() !!}
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

