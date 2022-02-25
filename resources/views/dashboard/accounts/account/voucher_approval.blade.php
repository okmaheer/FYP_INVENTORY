@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
@section('innerStyleSheet')
    @include('includes.datatable-css')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@include('includes.dashboard-breadcrumbs')
@section('body')
            <div class="page-content">
                <div class="container-fluid">

                    <div class="row ">

                        <div class="col-12">

                            <div class="card">
                                @include('includes.messages')

                                <div class="card-body">
                                    <table id="datatable" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                <thead>
                                                <tr>
                                                    <th>Sr.</th>
                                                    <th>Voucher No</th>
                                                    <th>Date</th>
                                                    <th>Remark</th>
                                                    <th>Debit</th>
                                                    <th>Credit</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>


                                                <tbody>
                                                @foreach($approvalInfo as $key => $approval)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$approval->VNo}}</td>
                                                        <td>{{ \AccountHelper::date_format( $approval->VDate) }}</td>
                                                        <td>{{$approval->Narration}}</td>
                                                        <td>{{ \AccountHelper::number_format( $approval->Debit ) }}</td>
                                                        <td>{{ \AccountHelper::number_format( $approval->Credit ) }}</td>
                                                        <td>
                                                            <form action="{{ route('dashboard.accounts.voucher.approval.destroy', $approval->VNo)}}" method="POST" id="deleteForm{{ $approval->id }}">
                                                                @csrf
                                                                @method('DELETE')
{{--                                                                <a href="{{ AccountHelper::getVoucherUrl($approval->VType,$approval->VNo) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>--}}
                                                                <button type="submit" onclick="DeleteEntry({{ $approval->id }});" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                            </form>
                                                            <form action="{{ route('dashboard.accounts.voucher.approval.update', $approval->VNo)}}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-primary">Approved</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                {{-- @empty
                                                    <tr>
                                                        <td colspan="7"> No Record Found</td>
                                                    </tr> --}}
                                                @endforeach




                                                </tbody>
                                            </table>
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
    @include('includes.datatable-init', ['table' => 'datatable'])
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
