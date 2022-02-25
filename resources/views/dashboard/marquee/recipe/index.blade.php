@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
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
                @include('includes.messages')  <!--ALert Message--->
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">





                                        <thead>
                                            <tr>
                                                <th class="no-sort">Sl</th>

                                                <th>Name</th>


                                                <th class="text-center no-sort">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                           @foreach($data as $key =>$d)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td class="text-center">


                                                       {{ $d->recipe_name }}
                                                    </td>



                                                    <td class="text-center">     <form action="{{ route('dashboard.marquee.recipe.destroy', $d->id)}}" method="POST" id="deleteForm{{ $d->id }}">
                                                        @csrf
                                                        @method('DELETE')

                                             <a href="{{ route('dashboard.marquee.recipe.edit',$d->id) }}" class="btn btn-sm btn-success text-center"><i class="fas fa-edit"></i></a>
                                             <a href="{{ route('recipe.marquee',$d->id) }}" class="btn btn-sm btn-warning text-center"><i class="fas fa-book"></i></a>

{{--                                                        <button type="button" onclick="DeleteEntry({{ $d->id }});" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>--}}
                                                    </form></td>

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
    @include('includes.datatable-init', ['table' => 'datatable', 'create' => 'dashboard.marquee.recipe.create'])
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection
