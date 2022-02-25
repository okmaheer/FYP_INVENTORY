@extends('layouts.dashboard')
@section('page_title')
@section('content')
@include('includes.dashboard-breadcrumbs')
<style>
  /* .col-sm-1{
      margin-left: -115px;
  } */
</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row  mb-2">
                        <div class="col-sm-12">
                            <a href="#" class="btn btn-info m-b-5 m-r-2">
                                <i class="ti-align-justify"></i> &nbsp;Currency List
                            </a>

                        </div>
                    </div>

                        <div class="card">
                            <div class="penal-tilte  border-grey border-bottom">
                            <h4 class="p-3 text-success">Add Currency</h4>
                            </div>
                            <div class="card-body">

                                <div class="general-label">
                                    {{-- {!! Form::open(['route' => 'dashboard.accounts.supplier.store', 'files' => true] ) !!} --}}
                                    {!! csrf_field() !!}
                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('currency_name' ,'Currency Name <i class="text-danger">*</i>' ,['class'=>'col-form-label'])) !!}
                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('currency_name',null,['id'=>'currency_name','class'=>'form-control ','placeholder'=>'Currency Name','required']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2">
                                                {!!  Html::decode(Form::label('surrency_symbol' ,'Currency Symbol <i class="text-danger">*</i>' ,['class'=>'col-form-label'])) !!}
                                            </div>
                                            <div class="col-sm-10">
                                                {!!  Form::text('surrency_symbol',null,['id'=>'surrency_symbol','class'=>'form-control ','placeholder'=>'Currency Symbol']) !!}
                                            </div>
                                        </div>




                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                {!! Form::submit('Reset', array('class' => 'btn btn-danger')) !!}
                                                {!! Form::submit('Save', array('class' => 'btn btn-success')) !!}
                                                {{-- <button type="submit" class="btn btn-danger">Reset</button>
                                                <button type="submit" class="btn btn-success">Save</button> --}}

                                            </div>
                                        </div>
                                    </form>
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

