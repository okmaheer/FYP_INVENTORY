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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            @include('dashboard.accounts.common.purchase-filter-with-booking',['route'=>'dashboard.accounts.purchase.index'])
                        </div>
                    </div>
                </div>
                <div class="row" id="printArea">
                    <div class="col-md-12">
                        <div class="card">
                            @include('includes.messages')  <!--ALert Message--->
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('accounts.general.sr') }}</th>
                                            <th>{{ trans('accounts.general.invoice_no') }}</th>
                                            <th>{{ trans('accounts.general.bookings') }}</th>
                                            <th>{{ trans('accounts.general.supplier_name') }}</th>
                                            <th>{{ trans('accounts.general.purchase_date') }}</th>
                                            <th>{{ trans('accounts.general.amount_total') }}</th>
                                            <th>{{ trans('accounts.general.attachment') }}</th>
                                            <th class="text-center">{{ trans('accounts.general.action') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                            @foreach ($purchases as $key =>$purchase)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$purchase->chalan_no}}</td>
                                                    <td>
                                                        @if (!empty($purchase->booking))
                                                            <a href="{{ route('marquee.booking.sheet.function',$purchase->booking_id) }}" target="_blank">{{$purchase->booking->custom_booking_number}}</a>
                                                        @endif
                                                    </td>
                                                    <td>{{$purchase->supplier->supplier_name}}</td>
                                                    <td>{{ \AccountHelper::date_format( $purchase->purchase_date ) }}</td>
                                                    <td>{{ \AccountHelper::number_format($purchase->net_total_amount) }}</td>
                                                    <td>
                                                        @if (file_exists(($purchase->attachment)))
                                                            <a href="{{ asset($purchase->attachment) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <form action="{{ route('dashboard.accounts.purchase.destroy', $purchase->id)}}" method="POST" id="deleteForm{{ $purchase->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        @can('edit', \App\Models\Purchase::class)
                                                            <a href="{{ route('dashboard.accounts.purchase.edit',$purchase->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                        @endcan
                                                        @can('viewInvoice', \App\Models\Purchase::class)
                                                            <a href="{{ route('dashboard.accounts.purchase.invoice',$purchase->id) }}" target="_blank" class="btn btn-sm btn-warning"><i class="fas fa-file-invoice"></i></a>
                                                        @endcan
                                                        @can('delete', \App\Models\Purchase::class)
                                                            <button type="button" onclick="DeleteEntry({{ $purchase->id }});" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
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
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.accounts.purchase.create'])
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
