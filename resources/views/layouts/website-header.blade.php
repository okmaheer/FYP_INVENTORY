<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Directorio Médico de Honduras</title>
    <link rel="stylesheet" href="{{ url('public/website/css/style.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">

    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,400italic,300italic' rel='stylesheet'
        type='text/css'>
    {{-- <link rel="stylesheet" href="{{url('public/website/assets/css/docs.theme.min.css')}}"> --}}

    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="{{ url('public/website/assets/owlcarousel/assets/owl.carousel.min.css') }}">
    {{-- <link rel="stylesheet" href="{{url('public/website/assets/owlcarousel/assets/owl.theme.default.min.css')}}"> --}}
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="{{ url('public/website/assets/vendors/jquery.min.js') }}"></script>
    <script src="{{ url('public/website/assets/owlcarousel/owl.carousel.js') }}"></script>


    <style>
        .MainContent {
            overflow: hidden;
            /* height: calc(100vh - 157px); */
            overflow-y: auto;
        }

        .h1s {
            height: 110px !important;

        }

        @media only screen and (max-width: 376px) {
            .h1s {
                height: 95px !important;

            }
        }

        a,
        a:hover,
        a:focus,
        a:active {
            text-decoration: none;
            color: inherit;
            outline: none;

        }

        a:-webkit-any-link:focus-visible {
            outline: none;
        }

        .line-height {
            line-height: 8px;
        }

        .font-12 {
            font-size: 12px;
        }

        .font-10 {
            font-size: 10px;
        }

    </style>
</head>

<body>
    <header class="p-3 bgheader">
        <div class=" d-flex justify-content-between align-items-center">
            <div class="col-4">
                <img src="{{ url('public/website/imgs/add_user.svg') }}" width="25" data-toggle="modal"
                    data-target="#myModalt" class="img-fluid" alt="add user" />
            </div>
            <div class="col-4 text-center">
                <div>
                    <!-- <div class="">
                  <span class="h6 font-12 line-height mb-0 d-block text-white">
                      Medirectory
                  </span>
                  <small class="text-white font-10 d-block">Florida</small>
                </div> -->
                    <a href="{{ url('/') }}"> <img src="{{ url('public/website/imgs/logo.svg') }}" width="100"
                            alt="logo" /></a>
                </div>
            </div>
            <div class="col-4 text-right align-self-center">
                <!-- <img src="{{ url('public/website/imgs/fb.svg') }}" class="img-fluid mr-3" alt="fb" />  -->
                <a href="https://www.instagram.com/doctores.hn/">  <img src="{{ url('public/website/imgs/instagram.svg') }}" alt="fb" width="30" class="img-fluid" /></a>
            </div>
        </div>
    </header>

    <div class="MainContent p-3">
        @yield('webiste-content')
    </div>

    @extends('layouts.website-footer')
    <script>
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            margin: 10,
            loop: true,
            responsive: {
                0: {
                    items: 3
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        })
    </script>
    <script>
        $(document).ready(function() {


            get_location();




        });

        var specialist = (function() {
            var executed = false;
            return function() {
                if (!executed) {
                    executed = true;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    console.log("data");

                    $.ajax({
                        type: 'GET',
                        url: "/specialist",
                        beforeSend: function() {
                $('#loader').removeClass('hidden')
            },
                        success: function(data) {
                            console.log(data);



                            for (let i = 0; i < data.length; i++) {
                                $("#specialist").append(
                                    '<li class="list-group-item p-2"><div class="d-flex justify-content-between align-items-center"><div class="d-flex align-items-center"><span class="' +
                                    data[i].color +
                                    ' listLeftIcons rounded-circle mr-3"><img src="public/' +
                                    data[i].logo +
                                    '" class="img-fluid icons" alt="" /></span><h6 class=" mb-0 listtext fontw-400">' +
                                    data[i].specialist_name +
                                    '</h6></div><div><div class="custom-control custom-checkbox mr-sm-2"><input type="checkbox"  onclick= "btclick()" name="speciality[]" value="' +
                                    data[i].id + '" class="custom-control-input" id="' + data[i]
                                    .specialist_name +
                                    '"><label class="custom-control-label" for="' +
                                    data[i].specialist_name +
                                    '"></label></div></div></div></li>');

                            }



                    },
            complete: function(){
                $('#loader').addClass('hidden')
            },
                    });
                }
            };
        })();







        function btclick() {
    document.getElementById("myForm").submit();
               }






        function get_location() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            console.log("data");

            $.ajax({
                type: 'GET',
                url: "/get_location",           beforeSend: function() {
                $('#loader').removeClass('hidden')
            },
                success: function(data) {
                    console.log(data);



                    for (let i = 0; i < data.length; i++) {
                        $("#location").append(
                            '<li class="list-group-item p-2"><div class="d-flex justify-content-between align-items-center"><div class="d-flex align-items-center"><span class="' +
                            data[i].color + ' listLeftIcons rounded-circle mr-3"><img src="public/' +
                            data[i].logo +
                            '" class="img-fluid icons" alt="" /></span><h6 class=" mb-0 listtext fontw-400">' +
                            data[i].location_name +
                            '</h6></div><div><div class="custom-control custom-checkbox mr-sm-2"><input type="checkbox" onclick= "specialist()" name="location[]" value="' +
                            data[i].id + '" class="custom-control-input" id="' + data[i]
                            .location_name + '"><label class="custom-control-label" for="' +
                            data[i].location_name + '"></label></div></div></div></li>');



                    }


                },
            complete: function(){
                $('#loader').addClass('hidden')
            },
            });

        }
    </script>
    <script src="{{ url('public/website/assets/vendors/highlight.js') }}"></script>
    <script src="{{ url('public/website/assets/js/app.js') }}"></script>
