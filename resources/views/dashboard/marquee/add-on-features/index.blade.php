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
                                <div class="card-body">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th class="no-sort"></th>
                                            <th class="text-center no-sort">Action</th>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Barcode</th>
                                            <th>Created Date</th>
                                            <th>Last Update</th>
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
                                                            {!! link_to_route('dashboard.marquee.add-on-features.edit', "Edit", $d->id, ['class' => 'dropdown-item']) !!}
                                                            <button type="button" class="dropdown-item"
                                                                    onclick="DeleteEntry({{ $d->id }});">
                                                                Delete
                                                            </button>
                                                            <form action="{{ route('dashboard.marquee.add-on-features.destroy',$d->id) }}" method="POST" id="deleteForm{{ $d->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    {{ $d->id }}
                                                </td>
                                                <td>{{$d->name}}</td>
                                                <td>{{$d->price}}</td>
                                                <td>{{$d->barcode}}</td>
                                                <td>{{ \AccountHelper::date_format( $d->created_at ) }}</td>
                                                <td>{{ \AccountHelper::date_format( $d->updated_at ) }}</td>
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
    @include('includes.datatable-js')
@endsection
@section('innerScript')
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.marquee.add-on-features.create'])
@endsection
