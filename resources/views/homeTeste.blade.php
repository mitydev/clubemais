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
  <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  @vite(['resources/css/default.css','resources/css/app.css','resources/css/pages/home.css','resources/js/app.js'])

  <style>
    #otabuilder-widget{ position:relative; z-index:9999; }
    [data-hero-slider] .pointer-events-none{ pointer-events:none !important; }
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
      var STORE_ID = 'DMfMlkDfi5acPpHsWT4r3';
      var ELEM_ID  = 'otabuilder-widget';
      var ORIENT   = 'HORIZONTAL';
      var KEY      = '_OTABUILDER_EMBEDDED_SEARCH_INIT';
      var started  = false;

      function log(){ try{ console.log.apply(console, ['[OTA]'].concat([].slice.call(arguments))); }catch(e){} }
      function err(){ try{ console.error.apply(console, ['[OTA]'].concat([].slice.call(arguments))); }catch(e){} }

      function loadJS(url){
        return new Promise(function(resolve, reject){
          var s = document.createElement('script');
          s.src = url;
          s.crossOrigin = 'anonymous';
          s.defer = true;
          s.async = true;
          s.onload  = function(){ log('widget.js carregado'); resolve(); };
          s.onerror = function(){ err('ERRO ao carregar widget.js'); reject(new Error('load error')); };
          document.body.appendChild(s);
        });
      }

      function tryBoot(initFn){
        if (started) return;
        var el = document.getElementById(ELEM_ID);
        if (!el){ log('sem container ainda'); return; }
        try{
          initFn(el, { storefrontId: STORE_ID, orientation: ORIENT });
          started = true;
          log('init chamado com sucesso');
        }catch(e){ err('falha no init', e); }
      }

      // 1) Registrar listener ANTES de carregar o script
      document.addEventListener('otabuilder-search-ready', function(e){
        log('evento otabuilder-search-ready recebido');
        tryBoot(e.detail.initSearchForm);
      });

      // 2) Fallback: polling por 10s caso o evento tenha disparado cedo/demorado
      var tries = 0, timer = setInterval(function(){
        tries++;
        if (window[KEY]){ log('found global init via polling'); tryBoot(window[KEY]); clearInterval(timer); }
        if (tries > 100){ clearInterval(timer); }
      }, 100);

      // 3) Injetar o script
      function start(){
        // pequeno atraso garante que o container esteja no DOM
        setTimeout(function(){
          if (window[KEY]){ log('global init já presente (pré-carregado)'); tryBoot(window[KEY]); }
          loadJS('https://app.otabuilder.com/static/js/widget.js').catch(function(){});
        }, 0);
      }

      if (document.readyState === 'loading'){
        document.addEventListener('DOMContentLoaded', start, { once:true });
      }else{
        start();
      }
    })();
  </script>


  @stack('page-scripts')
</body>
</html>
