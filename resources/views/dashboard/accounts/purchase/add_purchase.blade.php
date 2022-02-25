@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('includes.dashboard-breadcrumbs')
    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                {!! Form::open(['route' => 'dashboard.accounts.purchase.store', 'files' => true, 'id' => 'purchase_form', 'class' => 'solid-validation'] ) !!}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @include('dashboard.accounts.purchase.components.general')
                                <div class="row">
                                    @include('dashboard.accounts.purchase.components.items')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                @include('dashboard.accounts.purchase.components.totals')
                                @include('dashboard.accounts.common.buttons.buttons-crud',
                                    ['save' => true, 'save_print' => true, 'form_id' => 'purchase_form', 'reset' => 'true',
                                    'cancel' => true, 'cancel_route' => 'dashboard.accounts.purchase.index',
                                    'full_paid' => true, 'paid_field' => 'paid_amount', 'total_field' => 'net_total_amount'])
                            </div>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
           @include('includes.dashboard-footer')
        </div>

        @include('dashboard.accounts.common.modals.supplier-model')
        @include('dashboard.accounts.common.modals.product-model')
    @endsection
@endsection
@include('dashboard.accounts.purchase.components.scripts')
