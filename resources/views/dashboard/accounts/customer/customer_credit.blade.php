@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    @include('includes.datatable-css')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')
@section('body')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="width: 99%;">
                        <div class="penal-title  border-grey border-bottom">
                            <h4 class="p-3 text-dark text-center">{{ __('accounts.customers.credit') }}</h4>
                        </div>
                        @include('includes.messages')
                        <!--ALert Message--->
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>{{ __('accounts.customers.sl') }}</th>
                                        <th>{{ __('accounts.customers.name') }}</th>
                                        <th>{{ __('accounts.customers.mobile') }}</th>
                                        <th>{{ __('accounts.customers.city') }}</th>
                                        <th>{{ __('accounts.customers.country') }}</th>
                                        <th>{{ __('accounts.customers.balance') }}</th>
                                    </tr>
                                </thead>


                                <tbody>

                                    @forelse($customer as $key => $data)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $data->customer_name }}</td>
                                            <td>{{ $data->customer_mobile }}</td>
                                            <td>{{ $data->city }}</td>
                                            <td>{{ $data->country }}</td>
                                            <td>{{ $data->balance }}</td>

                                        </tr>
                                    @empty
                                    @endforelse
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
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.accounts.customer.create'])
    <script>
        $(document).ready(function() {
            $('select').select2();
        });
    </script>
@endsection
