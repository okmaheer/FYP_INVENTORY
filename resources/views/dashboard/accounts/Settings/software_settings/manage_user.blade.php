@extends('layouts.dashboard')
@section('page_title')
@section('content')
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

                    <div class="row ">

                        <div class="col-12">

                            <div class="card">
                                <div class="panel-title">
                                    <span class="p-3">

                                        <div class="penal-tilte  border-grey border-bottom">
                                            <h4 class="p-3 text-dark">User List</h4>
                                            </div>
                                    </span>


                                </div>
                                <div class="card-body">
                                    <div class="table-rep-plugin">
                                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                                            <table id="datatable-buttons" class="table table-striped mb-0 table-striped table-bordered dt-responsive nowrap">
                                                <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th>Image</th>
                                                    <th>User Name</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                    <th>Action</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>


                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Image</td>
                                                    <td>Admin User</td>
                                                    <td>admin@example.com</td>
                                                    <td>Active</td>
                                                    <td>

                                                        <button type="button" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>

                                                    </td>
                                                    <td>Image</td>
                                                    <td>Admin User</td>
                                                    <td>admin@example.com</td>
                                                    <td>Active</td>
                                                    <td>Image</td>
                                                    <td>Admin User</td>
                                                    <td>admin@example.com</td>
                                                    <td>Active</td>
                                                </tr>




                                                </tbody>
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
