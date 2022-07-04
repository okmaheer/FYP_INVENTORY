@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    @include('includes.datatable-css')
    <link href="{{ url('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')
    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        {{-- <div class="card">
                            @include('dashboard.accounts.common.supplier-filter-manage',['route'=>'dashboard.accounts.supplier.index'])
                        </div> --}}
                        <div class="card" id="printArea">
                        @include('includes.messages')
                            <div class="panel-title border-grey border-bottom">
                                <h4 class="p-3 text-dark">{{ __('accounts.supplier.list') }}</h4>
                            </div>

                            <div class="card-body">

                                <table id="datatable" class="table table-bordered dt-responsive "
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                    <thead>
                                        <tr>
                                            <th>{{__('accounts.supplier.sl')}}</th>
                                            <th>{{__('accounts.supplier.name')}}</th>
                                            <th>{{__('accounts.supplier.mobile')}}</th>
                                            <th>{{__('accounts.general.cnic')}}</th>
                                            <th>{{__('accounts.supplier.city')}}</th>
                                            <th>{{__('accounts.supplier.balance')}}</th>
                                            <th>{{__('accounts.supplier.action')}}</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @php $i = 0; @endphp
                                        @foreach($supplier as $data)
                                        @php $i++; @endphp
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$data->supplier_name}}</td>
                                            <td>{{$data->supplier_mobile}}</td>
                                            <td>{{$data->cnic}}</td>
                                            <td>{{$data->city}}</td>
                                            <td>{{ $data->previous_balance}}</td>
                                            <td class="text-center">
                                                <form action="{{ route('dashboard.accounts.supplier.destroy', $data->id)}}" method="POST" id="deleteForm{{ $data->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            
                                                    <a href="{{ route('dashboard.accounts.supplier.edit',$data->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                               
                                                    <button type="button" onclick="DeleteEntry({{ $data->id }});" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
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
    <script src="{{ url('dashboard/plugins/select2/select2.min.js') }}"></script>
@endsection
@section('innerScript')
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.accounts.supplier.create'])
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
