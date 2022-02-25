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
                        <div class="penal-title  border-grey border-bottom">
                            <h4 class="p-3 text-dark text-center">{{ __('accounts.hrm.manage') }}</h4>
                        </div>
                        @include('includes.messages')
                        <div class="card-body">

                                        <table id="datatable" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('accounts.hrm.sl') }}</th>
                                                    <th>{{ __('accounts.hrm.desgination') }}</th>
                                                    <th>{{ __('accounts.hrm.detail') }}</th>
                                                    <th>{{ __('accounts.hrm.desgination') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 0; @endphp
                                                @foreach($designation as $data)
                                                    @php $i++; @endphp
                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td>{{ $data->name }}</td>
                                                        <td>{{ $data->detail }}</td>
                                                        <td class="text-center">
                                                            <form action="{{ route('dashboard.accounts.designation.destroy', $data->id) }}" method="POST" id="deleteForm{{ $data->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            @can('edit', \App\Models\Designation::class)
                                                                <a href="{{ route('dashboard.accounts.designation.edit', $data->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                            @endcan
                                                            @can('delete', \App\Models\Designation::class)
                                                                <button type="button" onclick="DeleteEntry({{ $data->id }});" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                {{-- @empty
                                                    <tr>
                                                        <td class="text-center" colspan="4" align="right">no data found
                                                        </td>
                                                    </tr> --}}
                                                @endforeach
                                            </tbody>



                                        </table>
                                        <!--end /table-->

                            <!--end /tableresponsive-->
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
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.accounts.designation.create'])
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection
