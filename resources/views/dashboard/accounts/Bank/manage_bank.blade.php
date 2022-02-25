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
                                <div class="card-body">
                                    <div class="penal-tilte mb-2  border-grey border-bottom">
                                    <h4 class="mt-0  header-title">Bank List</h4>
                                    </div>

                                    <table id="datatable" class="table table-striped mb-0 table-bordered table-striped table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>SL.</th>
                                                                        <th>Bank Name</th>
                                                                        <th>A/C Name</th>
                                                                        <th>A/C Number</th>
                                                                        <th>Branch</th>
                                                                        <th>Signature Picture</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody>
                                                                    @php $i = 0; @endphp
                                                                    @foreach($bank as $data)
                                                                        @php $i++; @endphp
                                                                        <tr>
                                                                            <td class="text-center">{{$i}}</td>
                                                                            <td class="text-center">{{$data->name}}</td>
                                                                            <td class="text-center">{{$data->account_name}}</td>
                                                                            <td class="text-center">{{$data->account_number}}</td>
                                                                            <td class="text-center">{{$data->branch}}</td>
                                                                            <td><img src="{{asset($data->signature_pic)}}"   width="100px"; height="100px";></td>
                                                                            {{-- <td class="text-center">{{$data->signature_pic}}</td> --}}

                                                                            <td class="text-center">
                                                                                <form action="{{ route('dashboard.accounts.bank.destroy', $data->id)}}" method="POST" id="deleteForm{{ $data->id }}">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                </form>
                                                                                @can('edit', \App\Models\Bank::class)
                                                                                    <a href="{{ route('dashboard.accounts.bank.edit',$data->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                                                @endcan
                                                                                @can('delete', \App\Models\Bank::class)
                                                                                    <button type="button" onclick="DeleteEntry({{ $data->id }});" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                                                @endcan
                                                                            </td>
                                                                        </tr>
                                                                    {{-- @empty
                                                                        <tr>
                                                                            <td class="text-center" colspan="7" align="center">no data found</td>
                                                                        </tr> --}}
                                                                    @endforeach
                                                                    </tbody>

                                                            </table>

                                    </div>
                                    <!--end /tableresponsive-->
                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
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
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.accounts.bank.create'])
@endsection

