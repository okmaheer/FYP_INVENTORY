@extends('layouts.dashboard')
@section('page_title')
@section('content')
@include('includes.dashboard-breadcrumbs')
<style>
  /* .col-sm-1{
      margin-left: -115px;
  } */
</style>
@section('body')
            <div class="page-content">
                <div class="container-fluid">

                    <div class="row ">

                        <div class="col-12">

                            <div class="card">
                                <div class="panel-title">
                                    <span class="p-3">

                                        <div class="penal-tilte  border-grey border-bottom ml-4 ">
                                            <a href="#" class="btn btn-success text-white mb-3"><i class="fa fa-plus"></i> Add Pharas</a>
                                        </div>

                                    </span>


                                </div>
                                <div class="card-body">

                                    <table id="datatable-buttons" class="table mb-0 table-centered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <td colspan="3">
                                                <form action="" class="form-inline">
                                                    {{-- {!! Form::open(['route' => 'dashboard.accounts.supplier.store', 'files' => true] ) !!} --}}
                                                     {!! csrf_field() !!}
                                                    <div class="form-group">
                                                        {{-- <label for="addLanguage" class="sr-only"> Language Name</label> --}}
                                                        {!!  Form::text('language',null,['id'=>'language','class'=>'form-control ','placeholder'=>'Language Name']) !!}


                                                    </div>
                                                    {!! Form::submit('Save', array('class' => 'form-control btn btn-success')) !!}


                                                    {!! Form::close() !!}
                                            </td>

                                        </tr>
                                        <tr>
                                            <th><i class="fa fa-th-list"></i></th>
                                            <th>Language</th>
                                            <th><i class="fa fa-cogs"></i></th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>English</td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>2</td>
                                            <td>Bangla</td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                                            </td>
                                        </tr>




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

