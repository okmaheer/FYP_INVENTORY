@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    @include('includes.datatable-css')
@endsection
@section('content')
@include('includes.dashboard-breadcrumbs')
@section('body')
    <div class="page-content">
        <div class="container-fluid mb-5">

            <div class="row ">

                <div class="col-12">
                    <div class="card">
                        <div class="panel-title border-grey border-bottom">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="p-3 text-dark">{{ $page_title }}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">Product Name</th>
                                        <th class="text-center">Stock Qty.</th>
                                        <th class="text-center">Stock Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $ttlStock = $stockvalue = 0; @endphp
                                    @foreach($data as $key => $data)
                                        @php
                                            $stockvalue += $data->stock_value;
                                            $ttlStock += $data->stock;
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{$data->product_name}}</td>
                                            <td class="text-center">{{AccountHelper::number_format($data->stock,2)}}</td>
                                            <td class="text-center">{{AccountHelper::number_format($data->stock_value,2)}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-center"><b>Total</b></td>
                                        <td class="text-center" ><b>{{AccountHelper::number_format($ttlStock,2)}}</b></td>
                                        <td class="text-center" ><b>Pkr {{AccountHelper::number_format($stockvalue,2)}}</b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('includes.dashboard-footer')
    </div>

@endsection

@endsection

@section('innerScriptFiles')
    @include('includes.datatable-js')
@endsection
@section('innerScript')
    @include('includes.datatable-init', ['table' => 'datatable'])
@endsection
