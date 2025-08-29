<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Clube+ | Benefícios</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  @vite(['resources/css/default.css','resources/css/app.css','resources/js/app.js'])

  <style>
    /* ========= CONTAINER PADRÃO ========= */
    :root{
      --page-w: 1280px;
      --gutter: clamp(24px, 4vw, 28px);
      --header-h: clamp(64px, 9vh, 100px);
    }
    .section-inner{ max-width: var(--page-w); margin-inline: auto; padding-inline: var(--gutter); }
    .align-with-timeline{ margin-inline: 0 !important; max-width: var(--page-w) !important; }

    /* ========= HERO ========= */
    .hero-band{ position:relative; width:100vw; left:50%; margin-left:-50vw; overflow:hidden; }
    .hero-photo{ display:block; width:100vw; height:auto; max-width:none; }
    :root{ --panel-left-desktop: calc(50vw - (var(--page-w)/2) + var(--gutter)); --panel-bottom-offset: clamp(24px, 8vh, 77px); }
    .hero-panel{
      position:absolute; left: var(--panel-left-desktop); top: var(--header-h); bottom: var(--panel-bottom-offset);
      width: min(660px, 50vw); padding: clamp(18px, 2.4vw, 36px);
      color:#fff; background: rgba(244,110,0,.50);
      border-bottom-left-radius: 220px 170px; box-shadow: 0 10px 30px rgba(0,0,0,.18);
      overflow:hidden; isolation:isolate;
    }
    .hero-panel h1{ font-weight:800; font-size:clamp(28px,3.6vw,48px); margin:0 0 16px; letter-spacing:-0.02em; }
    .hero-panel p{ margin-top:14px; line-height:1.65; color:rgba(255,255,255,.95); }
    .hero-panel__inner{ position:relative; height:100%; padding:clamp(18px,2.4vw,36px); overflow:auto; -webkit-overflow-scrolling:touch; }
    @media (max-width:1279.98px){
      .hero-panel{ left: var(--gutter); width: calc(100vw - (var(--gutter)*2)); border-radius:60px !important; border-bottom-left-radius:60px !important; }
    }

    /* ========= PARA QUEM É? ========= */
    .pq{ background:#F4F1EA; }
    .pq-wrap{ display:grid; grid-template-columns: 0.9fr 1.1fr; gap: clamp(40px,6.5vw,110px); align-items:center; }
    .pq h2{ font-weight:800; font-size:clamp(36px,3.6vw,52px); letter-spacing:-0.02em; margin:0 0 18px; }
    .pq-copy{ max-width:323px; }
    .pq-copy p{ margin:0 0 18px; line-height:1.72; color:rgba(0,0,0,.70); }
    .pq-art{ position:relative; justify-self:center; }
    .pq-art:before{ content:""; position:absolute; inset:-50px -90px -70px -90px; background: radial-gradient(closest-side, rgba(0,0,0,.18), transparent 70%); filter: blur(18px); opacity:.22; pointer-events:none; }
    .pq-art img{ display:block; width: clamp(780px, 60vw, 980px); height:auto; filter: drop-shadow(0 16px 30px rgba(0,0,0,.20)); }
    @media (min-width:1200px){ .pq-art{ margin-right:-32px; } }
    @media (max-width:900px){
      .pq-wrap{ grid-template-columns:1fr; }
      .pq-art{ order:2; margin-top:28px; margin-right:0; }
      .pq-art img{ width:min(640px,94vw); }
      .pq-copy{ max-width:640px; }
    }

   /* ===== COMO FUNCIONA — Grid 5 colunas (centros fixos), textos nos vãos ===== */
.how-title{ font-weight:800; color:#F46E00; letter-spacing:-0.02em; }

.timeline5{ list-style:none; margin:0; padding:0; position:relative; }

.timeline5{
  /* dimensões */
  --dot: 22px; --ring: 4px; --line: 4px;
  --hex: 108px; --gap-up: 18px; --gap-down: 22px;
  --text-gap: 18px;        /* dist. texto ↔ linha */
  --slotpad: 14px;         /* respiro perto do ponto (ajuste fino) */
  --vpad: 165px;           /* altura das áreas sup/inf (ajuste fino) */

  display:grid;
  grid-template-columns: repeat(5, 1fr);     /* centros em 10/30/50/70/90 */
  grid-template-rows: var(--vpad) auto var(--vpad);
  gap: 0;
}

/* linha central */
.timeline5::before{
  content:""; position:absolute; top:50%; left:10%; right:10%;
  height: var(--line); transform: translateY(-50%);
  background:#FF8F2C; border-radius:999px;
}

/* cada item usa o grid do pai */
.tl-item{ display: contents; }

/* centros (row 2) 1..5 */
.tl-item:nth-child(1) .tl-center{ grid-column:1; grid-row:2; }
.tl-item:nth-child(2) .tl-center{ grid-column:2; grid-row:2; }
.tl-item:nth-child(3) .tl-center{ grid-column:3; grid-row:2; }
.tl-item:nth-child(4) .tl-center{ grid-column:4; grid-row:2; }
.tl-item:nth-child(5) .tl-center{ grid-column:5; grid-row:2; }

.tl-center{ position:relative; min-height: 220px; }

/* ponto */
.tl-dot{
  position:absolute; top:50%; left:50%;
  width: var(--dot); height: var(--dot);
  transform: translate(-50%,-50%);
  border-radius:999px; background:#fff; z-index:3;
  box-shadow: 0 0 0 var(--ring) #FF8F2C;
}
.tl-item.blue .tl-dot{ box-shadow:0 0 0 var(--ring) #2BB9FF; }
.tl-dot::after{
  content:""; display:block; width: calc(var(--dot)/2.8); height: calc(var(--dot)/2.8);
  margin:auto; margin-top: calc(50% - (var(--dot)/5.6));
  border-radius:999px; background:#FF8F2C;
}
.tl-item.blue .tl-dot::after{ background:#2BB9FF; }

/* conector vertical */
.tl-connector{ position:absolute; left:50%; transform:translateX(-50%); width:2px; background:#D9D9D9; z-index:2; }
.tl-item.up   .tl-connector{  bottom: calc(50% + (var(--dot)/2)); height: calc(var(--gap-up)   + (var(--hex)/2)); }
.tl-item.down .tl-connector{     top: calc(50% + (var(--dot)/2)); height: calc(var(--gap-down) + (var(--hex)/2)); }

/* hexágono */
.tl-hexwrap{ position:absolute; left:50%; transform: translateX(-50%); z-index:4; }
.tl-item.up   .tl-hexwrap{   bottom: calc(50% + var(--gap-up)); }
.tl-item.down .tl-hexwrap{     top:   calc(50% + var(--gap-down)); }
.how-hex{ position:relative; display:grid; place-items:center; width:var(--hex); height:var(--hex); color:#F3C600; filter: drop-shadow(0 10px 18px rgba(0,0,0,.08)); }
.tl-item.blue .how-hex{ color:#35B6FF; }
.how-hex svg{ position:absolute; inset:0; width:100%; height:100%; }
.how-hex svg polygon{ fill:#fff; stroke: currentColor; stroke-width:3; stroke-linejoin:round; }
.how-hex img{ position:relative; width:46px; height:46px; object-fit:contain; }

/* ===== textos nos VÃOS (span de 2 colunas com wrapper central) ===== */
/* ===== textos nos VÃOS (centro→centro, topo e base) ===== */
/* ===== Textos nos VÃOS — sem position absolute, 100% robusto ===== */
.timeline5{
  /* ajuste fino */
  --slotpad: 14px;    /* respiro a partir do centro/dot (12–18px) */
  --text-gap: 18px;   /* distância da linha até o bloco de texto    */
  --vpad: 165px;      /* altura das áreas superior/inferior          */
}

/* o item de texto ocupa o span de 2 colunas (definido nos :nth-child) */
.timeline5 .tl-text{
  align-self: center;
  width: 100%;
  box-sizing: border-box;
}

/* conteúdo real do texto */
.timeline5 .tl-slot{
  width: 100%;
  max-width: 36ch;               /* opcional p/ leitura; pode remover */
  box-sizing: border-box;
  line-height: 1.55;
  word-break: break-word;
  hyphens: auto;
  text-align: left;
}
.timeline5 .tl-slot h3{ margin:0 0 6px !important; line-height:1.25; }
.timeline5 .tl-slot p { margin:0 !important; }

/* ===== mapeamento dos spans (segue teu layout) ===== */
/* TOP-RIGHT (itens 1,2,4): o span é 2 colunas; desloca conteúdo p/ a metade DIREITA */
.tl-item:nth-child(1) .tl-text{ grid-row: 1; padding-left: calc(4% + var(--slotpad)); }
.tl-item:nth-child(2) .tl-text{ grid-column: 2 / 4; grid-row: 1; padding-left: calc(50% + var(--slotpad)); }
.tl-item:nth-child(4) .tl-text{ grid-column: 4 / 6; grid-row: 1; padding-left: calc(50% + var(--slotpad)); }

/* BOTTOM-LEFT (itens 3,5): desloca conteúdo p/ a metade ESQUERDA */
.tl-item:nth-child(3) .tl-text{ grid-column: 2 / 4; grid-row: 3; align-self: start; padding-right: calc(50% + var(--slotpad)); }
.tl-item:nth-child(5) .tl-text{ grid-column: 4 / 6; grid-row: 3; align-self: start; padding-right: calc(50% + var(--slotpad)); }

/* (opcional) limite visual do parágrafo para ficar mais parecido com o mock */
@media (min-width: 960px){
  .timeline5 .tl-slot{ max-width: 36ch; }
}


/* (Opcional) limitar largura visual do parágrafo, para parecer com o mock
    Descomente se quiser deixar mais estreito (≈ 32–36 caracteres):
.timeline5 .tl-text{ max-width: 34ch; }
*/
  </style>
</head>

<body class="bg-white">

@include('components.header')

<!-- ================= HERO ================= -->
<section>
  <figure class="hero-band">
    <img class="hero-photo" src="{{ asset('images/beneficios/benefioPrograma.png') }}" alt="O programa - Clube+">
    <div class="hero-panel">
      <div class="hero-panel__inner">
        <h1>{{ $heroTitle ?? 'O programa' }}</h1>
        @php $sentences = preg_split('/(?<=[.!?])\s+/u', trim($heroText ?? ''), -1, PREG_SPLIT_NO_EMPTY); @endphp
        @foreach ($sentences as $s) <p>{{ $s }}</p> @endforeach
      </div>
    </div>
  </figure>
</section>

<!-- ================= Para quem é? ================= -->
<section class="pq">
  <div class="section-inner">
    <div class="pq-wrap align-with-timeline">
      <div>
        <h2>Para quem é?</h2>
        <div class="pq-copy">
          <p>Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequis modic to berrovdiem.</p>
          <p>Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequis modic to berrovdiem. Musam aliquo optae que nonecul.</p>
          <p>Optaquae perepedi dende officia cabore… que nonecul.</p>
        </div>
      </div>

      <figure class="pq-art">
        <img src="{{ asset('images/beneficios/praquem.png') }}" alt="Públicos do Clube+">
      </figure>
    </div>
  </div>
</section>

<!-- ================= Como funciona? ================= -->
<section class="bg-white">
  <div class="section-inner">
    <h2 class="how-title text-[34px] md:text-[42px] mb-3">Como funciona?</h2>
    <p class="how-lead text-black/70 mb-10 md:mb-12 max-w-2xl">
      Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum
      qui auda sundi num quisque proresequis modic to berrovdiem. Musam aliquo optae que nonecul.
    </p>
  </div>

  <div class="section-inner">
    @php
      $steps = [
        ['icon' => 'money.png',   'title' => 'Lorem Ipsum', 'desc' => 'Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem.'],
        ['icon' => 'praia.png',   'title' => 'Lorem Ipsum', 'desc' => 'Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequis modic to berrovidem. Musam aliquo optae.'],
        ['icon' => 'onibus.png',  'title' => 'Lorem Ipsum', 'desc' => 'Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi.'],
        ['icon' => 'objetos.png', 'title' => 'Lorem Ipsum', 'desc' => 'Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi. Musam aliquo optae que nonecul.'],
        ['icon' => 'cruz.png',    'title' => 'Lorem Ipsum', 'desc' => 'Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequis.'],
      ];
    @endphp

    <ol class="timeline5">
    @foreach($steps as $i => $s)
        @php $pos = in_array($i, [1,3]) ? 'up' : 'down'; @endphp

        <li class="tl-item {{ $pos }} {{ $pos === 'up' ? 'blue' : 'orange' }}">
        <!-- centro (ponto/linha/hex) -->
        <div class="tl-center">
            <span class="tl-dot"></span>
            <span class="tl-connector"></span>
            <div class="tl-hexwrap">
            <div class="how-hex" aria-hidden="true">
                <svg viewBox="0 0 100 100"><polygon points="25,6.7 75,6.7 100,50 75,93.3 25,93.3 0,50"/></svg>
                <img src="{{ asset('images/beneficios/'.$s['icon']) }}" alt="">
            </div>
            </div>
        </div>

        <!-- texto no vão (span 2 colunas; o .tl-slot é a metade centralizada = 1 coluna) -->
        <div class="tl-text">
            <div class="tl-slot">
            <h3 class="font-semibold text-[#6C6C6C]">{{ $s['title'] }}</h3>
            <p class="text-sm text-[#6C6C6C] mt-1 leading-relaxed">{{ $s['desc'] }}</p>
            </div>
        </div>
        </li>
    @endforeach
    </ol>

  </div>
</section>

<!-- ================= Depoimentos ================= -->
<section class="bg-[#39C0F2]">
  <div class="section-inner">
    <h2 class="text-white text-[34px] md:text-[42px] font-extrabold mb-8">Depoimentos</h2>

    <div class="relative">
      <div id="dep-list" class="flex gap-6 overflow-x-auto snap-x pb-4">
        @for($i=0; $i<5; $i++)
          <article class="card-snap min-w-[320px] max-w-[420px] bg-white rounded-2xl p-5 shadow-md">
            <div class="flex items-center gap-3 mb-3">
              <img class="w-10 h-10 rounded-full object-cover" src="{{ asset('images/beneficios/avatar.jpg') }}" alt="">
              <div>
                <div class="font-semibold">David Rodrigo W.</div>
                <div class="text-xs text-black/60">Traveler</div>
              </div>
            </div>
            <p class="text-black/80 leading-relaxed">
              Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum
              qui auda sundi num quisque proresequis modic to berrovdiem. Musam aliquo optae que
              nonecul luptionempos a nossi sum autares pictori buscim laboresut.
            </p>
          </article>
        @endfor
      </div>

      <div class="mt-4 flex items-center justify-center gap-3">
        <button id="prevDep" class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/30 grid place-items-center text-white">‹</button>
        <button id="nextDep" class="w-9 h-9 rounded-full bg-white/20 hover:bg-white/30 grid place-items-center text-white">›</button>
      </div>
    </div>
  </div>
</section>

@include('components.footer')

<script>
  (function(){
    const wrap = document.getElementById('dep-list');
    if(!wrap) return;
    const step = 360;
    document.getElementById('prevDep')?.addEventListener('click', ()=> wrap.scrollBy({left:-step, behavior:'smooth'}));
    document.getElementById('nextDep')?.addEventListener('click', ()=> wrap.scrollBy({left: step, behavior:'smooth'}));
  })();
</script>

</body>
</html>
