@extends('layouts.dashboard')
@section('page_title', trans('accounts.company.manage_company'))
@section('innerStyleSheet')
    @include('includes.datatable-css')
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')

    @section('body')

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @include('includes.messages')  <!--ALert Message--->
                            <div class="card-body">
                                <table id="datatable" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                            <thead>
                                            <tr>
                                                <th>{{ trans('accounts.general.sr') }}</th>
                                                <th>{{ trans('accounts.general.company_name') }}</th>
                                                <th>{{ trans('accounts.general.address') }}</th>
                                                <th>{{ trans('accounts.general.mobile') }}</th>
                                                <th class="text-center">{{ trans('accounts.general.action') }}</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @foreach ($companies as $key => $company)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$company->company_name}}</td>
                                                    <td>{{$company->address}}</td>
                                                    <td>{{$company->mobile}}</td>
                                                    <td class="text-center">
                                                        @can('edit', \App\Models\Company::class)
                                                            <a href="{{ route('dashboard.accounts.companies.edit',$company->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                        @endcan
                                                        @can('delete', \App\Models\Company::class)
{{--                                                            <form action="{{ route('dashboard.accounts.companies.destroy', $company->id)}}" method="POST" id="deleteForm{{ $company->id }}">--}}
{{--                                                                @csrf--}}
{{--                                                                @method('DELETE')--}}
{{--                                                            </form>--}}
{{--                                                            <button type="button" onclick="DeleteEntry({{ $company->id }});" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>--}}
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
    @include('includes.datatable-js')
@endsection
@section('innerScript')
    @include('includes.datatable-init', ['table' => 'datatable'])
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
