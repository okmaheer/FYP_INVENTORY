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
                    @include('dashboard.marquee.filters.stagequotation_report_filter',['route'=>'stagequotation.report'])
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            @include('includes.messages')  <!--ALert Message--->
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>

                                            <th>Id</th>
                                            <th>Person Name</th>
                                            <th>Event Date</th>
                                            <th>Event Time</th>
                                            <th>Stage Decorations</th>
                                            <th>Grand Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $d)
                                        <tr>

                                            <td class="text-center">
                                                {{ $d->quot_number }}
                                            </td>
                                            <td class="text-center">
                                                {{ $d->customer_name }}
                                            </td>
                                            <td class="text-center">
                                                {{ \AccountHelper::date_format( $d->event_date ) }}
                                            </td>
                                            <td class="text-center">
                                                {{ MarqueeHelper::eventTime($d->event_time) }}
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm" width="200">
                                                    @if(count($d->stageDecorations))
                                                        @foreach($d->stageDecorations as $stageDecoration)
                                                            <option>{{ $stageDecoration->name }}</option>
                                                        @endforeach
                                                    @else
                                                        <option>No Stage Decorations</option>
                                                    @endif
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                {{ \AccountHelper::number_format( $d->grand_total ) }}
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.marquee.quotation.stage.create'])
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
