@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    @include('includes.datatable-css')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    @include('includes.dashboard-breadcrumbs')

    @section('body')
        <div class="page-content">
            <div class="container-fluid">

                <div class="card">
                    @include('dashboard.marquee.filters.stage_reports_filter',['route'=>'stage.report'])
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        @include('includes.messages')  <!--ALert Message--->
                            <div class="card-body">
                                <section id="printHolder">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>

                                        <th class="text-center no-sort">SL</th>
                                        <th>Person Name</th>
                                        <th>Event Date</th>
                                        <th>Event Time</th>
                                        <th>Grand Total</th>
                                        <th>Received Amount</th>
                                        <th>Due Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $key= 1;
                                        @endphp
                                    @foreach($data as $d)
                                        <tr>
                                            <td class="text-center">{{ $key++ }}</td>
                                            <td class="text-center">
                                                {{ $d->customer->customer_name }}
                                            </td>
                                            <td class="text-center">
                                                {{ \AccountHelper::date_format( $d->event_date ) }}
                                            </td>
                                            <td class="text-center">
                                                {{ \MarqueeHelper::eventTime( $d->event_time ) }}
                                            </td>
                                            <td class="text-center">
                                                {{ \AccountHelper::number_format( MarqueeHelper::stageTotalNetAmount($d->booking_id,$d->id) ) }}
                                            </td>
                                            <td class="text-center">
                                                {{ \AccountHelper::number_format( MarqueeHelper::stageAmountClc($d->booking_id,$d->id) ) }}
                                            </td>
                                            <td class="text-center">
                                                {{ AccountHelper::number_format( MarqueeHelper::stageTotalNetAmount($d->booking_id,$d->id) - MarqueeHelper::stageAmountClc($d->booking_id,$d->id) ) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                </section>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
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
