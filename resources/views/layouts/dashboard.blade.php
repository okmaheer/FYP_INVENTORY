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
    <link rel="stylesheet" href="{{ asset('dashboard/fonts/signature/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/sweet-alert2/sweetalert2.min.css') }}">
    <link href="{{ asset('dashboard/plugins/toastr-js/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/custom.css') }}">
    @yield('innerStyleSheet')
</head>
<style>

</style>
<body>

@include('includes.dashboard-header')

@yield('content')
<div class="page-wrapper">
    <div class="page-wrapper-inner">
        @include('includes.dashboard-nav-bar')
        @yield('body')

        <div class="modal fade" id="calendar-modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('dashboard/vendor.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/toastr-js/toastr.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/moment/moment.js') }}"></script>
<script src="{{ asset('dashboard/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/reports/report.js') }}"></script>
{{--<script src="{{ asset('dashboard/pages/jquery.validation.init.js') }}"></script>--}}
<script src="{{ asset('dashboard/plugins/parsleyjs/parsley.min.js')}}"></script>
<script src="{{ asset('js/admin_js/global_functions.js')}}"></script>
<script src="{{ asset('js/admin_js/jquery.PrintArea.js') }}"></script>
<script>
    let dateFormat = "{{ \App\Models\BusinessLocation::MomentFormat( \Cache::get(\CacheEnum::AUTH_LOCATION)->date_format) }}";
</script>
<script src="{{ asset('js/admin_js/custom.js') }}"></script>
<div id="online-status"></div>
<script>
    let base_url = '{{ url('/')}}';

    function setCookie(cName, cValue, expDays) {
        let date = new Date();
        date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
        const expires = "expires=" + date.toUTCString();
        document.cookie = cName + "=" + cValue + "; " + expires + "; path=/";
    }

    function getCookie(cName) {
        const name = cName + "=";
        const cDecoded = decodeURIComponent(document.cookie); //to be careful
        const cArr = cDecoded.split('; ');
        let res;
        cArr.forEach(val => {
            if (val.indexOf(name) === 0) res = val.substring(name.length);
        })
        return res;
    }


    $('#calendar-modal').on('show.bs.modal', function (e) {
        $('#calendar-modal').modal().find('.modal-content').load('{{ route("marquee.booking.calendar") }}');
    });

    (function () {

       /* $('input[type=checkbox]').change(function () {
            $(this).val($(this).is(':checked') ? 1 : 0);
        });*/

        {{--var runner = setInterval(function () {--}}

        {{--    let existing_cookie = getCookie('internet_status');--}}
        {{--    if (existing_cookie === undefined) {--}}

        {{--        existing_cookie = (true === navigator.onLine) ? 'online' : 'offline';--}}
        {{--        setCookie('internet_status', existing_cookie);--}}

        {{--    } else {--}}

        {{--        existing_cookie = getCookie('internet_status');--}}

        {{--    }--}}

        {{--    let current_cookie = (true === navigator.onLine) ? 'online' : 'offline';--}}

        {{--    if (current_cookie !== existing_cookie) {--}}
        {{--        setCookie('internet_status', current_cookie);--}}
        {{--        Swal.fire({--}}
        {{--            title: current_cookie.toUpperCase(),--}}
        {{--            text: 'Please click "Start Switching" for switching the mode.After clicking on the ok button data will be automatically synced from ' + existing_cookie + " to " + current_cookie + " in backend and this will not effect the actual Working of the system",--}}
        {{--            icon: 'warning',--}}
        {{--            showCancelButton: true,--}}
        {{--            confirmButtonText: 'Start Switching',--}}
        {{--            cancelButtonText: 'No Switching'--}}
        {{--        }).then((result) => {--}}

        {{--            $.ajax({--}}
        {{--                type: "GET",--}}
        {{--                url: "{{ route('call-offline-online-syncing') }}",--}}
        {{--                data: {--}}
        {{--                    'status': current_cookie,--}}
        {{--                },--}}
        {{--                success: function (result, status, xhr) {--}}
        {{--                    if (current_cookie === 'online') {--}}
        {{--                        window.location.assign('{{ env('LIVE_PATH') }}');--}}
        {{--                    } else {--}}
        {{--                        window.location.assign('{{ env('LOCAL_PATH') }}');--}}
        {{--                    }--}}
        {{--                }--}}
        {{--            });--}}
        {{--        })--}}

        {{--    } else {--}}

        {{--        console.log('status not changed', current_cookie, existing_cookie);--}}

        {{--    }--}}
        {{--}, 3000);--}}
    })();


</script>

@yield('innerScriptFiles')
@yield('innerScript')
</body>


