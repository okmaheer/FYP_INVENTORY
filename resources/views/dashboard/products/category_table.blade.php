@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    {{-- @include('includes.datatable-css') --}}
@endsection
@section('content')

@include('includes.dashboard-breadcrumbs')

@section('body')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="panel-title border-grey border-bottom">
                            <h4 class="p-3 text-dark">Category List</h4>
                        </div>
                        @include('includes.messages')
                        <div class="card-body">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Sr.</th>
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
                                                     
                                                            <td class="text-center"><h4 class="m-0 p-0"><span class="badge badge-success w-sm">Active</span></h4></td>
                                                       
                                                        <td>
                                                            <form
                                                                action="{{ route('dashboard.accounts.category.destroy', $category->id) }}" method="POST" id="deleteForm{{ $category->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                                <a href="{{ route('dashboard.accounts.category.edit', $category->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                        
                                                                <button type="button" onclick="DeleteEntry({{ $category->id }});" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                            
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
    <script src="{{ url('dashboard/plugins/select2/select2.min.js') }}"></script>
    {{-- @include('includes.datatable-js') --}}
@endsection
@section('innerScript')
    {{-- @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.accounts.category.create']) --}}
@endsection
