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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="panel-title  border-grey border-bottom text-center">
                            @if (isset($pageTittle) && $pageTittle != '')
                                <h4 class="p-3 text-dark">{{ $pageTittle }}</h4>
                            @endif
                        </div>
                        @include('includes.messages')
                        <div class="card-body">
                            <table id="datatable" class="table table-striped mb-0 table-bordered table-striped mb-0 dt-responsive nowrap">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>SL.</th>
                                                    <th>Category Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $key => $category)
                                                    <tr class="text-center">
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $category->name }}</td>
                                                        @if ($category->status == 1)
                                                            <td class="text text-center text-success">Active</td>
                                                        @else
                                                            <td>Disable</td>
                                                        @endif
                                                        <td>
                                                            <form
                                                                action="{{ route('dashboard.accounts.category.destroy', $category->id) }}" method="POST" id="deleteForm{{ $category->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            @can('edit', \App\Models\Category::class)
                                                                <a href="{{ route('dashboard.accounts.category.edit', $category->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                            @endcan
                                                            @can('delete', \App\Models\Category::class)
                                                                <button type="button" onclick="DeleteEntry({{ $category->id }});" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>

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
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.accounts.category.create'])
@endsection
