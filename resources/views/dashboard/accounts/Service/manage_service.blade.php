@extends('layouts.dashboard')
@section('page_title')
@section('content')
@section('innerStyleSheet')
    <link href="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@include('includes.dashboard-breadcrumbs')
<style>
   .btn-secondary{
        background-color: #31B404 !important;
        color: #fff;

    }
    .btn-secondary:hover{
        background-color: #e4e7e3 !important;
    }

</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row  mb-2">
                        <div class="col-sm-12">
                            <a href="#" class="btn btn-info m-b-5 m-r-2">
                                <i class="ti-plus"></i> &nbsp;Add Service
                            </a>


                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-12">
                            <div class="card">
                                @include('includes.messages')  <!--ALert Message--->
                                <div class="card-body">
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>SL.</th>
                                                        <th>Service Name</th>
                                                        <th>Charge</th>
                                                        <th>Description</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                               <tbody>
                                                <tbody>
                                                    @php $i = 0; @endphp
                                                    @forelse($service as $data)
                                                        @php $i++; @endphp
                                                        <tr>
                                                            <td>{{$i}}</td>
                                                            <td>{{$data->service_name}}</td>
                                                            <td>{{$data->charge}}</td>
                                                            <td>{{$data->description}}</td>
                                                            <td class="">
                                                                <form action="{{ route('dashboard.accounts.service.destroy', $data->id)}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <a href="{{ route('dashboard.accounts.service.edit',$data->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="" colspan="5" align="right">no data found</td>
                                                        </tr>
                                                    @endforelse
                                                    </tbody>
                                               </tbody>
                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>


                </div>
                <!-- container -->

               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection
        @section('innerScript')
            <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('dashboard/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

                    <!-- Buttons examples -->
            <script src="{{ asset('dashboard/plugins/datatables/dataTables.buttons.min.js') }}"></script>
            <script src="{{ asset('dashboard/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('dashboard/plugins/datatables/jszip.min.js') }}"></script>
            <script src="{{ asset('dashboard/plugins/datatables/pdfmake.min.js') }}"></script>
            <script src="{{ asset('dashboard/plugins/datatables/vfs_fonts.js') }}"></script>
            <script src="{{ asset('dashboard/plugins/datatables/buttons.html5.min.js') }}"></script>
            <script src="{{ asset('dashboard/plugins/datatables/buttons.print.min.js') }}"></script>
            <script src="{{ asset('dashboard/plugins/datatables/buttons.colVis.min.js') }}"></script>
            <!-- Responsive examples -->
            <script src="{{ asset('dashboard/plugins/datatables/dataTables.responsive.min.js') }}"></script>
            <script src="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('dashboard/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('dashboard/pages/jquery.datatable.init.js') }}"></script>

        @endsection
