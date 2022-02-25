@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')
@section('body')
    <div class="page-content">
        <div class="container-fluid">
            {!! Form::model($model, [ 'route' => ['dashboard.accounts.sale.update', $model->id],'files' => true,'id' => 'sale_form', 'class' => 'solid-validation' ]) !!}
            @method('PATCH')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="panel-title ">
                            <div class="row border-grey border-bottom">
                                <div class="col-lg-6">
                                    <h3 class="p-3 text-dark">{{ $page_title }}</h3>
                                </div>
                                <div class="d-flex col-lg-6 align-items-center justify-content-end">
                                    <h3 id="amount_span" class="text-dark p-3" style="display: none;">
                                        Previous Balance: <b><span id="amount_balance" class="text-muted">0.00</span></b>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('dashboard.accounts.sale.components.general', ['for' => 'edit'])
                            @include('dashboard.accounts.sale.components.items', ['for' => 'edit'])
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @include('dashboard.accounts.sale.components.totals', ['for' => 'edit'])
                            @include('dashboard.accounts.common.buttons.buttons-crud',
                                ['update' => true, 'update_print' => true, 'form_id' => 'sale_form',
                                'cancel' => true, 'cancel_route' => 'dashboard.accounts.sale.index',
                                'full_paid' => true, 'paid_field' => 'paid_amount', 'total_field' => 'net_total'])
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
        @include('includes.dashboard-footer')
    </div>
    @include('dashboard.accounts.common.modals.customer-model')
@endsection
@endsection

@include('dashboard.accounts.sale.components.scripts', ['for' => 'edit'])
