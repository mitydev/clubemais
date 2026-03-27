@php
  $cfg = site_setting('navbar') ?? [];

  $toUrl = function (?string $path) {
      if (!$path) return null;
      if (preg_match('#^(https?:)?//#', $path)) {
          return $path;
      }
      return asset($path);
  };

  $logoPath = data_get($cfg, 'logo_path');
  $logoUrl  = $toUrl($logoPath) ?? asset('images/novo_logo_320x100_tight.svg');

  $menu = collect(data_get($cfg, 'menu', []))
      ->filter(fn($r) => !empty($r['label']) && !empty($r['href']))
      ->values();

  // 🔹 Verifica se já existe um item que aponte para a home
  $hasHomeInMenu = $menu->contains(function ($item) {
      $href = $item['href'] ?? '';
      return $href === '/' || $href === url('/');
  });
@endphp

<header class="bg-white">
  <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-[80px] md:h-[90px] lg:h-[100px]">

      {{-- logo --}}
      <div class="flex-shrink-0">
        <a href="{{ url('/') }}" aria-label="Clube+">
          <img src="{{ $logoUrl }}" class="h-9 md:h-11 lg:h-12 w-auto" alt="Clube+">
        </a>
      </div>

      {{-- NAV DESKTOP --}}
      <nav class="hidden lg:flex items-center gap-6 xl:gap-8 2xl:gap-10 menu-content text-[15px] xl:text-base whitespace-nowrap">
        @foreach($menu as $item)
          @php
            $href = $item['href'];
            $isExternal = !empty($item['is_external']);
          @endphp
          <a href="{{ $href }}"
             @if($isExternal) target="_blank" rel="noopener" @endif
             class="hover:text-black/80">
            {{ $item['label'] }}
          </a>
        @endforeach
      </nav>

      {{-- AÇÕES DESKTOP (mantive a lógica de login/logout igual) --}}
      <div class="hidden lg:flex items-center gap-4">
        @if(auth()->check())
          <form action="{{ route('logout.sso') }}" method="POST">
            @csrf
            <button type="submit"
                    class="px-5 py-2 bg-red-600 text-white rounded-full hover:brightness-110">
              Sair
            </button>
          </form>
        @else
          <a href="{{ route('login.sso') }}"
             class="px-5 py-2 bg-[#F46E00] text-white rounded-full hover:brightness-110">
            Login
          </a>
        @endif
      </div>

      {{-- TRIGGER MOBILE --}}
      <div class="lg:hidden">
        <button id="drawer-open" aria-controls="mobile-drawer" aria-expanded="false"
                class="p-2 rounded-md text-gray-700 hover:bg-black/5 focus:outline-none">
          <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>

    </div>
  </div>

  {{-- OFF-CANVAS MOBILE --}}
  <div id="mobile-drawer" class="fixed inset-0 z-[99999] lg:hidden pointer-events-none" aria-hidden="true">
    <div id="drawer-backdrop" class="absolute inset-0 bg-black/40 opacity-0 transition-opacity duration-200 ease-out"></div>

    <aside id="drawer-panel" tabindex="-1"
           class="absolute right-0 top-0 h-full w-[86vw] max-w-[420px] translate-x-full
                  bg-white shadow-2xl transition-transform duration-200 ease-out focus:outline-none z-10">
      <div class="flex items-center justify-between p-5 border-b">
        <h3 class="text-lg font-semibold">Menu</h3>
        <button id="drawer-close" aria-label="Fechar" class="p-2 rounded-md hover:bg-black/5">
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>

      <nav class="p-4 space-y-5 text-lg">
        {{-- Home fixa só se NÃO existir no menu configurado --}}
        @unless($hasHomeInMenu)
          <a href="{{ url('/') }}" class="block">Home</a>
        @endunless

        @foreach($menu as $item)
          @php
            $href = $item['href'];
            $isExternal = !empty($item['is_external']);
          @endphp
          <a href="{{ $href }}"
            @if($isExternal) target="_blank" rel="noopener" @endif
            class="block">
            {{ $item['label'] }}
          </a>
        @endforeach
      </nav>

      <div class="mt-auto p-4 border-t">
        @if(auth()->check())
          <form action="{{ route('logout.sso') }}" method="POST">
            @csrf
            <button type="submit"
                    class="w-full inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white rounded-full">
              Sair
            </button>
          </form>
        @else
          <a href="{{ route('login.sso') }}"
             class="w-full inline-flex items-center justify-center px-6 py-3 bg-[#F46E00] text-white rounded-full">
            Login
          </a>
        @endif
      </div>
    </aside>
  </div>
</header>
