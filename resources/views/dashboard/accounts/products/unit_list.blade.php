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
                        <div class="penal-title  border-grey border-bottom text-center">
                            @if (isset($pageTittle) && $pageTittle != '')
                                <h4 class="p-3 text-dark">{{ $pageTittle }}</h4>
                            @endif
                        </div>
                        @include('includes.messages')
                        <div class="card-body">
                            <table id="datatable" class="table table-striped mb-0 table-bordered table-striped mb-0 dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-left">SL.</th>
                                        <th class="text-center">Unit Name</th>
                                        <th class="text-center">Status</th>
                                        <th class="border-bottom-0 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $unit)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $unit->unit_name }}</td>
                                            @if ($unit->status == 1)
                                                <td class="text text-center text-success">Active</td>
                                            @else
                                                <td>Disable</td>
                                            @endif
                                            <td class="text-center">
                                                <form
                                                    action="{{ route('dashboard.accounts.unit.destroy', $unit->id) }}" method="POST" id="deleteForm{{ $unit->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                @can('edit', \App\Models\Unit::class)
                                                    <a href="{{ route('dashboard.accounts.unit.edit', $unit->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                @endcan
                                                @can('delete', \App\Models\Unit::class)
                                                    <button type="button" onclick="DeleteEntry({{ $unit->id }});" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                @endcan
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
    <script src="{{ asset('dashboard/plugins/select2/select2.min.js') }}"></script>
    @include('includes.datatable-js')
@endsection
@section('innerScript')
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.accounts.unit.create'])
@endsection
