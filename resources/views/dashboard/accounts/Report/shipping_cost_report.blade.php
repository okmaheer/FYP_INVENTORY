@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
@include('includes.dashboard-breadcrumbs')

@section('body')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="card">
                        @include('dashboard.accounts.common.filter-by-start-end-date',['route'=>'shipping.cost_report'])

                    </div>
                    <div class="card">
                        <div class="">
                            <div class="col-lg-12">
                                <div class="">
                                    @include('includes.report-header')
                                    <div class="container-fluid" id="printArea">
                                        @include('includes.company-detail-header')
                                        <div class="table-rep-plugin mt-3">
                                            <div class="table-responsive mb-3" data-pattern="priority-columns">
                                                <table class="table table-striped mb-0 table-bordered mb-0 table-centered" cellpadding="6" cellspacing="1" width="100%">
                                                    <div class="table-title">

                                                        <tbody>

                                                            <tr>
                                                                <th>Sr.</th>
                                                                <th>Sales Date</th>
                                                                <th>Invoice No</th>
                                                                <th>Shipping Cost</th>

                                                            </tr>
                                                            @php $balance = $paidAmount = $dueAmount =0; @endphp
                                                            @forelse($report as $key => $report)
                                                                @php
                                                                    $balance += $report->shipping_cost;
                                                                @endphp
                                                                <tr>
                                                                    <td>{{$key + 1}}</td>
                                                                    <td>{{$report->date}}</td>
                                                                    <td>{{$report->id}}</td>
                                                                    <td>{{$report->shipping_cost}}</td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="4"> No Record Found</td>
                                                                </tr>
                                                            @endforelse

                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <td colspan="3" class="text-right"><b>Total:</b></td>
                                                            <td><b>{{ $balance }}</b></td>
                                                        </tr>
                                                        </tfoot>



                                                    </div>

                                                </table>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                        </div>

                    </div>

                </div><!-- container -->

               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection



