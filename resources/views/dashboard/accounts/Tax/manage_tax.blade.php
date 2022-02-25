@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    @include('includes.datatable-css')
@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')

    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    @include('includes.messages')  <!--ALert Message--->
                    <div class="penal-title ">
                        <h4 class="p-3 text-dark">{{ __('accounts.tax.manage_tax') }}</h4>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>{{ trans('accounts.general.sr') }}</th>
                                <th>{{ trans('accounts.tax.tax_name') }}</th>
                                <th>{{ trans('accounts.tax.tax_type') }}</th>
                                <th>{{ trans('accounts.general.value') }}</th>
                                <th>{{ trans('accounts.general.status') }}</th>
                                <th class="text-center">{{ trans('accounts.general.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($taxes as $key =>$data)
                                <tr>
                                    <td>{{ $key +1 }}</td>
                                    <td>{{ $data->tax_name }}</td>
                                    <td>{{ \AccountHelper::FixPercentTypes( $data->tax_type ) }}</td>
                                    <td>{{ $data->tax_value }} {{ $data->tax_type == 2 ? '%' : '' }}</td>
                                    <td>{{ \AccountHelper::manualStatus( $data->status ) }}</td>
                                    <td>
                                        <form action="{{ route('dashboard.accounts.tax.destroy',$data->id) }}" method="POST" id="deleteForm{{$data->id}}" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        @can('edit', \App\Models\Tax::class)
                                        <a href="{{ route('dashboard.accounts.tax.edit', $data->id) }}"
                                           class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                        @endcan
                                        @can('delete', \App\Models\Tax::class)
                                        <a href="javascript:void(0);" onclick="DeleteEntry({{$data->id}});" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.accounts.tax.create'])
@endsection
