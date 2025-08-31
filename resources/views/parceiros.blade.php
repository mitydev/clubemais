<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Clube+ | Parceiros</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  @vite(['resources/css/default.css','resources/css/app.css','resources/css/pages/parceiros.css', 'resources/js/app.js'])

  <style>

  </style>
</head>

<body class="bg-white">
  @include('components.header')

  <!-- ==================== HERO PARCEIROS ==================== -->
    @php
        $heroPath = 'images/parceiros/parceiroprincipal.png'; // use o que vc salvou
        $heroUrl  = asset($heroPath) . '?v=' . filemtime(public_path($heroPath));
    @endphp
    <section section class="parc-hero" style="--hero: url('{{ $heroUrl }}')">
        <!-- Foto SEM corte -->
        <img class="parc-hero__photo" src="{{ $heroUrl }}" alt="Parceiros - Clube+">

        <!-- Título -->
        <div class="parc-hero__heading">
        <h1>Lista de<br>benefícios</h1>
        </div>

        <!-- Painel de filtro -->
        <div class="parc-hero__panel">
        <h3>Lorem ipsum</h3>
        <p class="desc">Lorem lorem lorem relson lorem — um texto curto explicando o filtro.</p>
        <hr class="parc-hero__hr">

        <form class="parc-form" action="#" method="get">
            <!-- Campo 1: FILLED (branco) -->
            <label class="field field--filled">
            <span class="field__icon field__icon--circle" aria-hidden="true">
                <!-- ícone bússola branco -->
                <svg width="18" height="18" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2a10 10 0 1 0 .001 20.001A10 10 0 0 0 12 2zm3.53 6.47-2.12 5.3a1 1 0 0 1-.58.58l-5.3 2.12a.5.5 0 0 1-.65-.65l2.12-5.3a1 1 0 0 1 .58-.58l5.3-2.12a.5.5 0 0 1 .65.65z"/>
                </svg>
            </span>
            <input type="text" name="q" placeholder="Lorem Ipsum">
            </label>

            <!-- Campo 2: OUTLINE (select) -->
            <label class="field field--outline field--select">
            <span class="field__icon" aria-hidden="true">
                <!-- ícone calendário laranja -->
                <svg width="20" height="20" viewBox="0 0 24 24" fill="#F46E00" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 2h2v2h6V2h2v2h3a1 1 0 0 1 1 1v3H3V5a1 1 0 0 1 1-1h3V2zm14 8v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-9h18z"/>
                </svg>
            </span>
            <select name="categoria" aria-label="Categoria" required>
                <option value="" hidden selected>Lorem Ipsum</option>
                <option>Opção A</option>
                <option>Opção B</option>
            </select>
            </label>

            <!-- Campo 3: OUTLINE (select) -->
            <label class="field field--outline field--select">
            <span class="field__icon" aria-hidden="true">
                <!-- ícone localização laranja -->
                <svg width="20" height="20" viewBox="0 0 24 24" fill="#F46E00" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7zm0 9.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5z"/>
                </svg>
            </span>
            <select name="sub" aria-label="Subcategoria" required>
                <option value="" hidden selected>Lorem Ipsum</option>
                <option>Opção 1</option>
                <option>Opção 2</option>
            </select>
            </label>

            <button class="parc-btn" type="submit">Busca</button>
        </form>
        </div>

        <div class="parc-hero__icons" aria-hidden="true"></div>
    </section>

    <!-- =============== REGRAS DE USO =============== -->
    @php
        $rulesBgPath = 'images/parceiros/bg.png';
        $rulesBgAbs  = public_path($rulesBgPath);
        $rulesBgUrl  = asset($rulesBgPath) . (file_exists($rulesBgAbs) ? '?v='.filemtime($rulesBgAbs) : '');
    @endphp
    <section class="rules">
        <div class="section-inner rules__grid">
            <!-- Coluna esquerda -->
            <div class="rules__copy">
            <h2>Regras de Uso</h2>
            <p>Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum qui auda
                sundi num quisque proresequís modic to berrovdiem. Musam aliquo optae que nonecul.</p>
            <p>Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum qui auda
                sundi num quisque proresequís modic to berrovdiem. Musam aliquo optae que nonecul.</p>
            <p>Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum qui auda
                sundi num quisque proresequís modic to berrovdiem. Musam aliquo optae que nonecul.</p>
            </div>

            <!-- Coluna direita com a imagem do balão -->
            <aside class="rules__frame">
            <img class="rules__img" src="{{ $rulesBgUrl }}" alt="" aria-hidden="true">

            <!-- pill -->
            <span class="rules__pill">Lorem Ipsum Lorem</span>

            <!-- conteúdo dentro do balão -->
            <div class="rules__slot">
                <p>Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum
                qui auda sundi num quisque proresequís modic to berrovdiem. Musam aliquo optae que nonecul.</p>
                <p>Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum
                qui auda sundi num quisque proresequís modic to berrovdiem. Musam aliquo optae que nonecul.</p>
            </div>

            <!-- botão -->
            <button class="rules__cta" aria-label="Próxima regra">
                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M12 16a1 1 0 0 1-.71-.29l-6-6 1.42-1.42L12 13.59l5.29-5.3 1.42 1.42-6 6A1 1 0 0 1 12 16z"/>
                </svg>
            </button>
            </aside>
        </div>
    </section>

    <!-- =============== SEJA PARCEIRO =============== -->
    <section class="partner" id="seja-parceiro">
        <div style="margin-bottom: 100px;" class="section-inner">
            <header style="margin-bottom: 100px; margin-top: 100px;" class="partner__head">
            <h2>Seja Parceiro</h2>
            <p>Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum qui auda
                sundi num quisque proresequís modic to berrovdiem. Musam aliquo optae que nonecul.</p>
            </header>

            <form class="partner__form" action="#" method="post">
            <!-- 1) linha full -->
            <div class="partner__row">
                <label class="u-field">
                <span class="u-label">Lorem Ipsum</span>
                <input class="u-input" type="text" name="campo1" placeholder="">
                </label>
            </div>

            <!-- 2) linha em duas colunas -->
            <div class="partner__row partner__row--2">
                <label class="u-field">
                <span class="u-label">Lorem Ipsum</span>
                <input class="u-input" type="text" name="campo2" placeholder="">
                </label>

                <label class="u-field">
                <span class="u-label">Lorem Ipsum</span>
                <input class="u-input" type="text" name="campo3" placeholder="">
                </label>
            </div>

            <!-- 3) linha full -->
            <div class="partner__row">
                <label class="u-field">
                <span class="u-label">Lorem Ipsum</span>
                <input class="u-input" type="text" name="campo4" placeholder="">
                </label>
            </div>

            <button class="partner__btn" type="submit">Lorem Ipsum</button>
            </form>
        </div>
    </section>

  @include('components.footer')
</body>
</html>
