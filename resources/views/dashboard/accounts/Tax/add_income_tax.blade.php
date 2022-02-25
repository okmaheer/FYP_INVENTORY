@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
@section('innerStyleSheet')
<link href="{{ asset('dashboard/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@include('includes.dashboard-breadcrumbs')
<style>
    .form-control{
        width: 94% !important;

    }
    .form-group{
        margin-bottom: 60px;
    }
    .mt-2{
        margin-right: 12%
    }

</style>
@section('body')

            <div class="page-content">
                <div class="container-fluid">

                            <div class="card">
                                <div class="penal-title ">
                                    <h4 class="p-3 text-success">Setup Tax</h4>
                                </div>
                                <div class="card-body">
                                {{-- {!! Form::open([ 'files' => true] ) !!} --}}
                                        @php
                                        $i=1;
                                        @endphp
                                        <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table  id="POITable"  class="table table-striped mb-0 border-0 border-top-0 border-bottom-0">

                                                    <thead id="test-body">
                                                        <tr>
                                                            <td>SL.</td>
                                                            <td>Start Amount <i class="text-danger">*</i></td>
                                                            <td>End Amount <i class="text-danger">*</i></td>
                                                            <td>Tax Rate <i class="text-danger">*</i></td>
                                                            <td>Delete?</td>
                                                            <td>Add More?</td>
                                                        </tr>
                                                        <tr id="row">
                                                            <td>@php echo $i++; @endphp</td>
                                                            <td>
                                                                {!!  Form::text('start_amount',null,['id'=>'start_amount','class'=>'form-control']) !!}

                                                            </td>
                                                            <td>
                                                                {!!  Form::text('end_amount',null,['id'=>'end_amount','class'=>'form-control']) !!}

                                                            <td>
                                                                {!!  Form::text('rate',null,['id'=>'rate','class'=>'form-control']) !!}

                                                            <td class="paddin5ps">
                                                                <button class="delete-row btn  btn-danger" type="button" id="delPOIbutton" value="Delete">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>
                                                            <td class="paddin5ps ">
                                                                <button id="add-row" class="btn btn-success ml-2" type="button" value="Add More POIs">
                                                                    <i class="fa fa-plus-circle"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </thead>

                                                </table>
                                            </div>
                                        </div>

                                        <div class="form-group text-center mt-2 ">
                                            {!! Form::submit('Reset', array('class' => 'btn btn-primary w-md m-b-5')) !!}
                                            {!! Form::submit('Setup', array('class' => 'btn btn-success w-md m-b-5')) !!}
                                        </div>
                                    {!! Form::close() !!}
                                    <!--end form-->
                                </div>
                            </div>

                </div><!-- container -->

               @include('includes.dashboard-footer')
            </div>

        @endsection
        @endsection
        @section('innerScript')

        <!-- Plugins js -->
        <script src="{{ asset('dashboard/plugins/morris/script.js') }}"></script>
        <script src="{{ asset('dashboard/js/jquery.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/waves.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/repeater/jquery.repeater.min.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/jquery.form-repeater.js') }}"></script>

       @endsection

