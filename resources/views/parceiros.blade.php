<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Clube+ | Parceiros</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  @vite(['resources/css/default.css','resources/css/app.css','resources/js/app.js'])

  <style>
    :root{
      --page-w: 1440px;
      --gutter: clamp(24px, 4vw, 28px);

      /* ajuste p/ a proporção REAL da foto */
      --parc-hero-ar: 1440/1278;

      /* offsets do conteúdo sobreposto */
      --panel-left-desktop: calc(50vw - min(100vw, var(--page-w))/2 + var(--gutter));
      --panel-top: clamp(110px, 25vh, 240px);

      /* paleta do painel/form */
      --panel-bg: rgb(244 110 0 / 75%);                    /* fundo do card (como no mock) */
      --panel-outline: rgba(255,255,255,.22); /* borda dos selects */
      --panel-outline-hover: rgba(255,255,255,.35);
      --accent: #F46E00;                      /* laranja dos ícones */
      --btn-bg: #39C0F2;                      /* botão azul */
      --panel-min-h: 670px;
    }

    html, body{ margin:0; padding:0; overflow-x:hidden; }
    .section-inner{ max-width: var(--page-w); margin-inline:auto; padding-inline:var(--gutter); }

    /* ===================== HERO (sem corte) ===================== */
    .parc-hero{
      /* passe a imagem também aqui via --hero: url(...) */
      --hero: none;

      position: relative;
      width: 100vw;
      margin-inline: calc(50% - 50vw);   /* full-bleed */
      aspect-ratio: var(--parc-hero-ar); /* mantém a área na razão da foto */
      isolation:isolate;
      overflow:hidden;
      background: transparent;
    }
    @supports (width: 100dvw){
      .parc-hero{ width:100dvw; margin-inline: calc(50% - 50dvw); }
    }

    /* “cover + blur” no fundo p/ eliminar letterboxing sem cortar a foto principal */
    .parc-hero::before{
      content:""; position:absolute; inset:-2%;
      background: var(--hero) center/cover no-repeat;
      filter: blur(14px) saturate(0.95) brightness(0.98);
      transform: scale(1.03);
      z-index:0;
    }
    /* leve darkening p/ dar leitura ao título */
    .parc-hero::after{
      content:""; position:absolute; inset:0;
      background: linear-gradient(180deg, rgba(0,0,0,.20) 0%, rgba(0,0,0,.10) 40%, rgba(0,0,0,0) 100%);
      z-index:1;
    }

    /* imagem principal NÃO é cortada */
    .parc-hero__photo{
      position:absolute; inset:0;
      width:100%; height:100%;
      /* object-fit: contain !important;       não corta */
      object-position: center;
      max-width:none;
    }

    /* título */
    .parc-hero__heading{
      position:absolute; left: var(--panel-left-desktop);
      top: clamp(22px, 8vh, 70px);
      color:#fff; z-index:3;
      text-shadow: 0 3px 14px rgba(0,0,0,.35);
    }
    .parc-hero__heading h1{
      margin:0; font-weight:800; letter-spacing:-0.02em; line-height:1.06;
      font-size: clamp(36px, 5vw, 56px);
    }

    /* painel / formulário */
    .parc-hero__panel{
      position:absolute; left: var(--panel-left-desktop); top: var(--panel-top);
      width: min(500px, 42vw);
      padding: clamp(26px, 3vw, 32px);
      border-radius: 28px;
      background: var(--panel-bg);
      color:#fff; z-index:3;
      box-shadow: 0 14px 32px rgba(0,0,0,.22);
      backdrop-filter: saturate(1.05);
      min-height: var(--panel-min-h);
    }
    .parc-hero__panel h3{
      margin:0 0 12px; font-weight:800; font-size: clamp(22px, 2.2vw, 28px);
      letter-spacing:-0.01em;
    }
    .parc-hero__panel p.desc{
      margin:0 0 18px; color:rgba(255,255,255,.97); line-height:1.6; font-size:16px;
    }
    .parc-hero__hr{
      height:1px; width:100%;
      background: var(--panel-outline);
      margin: 12px 0 85px; border:0;
    }

    .parc-form{ display:grid; gap:30px; }

    .field{
      position:relative; display:grid; align-items:center;
      height: 58px; border-radius:12px;
      box-shadow: none;
    }
    .field input, .field select{
      width:100%; height:100%; border:0; outline:0; background:transparent;
      font-size:16px; line-height:1;
      padding: 0 52px; /* espaço p/ ícone e seta */
    }

    /* ícone base */
    .field__icon{
      position:absolute; left:16px; top:50%; transform:translateY(-50%);
      width:20px; height:20px; display:grid; place-items:center;
    }

    /* campo 1 (FILLED branco) */
    .field--filled{
      background: #fff;
      box-shadow: 0 2px 0 rgba(0,0,0,.05);
    }
    .field--filled input{ color:#101828; }
    .field--filled input::placeholder{ color:#667085; }
    .field__icon--circle{
      width:34px; height:34px; border-radius:9999px; background: var(--accent);
      left:14px; display:grid; place-items:center;
    }
    .field__icon--circle svg{ display:block; }
    .field__icon--circle svg *{ fill:#fff !important; }

    /* campos 2 e 3 (OUTLINE) */
    .field--outline{ background: transparent; border: 1px solid var(--panel-outline); }
    .field--outline:hover{ border-color: var(--panel-outline-hover); }
   .field--outline select{
        color: #fff;
        background-color: transparent; /* rótulo */
        color-scheme: light;            /* evita tema escuro do SO influenciar */
    }

    .field--outline select option,
    .field--filled  select option{
        color: #101828;                 /* texto das opções */
        background-color: #fff;         /* fundo do menu */
    }

    .field--outline select option[hidden],
    .field--outline select option[value=""]{
        color: #667085;
    }
    .field--outline input::placeholder,
    .field--outline select:invalid{ color: rgba(255,255,255,.95); }

    /* ícones laranja nos outline */
    .field--outline .field__icon svg *{ fill: var(--accent); }

    /* seta branca dos selects */
    .field--select::after{
      content:""; position:absolute; right:16px; top:50%; transform:translateY(-50%);
      width:16px; height:16px; pointer-events:none; opacity:.95;
      background: center/16px 16px no-repeat;
      background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="white"><path d="M7 10l5 5 5-5z"/></svg>');
    }

    /* botão grande */
    .parc-btn{
      height: 64px; border:0; outline:0; border-radius:12px;
      background: var(--btn-bg); color:#fff; font-weight:800; font-size:22px; letter-spacing:.01em;
      box-shadow: 0 10px 22px rgba(6,110,150,.34);
      cursor:pointer; transition: transform .06s ease, filter .12s ease;
      margin-top:6px;
    }
    .parc-btn:hover{ filter: brightness(1.07); }
    .parc-btn:active{ transform: translateY(1px); }

    /* faixa de ícones decorativa no rodapé do banner */
    .parc-hero__icons{
      position:absolute; left:0; right:0; bottom: clamp(8px, 1.4vw, 16px);
      height: clamp(58px, 10vw, 102px);
      background: url("{{ asset('assets/image_banner.png') }}") center/contain no-repeat;
      opacity:.78; z-index:4; pointer-events:none;
    }

    /* responsivo */
    @media (max-width: 1279.98px){
      .parc-hero__heading{ left: var(--gutter); }
      .parc-hero__panel{
        left: var(--gutter);
        width: calc(100vw - (var(--gutter)*2));
        top: clamp(140px, 32vh, 320px);
      }
    }
    @media (max-width: 640px){
      .field{ height:52px; }
      .parc-btn{ height:58px; font-size:20px; }
    }


    /* ======== REGRAS DE USO (com imagem bg.png) ======== */
    :root{
    /* ajuste fino sem mexer no CSS todo */
    --rules-bg: #45C9F0;
    /* insets do conteúdo dentro do balão (em %) */
        --slot-top: 30%;
        --slot-right: 7%;
        --slot-bottom: 8%;
        --slot-left: 7%; 
        /* posições dos elementos flutuantes */
        --pill-top: 12%;
        --pill-right: 9%;
        --cta-right: 9%;
        --cta-bottom: 9%;
    }

    .rules{ background: var(--rules-bg); padding-block: clamp(64px, 8vw, 104px); }

    .rules__grid{
    display:grid;
    grid-template-columns: 1.05fr min(600px, 44vw);
    gap: clamp(28px, 5vw, 72px);
    align-items:center;
    }

    .rules__copy h2{
    margin:0 0 18px; color:#000; font-weight:800; letter-spacing:-0.02em;
    line-height:1.06; font-size: clamp(30px, 3.6vw, 48px);
    }
    .rules__copy p{ margin:0 0 18px; color:rgba(0, 0, 0, 0.96); line-height:1.75; max-width:62ch; }

    /* Moldura com a imagem */
    .rules__frame{
    position: relative;
    width: min(620px, 44vw);          /* largura responsiva */
    /* se quiser travar exatamente na altura nativa da imagem: descomente a linha abaixo
        e ajuste a largura conforme a proporção real do seu PNG
    */
    /* height: 566px; */
    }

    /* a imagem escala mantendo a proporção, sem distorcer */
    .rules__img{
    display:block;
    width:100%;
    height:auto;
    user-select:none;
    pointer-events:none;
    filter: drop-shadow(0 26px 60px rgba(0,0,0,.22)); /* sombra como no mock */
    }

    /* área "clicável"/de texto, respeitando a mordida */
    .rules__slot{
    position:absolute;
    inset: var(--slot-top) var(--slot-right) var(--slot-bottom) var(--slot-left);
    color:#3A3A3A;
    line-height:1.7;
    }
    .rules__copy{
        width: 340px;
    }

    /* pill superior direita */
    .rules__pill{
    position:absolute;
    top: var(--pill-top);
    right: var(--pill-right);
    background:#39C0F2; color:#fff;
    font-weight:700; font-size:12px;
    padding:8px 14px; border-radius:9999px;
    letter-spacing:.01em;
    box-shadow: 0 6px 14px rgba(0,0,0,.12);
    }

    /* botão circular inferior direito */
    .rules__cta{
    position:absolute;
    right: var(--cta-right);
    bottom: var(--cta-bottom);
    width:42px; height:42px; border:0; border-radius:9999px;
    background:#F46E00; color:#fff;
    display:grid; place-items:center; cursor:pointer;
    box-shadow: 0 10px 22px rgba(0,0,0,.20);
    }
    .rules__cta svg{ width:18px; height:18px; display:block; }

    @media (max-width: 991.98px){
    .rules__grid{ grid-template-columns: 1fr; }
    .rules__frame{ margin-inline:auto; max-width: 640px; }
    }

    /* ======== SEJA PARCEIRO ======== */
:root{
    --partner-maxw: 760px;   /* largura do form (ajuste se quiser) */

    --partner-btn-h: 36px;     /* altura como no mock */
    --partner-btn-r: 6px;      /* raio pequeno */
    --partner-btn-px: 14px;    /* padding horizontal */
    --partner-btn-fs: 12px;    /* fonte pequena uppercase
}

.partner{
  background:#fff;
  padding-block: clamp(56px, 8vw, 96px);
  color:#111827;
}

.partner .section-inner{ /* mantém tudo alinhado à esquerda do layout */
  display:block;
}

.partner__head h2{
  margin:0 0 10px;
  color: var(--accent);        /* usa o mesmo laranja do projeto */
  font-weight:800;
  letter-spacing:-0.02em;
  line-height:1.06;
  font-size: clamp(28px, 3.4vw, 44px);
}
.partner__head p{
  margin:0 0 34px;
  max-width: 62ch;
  color:#6B7280;
  line-height:1.7;
  font-size: 15px;
}

/* Form */
.partner__form{
  width:100%;
  max-width: var(--partner-maxw);
  display:grid;
  gap: 30px;
}

/* linhas (1 coluna / 2 colunas) */
.partner__row{ display:block; }
.partner__row--2{
  display:grid;
  grid-template-columns: 1fr 1fr;
  gap: clamp(24px, 4vw, 56px);
}

.u-field{ display:block; }
.u-label{
  display:block;
  font-size: 15px;
  color:#6B7280;
  margin: 0 0 14px;
}

/* inputs “underlined” */
.u-input{
  width:100%;
  border:0;
  background:transparent;
  outline:0;
  padding: 10px 0 14px;
  border-bottom: 1px solid #EFEFEF;
  font-size: 16px;
  color:#111827;
}
.u-input::placeholder{ color:#9CA3AF; }
.u-input:focus{
  border-bottom-color:#D1D5DB;   /* leve realce no foco */
}

/* Botão pill azul à esquerda */
.partner__btn{
  display: inline-flex !important;
  align-items: center;
  justify-content: center;
  height: var(--partner-btn-h);
  padding: 0 var(--partner-btn-px);
  width: auto !important;
  min-width: 0;
  max-width: none;
  border-radius: var(--partner-btn-r);
  font-size: var(--partner-btn-fs);
  font-weight: 700;
  letter-spacing: .06em;
  text-transform: uppercase;

  background:#39C0F2;
  color:#fff;
  border:0;
  cursor:pointer;

  box-shadow: 0 8px 18px rgba(6,110,150,.18);
  transition: filter .12s ease, transform .06s ease;
  place-self: start;          /* fixa à esquerda dentro do grid */
  justify-self: start;
  margin-top: 6px;            /* espaço do mock */
}

.partner__btn:hover{ filter: brightness(1.05); }
.partner__btn:active{ transform: translateY(1px); }

@media (max-width: 768px){
  .partner__row--2{ grid-template-columns: 1fr; }
}


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
