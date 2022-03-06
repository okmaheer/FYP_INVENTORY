<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title')</title>
    <meta name="google-site-verification" content="f0fXSzib6CVljzkfvx54v9nui5qh3iPeyO3UqujVjgc"/>
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keywords')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('dashboard/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/sweet-alert2/sweetalert2.min.css') }}">
    @yield('innerStyleSheet')
</head>
<body>
@include('includes.dashboard-header')
@yield('content')
<div class="page-wrapper">
    <div class="page-wrapper-inner">
        @include('includes.dashboard-nav-bar')
        @yield('body')
    </div>

<script src="{{ asset('dashboard/vendor.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/reports/report.js') }}"></script>
<script src="{{ asset('dashboard/pages/jquery.validation.init.js') }}"></script>
<script src="{{ asset('dashboard/plugins/parsleyjs/parsley.min.js')}}"></script>

@yield('innerScriptFiles')
@yield('innerScript')
</body>


