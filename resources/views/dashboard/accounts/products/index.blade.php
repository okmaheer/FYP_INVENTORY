@extends('layouts.dashboard')
@section('page_title',$page_title)
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
                            <div class="panel-title border-grey border-bottom">
                                <div class="row">
                                    <div class="col-lg-4">
                                        @if(isset($page_title) && $page_title != '')
                                            <h3 class="p-3 text-dark">{{ $page_title }}</h3>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @include('includes.messages')
                            <div class="card-body">
                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="datatable"
                                               class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                            <tr>
                                                <th>{{ trans('accounts.general.sr') }}</th>
                                                <th>{{ trans('accounts.general.product_name') }}</th>
                                                <th>{{ trans('accounts.general.product_model') }}</th>
                                                <th>{{ trans('accounts.general.price') }}</th>
                                                <th>{{ trans('accounts.general.image') }}</th>
                                                <th>{{ trans('accounts.general.action') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data as $key => $product)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $product->product_name }}</td>
                                                    <td>{{ $product->model }}</td>
                                                    <td>{{ $product->price }}</td>
                                                    <td><img src="{{URL::to('/').'/'.$product->image}}" height="50" width="50"></td>
                                                    <td>
                                                        <form action="{{ route('dashboard.accounts.products.destroy', $product->id)}}" method="POST" id="deleteForm{{ $product->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        @can('edit', \App\Models\Product::class)
                                                            <a href="{{ route('dashboard.accounts.products.edit',$product->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                        @endcan
                                                        @can('delete', \App\Models\Product::class)
                                                            <button type="button" onclick="DeleteEntry({{ $product->id }});" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                        @endcan

{{--                                                        <a href="" class="btn btn-success btn-xs"><i--}}
{{--                                                                class="fa fa-qrcode"></i></a>--}}
{{--                                                        <a href="" class="btn btn-warning btn-xs"><i--}}
{{--                                                                class="fa fa-barcode"></i></a>--}}
                                                    </td>
                                                </tr>

                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div> <!-- end col -->
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
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.accounts.products.create'])
@endsection
