@extends('layouts.dashboard')
@section('page_title', $page_title)
@section('content')
@section('innerStyleSheet')

    <link href="{{ asset('dashboard/plugins/treeview/file-explore.css')}}" rel="stylesheet">
    <link href="{{ asset('dashboard/plugins/treeview/themes/default/style.css')}}" rel="stylesheet">

@endsection
@include('includes.dashboard-breadcrumbs')
<style>
    .col-sm-2::selection {
        color: #fff;
        background-color: #37a000;
    }

    .text-success::selection {
        color: #fff;
        background-color: #37a000;

    }

</style>
@section('body')
    <div class="page-content">
        <div class="container-fluid">

            <div class="card">
                <div class="penal-title  border-grey border-bottom">
                    <h4 class="p-3 ">Charts Of Account</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="jstree">
                                <!-- in this example the tree is populated from inline HTML -->
                                <ul>
                                    @php $visit=array(); @endphp
                                    @for ($i = 0; $i < count($userList); $i++)

                                        @php $visit[$i] = false; @endphp

                                    @endfor
                                    @php

                                        \QueryHelper::dfs("COA","0",$userList,$visit,0);
                                        @endphp
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->


        </div><!-- container -->

    </div>

@endsection
@endsection
@section('innerScriptFiles')
    <!-- Plugins js -->

    <script src="{{ asset('dashboard/plugins/treeview/jstree.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/treeview/file-explore.js') }}"></script>
    <script src="{{ asset('dashboard/pages/jquery.treeview.init.js') }}"></script>

@endsection
