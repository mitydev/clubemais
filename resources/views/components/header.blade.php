<header class="bg-white">
    <!--  -->
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-[100px] items-center">

            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo-600">
                    <img src="{{ asset('images/Logotipo.svg') }}" alt="logo">
                </a>
            </div>

            <nav class="hidden md:flex space-x-8 menu-content">
                <a href="#">O que é</a>
                <a href="#">Hotéis & Resorts</a>
                <a href="{{ route('beneficios') }}">Benefícios</a>
                <a href="#">Parceiros</a>
                <a href="#">FAQ</a>
                <a href="#">Contato</a>
            </nav>

            <div class="hidden md:flex">
                <a href="#" class="px-6 py-2 bg-[#F46E00] text-white rounded-full hover:bg-indigo-700">
                    Login
                </a>
                <button class="mx-4 text-center">
                    <svg class="w-9 h-9" fill="none" stroke="#A5A5A5" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <div class="md:hidden">
                <button id="menu-btn" class="text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden px-4 pt-2 pb-3 space-y-1 bg-gray-50">
        <a href="#" class="block text-gray-700 hover:text-indigo-600">Início</a>
        <a href="#" class="block text-gray-700 hover:text-indigo-600">Sobre</a>
        <a href="#" class="block text-gray-700 hover:text-indigo-600">Serviços</a>
        <a href="#" class="block text-gray-700 hover:text-indigo-600">Contato</a>
        <a href="#" class="block px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
            Login
        </a>
    </div>
</header>
