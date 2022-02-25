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
                                                <th class="text-center">{{__('accounts.expense.sl')}}</th>
                                                <th class="text-center">{{__('accounts.expense.expense_id')}}</th>
                                                <th class="text-center">{{__('accounts.expense.date')}}</th>
                                                <th class="text-center">{{__('accounts.expense.e_head')}}</th>
                                                <th class="text-center">{{__('accounts.general.payment_account')}}</th>
                                                <th class="text-center">{{__('accounts.general.details')}}</th>
                                                <th class="text-center">{{__('accounts.expense.amount')}}</th>
                                                <th class="text-center">{{__('accounts.general.attachment')}}</th>
                                                <th class="text-center">{{__('accounts.general.action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $totalExpense = 0; @endphp
                                            @foreach($expense as $key => $data)
                                                @php $totalExpense += $data->amount ; @endphp
                                                <tr>
                                                    <td></td>
                                                    <td class="text-center">{{$key+1}}</td>
                                                    <td class="text-center">{{  $data->voucher_no }}</td>
                                                    <td class="text-center">{{ \AccountHelper::date_format( $data->date ) }}</td>
                                                    <td class="text-center">{{ $data->expense_HeadName->expense_head_name }}</td>
                                                    <td class="text-center">{{ $data->accountHead->HeadName }}</td>
                                                    <td class="text-center">{{ $data->description }}</td>
                                                    <td class="text-center">{{ \AccountHelper::number_format($data->amount) }}</td>
                                                    <td class="text-center">
                                                        @if(file_exists($data->attachment))
                                                            <a href="{{ asset($data->attachment) }}" class="btn btn-primary btn-xs" target="_blank">View</a>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ \AccountHelper::getRouteForVoucher('Expense', $data->voucher_no) }}" class="btn btn-sm btn-primary text-white" target="_blank"><i class="fas fa-eye"></i></a>
{{--                                                        @can('delete', \App\Models\Expense::class)--}}
{{--                                                        <a href="javascript:void(0);" onclick="DeleteEntry({{$data->id}});" class="btn btn-sm btn-danger text-white tippy-btn" title="Delete Record!"><i class="fas fa-trash"></i></a>--}}
{{--                                                        @endcan--}}
{{--                                                        <form action="{{ route('dashboard.accounts.expense.destroy',$data->id) }}" method="POST" id="deleteForm{{$data->id}}" style="display: none">--}}
{{--                                                            @csrf--}}
{{--                                                            @method('DELETE')--}}
{{--                                                        </form>--}}
                                                    </td>
                                                </tr>
                                            {{-- @empty
                                                <tr>
                                                    <td class="text-center" colspan="8">{{ __('accounts.general.no_data') }}</td>
                                                </tr> --}}
                                            @endforeach

                                            <!-- <tr>
                                                <td colspan="6" class="text-right font-weight-bold">{{ __('accounts.general.total') }}</td>
                                                <td colspan="2" class="text-left font-weight-bold">{{ \AccountHelper::number_format($totalExpense) }}</td>
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
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.accounts.expense.create'])
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
