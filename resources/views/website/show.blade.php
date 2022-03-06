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
    {{-- <div class="MainContent p-3"> --}}

    <div class="chatBox">

        <div class="leftChat mb-3">

            <div class="doc-search-results">
                <div class="rightChat mb-3 ml-auto text-right">
                    <span class="  d-inline-block  ">
                      <div class="d-flex align-items-center ChatBubble   py-2 px-3 rounded-pill">
                          <img src="public/{{ $logo }}" class="img-fluid" style="width:30px;" />
                          <span class="ml-2 text-white fontw-400 d-inline-block"> {{ $text}}</span>
                      </div>
                    </span>
              </div>
              <div class="leftChat mb-3 ">
                  <span class="   d-inline-block ">
                     <div class="d-flex align-items-center ChatBubble-grey py-2 px-3 rounded-pill  ">
                      <span class="  d-inline-block fontw-400 ">Resultados:</span>
                     </div>
                  </span>
              </div>

              <div class="   border roundcorner py-3 ">
@foreach ($search as $item)



<div class="border-bottom pb-2 mb-3 doc-search-results">
    <div class="d-flex justify-content-between addslick owl-carousel owl-theme mx-0 px-3 px-xs-1">
        <div class=" h1s item mr-2 ">

            <div class="roundcorner  " >
              <a href="{{(!empty($item->profile_picture)) ? url('public/'.$item->profile_picture) : url('public/uploads/profile_picture/default.jpg') }}" data-fancybox="gallery">
                 <img src="{{(!empty($item->profile_picture)) ?  url('public/'.$item->profile_picture) : url('public/uploads/profile_picture/default.jpg') }}" class="h-100" alt="" style="width: 110px;">
                </a>
            </div>

        </div>

        <div class="h1s item mr-2 ">

            <div class="roundcorner " >

              <a href="{{(!empty($item->clinic_pic)) ? url('public/'.$item->clinic_pic) : url('public/uploads/profile_picture/default.jpg') }}" data-fancybox="gallery">
                     <img src="{{(!empty($item->clinic_pic)) ? url('public/'.$item->clinic_pic) : url('public/uploads/profile_picture/default.jpg') }}" class="h-100 " alt="" style="width: 110px;">
              </a>

           </div>

        </div>
        <div class="h1s item mr-2">
            <div class="roundcorner d-flex flex-column justify-content-center align-items-center text-center bgpurple p-3 h-100">
                 <img src="{{url('public/website/imgs/Group.svg')}}" class="img-fluid w-auto mb-2" alt="" >
                 <h6 class="m-0 font-9 fontw-700">{{ $item->year_exp ."+" }}</h6>
                 <span class="font-9 fiveyear fontw-400">Años de experiencia</span>
            </div>
        </div>
        <div class="h1s item mr-2">
            <div class="roundcorner d-flex flex-column justify-content-center align-items-center text-center bglightblue p-3 h-100">
                <a href="{{url('public/website/imgs/mappointer.svg')}}" data-toggle="modal" data-target="#myModal2" >
                <img src="{{url('public/website/imgs/mappointer.svg')}}" height="26" class=" mb-2 text-center" alt="" style="" >
                 <h6 class=" text-center font-9 fontw-700">{{ $item->address }}</h6>

            </div>
        </div>


      <div class="h1s item mr-2">
      <div class="roundcorner d-flex flex-column justify-content-center align-items-center text-center bglightgreen p-3 h-100">
      <img src="{{url('public/website/imgs/Union.svg')}}" class="img-fluid w-auto mb-2" alt="" >
      <h6 class="m-0 font-9 fontw-700">{{ date('h:i:s a', strtotime($item->o_time)) }}  {{ date('h:i:s a', strtotime($item->c_time)) }} </h6>
      <span class="font-9 fiveyear fontw-400"></span>
         </div>
      </div>
    </div>
    <div class="d-flex mt-3 px-3 align-items-center justify-content-between">
      <h6 class="  mb-0">{{ $item->name }}</h6>
      <div>
       
        <a href="https://wa.me/{{ $item->whatsapp }}">

          <img src="{{url('public/website//imgs/whatsapp.svg')}}" class="img-fluid " alt="" />
        </a>
        <a href="{{ $item->ig_username }}">

            <img src="{{url('public/website//imgs/insta.png')}}" style="height: 20px;" class="img-fluid" alt="" />
        </a>
        <a href="tel:{{ $item->whatsapp }}">

            <img src="{{url('public/website//imgs/telegram.svg')}}" class="img-fluid" alt="" />
        </a>
       
    </div>
    </div>
    <div class="d-flex px-3 mt-2 align-items-center ">
        <img src="{{url('public/website/imgs/bag.svg')}}" class="img-fluid mr-2" alt="" />
           <span class="text-muted font-12 fontw-600">{{ $item->specialist->specialist_name }}</span>
    </div>
 </div>
 @endforeach
              </div>
            </div>
            <div id="loader" class="lds-dual-ring hidden overlay"></div>
        </div>
    </div>


    {{-- </div> --}}
    {{-- <div class="modal fade animate pl-0" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog max100  mt-5 pt-5 mx-0" role="document">
            <div class="modal-content animate-bottom h-100">
                <div class="modal-header border-bottom-0">
                    <a type="button" class="close up p-2" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></a>
                </div>!-- MODAL CONTENT SAMPLE STARTS HERE -->
    <
                <div class="modal-body "> --}}
              {{-- <div class="text-center">
                <h6 class="text-center font-weight-bold"> Únete a doctores.hn hoy!</h6>
                <p class="text-muted fontw-400">Forma parte del equipo de médicos con mayor presencia en redes sociales de Honduras.</p>
                <div class="mt-4 text-center">
                  <span class="bgdarkpurple mediaPurple mx-auto listLeftIcons rounded-circle mr-3">
                      <img src="{{url('public/website/imgs/media.svg')}}" class="img-fluid icons" alt="" />
                      </span>
                </div>
                <p class="text-muted mt-4 fw-400">4 diseños de banners digitales para promoción de productos o servicios</p>
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <a href="{{url('public/website/imgs/carouselImg.svg')}}" data-fancybox="gallery">
                        <img class="d-block w-100" src="{{url('public/website/imgs/carouselImg.svg')}}"  alt="First slide">

                      </a>
                    </div>
                    <div class="carousel-item">
                      <a href="{{url('public/website/imgs/carouselImg.svg')}}" data-fancybox="gallery">
                        <img class="d-block w-100" src="{{url('public/website/imgs/carouselImg.svg')}}"  alt="First slide">

                      </a>              </div>
                    <div class="carousel-item">
                      <a href="{{url('public/website/imgs/carouselImg.svg')}}" data-fancybox="gallery">
                        <img class="d-block w-100" src="{{url('public/website/imgs/carouselImg.svg')}}"  alt="First slide">

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

              </div> --}}
                    {{-- <h6 class=" font-weight-bold mb-0">A tu gusto</h6>
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
    </div> --}}

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
@endsection



