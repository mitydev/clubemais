<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clube + Seu clube de benefícios</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @vite(['resources/css/default.css','resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('components.header')

    <section class="bg-white">
        <div class="max-w-[1920px] pt-[10rem] bg-center bg-cover min-h-[clamp(674px,calc(100vh-100px),1080px)] mx-auto bg-no-repeat flex justify-center items-center"
             style="background-image: url('{{ asset('images/image_banner.png') }}')">
            <div class="max-w-[1204px] w-full">
                <h1 class="text-[48px] text-white leading-[55px] my-6 mb-[80px]" style="font-weight: 300">
                    Um Clube <br> <strong>pensado</strong> <br>em você!
                </h1>
                <div class="w-full bg-white rounded-3xl p-2 h-min-[129px]">
                    <div class="grid grid-cols-[1fr_1fr_1fr_1fr_100px] gap-1 h-full items-center">
                        <div class="p-5">
                            <p class="my-2 text-[#F46E00] font-bold">Localização</p>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                    <img src="{{ asset('images/location.svg') }}" alt="location">
                                </span>
                                <input type="text" placeholder="Pesquise por Hotel/Cidade"
                                       class="w-full pl-10 pr-4 text-[#A5A5A5] placeholder-[#A5A5A5] h-12 rounded-full border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>
                        <div class="p-5">
                            <p class="my-2 text-[#F46E00] font-bold">Check-in</p>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                    <img src="{{ asset('images/calendar.svg') }}" alt="location">
                                </span>
                                <input type="date"
                                       class="w-full pl-10 pr-4 text-[#A5A5A5] placeholder-[#A5A5A5] h-12 rounded-full border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>
                        <div class="p-5">
                            <p class="my-2 text-[#F46E00] font-bold">Check-out</p>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                    <img src="{{ asset('images/calendar.svg') }}" alt="location">
                                </span>
                                <input type="date"
                                       class="w-full pl-10 pr-4 text-[#A5A5A5] placeholder-[#A5A5A5] h-12 rounded-full border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>
                        <div class="p-5">
                            <p class="my-2 text-[#F46E00] font-bold">Hóspedes</p>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                                    <img src="{{ asset('images/users.svg') }}" alt="icone de usuários">
                                </span>
                                <select class="w-full pl-10 pr-4 text-[#A5A5A5] placeholder-[#A5A5A5] h-12 rounded-full border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option>1 hóspede</option>
                                    <option>2 hóspedes</option>
                                    <option>3 hóspedes</option>
                                </select>
                            </div>
                        </div>
                        <div class="h-[89px] flex justify-start items-end">
                            <a href="">
                                <img src="{{ asset('images/button-select.svg') }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="max-w-[1920px] pt-10 bg-center bg-cover bg-[#F4F1EA] min-h-[clamp(777px,100vh,1080px)] mx-auto bg-no-repeat"
             style="background-image: url('{{ asset('images/banner-oq-é 1.png') }}');">
            <div class="ml-12 relative bg-contain bg-center bg-no-repeat w-[500px] h-[500px]" style="background-image: url('{{ asset('images/Subtract.svg') }}')">
                <div class="absolute top-5 right-0">
                    <svg width="72" height="83" viewBox="0 0 72 83" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M-9.47676e-07 59.2768C-4.24224e-07 72.1619 9.72216 82.6044 21.7099 82.6044L71.7645 82.6044C71.7494 82.2034 71.708 81.8064 71.708 81.4013L71.708 8.05507e-05L-3.35578e-06 8.39233e-05L-9.47676e-07 59.2768ZM38.5343 17.0491C40.9281 17.0491 42.8732 19.1393 42.8732 21.7195L42.8732 33.7944L54.1184 33.7944C56.5121 33.7944 58.4573 35.8926 58.4573 38.4648L58.4573 44.1478C58.4573 46.728 56.5121 48.8181 54.1184 48.8181L42.8732 48.8181L42.8732 60.893C42.8732 63.4733 40.9281 65.5634 38.5343 65.5634L33.2378 65.5634C30.844 65.5634 28.8913 63.4733 28.8913 60.893L28.8913 48.8181L17.6537 48.8181C15.2599 48.8181 13.3072 46.728 13.3072 44.1478L13.3072 38.4648C13.3072 35.8926 15.2599 33.7944 17.6537 33.7944L28.8913 33.7944L28.8913 21.7195C28.8913 19.1393 30.844 17.0491 33.2378 17.0491L38.5343 17.0491Z" fill="white"/>
                    </svg>
                </div>
                <div class="pt-[clamp(10px,3.472vw,50px)] pl-[clamp(10px,2.083vw,30px)]">
                    <h1 class="text-[clamp(30px,3.264vw,47px)] font-bold text-white leading-[55px] p-5">O que é o <br> Clube +</h1>
                    <p class="text-[clamp(10px,1.389vw,20px)] p-5 pt-0 max-w-[296px] text-white">
                        Descontos exclusivos, experiências únicas e benefícios especiais em hospedagens e roteiros.
                        <a class="text-[#3FD0FC]" href="">Viaje mais, aproveite melhor</a>.
                    </p>
                </div>
            </div>
            <div class="max-w-[1280px] mt-[50px] m-auto">
                <div class="w-[604px] ml-5">
                    <h2 class="text-[40px] leading-[40px] font-bold">Sua próxima viagem começa com vantagens!</h2>
                    <p class="font-light opacity-[49%] mt-2">
                        Optaquae perepedi dende officae cabore, niandi opti ut lam de cumque nimo ommolum qui auda
                        sundi num quisque proresequis modic to berrovidem. Musam aliquo optae que nonecul.
                    </p>
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
                    <div class="destination-block active bg-center bg-cover bg-no-repeat"
                         style="background-image: url('{{ asset("images/wanderlust.png") }}')">
                        <div class="destination-description">
                            <h3 class="destination-text-title">Wanderlust Experience Hotel</h3>
                            <p class="destination-text-description">
                                Lorem ipsum lorem nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem.
                            </p>
                            <div class="destination-button"></div>
                        </div>
                    </div>

                    <div class="destination-block bg-center bg-cover bg-no-repeat"
                         style="background-image: url('{{ asset("images/bravamundo.png") }}')">
                        <div class="destination-description">
                            <h3 class="destination-text-title">Brava Mundo</h3>
                            <p class="destination-text-description">
                                Lorem ipsum lorem nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem.
                            </p>
                            <div class="destination-button"></div>
                        </div>
                    </div>

                    <div class="destination-block bg-center bg-cover bg-no-repeat"
                         style="background-image: url('{{ asset("images/poehma.png") }}')">
                        <div class="destination-description">
                            <h3 class="destination-text-title">Poehma</h3>
                            <p class="destination-text-description">
                                Lorem ipsum lorem nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem.
                            </p>
                            <div class="destination-button"></div>
                        </div>
                    </div>

                    <div class="destination-block bg-center bg-cover bg-no-repeat"
                         style="background-image: url('{{ asset("images/poehma.png") }}')">
                        <div class="destination-description">
                            <h3 class="destination-text-title">Vivant Eco Beach</h3>
                            <p class="destination-text-description">
                                Lorem ipsum lorem nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem.
                            </p>
                            <div class="destination-button">
                                <button class=""></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.footer')

</body>
</html>
