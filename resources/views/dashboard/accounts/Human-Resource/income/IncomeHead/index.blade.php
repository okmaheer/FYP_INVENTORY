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
                                                <th class="text-left">{{__('accounts.income.sl')}}</th>
                                                <th class="text-left">{{__('accounts.income.name_head')}}</th>
                                                <th class="text-left">{{__('accounts.income.name_head_parent')}}</th>
                                                <th class="text-left">{{__('accounts.income.action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($income_heads as $index => $d)
                                                <tr>
                                                    <td>{{$index+1}}</td>
                                                    <td>{{$d->income_head_name}}</td>
                                                    <td>
                                                        @if (!is_null($d->parent_id))
                                                            {{ $d->getIncomeHeadName($d->parent_id) }}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @can('edit', \App\Models\IncomeHead::class)
                                                        <a href="{{ route('dashboard.accounts.incomehead.edit',$d->id) }}" class="btn btn-sm btn-success tippy-btn" title="Edit Record"><i class="fas fa-edit"></i></a>
                                                        @endcan
                                                        @can('delete', \App\Models\IncomeHead::class)
                                                        <button type="button" onclick="DeleteEntry({{$d->id}});" class="btn btn-sm btn-danger text-white tippy-btn" title="Delete Record"><i class="fas fa-trash"></i></button>
                                                        @endcan
                                                        <form action="{{ route('dashboard.accounts.incomehead.destroy',$d->id) }}" method="POST" id="deleteForm{{$d->id}}" style="display: none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-center" colspan="4">{{ __('accounts.general.no_data') }}</td>
                                                </tr>
                                            @endforelse
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
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.accounts.incomehead.create'])
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
