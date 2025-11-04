{{-- resources/views/homeTeste.blade.php --}}
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @php
    /** @var \App\Models\Page|null $page */
    $metaTitle = $page->meta_title ?? 'Clube + Seu clube de benefícios';
    $metaDesc  = $page->meta_description ?? 'Clube+ • Descontos e vantagens em hotéis, viagens e parceiros selecionados.';
  @endphp
  <title>{{ $metaTitle }}</title>
  <meta name="description" content="{{ $metaDesc }}">

  <link rel="icon" type="image/png" href="{{ asset('images/plus.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  @vite(['resources/css/default.css','resources/css/app.css','resources/css/pages/home.css','resources/js/app.js'])

  <style>
    #otabuilder-widget{position:relative;z-index:9999}
    [data-hero-slider] .pointer-events-none{pointer-events:none!important}
  </style>
</head>
<body>
  @include('components.header')

  @php
    $isHome =
         request()->routeIs('home')
      || url()->current() === url('/')
      || request()->getPathInfo() === '/'
      || ($page && trim((string)($page->slug ?? ''), '/') === '');
    $sections = ($page?->sections ?? collect())->sortBy('position')->values();
  @endphp

  @if($sections->isNotEmpty())
    @foreach($sections as $section)
      @includeIf('site.sections.' . $section->type, ['section' => $section, 'isHome' => $isHome])
    @endforeach
  @else
    @includeIf('site.sections.hero_slider',   ['section' => null, 'isHome' => $isHome])
    @includeIf('site.sections.oque_e',        ['section' => null, 'isHome' => $isHome])
    @includeIf('site.sections.destinations',  ['section' => null, 'isHome' => $isHome])
    @includeIf('site.sections.advantages',    ['section' => null, 'isHome' => $isHome])
  @endif

  @include('components.footer')

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>

  <script>
    (function(){
      function loadJS(u, where){
        var s=document.createElement('script');
        s.src=u; s.crossOrigin='anonymous'; s.defer=true; s.async=true;
        where.appendChild(s);
      }
      function initOta(storefrontId, elementId, orientation){
        var K='_OTABUILDER_EMBEDDED_SEARCH_INIT', loaded=false;
        var boot=function(initFn){
          if(loaded) return;
          var el=document.getElementById(elementId);
          if(!el) return;
          loaded=true; initFn(el,{storefrontId:storefrontId,orientation:orientation});
        };
        if(window[K]) boot(window[K]);
        else document.addEventListener('otabuilder-search-ready', function(e){ boot(e.detail.initSearchForm); }, { once:true });
      }
      document.addEventListener('DOMContentLoaded', function(){
        initOta('DMfMlkDfi5acPpHsWT4r3','otabuilder-widget','HORIZONTAL');
        loadJS('https://app.otabuilder.com/static/js/widget.js', document.body);
      });
    })();
  </script>

  @stack('page-scripts')
</body>
</html>
