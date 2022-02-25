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
                                        <th class="text-center">Purchase Price</th>
                                        <th class="text-center">In Qnty.</th>
                                        <th class="text-center">Stock Purchase Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $ttlStock = $stockSalePrice = $stockPurchasePrice = 0; @endphp
                                    @foreach($data as $key => $data)
                                        @php
                                            $stockPurchasePrice += $data['purchase_p'];
                                         @endphp
                                        <tr>
                                            <td>{{$data['product_name']}}</td>
                                            <td>{{AccountHelper::number_format($data['purchase_p'])}}</td>

                                            <td>{{AccountHelper::number_format($data['totalPurchaseQnty'])}}</td>

                                            <td class="text-right">{{AccountHelper::number_format($data['purchase_total'])}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right"><b>Total</b></td>
                                        <td class="text-right"><b>Pkr {{AccountHelper::number_format($stockPurchasePrice)}}</b></td>
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

