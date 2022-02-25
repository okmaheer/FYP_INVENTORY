@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
@include('includes.dashboard-breadcrumbs')
@section('body')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="card">
                        @include('dashboard.accounts.common.filter-by-start-end-date',['route'=>'closing.report'])
                    </div>
                    <div class="card" id="printArea">
                        <div class="card-body">
                            @include('includes.company-detail-header')
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped mb-0 table-bordered dt-responsive nowrap container-fluid mb-4" cellpadding="6" cellspacing="1" width="100%">
                                        <thead>
                                                <tr>
                                                    <td class="text-center">SL.</td>
                                                    <td class="text-center">Date</td>
                                                    <td class="text-center">Cash In	</td>
                                                    <td class="text-center">Cash Out</td>
                                                    <td class="text-center">Balance</td>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @php $cash_in_hand = 0; @endphp
                                            @forelse($dailyClosing as $data)
                                                @php
                                                    $cash_in_hand += $data->cash_in - $data->cash_out;
                                                @endphp
                                                <tr>
                                                    <td>1</td>
                                                    <td>{{$data->date}}</td>
                                                    <td>{{$data->cash_in}}</td>
                                                    <td>{{$data->cash_out}}</td>
                                                    <td>{{$cash_in_hand}}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center"> No Record Found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @include('includes.report-footer')
                        </div>
                    </div>

                </div><!-- container -->

               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection



