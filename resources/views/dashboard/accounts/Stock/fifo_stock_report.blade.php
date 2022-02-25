@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
@section('innerStyleSheet')
    @include('includes.datatable-css')
@endsection
@include('includes.dashboard-breadcrumbs')

@section('body')
    <div class="page-content">
        <div class="container-fluid mb-5">

            <div class="row ">

                <div class="col-12">
                    <div class="card">
                        <div class="panel-title border-grey border-bottom">
                            <div class="row">

                            </div>
                        </div>
                        <div class="card-body">

                                    <table id="datatable"
                                           class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap">
                                        <thead>
                                        <tr>
                                            <th>Sr</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Stock Qnty.</th>
                                            <th>Inventory Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @php $ttlStock =  $stockPrice = 0; $stock = [];@endphp
                                        @forelse($products as $key => $data)
                                            @php

                                            $stock = QueryHelper::fifoStock($data->id);
                                            if(!empty($stock))
                                            {
                                                $ttlStock = $stock[0]->actual_stock;
                                                $stockPrice = $stock[0]->stock_value;
                                            }
                                             @endphp

                                            @if(!empty($stock))
                                                <tr>
                                                    <td class="text-right">{{$key}}</td>
                                                    <td class="text-right">{{$stock[0]->product_name}}</td>
                                                    <td class="text-right">{{$stock[0]->rate}}</td>
                                                    <td class="text-right">{{$stock[0]->actual_stock}}</td>

                                                    <td class="text-right">{{$stock[0]->stock_value}}</td>
                                                </tr>
                                            @endif


                                        @empty
                                            <tr>
                                                <td colspan="5"> No Record Found</td>
                                            </tr>
                                        @endforelse


                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right"><b>Total</b></td>
                                            <td class="text-right" ><b>{{$ttlStock}}</b></td>
                                            <td class="text-right" ><b>Pkr {{$stockPrice}}</b></td>
                                        </tr>
                                        </tfoot>
                                    </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>


        </div><!-- container -->

        @include('includes.dashboard-footer')
    </div>

@endsection

@endsection

@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    @include('includes.datatable-js')
@endsection
@section('innerScript')
    @include('includes.datatable-init', ['table' => 'datatable'])
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection

