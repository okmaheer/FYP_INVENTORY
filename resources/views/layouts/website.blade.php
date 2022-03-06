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
    <link rel="stylesheet" href="{{ url('public/website/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/icons.css') }}">
    @yield('innerStyleSheet')
</head>
<body>
@include('includes.website-header')
<main id="app">
    @yield('content')
</main>
<script>
    var APP_URL = "{{ env('PUBLIC_PATH') }}";
</script>
<script src="{{ url('public/website/js/jquery.min.js') }}"></script>
<script src="{{ url('public/website/js/popper.min.js') }}"></script>
<script src="{{ url('public/website/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
@yield('innerScriptFiles')
@yield('innerScript')
</body>


