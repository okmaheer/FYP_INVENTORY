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
        color: #fff

    }
    .btn-secondary:hover{
        background-color: #e4e7e3 !important;
    }
</style>

@section('body')
            <div class="page-content">
                <div class="card">


                </div>
                <div class="container-fluid">

                    <div class="row ">

                        <div class="col-12">

                            <div class="card">
                                <div class="panel-title border-grey border-bottom">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            @if(isset($pageTittle) && $pageTittle != '')
                                                <h3 class="p-3 text-dark">{{ $pageTittle }}</h3>
                                            @endif
                                        </div>
                                            <div class="col-lg-8 text-right p-3 ">
                                                <a href="#" class="btn btn-info m-b-5 m-r-2 "><i class="ti-plus"></i>&nbsp Add Product</a>&nbsp;&nbsp;
                                                <a href="#" class="btn btn-primary m-b-5 m-r-2" ><i class="ti-plus"></i> &nbsp Add Product(CSV)</a>&nbsp;&nbsp;

                                            </div>
                                    </div>

                                </div>

                                <div class="card-body">
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="datatable-buttons" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap" >
                                                <thead>
                                                    <tr>
                                                        <th>SL.</th>
                                                        <th>Product Name</th>
                                                        <th>Product Model</th>
                                                        <th>Supplier Name</th>
                                                        <th>price</th>
                                                        <th>Price Supplier</th>
                                                        <th>Image</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>


                                                {{-- <tbody>
                                                    @foreach($data as $key => $product)

                                                        <tr>
                                                            <td>{{ $key+1 }}</td>
                                                            <td>{{ $product->product_name }}</td>
                                                            <td>{{ $product->model }}</td>
                                                            <td>New York</td>
                                                            <td>{{ $product->price }}</td>
                                                            <td>2011/09/03</td>
                                                            <td>$345,000</td>
                                                            <td>
                                                                <a href="" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                                <a href="" class="btn btn-success btn-xs"><i class="fa fa-qrcode"></i></a>
                                                                <a href="" class="btn btn-warning btn-xs"><i class="fa fa-barcode"></i></a>
                                                                <a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                            </td>
                                                        </tr>

                                                    @endforeach

                                                </tbody> --}}
                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>


                </div><!-- container -->

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
