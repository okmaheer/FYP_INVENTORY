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
<script>

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({html: true});

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    toastr.options = {
        "progressBar": true,
        "closeButton": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
    }

    $('#printBtn').click(function(){
        var mode = 'popup'; //popup
        var close = mode == "popup";
        var options = {
            mode: mode,
            popClose: true,
            popHt: 1300,
            popWd: 1000,
            popX: 0,
            popY: 0
        };
        $("div#printArea").printArea(options);
    });
});


    function DeleteEntry(recID) {
    swal.fire({
        title: "Do you really want to remove this record?",
        type: "question",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: 'Yes! Delete',
        confirmButtonColor: '#00a5bb',
        cancelButtonColor: '#f82269',
        allowOutsideClick: () => {
            const popup = swal.getPopup();
            popup.classList.remove('swal2-show');
            setTimeout(() => {
                popup.classList.add('headShake', 'animated');
            })
            setTimeout(() => {
                popup.classList.remove('headShake', 'animated');
            }, 500);
            return false;
        }
    }).then((result) => {
        if (result.value === true) {
            $('#deleteForm'+recID).submit();
        }
    });
}
</script>
</body>


