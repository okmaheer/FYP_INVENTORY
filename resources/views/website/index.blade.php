@extends('layouts.website-header')
@section('webiste-content')
    <style>
        .lds-dual-ring.hidden {
            display: none;
        }
        .lds-dual-ring {
            display: inline-block;
            width: 80px;
            height: 80px;
        }
        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 64px;
            height: 64px;
            margin: 18% auto;
            border-radius: 50%;
            border: 6px solid #fff;
            border-color: #fff transparent #fff transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }
        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }


        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0,0,0,.8);
            z-index: 999;
            opacity: 1;
            transition: all 0.5s;
        }
    </style>
    {{-- <div class="MainContent p-3"> --}}

    <div class="chatBox">

        <div class="leftChat mb-3 ">
            <span class="   d-inline-block ">
               <div class="d-flex align-items-center ChatBubble-grey py-2 px-3 rounded-pill  ">
                <span class="  d-inline-block fontw-400">Seleccione la ciudad:</span>
               </div>
            </span>
          </div>
          <form action="{{ route('live.search') }}" method="POST"id="myForm" >
            @csrf
          <div class="leftChat mb-3" >
            <ul class="list-group w-75" id="location" >

              </ul>
          </div>
          <div class="leftChat mb-3 w-50">
            <span class="   d-inline-block ">
               <div class="d-flex align-items-center ChatBubble-grey py-2 px-3 rounded  ">
                <span class="  d-inline-block fontw-4004"> Seleccione la especialidad:</span>
               </div>
            </span>
          </div>
          <div class="leftChat mb-3">

            <ul class="list-group w-75" id="specialist">

              </ul>
          </div>
          <div id="loader" class="lds-dual-ring hidden overlay"></div>
          {{-- <div class="leftChat mb-3">
            <ul class="list-group w-75">
                <li class="list-group-item p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <span class="bgdarkyellow listLeftIcons rounded-circle mr-3">
                                <img src="{{url('public/website/imgs/teeth.svg')}}" class="img-fluid icons" alt="" />
                                </span>
                                <h6 class=" mb-0 listtext fontw-400">Dentist</h6>
                        </div>
                        <div>
                            <form id="form" action="{{ route('all.records') }}" method="post">
                                @csrf
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="submit" class="custom-control-input"  id="customControlAutosizing2" >
                                <label class="custom-control-label" for="customControlAutosizing2"></label>
                              </div>
                            </form>
                        </div>
                    </div>
                </li>




              </ul>
          </div> --}}
    </div>


    {{-- </div> --}}
 <!-- MODAL CONTENT SAMPLE STARTS HERE -->
 <div class="modal fade animate pl-0" id="myModalt" tabindex="-1" role="dialog" aria-labelledby="myModalt">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog max100  mt-5 pt-5 mx-0" role="document">
      <div class="modal-content animate-bottom h-100">
        <div class="modal-header border-bottom-0">
          <a type="button" class="close p-2" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></a>
        </div>
        <div class="modal-body text-center">
          <div>
            <h6 class="text-center fontw-700"> Únete a doctores.hn hoy!</h6>
            <p class="text-muted text-center fontw-400">Forma parte del equipo de médicos con mayor presencia en redes sociales de
                Honduras.</p>
        </div>
        <div class="headingControl">
            <div>
                <h6 class="text-center fontw-700">Nuestra Subscripción incluye:</h6>

            </div>
            <div class="block1 mb-4">
                <div class="mt-3 text-center">
                    <span class="bgdarkblue mediaPurple mx-auto listLeftIcons rounded-circle mr-3">
                        <img src="{{url('public/website/imgs/folderIcon.svg')}}" class="img-fluid icons" alt="" />
                    </span>
                </div>
                <p class="text-muted mt-4 text-center fontw-400">Publicación de perfil en doctores.hn</p>
              
            </div>
            <div class="block2 mb-4">
                <div class="mt-3 text-center">
                    <span class="bgdarkblue mediaPurple mx-auto listLeftIcons rounded-circle mr-3">
                        <img src="{{url('public/website/imgs/speaker.svg')}}" class="img-fluid icons" alt="" />
                    </span>
                </div>
                <p class="text-muted mt-4 text-center fontw-400">Publicación en instagram (@doctores.hn)</p>
               
            </div>
            <div class="block3 mb-4">
                <div class="mt-3 text-center">
                    <span class="bgdarkblue mediaPurple mx-auto listLeftIcons rounded-circle mr-3">
                        <img src="{{url('public/website/imgs/announce.svg')}}" class="img-fluid icons" alt="" />
                    </span>
                </div>
                <p class="text-muted mt-4 text-center fontw-400">Promoción en comunidad nacional de más de 40,000 personas


                </p>
                
            </div>
        </div>
        <div class="headingControl2">
           
            
            
            <div class="block3 mb-4">
                
             
               
                <div class="text-center mt-5">
                    <p class="mb-0 text-muted fontw-400">Precio</p>
                    <p class="text-muted fontw-400">
                        1,000 lempiras al mes</p>
                        <a  class="btn px-4 btn-primary rounded-pill fontw-700" href="https://wa.me/50494351413">UNIRME HOY</a>
                   
                </div>
            </div>
        </div>
        </div>

      </div> 
    </div>
  </div>
    <!-- MODAL CONTENT SAMPLE STARTS HERE -->
    {{-- <div class="modal fade animate pl-0" id="myModalt" tabindex="-1" role="dialog" aria-labelledby="myModalt">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog max100  mt-5 pt-5 mx-0" role="document">
            <div class="modal-content animate-bottom h-100">
                <div class="modal-header border-bottom-0">
                    <a type="button" class="close up p-2" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></a>
                </div>
                <div class="modal-body text-center">
                    <div>
                        <h6 class="text-center fontw-700"> Join Medirectory today! </h6>
                        <p class="text-muted text-center fontw-400">Sign up for the fastest growing medical directory in Florida.
                        </p>
                    </div>
                    <div class="headingControl">
                        <div>
                            <h6 class="text-center fontw-700">Our Subscription includes:</h6>

                        </div>
                        <div class="block1 mb-4">
                            <div class="mt-3 text-center">
                    <span class="bgdarkblue mediaPurple mx-auto listLeftIcons rounded-circle mr-3">
                        <img src="{{url('public/website/imgs/folderIcon.svg')}}" class="img-fluid icons" alt="" />
                    </span>
                            </div>
                            <p class="text-muted mt-4 text-center fontw-400">Publishing of medical profile at <a href="medirectory.co/florida">medirectory.co/florida</a> </p>
                            <div id="carousel1" class="carousel commonCarousel slide" data-ride="carousel1">

                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <a href="{{url('public/website/imgs/bluebg.png')}}" data-fancybox="gallery">
                                            <img class="d-block w-100" src="{{url('public/website/imgs/bluebg.png')}}" alt="First slide">

                                        </a>                    </div>
                                    <div class="carousel-item">
                                        <a href="{{url('public/website/imgs/bluebg.png')}}" data-fancybox="gallery">
                                            <img class="d-block w-100" src="{{url('public/website/imgs/bluebg.png')}}" alt="First slide">

                                        </a>                    </div>
                                    <div class="carousel-item">
                                        <a href="{{url('public/website/imgs/bluebg.png')}}" data-fancybox="gallery">
                                            <img class="d-block w-100" src="{{url('public/website/imgs/bluebg.png')}}" alt="First slide">

                                        </a>                    </div>
                                    <div class="carousel-item">
                                        <a href="{{url('public/website/imgs/bluebg.png')}}" data-fancybox="gallery">
                                            <img class="d-block w-100" src="{{url('public/website/imgs/bluebg.png')}}" alt="First slide">

                                        </a>                    </div>
                                </div>
                                <ol class="carousel-indicators  mt-3 position-relative customIndicators">
                                    <li data-target="#carousel1" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel1" data-slide-to="1"></li>
                                    <li data-target="#carousel1" data-slide-to="2"></li>
                                    <li data-target="#carousel1" data-slide-to="3"></li>
                                </ol>
                            </div>
                        </div>
                        <div class="block2 mb-4">
                            <div class="mt-3 text-center">
                    <span class="bgdarkblue mediaPurple mx-auto listLeftIcons rounded-circle mr-3">
                        <img src="{{url('public/website/imgs/speaker.svg')}}" class="img-fluid icons" alt="" />
                    </span>
                            </div>
                            <p class="text-muted mt-4 text-center fontw-400">Promotion of medical profile on instagram (220k+ local followers)
                            </p>
                            <div id="carousel2" class="carousel commonCarousel slide" data-ride="carousel">

                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <a href="{{url('public/website/imgs/bluebg.png')}}" data-fancybox="gallery">
                                            <img class="d-block w-100" src="{{url('public/website/imgs/bluebg.png')}}" alt="First slide">

                                        </a>                    </div>
                                    <div class="carousel-item">
                                        <a href="{{url('public/website/imgs/bluebg.png')}}" data-fancybox="gallery">
                                            <img class="d-block w-100" src="{{url('public/website/imgs/bluebg.png')}}" alt="First slide">

                                        </a>                    </div>
                                    <div class="carousel-item">
                                        <a href="{{url('public/website/imgs/bluebg.png')}}" data-fancybox="gallery">
                                            <img class="d-block w-100" src="{{url('public/website/imgs/bluebg.png')}}" alt="First slide">

                                        </a>                    </div>
                                    <div class="carousel-item">
                                        <a href="{{url('public/website/imgs/bluebg.png')}}" data-fancybox="gallery">
                                            <img class="d-block w-100" src="{{url('public/website/imgs/bluebg.png')}}" alt="First slide">

                                        </a>                    </div>
                                </div>
                                <ol class="carousel-indicators  mt-3 position-relative customIndicators">
                                    <li data-target="#carousel2" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel2" data-slide-to="1"></li>
                                    <li data-target="#carousel2" data-slide-to="2"></li>
                                    <li data-target="#carousel2" data-slide-to="3"></li>
                                </ol>
                            </div>
                        </div>
                        <div class="block3 mb-4">
                            <div class="mt-3 text-center">
                    <span class="bgdarkblue mediaPurple mx-auto listLeftIcons rounded-circle mr-3">
                        <img src="{{url('public/website/imgs/announce.svg')}}" class="img-fluid icons" alt="" />
                    </span>
                            </div>
                            <p class="text-muted mt-4 text-center fontw-400">Daily posting of profile in stories</p>
                            <div id="carousel3" class="carousel commonCarousel slide" data-ride="carousel">

                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <a href="{{url('public/website/imgs/bluebg.png')}}" data-fancybox="gallery">
                                            <img class="d-block w-100" src="{{url('public/website/imgs/bluebg.png')}}" alt="First slide">

                                        </a>                    </div>
                                    <div class="carousel-item">
                                        <a href="{{url('public/website/imgs/bluebg.png')}}" data-fancybox="gallery">
                                            <img class="d-block w-100" src="{{url('public/website/imgs/bluebg.png')}}" alt="First slide">

                                        </a>                    </div>
                                    <div class="carousel-item">
                                        <a href="{{url('public/website/imgs/bluebg.png')}}" data-fancybox="gallery">
                                            <img class="d-block w-100" src="{{url('public/website/imgs/bluebg.png')}}" alt="First slide">

                                        </a>                    </div>
                                    <div class="carousel-item">
                                        <a href="{{url('public/website/imgs/bluebg.png')}}" data-fancybox="gallery">
                                            <img class="d-block w-100" src="{{url('public/website/imgs/bluebg.png')}}" alt="First slide">

                                        </a>                    </div>
                                </div>
                                <ol class="carousel-indicators  mt-3 position-relative customIndicators">
                                    <li data-target="#carousel3" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel3" data-slide-to="1"></li>
                                    <li data-target="#carousel3" data-slide-to="2"></li>
                                    <li data-target="#carousel3" data-slide-to="3"></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="headingControl2">


                        <div class="block3 mb-4">


                            <div class="text-center mt-5">
                                <p class="mb-0 text-muted fontw-400">Price:</p>
                                <p class="text-muted fontw-400">
                                    $19.99 per month</p>

                                <button type="button" class="btn px-4 btn-primary rounded-pill fontw-700">JOIN TODAY</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> --}}

@endsection



