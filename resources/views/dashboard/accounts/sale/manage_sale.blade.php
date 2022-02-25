@extends('layouts.dashboard')
@section('page_title', $page_title)
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
                    @include('dashboard.accounts.common.filter-by-start-end-date', ['route'=>'dashboard.accounts.sale.index', 'printme'=>'sale_table'])
                </div>

                <div class="row">
                    <div class="col-12">
                        <div id="printArea" class="card" style="width: 99%;">
                        @include('includes.messages')  <!--ALert Message--->
                            <div class="card-body">
                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>{{ trans('accounts.general.sr') }}</th>
                                                    <th>{{ trans('accounts.general.invoice_no') }}</th>
                                                    <th>{{ trans('accounts.general.customer_name') }}</th>
                                                    <th>{{ trans('accounts.general.invoice_date') }}</th>
                                                    <th>{{ trans('accounts.general.amount_total') }}</th>
                                                    <th class="text-center">{{ trans('accounts.general.action') }}</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            @foreach ($invoice as $key =>$invoice)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$invoice->invoice_no}}</td>
                                                    <td>{{$invoice->customer->customer_name}}</td>
                                                    <td>{{ \AccountHelper::date_format( $invoice->date ) }}</td>
                                                    <td>{{ \AccountHelper::number_format($invoice->net_total) }}</td>
                                                    <td class="text-center">
                                                        <form action="{{ route('dashboard.accounts.sale.destroy', $invoice->id)}}" method="POST" id="deleteForm{{ $invoice->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        @can('edit', \App\Models\Invoice::class)
                                                            <a href="{{ route('dashboard.accounts.sale.edit',$invoice->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                        @endcan
                                                        @can('viewInvoice', \App\Models\Invoice::class)
                                                            <a href="{{ route('dashboard.accounts.sale.invoice',$invoice->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-file-invoice"></i></a>
                                                        @endcan
                                                        @can('delete', \App\Models\Invoice::class)
                                                            <button type="submit" onclick="DeleteEntry({{ $invoice->id }});" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

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
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.accounts.sale.create'])
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
