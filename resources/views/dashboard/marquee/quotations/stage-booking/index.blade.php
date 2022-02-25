@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
    @include('includes.datatable-css')
   <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    @include('includes.dashboard-breadcrumbs')
    @section('body')
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    @include('dashboard.marquee.filters.stagequotation_no_filter',['route'=>'dashboard.marquee.quotation.stage.index'])
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            @include('includes.messages')  <!--ALert Message--->
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="no-sort"></th>
                                            <th class="no-sort text-center">Actions</th>
                                            <th>Id</th>
                                            <th>Person Name</th>
                                            <th>Event Date</th>
                                            <th>Event Time</th>
                                            <th>Stage Decorations</th>
                                            <th>Quotation Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $d)
                                        <tr>
                                            <td></td>
                                            <td class="text-center">
                                                <div class="dropdown d-inline-block">
                                                    <a class="nav-link dropdown-toggle arrow-none" id="dLabel8" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v font-20 text-muted"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-left"
                                                         aria-labelledby="dLabel8" x-placement="top-end"
                                                         style="position: absolute; transform: translate3d(-121px, -72px, 0px); top: 0px; left: 0px; will-change: transform;">

                                                        <a href="{{ route('dashboard.marquee.quotation.stage.edit', $d->id) }}" class="dropdown-item"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                        <a href="javascript:void(0);" onclick="DeleteEntry({{$d->id}});" class="dropdown-item"><i class="fas fa-trash"></i> Delete Record</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="{{route('view.quotation.stage',$d->id)}}" class="dropdown-item" target="_blank"><i class="fas fa-money-bill-alt"></i> View Quotation Print</a>
                                                        <form action="{{ route('dashboard.marquee.quotation.stage.destroy',$d->id) }}" method="POST" id="deleteForm{{$d->id}}" style="display: none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                {{ $d->quot_number }}
                                            </td>
                                            <td class="text-center">
                                                {{ $d->customer_name }}
                                            </td>
                                            <td class="text-center">
                                                {{ \AccountHelper::date_format( $d->event_date ) }}
                                            </td>
                                            <td class="text-center">
                                                {{ \MarqueeHelper::eventTime( $d->event_time ) }}
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm" width="200">
                                                    @if(count($d->stageDecorations))
                                                        @foreach($d->stageDecorations as $stageDecoration)
                                                            <option>{{ $stageDecoration->name }}</option>
                                                        @endforeach
                                                    @else
                                                        <option>No Stage Decorations</option>
                                                    @endif
                                                </select>
                                            </td>
                                            <td>{{ \AccountHelper::date_format( $d->created_at ) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
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
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.marquee.quotation.stage.create'])
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
