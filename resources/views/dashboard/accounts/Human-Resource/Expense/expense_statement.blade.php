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
                    <div class="card">
                        @include('dashboard.accounts.common.expenses-filter-by-start-end-date',['route'=>'expense.statement'])
                    </div>
                    @if (\Request::has('expense_head'))
                    <div class="card" id="printArea">
                        <div class="panel-title ">
                            <div class="row border-grey border-bottom">
                                <div class="col-md-12">
                                    <h3 class="p-3 text-dark text-center">{{__('accounts.expense.statment')}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort"></th>
                                                    <th>{{__('accounts.general.sr')}}</th>
                                                    <th class="text-left">{{__('accounts.expense.date')}}</th>
                                                    <th class="text-left">{{__('accounts.expense.e_head')}}</th>
                                                    <th class="text-center">{{__('accounts.general.payment_account')}}</th>
                                                    <th class="text-left">{{__('accounts.general.details')}}</th>
                                                    <th class="text-left">{{__('accounts.expense.amount')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $totalExpense = 0; @endphp
                                                @foreach($statement as $key => $data)
                                                    @php $totalExpense += $data->amount; @endphp
                                                    <tr>
                                                        <td></td>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{ \AccountHelper::date_format( $data->date ) }}</td>
                                                        <td>{{$data->expense_HeadName->expense_head_name}}</td>
                                                        <td>{{ $data->accountHead->HeadName }}</td>
                                                        <td>{{ $data->description }}</td>
                                                        <td>{{ \AccountHelper::number_format($data->amount) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6" class="text-right font-weight-bold">{{ __('accounts.general.total') }}</td>
                                                    <td class="text-left font-weight-bold">{{ \AccountHelper::number_format($totalExpense) }}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
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
    @include('dashboard.accounts.common.expenses-filter-js')
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.accounts.expense.create'])
    <script>

        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
