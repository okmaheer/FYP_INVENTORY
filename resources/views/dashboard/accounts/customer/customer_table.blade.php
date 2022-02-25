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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                @include('dashboard.accounts.common.customer-filter-manage',['route'=>'dashboard.accounts.customer.index'])
                            </div>
                            <div class="card" id="printArea" style="width: 99%;">
                            @include('includes.messages')  <!--ALert Message--->
                                <div class="panel-title border-grey border-bottom">
                                    <h4 class="p-3 text-dark text-center">{{ __('accounts.customers.list') }}</h4>
                                </div>

                                <div class="card-body">
                                    <table id="datatable" class="table table-bordered dt-responsive"
                                        style="border-collapse: collapse; border-spacing: 0; width: 99%;">
                                        <thead>
                                            <tr>
                                                <th class="no-sort"></th>
                                                <th>{{__('accounts.customers.sl')}}</th>
                                                <th>{{__('accounts.customers.name')}}</th>
                                                <th>{{__('accounts.customers.mobile')}}</th>
                                                <th>{{__('accounts.general.cnic')}}</th>
                                                <th>{{__('accounts.customers.city')}}</th>
                                                <th>{{__('accounts.customers.balance')}}</th>
                                                <th>{{__('accounts.customers.action')}}</th>

                                            </tr>

                                        </thead>
                                        <tbody>
                                                @forelse($customer as $data)
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{$data->customer_name}}</td>
                                                        <td>{{$data->customer_mobile}}</td>
                                                        <td>{{$data->cnic}}</td>
                                                        <td>{{$data->city}}</td>
                                                        <td>{{$data->previous_balance}}</td>
                                                        <td class="text-center">
                                                            <form action="{{ route('dashboard.accounts.customer.destroy', $data->id)}}" method="POST" id="deleteForm{{ $data->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            @can('edit', \App\Models\Customer::class)
                                                                <a href="{{ route('dashboard.accounts.customer.edit',$data->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                            @endcan
                                                            @can('delete', \App\Models\Customer::class)
                                                                <button type="button" onclick="DeleteEntry({{$data->id}});" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center" colspan="8" align="right">no data found</td>
                                                    </tr>

                                                @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>

                </div>

                <!-- container -->

                @include('includes.dashboard-footer')
            </div>

    @endsection

@endsection

@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    @include('includes.datatable-js')
@endsection

@section('innerScript')
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.accounts.customer.create'])
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
