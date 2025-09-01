<header class="bg-white">
  <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-[100px] items-center">
      <!-- logo -->
      <div class="flex-shrink-0">
        <a href="{{ url('/') }}" class="text-2xl font-bold">
          <img src="{{ asset('images/Logotipo.svg') }}" alt="logo">
        </a>
      </div>

      <!-- desktop nav -->
      <nav class="hidden md:flex space-x-8 menu-content">
        <a href="{{ route('o-que-e') }}">O que é</a>
        <a href="#">Hotéis & Resorts</a>
        <a href="{{ route('beneficios') }}">Benefícios</a>
        <a href="{{ route('parceiros') }}">Parceiros</a>
        <a href="#">FAQ</a>
        <a href="#">Contato</a>
      </nav>

      <!-- desktop actions -->
      <div class="hidden md:flex items-center">
        <a href="#" class="px-6 py-2 bg-[#F46E00] text-white rounded-full hover:brightness-110">Login</a>
        <button class="mx-4 text-center">
          <svg class="w-9 h-9" fill="none" stroke="#A5A5A5" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>

        <!-- mobile trigger -->
        <div class="md:hidden">
        <button id="drawer-open" aria-controls="mobile-drawer" aria-expanded="false"
                class="text-gray-700 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        </div>
    </div>
  </div>

    <!-- OFF-CANVAS (mobile only) -->
    <!-- Drawer mobile (substitui o seu <div id="mobile-menu">) -->
    <div id="mobile-drawer" class="fixed inset-0 z-[100] md:hidden pointer-events-none" aria-hidden="true">
    <!-- backdrop -->
    <div id="drawer-backdrop"
        class="absolute inset-0 bg-black/40 opacity-0 transition-opacity duration-200 ease-out"></div>

    <!-- painel -->
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
        <a href="#" class="w-full inline-flex items-center justify-center px-6 py-3
                            bg-[#F46E00] text-white rounded-full">Login</a>
        </div>
    </aside>
    </div>
</header>
