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
            margin: 5% auto;
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

        <div class="chatBox">
            <div class="rightChat mb-3 ml-auto text-right">
                <span class="  d-inline-block  ">
                  <div class="d-flex align-items-center ChatBubble   py-2 px-3 rounded-pill">
                    <img src="{{url('public/website/imgs/teethMsg.svg')}}" class="img-fluid" alt="" />
                      <span class="ml-2 text-white fontw-400 d-inline-block"> Dentist</span>
                  </div>
                </span>
            </div>
            <div class="leftChat mb-3 ">
              <span class="   d-inline-block ">
                 <div class="d-flex align-items-center ChatBubble-grey py-2 px-3 rounded-pill  ">
                  <span class="  d-inline-block fontw-400 "> Check this out</span>
                 </div>
              </span>
            </div>

                <div class="leftChat mb-3">

                    <div class=" doc-search-results">

                    </div>
                    <div id="loader" class="lds-dual-ring hidden overlay"></div>
                </div>

        </div>

      <!-- MODAL CONTENT SAMPLE STARTS HERE -->
      <div class="modal fade animate pl-0" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-dialog-scrollable modal-dialog max100  mt-5 pt-5 mx-0" role="document">
            <div class="modal-content animate-bottom h-100">
              <div class="modal-header border-bottom-0">
                <a type="button" class="close p-2" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></a>
              </div>
              <div class="modal-body ">
                <!-- <div class="text-center">
                  <h6 class="text-center font-weight-bold"> Únete a doctores.hn hoy!</h6>
                  <p class="text-muted fontw-400">Forma parte del equipo de médicos con mayor presencia en redes sociales de Honduras.</p>
                  <div class="mt-4 text-center">
                    <span class="bgdarkpurple mediaPurple mx-auto listLeftIcons rounded-circle mr-3">
                        <img src="./imgs/media.svg" class="img-fluid icons" alt="" />
                        </span>
                  </div>
                  <p class="text-muted mt-4 fw-400">4 diseños de banners digitales para promoción de productos o servicios</p>
                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <a href="./imgs/carouselImg.svg" data-fancybox="gallery">
                          <img class="d-block w-100" src="./imgs/carouselImg.svg"  alt="First slide">

                        </a>
                      </div>
                      <div class="carousel-item">
                        <a href="./imgs/carouselImg.svg" data-fancybox="gallery">
                          <img class="d-block w-100" src="./imgs/carouselImg.svg"  alt="First slide">

                        </a>              </div>
                      <div class="carousel-item">
                        <a href="./imgs/carouselImg.svg" data-fancybox="gallery">
                          <img class="d-block w-100" src="./imgs/carouselImg.svg"  alt="First slide">

                        </a>              </div>
                    </div>
                    <ol class="carousel-indicators  mt-3 position-relative customIndicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                      </ol>
                  </div>
                  <p class="mb-0 text-muted fontw-400">Precio</p>
                  <p class="text-muted fontw-400">
                    $160 por mes</p>
                  <p class="mb-0 text-muted fontw-400">Membresía</p>
                  <p class="text-muted fontw-400">
                    GRATIS hasta el 31/06/21</p>
                    <button type="button" class="btn px-4 btn-primary rounded-pill fontw-700">UNIRME HOY</button>

                </div> -->
                <h6 class=" font-weight-bold mb-0">A tu gusto</h6>
                <p class="text-muted font-14 mb-0">1 review</p>
                <p class="text-muted font-14 mb-0">Cake shop  <i class="fas ml-2 fa-motorcycle"></i> <span>16 min</span></p>
                <p class="text-muted font-14"><span class="text-success">Open</span> - Closes 17:00</p>
                <div class="mt-4 d-flex">
                  <div class="w-25 text-center font-14">
                      <span class="d-block OverviewIcons active mb-1">
                          <i class="fas fa-directions"></i>
                      </span>
                     <span class="font-12 bluetext text-uppercase"> Directions</span>
                  </div>
                  <div class="w-25 text-center font-14">
                      <span class="d-block OverviewIcons  mb-1">
                          <i class="fas fa-location-arrow"></i>
                      </span>
                     <span class="font-12 bluetext text-uppercase"> Start </span>
                  </div>
                  <div class="w-25 text-center font-14">
                      <span class="d-block OverviewIcons  mb-1">
                          <i class="fas fa-phone-alt"></i>
                      </span>
                     <span class="font-12 bluetext text-uppercase"> Call</span>
                  </div>
                  <div class="w-25 text-center font-14">
                      <span class="d-block OverviewIcons  mb-1">
                          <i class="far fa-bookmark"></i>
                      </span>
                     <span class="font-12 bluetext text-uppercase"> Save</span>
                  </div>
                </div>
                <ul class="list-group mt-4">
                    <li class="list-group-item border-0 px-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                              <i class="fal fa-check text-success font-14 mr-0"></i>
                              <span class="font-14">Delivery</span>
                            </div>
                            <i class="fal fa-angle-right " style="font-size: 26px;"></i>
                        </div>
                    </li>
                    <li class="list-group-item border-0 px-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                              <i class="far fa-map-marker-alt bluetext"></i>
                              <span class="font-14 ml-4">Unnamed Road, Tegucigalpa</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item border-0 px-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                              <i class="fas fa-ellipsis-h bluetext"></i>
                              <span class="font-14 ml-4">4Q43+66 Tegucigalpa</span>
                            </div>
                            <i class="fal fa-map-marker-exclamation" ></i>
                        </div>
                    </li>
                    <li class="list-group-item border-0 px-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                              <i class="fal fa-clock bluetext"></i>
                              <span class="font-14 ml-4"><strong>Open</strong> - Closes 17:00</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item border-0 px-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                              <i class="fas fa-phone-alt bluetext"></i>
                              <span class="font-14 ml-4">3207-1002</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item border-0 px-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                              <i class="fal fa-pencil bluetext"></i>
                              <span class="font-14 ml-4"><em>Suggest an edit</em></span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item border-0 px-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                              <i class="fas fa-globe-asia text-muted"></i>
                              <span class="font-14 ml-4 text-muted">Add website</span>
                            </div>
                        </div>
                    </li>
                </ul>


              </div>

            </div>
          </div>
        </div>

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
                          <img src="./imgs/speaker.svg" class="img-fluid icons" alt="" />
                      </span>
                  </div>
                  <p class="text-muted mt-4 text-center fontw-400">Diseño y publicación de perfil médico completo para Facebook e
                      Instagram con diseño moderno e innovador</p>
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
                  <p class="text-muted mt-4 text-center fontw-400">Publicidad permanente en Facebook e Instagram con informes y
                      resultados de las campañas</p>
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
              <div>
                  <h6 class="text-center fontw-700">Servicios opcionales a petición
                      del miembro:</h6>

              </div>



          </div>
          </div>

        </div>
      </div>
    </div>

@endsection



