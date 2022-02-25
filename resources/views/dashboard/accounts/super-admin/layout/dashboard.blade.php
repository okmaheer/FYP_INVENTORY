<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Deskbook ERP | @yield('page_title')</title>
        <meta name="google-site-verification" content="f0fXSzib6CVljzkfvx54v9nui5qh3iPeyO3UqujVjgc"/>
        <meta name="description" content="@yield('meta_description')">
        <meta name="keywords" content="@yield('meta_keywords')">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('/images/favicon.svg') }}" type="image/gif" >
        <link rel="stylesheet" href="{{ asset('dashboard/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/vendor.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/plugins/sweet-alert2/sweetalert2.min.css') }}">
        <link href="{{ asset('dashboard/plugins/toastr-js/toastr.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('dashboard/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('dashboard/custom.css') }}">
        @yield('innerStyleSheet')
    </head>
    <body>
        @include('dashboard.accounts.super-admin.layout.header')
        @include('dashboard.accounts.super-admin.layout.breadcrumbs')
        <div class="page-wrapper">
            <div class="page-wrapper-inner">
{{--                @include('dashboard.accounts.super-admin.nav-bar')--}}
                @yield('body')
            </div>
        </div>

        <script src="{{ asset('dashboard/vendor.min.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/toastr-js/toastr.min.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('js/admin_js/global_functions.js')}}"></script>
        <script>
            let dateFormat = "dd-mm-yyyy";
            let base_url = '{{ url('/')}}';
        </script>
        <script src="{{ asset('js/admin_js/custom.js') }}"></script>
        @yield('innerScriptFiles')
        @yield('innerScript')
    </body>
</html>
