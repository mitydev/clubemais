<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clube + Seu clube de benefícios</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    @vite(['resources/css/default.css','resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header class="bg-white">
    <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-[100px] items-center">

            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo-600">
                    <img src="{{asset('images/Logotipo.svg')}}" alt="logo">
                </a>
            </div>

            <!-- Navegação -->
            <nav class="hidden md:flex space-x-8 menu-content">
                <a href="#">O que é</a>
                <a href="#">Hotéis & Resorts</a>
                <a href="#">Benefícios</a>
                <a href="#">Parceiros</a>
                <a href="#">FAQ</a>
                <a href="#">Contato</a>
            </nav>

            <!-- Botão de ação -->
            <div class="hidden md:flex">
                <a href="#"
                   class="px-6 py-2 bg-[#F46E00] text-white rounded-full hover:bg-indigo-700">
                    Login
                </a>
                <button class="mx-4 text-center">
                    <svg class="w-9 h-9" fill="none" stroke="#A5A5A5" stroke-width="3"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- Menu Mobile -->
            <div class="md:hidden">
                <button id="menu-btn" class="text-gray-700 focus:outline-none">
                    <!-- Ícone hamburger -->
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu Mobile Dropdown -->
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
<section class="bg-white">
    <div class="max-w-[1920px] pt-[10rem] bg-center bg-cover min-h-[clamp(674px,calc(100vh-100px),1080px)] mx-auto bg-no-repeat flex justify-center items-center"
         style="background-image: url('{{asset('images/image_banner.png')}}')">
        <div class="max-w-[1204px] w-full w-100">
            <h1 class="text-[48px] text-white leading-[55px] my-6 mb-[80px]" style="font-weight: 300">
                Um Clube <br> <strong>pensado</strong> <br>em você!
            </h1>
            <div class="w-full bg-white rounded-3xl p-2 h-min-[129px]">
                <div class="grid grid-cols-[1fr_1fr_1fr_1fr_100px] gap-1 h-full items-center">
                    <div class="p-5">
                        <p class="my-2 text-[#F46E00] font-bold">Localização</p>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <img src="{{asset('images/location.svg')}}" alt="location">
                              </span>
                            <input
                                type="text"
                                placeholder="Pesquise por Hotel/Cidade"
                                class="w-full pl-10 pr-4 text-[#A5A5A5] placeholder-[#A5A5A5] h-12 rounded-full border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            >
                        </div>
                    </div>
                    <div class="p-5">
                        <p class="my-2 text-[#F46E00] font-bold">Check-in</p>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <img src="{{asset('images/calendar.svg')}}" alt="location">
                              </span>
                            <input
                                type="date"
                                class="w-full pl-10 pr-4 text-[#A5A5A5] placeholder-[#A5A5A5] h-12 rounded-full border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            >
                        </div>
                    </div>
                    <div class="p-5">
                        <p class="my-2 text-[#F46E00] font-bold">Check-out</p>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <img src="{{asset('images/calendar.svg')}}" alt="location">
                              </span>
                            <input
                                type="date"
                                class="w-full pl-10 pr-4 text-[#A5A5A5] placeholder-[#A5A5A5] h-12 rounded-full border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            >
                        </div>
                    </div>
                    <div class="p-5">
                        <p class="my-2 text-[#F46E00] font-bold">Hóspedes</p>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                <img src="{{asset('images/users.svg')}}" alt="icone de usuários">
                              </span>
                            <select
                                class="w-full pl-10 pr-4 text-[#A5A5A5] placeholder-[#A5A5A5] h-12 rounded-full border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                name="" id="">
                                <option>1 hóspede</option>
                                <option>2 hóspedes</option>
                                <option>3 hóspedes</option>
                            </select>
                        </div>
                    </div>
                    <div class="h-[89px] flex justify-start items-end">
                        <a href="">
                            <img src="{{asset('images/button-select.svg')}}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="max-w-[1920px] pt-10 bg-center bg-cover bg-[#F4F1EA] min-h-[clamp(777px,100vh,1080px)] mx-auto bg-no-repeat "
         style="background-image: url('{{asset('images/banner-oq-é 1.png')}}');">
        <div class="ml-12 relative bg-contain bg-center bg-no-repeat w-[500px] h-[500px] " style="background-image: url('{{asset('images/Subtract.svg')}}')">
            <div class="absolute top-5 right-0">
                <svg width="72" height="83" viewBox="0 0 72 83" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M-9.47676e-07 59.2768C-4.24224e-07 72.1619 9.72216 82.6044 21.7099 82.6044L71.7645 82.6044C71.7494 82.2034 71.708 81.8064 71.708 81.4013L71.708 8.05507e-05L-3.35578e-06 8.39233e-05L-9.47676e-07 59.2768ZM38.5343 17.0491C40.9281 17.0491 42.8732 19.1393 42.8732 21.7195L42.8732 33.7944L54.1184 33.7944C56.5121 33.7944 58.4573 35.8926 58.4573 38.4648L58.4573 44.1478C58.4573 46.728 56.5121 48.8181 54.1184 48.8181L42.8732 48.8181L42.8732 60.893C42.8732 63.4733 40.9281 65.5634 38.5343 65.5634L33.2378 65.5634C30.844 65.5634 28.8913 63.4733 28.8913 60.893L28.8913 48.8181L17.6537 48.8181C15.2599 48.8181 13.3072 46.728 13.3072 44.1478L13.3072 38.4648C13.3072 35.8926 15.2599 33.7944 17.6537 33.7944L28.8913 33.7944L28.8913 21.7195C28.8913 19.1393 30.844 17.0491 33.2378 17.0491L38.5343 17.0491Z" fill="white"/>
                </svg>
            </div>
            <div class="pt-[clamp(10px,3.472vw,50px)] pl-[clamp(10px,2.083vw,30px)]">
                <h1 class="text-[clamp(30px,3.264vw,47px)] font-bold text-white leading-[55px] p-5">O que é o <br> Clube +</h1>
                <p class="text-[clamp(10px,1.389vw,20px)] p-5 pt-0 max-w-[296px] text-white">
                    Descontos exclusivos, experiências únicas e benefícios especiais em hospedagens e roteiros. <a class="text-[#3FD0FC]"
                        href=""> Viaje mais,
                    aproveite melhor</a>.
                </p>
            </div>
        </div>
        <div class="max-w-[1280px] mt-[50px] m-auto">
            <div class="w-[604px] ml-5">
                <h2 class="text-[40px] leading-[40px] font-bold">Sua próxima viagem começa com vantagens!</h2>
                <p class="font-light opacity-[49%] mt-2">Optaquae perepedi dende officae cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem. Musam aliquo optae que nonecul.</p>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="max-w-[1920px] bg-[#E1E1E1] pt-10 bg-center bg-cover min-h-[clamp(777px,100vh,1080px)] mx-auto">
        <div class="max-w-[1280px] m-auto">
            <div>
                <h2 class="text-[#F46E00] text-[54px] max-w-[621px] ml-5">Seu próximo destino com desconto</h2>
            </div>
            <div class="destination-content flex justify-between">
                <div class="destination-block active bg-center bg-cover bg-no-repeat"  style="background-image: url('{{asset("images/wanderlust.png")}}')">
                    <div class="destination-description">
                        <h3 class="destination-text-title">Wanderlust Experience Hotel</h3>
                        <p class="destination-text-description">
                            Lorem ipsum lorem nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem.
                        </p>
                        <div class="destination-button">
                            <button>Veja o Hotel</button>
                        </div>
                    </div>

                </div>
                <div class="destination-block bg-center bg-cover bg-no-repeat"  style="background-image: url('{{asset("images/bravamundo.png")}}')">
                    <div class="destination-description" >
                        <h3 class="destination-text-title">Brava Mundo</h3>
                        <p class="destination-text-description">
                            Lorem Ipsum lorem ipsum
                            lorem.
                        </p>
                        <div class="destination-button">
                            <button>Veja o Hotel</button>
                        </div>
                    </div>

                </div>
                <div class="destination-block bg-center bg-cover bg-no-repeat"  style="background-image: url('{{asset("images/poehma.png")}}')">
                    <div class="destination-description">
                        <h3 class="destination-text-title">Poehma</h3>
                        <p class="destination-text-description">
                            Lorem Ipsum lorem ipsum
                            lorem.
                        </p>
                        <div class="destination-button">
                            <button>Veja o Hotel</button>
                        </div>
                    </div>
                </div>
                <div class="destination-block bg-center bg-cover bg-no-repeat"  style="background-image: url('{{asset("images/poehma.png")}}')">
                    <div class="destination-description">
                        <h3 class="destination-text-title">Vivant Eco Beach</h3>
                        <p class="destination-text-description">
                            Lorem Ipsum lorem ipsum
                            lorem.
                        </p>
                        <div class="destination-button">
                            <button>Veja o Hotel</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<section class="bg-[#F46E00]">
    <div class="w-full">
        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <div class="swiper-slide">
                    <div class="w-full flex justify-center">
                        <img src="{{asset('images/logoipsum.png')}}" class="m-auto" alt="logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="w-full flex justify-center">
                        <img src="{{asset('images/loqo.png')}}" class="m-auto" alt="logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="w-full flex justify-center">
                        <img src="{{asset('images/logoipsum.png')}}" class="m-auto" alt="logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="w-full flex justify-center">
                        <img src="{{asset('images/logoipsum.png')}}" class="m-auto" alt="logo">
                    </div>

                </div>
                <div class="swiper-slide">
                    <div class="w-full flex justify-center">
                        <img src="{{asset('images/logoipsum.png')}}" class="m-auto" alt="logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="w-full flex justify-center">
                        <img src="{{asset('images/logoipsum.png')}}" class="m-auto" alt="logo">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="max-w-[1440px] m-auto beneficios">
        <div class="w-full grid grid-cols-2">
            <div class="conheca">
                <h1>Conheça alguns benefícios
                    de quem é Clube +</h1>
            </div>
            <div class="">
                <p class="text-[#fff] font-[16px]">
                    Lorem ipsum lorem nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem.
                </p>
            </div>
        </div>
    </div>
</section>

<footer class="bg-[#EA6A0A] text-white">
    <div class="max-w-[1440px] mx-auto px-6 lg:px-[50px] py-12 lg:py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <div class="lg:col-span-5 space-y-6">
                <div>
                    <img src="{{asset('images/Logotipov2.svg')}}" alt="">
                </div>

                <p class="max-w-md leading-relaxed text-white/90">
                    Lorem ipsum lorem ipsums lorem Lorem ipsum lorem ipsums lorem Lorem ipsum lorem ipsums lorem
                </p>

                <div class="grid grid-cols-[auto_1fr] gap-x-6 gap-y-2 text-sm text-white/90">
                    <span class="opacity-80">End</span>  <span>Nonoonoonono<br>nononono<br>nononono</span>
                    <span class="opacity-80">Email</span><span>contato@clube.com</span>
                    <span class="opacity-80">Tel</span>  <span>(11) 99999-9999</span>
                </div>

                <ul class="flex items-center gap-3 pt-2">
                    @php
                        $btn = 'w-10 h-10 grid place-items-center rounded-full bg-white/20 hover:bg-white/30 transition';
                    @endphp

                    <li><a class="{{ $btn }}" href="#" aria-label="X/Twitter">
                            <img src="{{asset('images/x.svg')}}" alt="">
                        </a></li>

                    <li><a class="{{ $btn }}" href="#" aria-label="Instagram">
                            <img src="{{asset('images/x.svg')}}" alt="">

                        </a></li>

                    <li><a class="{{ $btn }}" href="#" aria-label="Facebook">
                            <img src="{{asset('images/x.svg')}}" alt="">

                        </a></li>

                    <li><a class="{{ $btn }}" href="#" aria-label="YouTube">
                            <img src="{{asset('images/x.svg')}}" alt="">

                        </a></li>

                    <li><a class="{{ $btn }}" href="#" aria-label="TikTok">
                            <img src="{{asset('images/x.svg')}}" alt="">
                        </a></li>
                </ul>
            </div>

            {{-- Coluna 2 – Links rápidos --}}
            <div class="lg:col-span-3 pt-4">
                <h4 class="text-2xl font-semibold mb-4">Links Rápidos</h4>
                <ul class="space-y-3 text-white/90">
                    <li><a class="hover:underline" href="#">O que é o Clube +</a></li>
                    <li><a class="hover:underline" href="#">Hotéis & Resorts</a></li>
                    <li><a class="hover:underline" href="#">Benefícios</a></li>
                    <li><a class="hover:underline" href="#">Parceiros</a></li>
                    <li><a class="hover:underline" href="#">FAQs</a></li>
                    <li><a class="hover:underline" href="#">Contato</a></li>
                    <li><a class="hover:underline" href="#">Login e Cadastro</a></li>
                </ul>
            </div>

            {{-- Coluna 3 – Card de cadastro --}}
            <div class="lg:col-span-4">
                <div class="rounded-[16px] ring-1 ring-white/60 p-6 md:p-8">
                    <h4 class="text-2xl font-semibold">Cadastre-se Agora!</h4>
                    <p class="mt-2 text-sm text-white/90">
                        Optaquae perepedi dende officia cabore… texto de exemplo para o call-to-action.
                    </p>

                    <form class="mt-6 flex flex-col sm:flex-row gap-3">
                        <input type="email" placeholder="Seu email"
                               class="min-w-0 flex-1 h-11 bg-transparent border-0 border-b border-white/50
                          placeholder-white/70 focus:border-white focus:ring-0">
                        <button type="submit"
                                class="h-11 px-6 rounded-full border border-white text-white
                           hover:bg-white/10 transition">
                            Cadastre-se
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-10 pt-6 text-center font-light text-sm text-white">
            Clube + © {{date('Y')}}. Todos os direitos reservados.
        </div>
    </div>

</footer>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script type="application/javascript">
    const blocks = document.querySelectorAll('.destination-block');
    blocks.forEach(block => {
        block.addEventListener('mouseenter', () => {
            blocks.forEach(b => b.classList.remove('active'));
            block.classList.add('active');
        });
    });
    const swiper = new Swiper('.swiper', {
        // Optional parameters
        slidesPerView: '5',
        loop: true,
        speed: 3000,
        grabCursor: true,
        spaceBetween: 16,
        freeMode: true,
        autoplay: {
            delay: 0,           // muda a cada 3s
            disableOnInteraction: false, // continua mesmo se clicar
        },
    });
</script>
</body>
</html>
