<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clube + Seu clube de benefícios</title>

    <link rel="icon" type="image/png" href="{{ asset('images/plus.png') }}">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

  @vite(['resources/css/default.css','resources/css/app.css', 'resources/css/pages/home.css' , 'resources/js/app.js'])
</head>

<body>
@include('components.header')

<!-- ================= HERO ================= -->
<section class="bg-white">
  <div
    class="max-w-[1920px] bg-center bg-cover min-h-[clamp(520px,100vh,1080px)] mx-auto bg-no-repeat flex justify-center items-center pt-[6rem] md:pt-[8rem] lg:pt-[10rem]"
    style="background-image:url('{{asset('images/image_banner.png')}}')">
    <div class="w-full max-w-[1204px] px-4 sm:px-6 md:px-8">
      <h1 class="text-white leading-[1.1] my-6 mb-6 md:mb-[80px] text-[34px] sm:text-[40px] md:text-[48px] font-light">
        Um Clube <br> <strong>pensado</strong> <br>em você!
      </h1>

      <!-- CARD FORM -->
      <div class="w-full bg-white rounded-3xl p-3 sm:p-4">
        <!-- 1 col mobile, 2 cols tablet, 5 cols desktop -->
        <div class="grid gap-2 sm:gap-3 md:gap-4 grid-cols-1 sm:grid-cols-2 xl:grid-cols-[1fr_1fr_1fr_1fr_100px] items-end">
          <!-- Localização -->
          <div class="p-2 sm:p-3">
            <p class="mb-2 text-[#F46E00] font-bold text-sm sm:text-base">Localização</p>
            <div class="relative">
              <span class="absolute left-3 top-1/2 -translate-y-1/2">
                <img src="{{asset('images/location.svg')}}" alt="location">
              </span>
              <input type="text" placeholder="Pesquise por Hotel/Cidade"
                     class="w-full pl-10 pr-4 h-11 sm:h-12 rounded-full border border-gray-300 text-[14px] sm:text-[15px] placeholder-[#A5A5A5] focus:ring-indigo-500 focus:border-indigo-500">
            </div>
          </div>

          <!-- Check-in -->
          <div class="p-2 sm:p-3">
            <p class="mb-2 text-[#F46E00] font-bold text-sm sm:text-base">Check-in</p>
            <div class="relative">
              <span class="absolute left-3 top-1/2 -translate-y-1/2">
                <img src="{{asset('images/calendar.svg')}}" alt="calendar">
              </span>
              <input type="date"
                     class="w-full pl-10 pr-4 h-11 sm:h-12 rounded-full border border-gray-300 text-[14px] sm:text-[15px] placeholder-[#A5A5A5] focus:ring-indigo-500 focus:border-indigo-500">
            </div>
          </div>

          <!-- Check-out -->
          <div class="p-2 sm:p-3">
            <p class="mb-2 text-[#F46E00] font-bold text-sm sm:text-base">Check-out</p>
            <div class="relative">
              <span class="absolute left-3 top-1/2 -translate-y-1/2">
                <img src="{{asset('images/calendar.svg')}}" alt="calendar">
              </span>
              <input type="date"
                     class="w-full pl-10 pr-4 h-11 sm:h-12 rounded-full border border-gray-300 text-[14px] sm:text-[15px] placeholder-[#A5A5A5] focus:ring-indigo-500 focus:border-indigo-500">
            </div>
          </div>

          <!-- Hóspedes -->
          <div class="p-2 sm:p-3">
            <p class="mb-2 text-[#F46E00] font-bold text-sm sm:text-base">Hóspedes</p>
            <div class="relative">
              <span class="absolute left-3 top-1/2 -translate-y-1/2">
                <img src="{{asset('images/users.svg')}}" alt="ícone usuários">
              </span>
              <select class="w-full pl-10 pr-4 h-11 sm:h-12 rounded-full border border-gray-300 text-[14px] sm:text-[15px] focus:ring-indigo-500 focus:border-indigo-500">
                <option>1 hóspede</option>
                <option>2 hóspedes</option>
                <option>3 hóspedes</option>
              </select>
            </div>
          </div>

          <!-- Botão buscar -->
            <div class="p-2 sm:p-3 xl:p-0">
                <a href="#" class="block search-btn">
                    <img
                    src="{{ asset('images/button-select.svg') }}"
                    alt="Buscar"
                    class="w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20 xl:w-auto xl:h-[89px] object-contain"
                    >
                </a>
            </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ================= O QUE É O CLUBE + ================= -->
<section>
  <div
    class="max-w-[1920px] bg-center bg-cover bg-[#F4F1EA] min-h-[clamp(640px,100vh,1080px)] mx-auto pt-10 md:pt-10"
    style="background-image:url('{{asset('images/banner-oq-é 1.png')}}');">

    <div class="ml-4 sm:ml-8 md:ml-12 relative w-[320px] sm:w-[420px] md:w-[500px] h-[360px] sm:h-[440px] md:h-[500px] bg-no-repeat bg-contain"
         style="background-image:url('{{asset('images/Subtract.svg')}}')">
      <div class="absolute top-5 right-0">
        <svg width="72" height="83" viewBox="0 0 72 83" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 59.2768C0 72.1619 9.72216 82.6044 21.7099 82.6044H71.7645C71.7494 82.2034 71.708 81.8064 71.708 81.4013V0H0v59.2768Zm38.5343-42.2277c2.3938 0 4.3389 2.0902 4.3389 4.6704v12.0749h11.2452c2.3937 0 4.3389 2.0982 4.3389 4.6704v5.683c0 2.5802-1.9452 4.6703-4.3389 4.6703H42.8732V60.893c0 2.5803-1.9451 4.6704-4.3389 4.6704h-5.2965c-2.3938 0-4.3465-2.1897-4.3465-4.7701V48.8181H17.6537c-2.3938 0-4.3465-2.0901-4.3465-4.6703v-5.683c0-2.5722 1.9527-4.6704 4.3465-4.6704h11.2376V21.7195c0-2.5802 2.006-4.6704 4.3998-4.6704h5.2432Z" fill="white"/></svg>
      </div>
      <div class="pt-[clamp(10px,3.472vw,50px)] pl-[clamp(10px,2.083vw,30px)]">
        <h1 class="text-[clamp(26px,3.264vw,47px)] font-bold text-white leading-[1.2] p-5">
          O que é o <br> Clube +
        </h1>
        <p class="text-[clamp(12px,1.389vw,20px)] p-5 pt-0 max-w-[296px] text-white">
          Descontos exclusivos, experiências únicas e benefícios especiais em hospedagens e roteiros.
          <a class="text-[#3FD0FC]" href="#">Viaje mais, aproveite melhor</a>.
        </p>
      </div>
    </div>

    <div class="max-w-[1280px] mx-auto mt-8 md:mt-[50px] px-4 sm:px-6">
      <div class="max-w-[680px]">
        <h2 class="text-[28px] sm:text-[34px] md:text-[40px] leading-tight font-bold">
          Sua próxima viagem começa com vantagens!
        </h2>
        <p class="font-light opacity-50 mt-2 text-[14px] sm:text-[15px]">
          Optaquae perepedi dende officae cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem. Musam aliquo optae que nonecul.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ================= DESTINOS ================= -->
<section>
  <div class="max-w-[1920px] bg-[#E1E1E1] pt-6 md:pt-10 min-h-[clamp(620px,100vh,1080px)] mx-auto">
    <div class="max-w-[1280px] mx-auto px-4 sm:px-6">
      <h2 class="text-[#F46E00] text-[30px] sm:text-[42px] md:text-[54px] leading-tight max-w-[680px]">
        Seu próximo destino com desconto
      </h2>

      <div class="destination-content mt-4 md:mt-6 flex justify-between md:justify-between">
        <!-- 1 -->
        <div class="destination-block active bg-center bg-cover bg-no-repeat"
             style="background-image:url('{{asset("images/wanderlust.png")}}')">
          <div class="destination-description">
            <h3 class="destination-text-title">Wanderlust Experience Hotel</h3>
            <p class="destination-text-description">
              Lorem ipsum lorem nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem.
            </p>
            <div class="destination-button">
              <button class="flex justify-between items-center">
                <span>Veja o Hotel</span>
                <span>
                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.172 7 6.808 1.636 8.222.222 16 8l-7.778 7.778-1.414-1.414L12.172 9H0V7h12.172Z"/></svg>
                </span>
              </button>
            </div>
          </div>
        </div>

        <!-- 2 -->
        <div class="destination-block bg-center bg-cover bg-no-repeat"
             style="background-image:url('{{asset("images/bravamundo.png")}}')">
          <div class="destination-description">
            <h3 class="destination-text-title">Brava Mundo</h3>
            <p class="destination-text-description">Lorem Ipsum lorem ipsum lorem.</p>
            <div class="destination-button">
              <button class="flex justify-between items-center">
                <span>Veja o Hotel</span>
                <span><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.172 7 6.808 1.636 8.222.222 16 8l-7.778 7.778-1.414-1.414L12.172 9H0V7h12.172Z"/></svg></span>
              </button>
            </div>
          </div>
        </div>

        <!-- 3 -->
        <div class="destination-block bg-center bg-cover bg-no-repeat"
             style="background-image:url('{{asset("images/poehma.png")}}')">
          <div class="destination-description">
            <h3 class="destination-text-title">Poehma</h3>
            <p class="destination-text-description">Lorem Ipsum lorem ipsum lorem.</p>
            <div class="destination-button">
              <button class="flex justify-between items-center">
                <span>Veja o Hotel</span>
                <span><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.172 7 6.808 1.636 8.222.222 16 8l-7.778 7.778-1.414-1.414L12.172 9H0V7h12.172Z"/></svg></span>
              </button>
            </div>
          </div>
        </div>

        <!-- 4 -->
        <div class="destination-block bg-center bg-cover bg-no-repeat"
             style="background-image:url('{{asset("images/poehma.png")}}')">
          <div class="destination-description">
            <h3 class="destination-text-title">Vivant Eco Beach</h3>
            <p class="destination-text-description">Lorem Ipsum lorem ipsum lorem.</p>
            <div class="destination-button">
              <button class="flex justify-between items-center">
                <span>Veja o Hotel</span>
                <span><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.172 7 6.808 1.636 8.222.222 16 8l-7.778 7.778-1.414-1.414L12.172 9H0V7h12.172Z"/></svg></span>
              </button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- ================= LOGOS / SWIPER ================= -->
<section class="bg-[#F46E00]">
  <div class="w-full">
    <div class="swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide"><div class="w-full flex justify-center"><img src="{{asset('images/logoipsum.png')}}" class="m-auto" alt="logo"></div></div>
        <div class="swiper-slide"><div class="w-full flex justify-center"><img src="{{asset('images/loqo.png')}}" class="m-auto" alt="logo"></div></div>
        <div class="swiper-slide"><div class="w-full flex justify-center"><img src="{{asset('images/logoipsum.png')}}" class="m-auto" alt="logo"></div></div>
        <div class="swiper-slide"><div class="w-full flex justify-center"><img src="{{asset('images/logoipsum.png')}}" class="m-auto" alt="logo"></div></div>
        <div class="swiper-slide"><div class="w-full flex justify-center"><img src="{{asset('images/logoipsum.png')}}" class="m-auto" alt="logo"></div></div>
        <div class="swiper-slide"><div class="w-full flex justify-center"><img src="{{asset('images/logoipsum.png')}}" class="m-auto" alt="logo"></div></div>
      </div>
    </div>
  </div>

  <div class="max-w-[1440px] mx-auto beneficios px-4 sm:px-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-4">
      <div class="conheca">
        <h1 class="text-[26px] sm:text-[32px] md:text-[36px] leading-tight text-white">
          Conheça alguns benefícios de quem é Clube +
        </h1>
      </div>
      <div class="flex md:justify-end items-end">
        <p class="text-white text-[14px] md:text-[16px] max-w-[485px]">
          Lorem ipsum lorem nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem.
        </p>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-4">
      <div class="banner-veja-mais order-last md:order-first">
        <img src="{{asset('images/veja-mais.png')}}" class="w-full" alt="">
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:col-span-2">
        {{-- 4 cards existentes inalterados --}}
        <div class="content-block-beneficios">
          <div class="content-banner-beneficios h-[275px] bg-cover bg-center" style="background-image:url('{{asset('images/uber.jpg')}}')">
            <div class="dot"><img src="{{asset('images/badge.png')}}" alt="badge"></div>
          </div>
          <div class="content-beneficios-description">
            <h2 class="flex justify-between text-[22px] md:text-[24px] font-bold"><span>Uber</span><span>8% Desc</span></h2>
            <div class="flex justify-between">
              <span class="text-[14px] md:text-[16px]">São Paulo, Rio de Janeiro</span>
              <div class="flex">@for($i=0;$i<5;$i++)<img src="{{asset('images/star.svg')}}" alt="">@endfor</div>
            </div>
          </div>
        </div>

        <div class="content-block-beneficios">
          <div class="content-banner-beneficios h-[275px] bg-cover bg-center" style="background-image:url('{{asset('images/americanas.png')}}')">
            <div class="dot"><img src="{{asset('images/badge.png')}}" alt="badge"></div>
          </div>
          <div class="content-beneficios-description">
            <h2 class="flex justify-between text-[22px] md:text-[24px] font-bold"><span>Americanas</span><span>20% Desc</span></h2>
            <div class="flex justify-between">
              <span class="text-[14px] md:text-[16px]">Búzios, Paraná</span>
              <div class="flex">@for($i=0;$i<5;$i++)<img src="{{asset('images/star.svg')}}" alt="">@endfor</div>
            </div>
          </div>
        </div>

        <div class="content-block-beneficios">
          <div class="content-banner-beneficios h-[275px] bg-cover bg-center" style="background-image:url('{{asset('images/farmacias.png')}}')">
            <div class="dot"><img src="{{asset('images/badge.png')}}" alt="badge"></div>
          </div>
          <div class="content-beneficios-description">
            <h2 class="flex justify-between text-[22px] md:text-[24px] font-bold"><span>Farmácias</span><span>5% Desc</span></h2>
            <div class="flex justify-between">
              <span class="text-[14px] md:text-[16px]">Balneário, São Paulo</span>
              <div class="flex">@for($i=0;$i<5;$i++)<img src="{{asset('images/star.svg')}}" alt="">@endfor</div>
            </div>
          </div>
        </div>

        <div class="content-block-beneficios">
          <div class="content-banner-beneficios h-[275px] bg-cover bg-center" style="background-image:url('{{asset('images/gol.png')}}')">
            <div class="dot"><img src="{{asset('images/badge.png')}}" alt="badge"></div>
          </div>
          <div class="content-beneficios-description">
            <h2 class="flex justify-between text-[22px] md:text-[24px] font-bold"><span>Gol</span><span>10% Desc</span></h2>
            <div class="flex justify-between">
              <span class="text-[14px] md:text-[16px]">Bahia, Santa Catarina</span>
              <div class="flex">@for($i=0;$i<5;$i++)<img src="{{asset('images/star.svg')}}" alt="">@endfor</div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- ================= VANTAGENS ================= -->
<section class="bg-[#F4F1EA] section-vantagens">
  <div
    class="max-w-[1920px] mx-auto h-[636px] p-4 bg-left bg-no-repeat"
    style="background-size:1440px; background-image:url('{{ asset('images/vantagens.png') }}')"
  >
    <!-- Título -->
    <div class="max-w-[600px] m-[50px]">
      <h2 class="font-semibold text-[50px]">
        Conheça as vantagens e assinaturas do Clube+
      </h2>
    </div>

    <!-- 3 cards amarelos -->
    <div class="flex max-w-[620px] ml-[60px] mt-[90px] justify-between relative">
      <!-- Card 1 -->
      <div class="relative">
        <div class="dot">
          <img src="{{ asset('images/arrow_outward.svg') }}" alt="" />
        </div>
        <div
          class="relative"
          style="clip-path:url(#shape); width:178px; height:243px; background:#E8CC00; padding-top:40px"
        >
          <div class="h-max">
            <div class="h-max p-4">
              <img src="{{ asset('images/cash.svg') }}" class="mb-4" alt="" />
              <p class="font-bold" style="font-size:20px">Desconto em passagens</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="relative">
        <div class="dot">
          <img src="{{ asset('images/arrow_outward.svg') }}" alt="" />
        </div>
        <div
          class="relative"
          style="clip-path:url(#shape); width:178px; height:243px; background:#E8CC00; padding-top:40px"
        >
          <div class="h-max">
            <div class="h-max p-4">
              <img src="{{ asset('images/cash.svg') }}" class="mb-4" alt="" />
              <p class="font-bold" style="font-size:20px">Descontos em mais de 80 hotéis</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="relative">
        <div class="dot">
          <img src="{{ asset('images/arrow_outward.svg') }}" alt="" />
        </div>
        <div
          class="relative"
          style="clip-path:url(#shape); width:178px; height:243px; background:#E8CC00; padding-top:40px"
        >
          <div class="h-max">
            <div class="h-max p-4">
              <img src="{{ asset('images/cash.svg') }}" class="mb-4" alt="" />
              <p class="font-bold" style="font-size:20px">Descontos em mais de 50 lojas</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Botão -->
      <div class="absolute bottom-0 button-assine-ja">
        <button>ASSINE JÁ</button>
      </div>

    </div>

    <!-- Faixa de badges -->
    <div class="max-w-full my-4 mx-4 grid grid-cols-2">
      <div class="flex w-full max-w-full m-auto justify-between">
        <div class="badge"><img src="{{ asset('images/badge/moneybadge.svg') }}" alt="" /></div>
        <div class="badge"><img src="{{ asset('images/badge/holidaybadge.svg') }}" alt="" /></div>
        <div class="badge"><img src="{{ asset('images/badge/gymbadge.svg') }}" alt="" /></div>
        <div class="badge"><img src="{{ asset('images/badge/plusbadge.svg') }}" alt="" /></div>
        <div class="badge"><img src="{{ asset('images/badge/busbadge.svg') }}" alt="" /></div>
        <div class="badge"><img src="{{ asset('images/badge/beautybadge.svg') }}" alt="" /></div>
        <div class="badge"><img src="{{ asset('images/badge/dogbadge.svg') }}" alt="" /></div>
        <div class="badge"><img src="{{ asset('images/badge/pluswhitebadge.svg') }}" alt="" /></div>
      </div>
    </div>

    <div class="button-assine-ja-mobile">
        <button>ASSINE JÁ</button>
    </div>
  </div>
</section>


<!-- Elementor widget (inalterado) -->
<!-- SEARCH / OTA (com respiro lateral) -->
<section style="display: none;" class="otabuilder-area py-6 sm:py-8">
  <div class="container max-w-[1280px] mx-auto px-4 sm:px-6 md:px-8">

    <!-- Elementor widget (inalterado por dentro) -->
    <div data-elementor-type="wp-page" data-elementor-id="1056" class="elementor elementor-1056" data-elementor-post-type="page">
      <div class="elementor-element elementor-element-84543a9 e-flex e-con-boxed e-con e-parent" data-id="84543a9" data-element_type="container" data-settings='{"background_background":"classic","_ha_eqh_enable":false}' data-core-v316-plus="true">
        <div class="e-con-inner">
          <div class="elementor-element elementor-element-6da6e43 e-flex e-con-boxed e-con e-child" data-id="6da6e43" data-element_type="container" data-settings='{"background_background":"classic","_ha_eqh_enable":false}'>
            <div class="e-con-inner">
              <div class="elementor-element elementor-element-1e17443 elementor-widget elementor-widget-html" data-id="1e17443" data-element_type="widget" data-widget_type="html.default">
                <div class="elementor-widget-container">
                  <div id="otabuilder-widget">Carregando...</div>
                  <script>
                    function loadJS(url, location){var s=document.createElement('script');s.src=url;s.crossOrigin='anonymous';s.defer=true;s.async=true;location.appendChild(s);}
                    function initOtabuilderWidget(storefrontId,getCredentials,elementId,orientation){
                      var k='_OTABUILDER_EMBEDDED_SEARCH_INIT',loaded=false;
                      var _i=function(initSearchForm){
                        if(!loaded){loaded=true;initSearchForm(document.getElementById(elementId),{storefrontId,getCredentials,orientation});}
                      }
                      if(window[k]){_i(window[k]);}
                      else{document.addEventListener('otabuilder-search-ready',function(e){_i(e.detail.initSearchForm);});}
                    }
                    initOtabuilderWidget('xcGENFcrc44OoqI8awMuE',undefined,'otabuilder-widget','HORIZONTAL');
                    loadJS('https://app.otabuilder.com/static/js/widget.js',document.body);
                  </script>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<svg width="0" height="0">
  <defs>
    <clipPath id="shape" clipPathUnits="userSpaceOnUse">
      <path d="M17.9365 1.46045H120.665C128.794 1.46052 135.384 8.05028 135.384 16.1792V24.8765C135.384 35.0585 143.638 43.3128 153.82 43.313H162.518C170.646 43.3132 177.236 49.9028 177.236 58.0317V224.354C177.236 233.984 169.43 241.79 159.8 241.791H17.9365C8.30672 241.79 0.500214 233.984 0.5 224.354V18.897C0.50008 9.26708 8.30663 1.46053 17.9365 1.46045Z"/>
    </clipPath>
  </defs>
</svg>

@include('components.footer')

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script type="application/javascript">
  // Hover dos cards de destino
  const blocks = document.querySelectorAll('.destination-block');
  blocks.forEach(block => {
    block.addEventListener('mouseenter', () => {
      blocks.forEach(b => b.classList.remove('active'));
      block.classList.add('active');
    });
  });

  // Swiper com breakpoints
  const swiper = new Swiper('.swiper', {
    slidesPerView: 5,
    loop: true,
    speed: 3000,
    grabCursor: true,
    spaceBetween: 16,
    freeMode: true,
    autoplay: { delay: 0, disableOnInteraction: false },
    breakpoints: {
      0:   { slidesPerView: 2, spaceBetween: 12 },
      480: { slidesPerView: 3, spaceBetween: 12 },
      768: { slidesPerView: 4, spaceBetween: 14 },
      1024:{ slidesPerView: 5, spaceBetween: 16 },
    }
  });
</script>
</body>
</html>
