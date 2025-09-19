<header class="bg-white">
  <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-[80px] md:h-[90px] lg:h-[100px]">

      <!-- logo -->
      <div class="flex-shrink-0">
        <a href="{{ url('/') }}" aria-label="Clube+">
          <img src="{{ asset('images/Logotipo.svg') }}" alt="Clube+">
        </a>
      </div>

      <!-- NAV DESKTOP (só >= 1024px) -->
      <nav class="hidden lg:flex items-center gap-6 xl:gap-8 2xl:gap-10 menu-content text-[15px] xl:text-base whitespace-nowrap">
        <a href="{{ route('o-que-e') }}" class="hover:text-black/80">O que é</a>
        <a href="#" class="hover:text-black/80">Hotéis & Resorts</a>
        <a href="{{ route('beneficios') }}" class="hover:text-black/80">Benefícios</a>
        <a href="{{ route('parceiros') }}" class="hover:text-black/80">Parceiros</a>
        <a href="#" class="hover:text-black/80">FAQ</a>
        <a href="#" class="hover:text-black/80">Contato</a>
      </nav>

      <!-- AÇÕES DESKTOP (só >= 1024px) -->
      <div class="hidden lg:flex items-center gap-4">
        <a href="#" class="px-5 py-2 bg-[#F46E00] text-white rounded-full hover:brightness-110">
          Login
        </a>
        <!-- o “menu” de três linhas no desktop causava ruído; esconda-o -->
        <!-- <button class="hidden xl:block">…</button> -->
      </div>

      <!-- TRIGGER MOBILE/TABLET (até <1024px) -->
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

  <!-- OFF-CANVAS (mobile/tablet) -->
  <div id="mobile-drawer" class="fixed inset-0 z-[100] lg:hidden pointer-events-none" aria-hidden="true">
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
        <a href="/" class="block">Home</a>
        <a href="{{ route('o-que-e') }}" class="block">O que é</a>
        <a href="#" class="block">Hotéis & Resorts</a>
        <a href="{{ route('beneficios') }}" class="block">Benefícios</a>
        <a href="{{ route('parceiros') }}" class="block">Parceiros</a>
        <a href="#" class="block">FAQ</a>
        <a href="#" class="block">Contato</a>
      </nav>

      <div class="mt-auto p-4 border-t">
        <a href="#" class="w-full inline-flex items-center justify-center px-6 py-3 bg-[#F46E00] text-white rounded-full">
          Login
        </a>
      </div>
    </aside>
  </div>
</header>