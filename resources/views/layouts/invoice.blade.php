<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ AccountHelper::CurrentCompany()->company_name }} | @yield('page_title')</title>
        <meta name="google-site-verification" content="f0fXSzib6CVljzkfvx54v9nui5qh3iPeyO3UqujVjgc"/>
        <meta name="description" content="@yield('meta_description')">
        <meta name="keywords" content="@yield('meta_keywords')">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon-deskbook.png') }}"/>
        <link rel="stylesheet" href="{{ asset('dashboard/vendor.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/plugins/sweet-alert2/sweetalert2.min.css') }}">
        @yield('innerStyleSheet')
    </head>
    <body>
        @include('includes.dashboard-header')

        @include('includes.dashboard-breadcrumbs')
        <div class="page-wrapper">
            <div class="page-wrapper-inner">
                @include('includes.dashboard-nav-bar')
                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row" id="printableArea">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body invoice-head">
                                        <!-- Print Button -->
                                        <div class="row d-flex justify-content-end d-print-none">
                                            <div class="col-lg-12 col-xl-4">
                                                <div class="float-right">
                                                    <a href="javascript:window.print()" id="btnPrint1" class="btn btn-info text-light"><i class="fa fa-print"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 align-self-center">                                                
                                                <img src="{{ asset(AccountHelper::CurrentCompany()->logo) }}" alt="{{ AccountHelper::CurrentCompany()->company_name }}" class="logo-lg" height="50">                                               
                                            </div>
                                            <div class="col-md-8">
                                                <ul class="list-inline mb-0 contact-detail float-right">                                                   
                                                    <li class="list-inline-item">
                                                        <div class="pl-3">
                                                            <i class="mdi mdi-web"></i>
                                                            <p class="text-muted mb-0">{{ AccountHelper::CurrentCompany()->email }}</p>
                                                            <p class="text-muted mb-0">{{ AccountHelper::CurrentCompany()->website }}</p>
                                                        </div>                                                
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <div class="pl-3">
                                                            <i class="mdi mdi-phone"></i>
                                                            <p class="text-muted mb-0">{{ AccountHelper::CurrentCompany()->mobile }}</p>
                                                            <p class="text-muted mb-0">{{ AccountHelper::CurrentCompany()->phone }}</p>
                                                        </div>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <div class="pl-3">
                                                            <i class="mdi mdi-map-marker"></i>
                                                            <p class="text-muted mb-0">&nbsp;</p>
                                                            <p class="text-muted mb-0">{{ AccountHelper::CurrentCompany()->address }}</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @yield('body')
                                        <div class="row justify-content-center">
                                            <div class="col-lg-6">
                                                <h5 class="mt-4">Terms And Condition :</h5>
                                                <ul class="pl-3">
                                                    <li><small>All accounts are to be paid within 7 days from receipt of invoice. </small></li>
                                                    <li><small>To be paid by cheque or credit card or direct payment online.</small></li>
                                                    <li><small> If account is not paid within 7 days the credits details supplied as confirmation<br> of work undertaken will be charged the agreed quoted fee noted above.</small></li>                                            
                                                </ul>
                                            </div>                                        
                                            <div class="col-lg-6 align-self-end">
                                                <div class="w-25 float-right">
                                                    <small>Account Manager</small>
                                                    {{-- <img src="assets/images/signature.png" alt="" class="" height="48"> --}}
                                                    <p class="border-top">Signature</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-12 col-xl-4 ml-auto align-self-center">
                                                <div class="text-center text-muted"><small>Thank you very much for doing business with us. Thanks !</small></div>
                                            </div>
                                            <div class="col-lg-12 col-xl-4">
                                                <div class="float-right d-print-none">
                                                    <a href="javascript:window.print()" class="btn btn-info"><i class="fa fa-print"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('includes.dashboard-footer')
                </div>
            </div>
        </div>

        <script src="{{ asset('dashboard/vendor.min.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/reports/report.js') }}"></script>
        <script src="{{ asset('dashboard/plugins/parsleyjs/parsley.min.js') }}"></script>
        <script src="{{ asset('dashboard/pages/jquery.PrintArea.js') }}"></script>
        <div id="online-status"></div>
        <script>

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

            (function () {




            /* $('input[type=checkbox]').change(function () {
                    $(this).val($(this).is(':checked') ? 1 : 0);
                });*/

                var runner = setInterval(function () {

                    let existing_cookie = getCookie('internet_status');
                    if (existing_cookie === undefined) {

                        existing_cookie = (true === navigator.onLine) ? 'online' : 'offline';
                        setCookie('internet_status', existing_cookie);

                    } else {

                        existing_cookie = getCookie('internet_status');

                    }

                    let current_cookie = (true === navigator.onLine) ? 'online' : 'offline';

                    if (current_cookie !== existing_cookie) {
                        setCookie('internet_status', current_cookie);
                        Swal.fire({
                            title: current_cookie.toUpperCase(),
                            text: 'Please click "Start Switching" for switching the mode.After clicking on the ok button data will be automatically synced from ' + existing_cookie + " to " + current_cookie + " in backend and this will not effect the actual Working of the system",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Start Switching',
                            cancelButtonText: 'No Switching'
                        }).then((result) => {

                            $.ajax({
                                type: "GET",
                                url: "{{ route('call-offline-online-syncing') }}",
                                data: {
                                    'status': current_cookie,
                                },
                                success: function (result, status, xhr) {
                                    if (current_cookie === 'online') {
                                        window.location.assign('{{ env('LIVE_PATH') }}');
                                    } else {
                                        window.location.assign('{{ env('LOCAL_PATH') }}');
                                    }
                                }
                            });
                        })

                    } else {

                        console.log('status not changed', current_cookie, existing_cookie);

                    }
                }, 3000);
            })();
        </script>

        @yield('innerScriptFiles')
        @yield('innerScript')
    </body>
</html>