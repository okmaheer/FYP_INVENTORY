<!doctype html>
<html>
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
    <link rel="stylesheet" href="{{ asset('dashboard/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/vendor.min.css') }}">
    @yield('innerStyleSheet')

</head>
<style>
     .btn-purple{
    background-color:  #8F3B7F!important;
    border: 1px solid #8F3B7F !important;
    box-shadow: 0 2px 6px 0 rgb(102 13 118 / 50%);
}

     
    .btn-primary:hover{
        background-color: #520c45!important;  
    }
    .btn-primary:active{
        background-color: #520c45!important;  
    }
    .btn-primary:focus{
        background-color: #520c45!important;  
    }
    .btn-primary.active, .btn-primary.focus, .btn-primary:active, .btn-primary:focus, .btn-primary:hover, .open > .dropdown-toggle.btn-primary, .btn-outline-primary.active, .btn-outline-primary:active, .show > .btn-outline-primary.dropdown-toggle, .btn-outline-primary:hover, .btn-primary.active, .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:active, .show > .btn-primary.dropdown-toggle, .btn-primary.disabled, .btn-primary:disabled, .btn-outline-primary:not(:disabled):not(.disabled).active, .btn-outline-primary:not(:disabled):not(.disabled):active, .show > .btn-outline-primary.dropdown-toggle, a.bg-primary:focus, a.bg-primary:hover, button.bg-primary:focus, button.bg-primary:hover{
        background-color: #520c45!important;    
    }

  
</style>
<body class="account-body">
    @yield('content')
    <script src="{{ asset('dashboard/vendor.min.js') }}"></script>
</body>


