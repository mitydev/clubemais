<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Clube+ | Beneficios</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  @vite(['resources/css/default.css','resources/css/app.css','resources/js/app.js'])

  <style>
    :root{
      --page-w: 1440px;
      --gutter: clamp(24px, 4vw, 28px);
      --header-h: clamp(64px, 9vh, 100px);

      /* largura efetiva do miolo (limitada ao page-w) */
      --band-w-cap: min(100vw, var(--page-w));

      /* alinhamento do painel com o container central */
      --panel-left-desktop: calc(50vw - (var(--band-w-cap)/2) + var(--gutter));
      --panel-bottom-offset: clamp(24px, 8vh, 77px);
      --panel-pad: clamp(18px, 2.4vw, 36px);
      --panel-top-pad: clamp(40px, 12vh, 160px);
    }

  </style>
</head>

<body class="bg-white">
  @include('components.header')
  <section class="w-full section-beneficios">
      <div class="max-w-[1440px] m-auto bg-center bg-no-repeat h-[1277px]" style="background-image: url('{{asset('images/hero_beneficios.png')}}')">
          <div class="grid grid-cols-2 h-full hero-banner-beneficios">
              <div></div>
              <div class="flex justify-center items-center flex-col">
                  <x-highlight>
                      <h1>+ do que hospedagem.</h1>
                      <h3 style="line-height: 40px">Mais de 100 benefícios para você.</h3>
                  </x-highlight>
                  <div class="w-full mt-10">
                      <p class="font-light text-[40px]">
                          <strong style="font-weight: bold">Ser Clube +</strong> é ter acesso a experiências, serviços e vantagens exclusivas em diversos segmentos, em todo o Brasil.
                      </p>
                  </div>
              </div>
          </div>

      </div>
  </section>
  <section class="bg-[#F4F1EA] pt-4 pb-4 section-beneficios-desc">
      <div class="max-w-[1440px] m-auto pt-[150px] section-content" >
          <div class="w-full">
              <div class="grid grid-cols-5">
                  <div class="col-span-2">
                      <div class="max-w-[360px] m-auto">
                          <h1>Nolren Upsim Lorem</h1>
                          <p>
                              Optaquae perepedi dende officae cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem. Musam aliquo optae que nonecul.
                          </p>
                      </div>
                  </div>
                  <div class="col-span-3 flex justify-center">
                      <div class="section-beneficios-content">
                          <div class="relative">
                              <div class="dot">
                                  <img src="{{asset('images/arrow_outward_white.svg')}}" alt="">
                              </div>
                              <img class="max-w-[343px] m-auto w-full" src="{{asset('images/bg-beneficios1.png')}}" alt="">
                          </div>
                          <div class="px-6 pt-2">
                              <p>Lorem ipusm Lorem ipusm
                              lorem lorem</p>
                          </div>
                      </div>
                      <div class="section-beneficios-content">
                          <div class="relative">
                              <div class="dot">
                                  <img src="{{asset('images/arrow_outward_white.svg')}}" alt="">
                              </div>
                              <img class="max-w-[343px] m-auto w-full" src="{{asset('images/bg-beneficios1.png')}}" alt="">
                          </div>
                          <div class="px-6 pt-2">
                              <p>Lorem ipusm Lorem ipusm
                                  lorem lorem</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="number-contents">
              <div class="box">
                  <div class="box-icon">
                      <img src="{{asset('images/products.svg')}}" alt="">
                  </div>
                  <div class="box-description">
                      <p>
                          <span>2000+</span> <br>
                          Produtos
                      </p>
                  </div>
              </div>
              <div class="box">
                  <div class="box-icon">
                      <img src="{{asset('images/segmentos.svg')}}" alt="">
                  </div>
                  <div class="box-description">
                      <p>
                          <span>7001+</span> <br>
                        Segmentos
                      </p>
                  </div>
              </div>
              <div class="box">
                  <div class="box-icon">
                      <img src="{{asset('images/products.svg')}}" alt="">
                  </div>
                  <div class="box-description">
                      <p>
                          <span>2000+</span> <br>
                          Produtos
                      </p>
                  </div>
              </div>
              <div class="box">
                  <div class="box-icon">
                      <img src="{{asset('images/segmentos.svg')}}" alt="">
                  </div>
                  <div class="box-description">
                      <p>
                          <span>7001+</span> <br>
                          Segmentos
                      </p>
                  </div>
              </div>
          </div>
      </div>
  </section>



  @include('components.footer')
</body>
</html>
