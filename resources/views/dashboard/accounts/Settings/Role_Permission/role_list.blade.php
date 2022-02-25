@extends('layouts.dashboard')
@section('page_title')
@section('content')
    @include('includes.dashboard-breadcrumbs')
<style>
    .form-control{
        width: 70% !important;

    }
    .form-group{
        margin-bottom: 60px;
    }
</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">
                    <div class="card">

                    </div>

                            <div class="card">
                                <div class="panel-title border-grey border-bottom">
                                    <h4 class="p-3 text-success">Role List</h4>
                                </div>
                                <div class="card-body">
                                    <form action="">
                                        <div class="table-rep-plugin">
                                            <div class="table-responsive" data-pattern="priority-columns">

                                                <table id="datatable-buttons" class="table table-striped mb-5 table-bordered dt-responsive nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>SL No</th>
                                                            <th>Role Name</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>testuser</td>
                                                                <td>
                                                                    <a href="" class="btn btn-info btn-xs"><i class="far fa-edit"></i></a>
                                                                    <a href="" class=" btn btn-danger btn-xs"><i class="fas fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>




                                </div>
                            </div>

                </div><!-- container -->

               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection
