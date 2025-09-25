<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clube + Seu clube de benefícios</title>

  <link rel="icon" type="image/png" href="{{ asset('images/plus.png') }}">

  {{-- CSRF para POST no Laravel --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  {{-- Flatpickr (calendário cross-browser) --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <style>
  </style>

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
        <div class="grid gap-2 sm:gap-3 md:gap-4 grid-cols-1 sm:grid-cols-2 xl:grid-cols-[1fr_1fr_1fr_1fr_100px] items-end">
          <!-- Localização -->
          <div class="p-2 sm:p-3">
            <p class="mb-2 text-[#F46E00] font-bold text-sm sm:text-base">Localização</p>
            <div class="relative">
              <span class="absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none">
                <img src="{{asset('images/location.svg')}}" alt="location">
              </span>
              <select id="select-filter"
                      class="w-full pl-10 pr-4 h-11 sm:h-12 rounded-full border border-gray-300 text-[14px] sm:text-[15px] focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Selecione uma categoria</option>
                @foreach(($termos ?? []) as $termo)
                  <option value="{{ $termo->id }}">{{ $termo->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <!-- Check-in -->
          <div class="p-2 sm:p-3">
            <p class="mb-2 text-[#F46E00] font-bold text-sm sm:text-base">Check-in</p>
            <div class="relative">
              <span class="absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none">
                <img src="{{asset('images/calendar.svg')}}" alt="calendar">
              </span>
              <input id="checkin" type="text" placeholder="dd/mm/aaaa"
                     class="js-date w-full pl-10 pr-4 h-11 sm:h-12 rounded-full border border-gray-300 text-[14px] sm:text-[15px] placeholder-[#A5A5A5] focus:ring-indigo-500 focus:border-indigo-500">
            </div>
          </div>

          <!-- Check-out -->
          <div class="p-2 sm:p-3">
            <p class="mb-2 text-[#F46E00] font-bold text-sm sm:text-base">Check-out</p>
            <div class="relative">
              <span class="absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none">
                <img src="{{asset('images/calendar.svg')}}" alt="calendar">
              </span>
              <input id="checkout" type="text" placeholder="dd/mm/aaaa"
                     class="js-date w-full pl-10 pr-4 h-11 sm:h-12 rounded-full border border-gray-300 text-[14px] sm:text-[15px] placeholder-[#A5A5A5] focus:ring-indigo-500 focus:border-indigo-500">
            </div>
          </div>

          <!-- Hóspedes -->
          <div class="p-2 sm:p-3">
            <p class="mb-2 text-[#F46E00] font-bold text-sm sm:text-base">Hóspedes</p>
            <div class="relative">
              <span class="absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none">
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
            <a href="#" class="block search-btn" aria-label="Buscar">
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

{{-- Container onde os resultados serão injetados --}}
<div class="max-w-[1280px] mx-auto px-4 sm:px-6 py-8">
  <div id="search-status" class="loader" aria-live="polite">
    <div class="spinner" aria-hidden="true"></div>
    <span>Carregando resultados…</span>
  </div>
  <div id="search-results-container"></div>
  <div id="search-error" class="error-box mt-3" style="display:none;"></div>
</div>

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

<!-- ================= VANTAGENS ================= -->
<section class="bg-[#F4F1EA] section-vantagens">
  <div
    class="max-w-[1920px] mx-auto h-[636px] p-4 bg-left bg-no-repeat"
    style="background-size:1440px; background-image:url('{{ asset('images/vantagens.png') }}')"
  >
    <div class="max-w-[600px] m-[50px]">
      <h2 class="font-semibold text-[50px]">Conheça as vantagens e assinaturas do Clube+</h2>
    </div>

    <div class="flex max-w-[620px] ml-[60px] mt-[90px] justify-between relative">
      <div class="relative">
        <div class="dot"><img src="{{ asset('images/arrow_outward.svg') }}" alt="" /></div>
        <div class="relative" style="clip-path:url(#shape); width:178px; height:243px; background:#E8CC00; padding-top:40px">
          <div class="h-max"><div class="h-max p-4"><img src="{{ asset('images/cash.svg') }}" class="mb-4" alt="" />
            <p class="font-bold" style="font-size:20px">Desconto em passagens</p></div></div>
        </div>
      </div>

      <div class="relative">
        <div class="dot"><img src="{{ asset('images/arrow_outward.svg') }}" alt="" /></div>
        <div class="relative" style="clip-path:url(#shape); width:178px; height:243px; background:#E8CC00; padding-top:40px">
          <div class="h-max"><div class="h-max p-4"><img src="{{ asset('images/cash.svg') }}" class="mb-4" alt="" />
            <p class="font-bold" style="font-size:20px">Descontos em mais de 80 hotéis</p></div></div>
        </div>
      </div>

      <div class="relative">
        <div class="dot"><img src="{{ asset('images/arrow_outward.svg') }}" alt="" /></div>
        <div class="relative" style="clip-path:url(#shape); width:178px; height:243px; background:#E8CC00; padding-top:40px">
          <div class="h-max"><div class="h-max p-4"><img src="{{ asset('images/cash.svg') }}" class="mb-4" alt="" />
            <p class="font-bold" style="font-size:20px">Descontos em mais de 50 lojas</p></div></div>
        </div>
      </div>

      <div class="absolute bottom-0 button-assine-ja">
        <button>ASSINE JÁ</button>
      </div>
    </div>

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
<section style="display: none;" class="otabuilder-area py-6 sm:py-8">
  <div class="container max-w-[1280px] mx-auto px-4 sm:px-6 md:px-8">
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>

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
    slidesPerView: 5, loop: true, speed: 3000, grabCursor: true, spaceBetween: 16, freeMode: true,
    autoplay: { delay: 0, disableOnInteraction: false },
    breakpoints: { 0:{slidesPerView:2,spaceBetween:12},480:{slidesPerView:3,spaceBetween:12},768:{slidesPerView:4,spaceBetween:14},1024:{slidesPerView:5,spaceBetween:16} }
  });

  // Calendário (Flatpickr)
  (function(){
    const inEl  = document.getElementById('checkin');
    const outEl = document.getElementById('checkout');

    const today = new Date();
    const fpOut = flatpickr(outEl, {
      locale: flatpickr.l10ns.pt,
      dateFormat: 'd/m/Y',
      minDate: new Date(today.getTime() + 24*60*60*1000),
    });

    flatpickr(inEl, {
      locale: flatpickr.l10ns.pt,
      dateFormat: 'd/m/Y',
      minDate: today,
      onChange: function(selectedDates) {
        if (selectedDates[0]) {
          const minOut = new Date(selectedDates[0].getTime());
          minOut.setDate(minOut.getDate() + 1);
          fpOut.set('minDate', minOut);
          if (!fpOut.selectedDates[0] || fpOut.selectedDates[0] <= selectedDates[0]) {
            fpOut.setDate(minOut, true);
          }
        }
      }
    });
  })();
</script>

{{-- Helpers de rolagem suave e estabilidade de imagens --}}
<script>
  // Easing suave para o scroll
  function smoothScrollTo(targetY, duration = 750) {
    const startY = window.scrollY || window.pageYOffset;
    const diff   = Math.max(0, targetY) - startY;
    if (Math.abs(diff) < 2) return;

    let start;
    const easeOutCubic = t => 1 - Math.pow(1 - t, 3);

    function step(ts) {
      if (!start) start = ts;
      const p = Math.min(1, (ts - start) / duration);
      const y = startY + diff * easeOutCubic(p);
      window.scrollTo(0, y);
      if (p < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  }

  // Aguarda imagens decodificarem no container
  async function waitImages(el) {
    const imgs = Array.from(el.querySelectorAll('img'));
    await Promise.all(imgs.map(img => {
      if (img.complete) return Promise.resolve();
      return (img.decode ? img.decode() : new Promise(r => img.addEventListener('load', r, { once:true })))
             .catch(()=>{});
    }));
  }
</script>

{{-- Busca Ajax com loader + transição sem salto --}}
<script>
(function() {
  const token    = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
  const select   = document.getElementById('select-filter');
  const results  = document.getElementById('search-results-container');
  if (results && results.innerHTML.trim() !== '') results.classList.add('show');
  const loader   = document.getElementById('search-status');
  const errBox   = document.getElementById('search-error');
  const btn      = document.querySelector('.search-btn');

  function showLoader(on=true){
    loader.classList.toggle('on', on);
    if (btn) btn.classList.toggle('pointer-events-none', on);
  }
  function showError(msg){
    errBox.style.display = 'block';
    errBox.textContent = msg || 'Não foi possível carregar os resultados. Tente novamente.';
  }
  function clearError(){ errBox.style.display = 'none'; errBox.textContent = ''; }

  // >>> versão com suavidade e sem salto <<<
  async function loadFragmentInto(url, targetEl) {
    // tira o estado visível e congela a altura atual para evitar pulo
    targetEl.classList.remove('show');
    const prevMin = targetEl.style.minHeight;
    targetEl.style.minHeight = targetEl.offsetHeight ? targetEl.offsetHeight + 'px' : '220px';

    const res = await fetch(url, { credentials: 'same-origin' });
    if (!res.ok) throw new Error('Falha ao carregar: ' + res.status);

    const html = await res.text();
    const temp = document.createElement('div');
    temp.innerHTML = html;
    const frag = temp.querySelector('#main-content');
    if (!frag) throw new Error('Fragmento #main-content não encontrado.');

    // injeta novo conteúdo
    targetEl.innerHTML = frag.outerHTML;

    // espera imagens para estabilizar layout
    await waitImages(targetEl);

    // reativa transição e faz scroll com easing
    requestAnimationFrame(() => {
      targetEl.style.minHeight = '';
      targetEl.classList.add('show');
      const offset = 24;
      const y = targetEl.getBoundingClientRect().top + window.scrollY - offset;
      smoothScrollTo(y, 750);
    });
  }

  async function onSearchClick(e) {
    e.preventDefault();
    clearError();
    const termId = select?.value;
    if (!termId) {
      showError('Escolha uma categoria para buscar.');
      return;
    }

    try {
      showLoader(true);
      const res = await fetch('{{ route('ajax.taxonomy.slug') }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
        body: JSON.stringify({ term_id: Number(termId) })
      });

      const slug = await res.text();
      if (!res.ok || !slug || slug === 'error') {
        throw new Error('Erro ao obter a categoria selecionada.');
      }

      const newPath = `/local/${slug}`;
      await loadFragmentInto(newPath, results);
      history.pushState({ fromAjax: true }, '', newPath);
    } catch (err) {
      console.error(err);
      showError(err.message);
    } finally {
      showLoader(false);
    }
  }

  if (btn) btn.addEventListener('click', onSearchClick);

  // Suporte a voltar/avançar
  window.addEventListener('popstate', async () => {
    clearError();
    const path = location.pathname;
    if (/^\/local\/.+/.test(path)) {
      try { showLoader(true); await loadFragmentInto(path, results); }
      catch (e) { showError('Não foi possível restaurar os resultados.'); }
      finally { showLoader(false); }
    } else {
      results.innerHTML = '';
      results.classList.remove('show');
    }
  });
})();
</script>
</body>
</html>
