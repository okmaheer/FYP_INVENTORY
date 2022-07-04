@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    <link href="{{ url('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')
    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                @include('includes.messages')  <!--ALert Message--->
                    <div class="penal-title  border-grey border-bottom">
                        <h4 class="p-3 text-dark">{{__('accounts.supplier.advance')}}</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::open([ 'route' => 'add.supplier.advance','files' => true, 'class' => 'solid-validation', 'id' => 'supplier_form'] ) !!}
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    {!!  HTML::decode(Form::label('supplier_id' ,__('accounts.supplier.name').'<i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                </div>
                                <div class="col-sm-4">
                                    {!!  Form::select('supplier_id', $suppliers,null,['id'=>'supplier_id',
                                        'class'=>'select2 form-control', 'style'=>'width:100%;',
                                        'placeholder'=>'Select Supplier','required'])
                                    !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    {!!  HTML::decode(Form::label('advance_type' ,__('accounts.supplier.type').'<i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                </div>
                                <div class="col-sm-4">
                                    {!!  Form::select('advance_type', AccountHelper::advanceTypes(),null,['id'=>'advance_type',
                                        'class'=>'select2 form-control', 'style'=>'width:100%;',
                                        'placeholder'=>'Select Type','required'])
                                     !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    {!!  HTML::decode(Form::label('amount' ,__('accounts.supplier.amount').'<i class="text-danger">*</i>' ,['class'=>'col-form-label']))   !!}
                                </div>
                                <div class="col-sm-4">
                                    {!!  Form::number('amount',null,['step'=>'any', 'min'=>1, 'id'=>'amount','class'=>'form-control','placeholder'=>'0.00','required']) !!}
                                </div>
                            </div>
                        @include('dashboard.accounts.common.buttons.buttons-crud', ['save' => true, 'save_print' => true, 'cancel' => true, 'form_id' => 'supplier_form', 'cancel_route' => 'dashboard.accounts.supplier.index'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
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


