@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
@section('innerStyleSheet')
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@include('includes.dashboard-breadcrumbs')

@section('body')
            <div class="page-content">
                <div class="container-fluid">

                        <div class="card">
                            @include('includes.messages')
                            <div class="card-body">

                                <div class="penal-title  border-grey border-bottom">
                                    <h4 class=" text-dark pb-3">Add Category</h4>
                                </div>
                                <div class="general-label pt-4">
                                    {!! Form::open(['route' => 'dashboard.accounts.category.store', 'files' => true, 'id' => 'category_form', 'class' => 'solid-validation'] ) !!}

                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('name' ,'Category Name <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}

                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('name',null,['id'=>'name','class'=>'form-control ','placeholder'=>'Category Name', 'required']) !!}

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">

                                                {!!  Html::decode(Form::label('status' ,'Status <i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                            </div>

                                            <div class="col-sm-10">

                                                {!!  Form::select('status', AccountHelper::manualStatus(),null,['id'=>'status',
                                                        'class'=>'select2 form-control mb-3 custom-select float-right',
                                                        'placeholder'=>'Select Status/Option', 'required'])
                                                !!}
                                            </div>
                                        </div>

                                        @include('dashboard.accounts.common.buttons.buttons-crud', ['save' => true, 'save_new' => true, 'form_id' => 'category_form', 'cancel' => true, 'cancel_route' => 'dashboard.accounts.category.index'])
                                        {!! Form::close() !!}
                                    {{-- </form> --}}
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
    <!-- Plugins js -->
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
@endsection
@section('innerScript')
    <script>
        (function (){
            $('.select2').select2();
        })();
    </script>
 @endsection



