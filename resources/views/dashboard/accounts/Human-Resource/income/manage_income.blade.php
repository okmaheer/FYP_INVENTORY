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
                    <div class="row ">
                        <div class="col-12">
                            <div class="card">
                                @include('includes.messages')  <!--ALert Message--->
                                <div class="card-body">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="no-sort"></th>
                                                <th class="text-center">{{__('accounts.income.sl')}}</th>
                                                <th class="text-center">{{__('accounts.income.date')}}</th>
                                                <th class="text-center">{{__('accounts.income.e_head')}}</th>
                                                <th class="text-center">{{__('accounts.income.p_type')}}</th>
                                                <th class="text-center">{{__('accounts.general.details')}}</th>
                                                <th class="text-center">{{__('accounts.income.amount')}}</th>
                                                <th class="text-center">{{__('accounts.general.action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $totalIncome = 0; @endphp
                                            @forelse($income as $key => $data)
                                                @php $totalIncome += $data->amount ; @endphp
                                                <tr>
                                                    <td></td>
                                                    <td class="text-center">{{$key+1}}</td>
                                                    <td class="text-center">{{ \AccountHelper::date_format( $data->date ) }}</td>
                                                    <td class="text-center">{{$data->income_HeadName->income_head_name}}</td>
                                                    <td class="text-center">{{ \AccountHelper::paymentTypes($data->payment_type) }}</td>
                                                    <td class="text-center">{{$data->description}}</td>
                                                    <td class="text-center">{{ \AccountHelper::number_format($data->amount) }}</td>
                                                    <td class="text-center">
                                                        @can('viewReceipt', \App\Models\Income::class)
                                                            <a href="{{ route('dashboard.accounts.income.show', $data->id) }}" target="_blank" class="btn btn-warning btn-sm"><i class="fas fa-file-invoice"></i></a>
                                                        @endcan
                                                        @can('delete', \App\Models\Income::class)
                                                        <button type="button" onclick="DeleteEntry({{$data->id}});" class="btn btn-sm btn-danger text-white tippy-btn" title="Delete Record!"><i class="fas fa-trash"></i></button>
                                                        @endcan
                                                        <form action="{{ route('dashboard.accounts.income.destroy',$data->id) }}" method="POST" id="deleteForm{{$data->id}}" style="display: none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                             @empty
                                                <tr>
                                                    <td class="text-center" colspan="8">{{ __('accounts.general.no_data') }}</td>
                                                </tr>
                                            @endforelse

                                            <!-- <tr>
                                                <td colspan="6" class="text-right font-weight-bold">{{ __('accounts.general.total') }}</td>
                                                <td colspan="2" class="text-left font-weight-bold">{{ \AccountHelper::number_format($totalIncome) }}</td>
                                            </tr> -->
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>


                </div><!-- container -->

               @include('includes.dashboard-footer')
            </div>
            <!-- end page content -->
            </div>
            <!--end page-wrapper-inner -->

        </div>
        <!-- end page-wrapper -->
    @endsection
@endsection
@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    @include('includes.datatable-js')
@endsection
@section('innerScript')
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.accounts.income.create'])
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
