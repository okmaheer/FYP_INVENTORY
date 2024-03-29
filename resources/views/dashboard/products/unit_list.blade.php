@extends('layouts.dashboard')
@section('page_title', $page_title)

@section('content')

@include('includes.dashboard-breadcrumbs')

@section('body')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @include('includes.messages')
                        <div class="panel-title  border-grey border-bottom">
                            <h4 class="p-3 text-dark">Unit List</h4>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sr.</th>
                                        <th class="text-center">Unit Name</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $unit)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $unit->unit_name }}</td>
                                          
                                                <td class="text-center"><h4 class="m-0 p-0"><span class="badge badge-success w-sm">Active</span></h4></td>
                                        
                                            <form action="{{ route('dashboard.accounts.unit.destroy', $unit->id)}}" method="POST" id="deleteForm{{ $unit->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <td class="text-center">
                                                    <a href="{{ route('dashboard.accounts.unit.edit', $unit->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                    <button type="button" onclick="DeleteEntry({{ $unit->id }});" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>

        </div>

    </div>
    @include('includes.dashboard-footer')
    </div>

@endsection
@endsection
@section('innerScriptFiles')
    <script src="{{ url('dashboard/plugins/select2/select2.min.js') }}"></script>
    
@endsection
@section('innerScript')
 
@endsection
