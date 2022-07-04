@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link href="{{ url('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('dashboard/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('dashboard/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('includes.dashboard-breadcrumbs')
@section('body')
    <div class="page-content">
        <div class="container-fluid">
            {!! Form::open(['route' => 'dashboard.accounts.purchase.store', 'files' => true, 'id' => 'purchase_form', 'class' => 'solid-validation']) !!}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="panel-title">
                            <div class="row border-grey border-bottom">
                                <div class="col-lg-6">
                                    <h3 class="p-3 text-dark">{{ trans('accounts.purchase.new_purchase') }}</h3>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            @include('dashboard.purchase.components.general')
                            <div class="row">
                                @include('dashboard.purchase.components.items')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @include('dashboard.purchase.components.totals')

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @include(
                                'includes.buttons.buttons-crud',
                                [
                                    'save' => true,
                                    'save_print' => true,
                                    'form_id' => 'purchase_form',
                                    'reset' => 'true',
                                    'cancel' => true,
                                    'cancel_route' => 'dashboard.accounts.purchase.index',
                                    'full_paid' => true,
                                    'paid_field' => 'paid_amount',
                                    'total_field' => 'net_total_amount',
                                ]
                            )

                        </div>
                    </div>
                </div>


                {!! Form::close() !!}
            </div>
            @include('includes.dashboard-footer')
        </div>

    @endsection
@endsection
@include('dashboard.purchase.components.scripts')
