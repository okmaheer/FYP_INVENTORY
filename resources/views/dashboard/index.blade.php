@extends('layouts.dashboard')
@section('page_title',$page_title)
@section('innerStyleSheet')
@endsection
@section('content')

    @include('includes.dashboard-breadcrumbs')

    @section('body')
    <div class="page-content">
        <div class="container-fluid">
           
             
            
          
        
nnxnxns

        </div><!-- container -->

        @include('includes.dashboard-footer')
    </div>
    @endsection
@endsection
@section('innerScriptFiles')
    <script src="{{ asset('dashboard/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endsection
@section('innerScript')

@endsection
