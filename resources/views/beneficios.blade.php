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
    /* ====== VARS / GRID ====== */
    :root{
      /* largura “cap” do conteúdo (recomendado 1440) */
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

    html, body{ margin:0; padding:0; overflow-x:hidden; }
    .section-inner{ max-width: var(--page-w); margin-inline: auto; padding-inline: var(--gutter);}
    .align-with-timeline{ margin-inline: 0 !important; max-width: var(--page-w) !important; }

    /* ====== HERO FULL-BLEED ROBUSTO ====== */
    figure.hero-band{ margin:0; } /* remove margem default do <figure> */

    .hero-band{
      position: relative;
      width: 100vw;
      margin-inline: calc(50% - 50vw);  /* encosta nas bordas */
      overflow: hidden;
    }
    @supports (width: 100dvw){
      .hero-band{
        width: 100dvw;
        margin-inline: calc(50% - 50dvw); /* corrige gaps em iOS/Android */
      }
    }

    .hero-photo{
      display:block;
      width:100%;
      height:auto;
      max-width:none; /* previne encolher por regras globais */
    }

    .hero-panel{
      position:absolute;
      left: var(--panel-left-desktop);
      top: 0;                               /* colado no topo da imagem */
      bottom: var(--panel-bottom-offset);
      width: clamp(420px, 36vw, 630px);     /* escala fluida com limites */
      padding: clamp(18px, 2.4vw, 36px);
      color:#fff; background: rgba(244,110,0,.50);
      border-bottom-left-radius: 220px 170px;
      box-shadow: 0 10px 30px rgba(0,0,0,.18);
      overflow:hidden; isolation:isolate;
    }
    .hero-panel h1{ font-weight:800; font-size:clamp(28px,3.6vw,48px); margin:0 0 16px; letter-spacing:-0.02em; }
    .hero-panel p{ margin-top:14px; line-height:1.65; color:rgba(255,255,255,.95); }
    .hero-panel__inner{
      position: relative;
      height: 100%;
      padding: var(--panel-pad);
      /* extra no topo, além do padding base */
      padding-top: calc(var(--panel-top-pad) + var(--panel-pad));
      overflow: auto;
      -webkit-overflow-scrolling: touch;
    }

    @media (max-width:1279.98px){
      .hero-panel{
        left: var(--gutter);
        top: 0;
        width: calc(100vw - (var(--gutter)*2));
        border-radius:60px !important;
        border-bottom-left-radius:60px !important;
      }
      .hero-panel__inner{
        padding: var(--panel-pad);
      }
    }

    /* ====== PARA QUEM É? ====== */
    .pq{ background:#F4F1EA; }
    .pq-wrap{ display:grid; grid-template-columns: 0.9fr 1.1fr;align-items:center; }
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

    /* ====== COMO FUNCIONA (timeline) ====== */
    .how-title{ font-weight:800; color:#F46E00; letter-spacing:-0.02em; margin-top: 30px;}
    .timeline5{ list-style:none; margin:0; padding:0; position:relative; }
    .timeline5{
      --dot: 22px; --ring: 2px; --line: 2px;
      --hex: 108px; --gap-up: 20px; --gap-down: 40px;
      --text-gap: 18px; --slotpad: 14px; --vpad: 165px;
      display:grid; grid-template-columns: repeat(5, 1fr);
      grid-template-rows: var(--vpad) auto var(--vpad); gap:0;
    }
    .timeline5::before{ content:""; position:absolute; top:50%; left:10%; right:10%; height:var(--line); transform:translateY(-50%); background:#FF8F2C; border-radius:999px; }
    .tl-item{ display:contents; }
    .tl-item:nth-child(1) .tl-center{ grid-column:1; grid-row:2; }
    .tl-item:nth-child(2) .tl-center{ grid-column:2; grid-row:2; }
    .tl-item:nth-child(3) .tl-center{ grid-column:3; grid-row:2; }
    .tl-item:nth-child(4) .tl-center{ grid-column:4; grid-row:2; }
    .tl-item:nth-child(5) .tl-center{ grid-column:5; grid-row:2; }
    .tl-center{ position:relative; min-height:220px; }
    .tl-dot{ position:absolute; top:50%; left:50%; width:var(--dot); height:var(--dot); transform:translate(-50%,-50%); border-radius:999px; background:#fff; z-index:3; box-shadow:0 0 0 var(--ring) #FF8F2C; }
    .tl-item.blue .tl-dot{ box-shadow:0 0 0 var(--ring) #2BB9FF; }
    .tl-dot::after{ content:""; display:block; width: calc(var(--dot)/2.8); height: calc(var(--dot)/2.8); margin:auto; margin-top: calc(50% - (var(--dot)/5.6)); border-radius:999px; background:#FF8F2C; }
    .tl-item.blue .tl-dot::after{ background:#2BB9FF; }
    .tl-connector{ position:absolute; left:50%; transform:translateX(-50%); width:2px; background:orange; z-index:2; }
    .tl-item.up   .tl-connector{  bottom: calc(50% + (var(--dot)/2)); height: calc(var(--gap-up)   + (var(--hex)/2)); }
    .tl-item.down .tl-connector{     top: calc(50% + (var(--dot)/2)); height: calc(var(--gap-down) + (var(--hex)/2)); }
    .tl-hexwrap{
       position:absolute; 
       left:50%; 
       transform: translateX(-50%); 
       z-index:4;
       margin-bottom: 75px;
       margin-top: 75px;
    }
    .tl-item.up   .tl-hexwrap{   bottom: calc(50% + var(--gap-up)); }
    .tl-item.down .tl-hexwrap{     top:   calc(50% + var(--gap-down)); }
    .how-hex{ position:relative; display:grid; place-items:center; width:var(--hex); height:var(--hex); color:#F3C600; filter: drop-shadow(0 10px 18px rgba(0,0,0,.08)); }
    .tl-item.blue .how-hex{ color:#35B6FF; }
    .how-hex svg{ position:absolute; inset:0; width:100%; height:100%; }
    .how-hex svg polygon{ fill:#fff; stroke: currentColor; stroke-width:3; stroke-linejoin:round; }
    .how-hex img{ position:relative; width:46px; height:46px; object-fit:contain; }
    .timeline5 .tl-text{ align-self:center; width:100%; box-sizing:border-box; }
    .timeline5 .tl-slot{ width:100%; max-width:36ch; box-sizing:border-box; line-height:1.55; word-break:break-word; hyphens:auto; text-align:left; }
    .timeline5 .tl-slot h3{ margin:0 0 6px !important; line-height:1.25; }
    .timeline5 .tl-slot p{ margin:0 !important; }
    .tl-item:nth-child(1) .tl-text{ grid-row:1; padding-left: calc(4% + var(--slotpad)); }
    .tl-item:nth-child(2) .tl-text{ grid-column:2 / 4; grid-row:1; padding-left: calc(50% + var(--slotpad)); }
    .tl-item:nth-child(4) .tl-text{ grid-column:4 / 6; grid-row:1; padding-left: calc(50% + var(--slotpad)); }
    .tl-item:nth-child(3) .tl-text{ grid-column:2 / 4; grid-row:3; align-self:start; padding-right: calc(50% + var(--slotpad)); }
    .tl-item:nth-child(5) .tl-text{ grid-column:4 / 6; grid-row:3; align-self:start; padding-right: calc(50% + var(--slotpad)); }
    @media (min-width:960px){ .timeline5 .tl-slot{ max-width:36ch; } }

/* ===== Depoimentos ===== */
.depo { padding-block: clamp(44px, 7vw, 96px); }

.depo-band{
  position:absolute; inset:auto 0 0 0; top:0; height:128px;
  background:
    radial-gradient(circle at 60px 60px, rgba(255,255,255,.16), transparent 70%) 0 0/220px 120px repeat-x,
    linear-gradient(to bottom, rgba(255,255,255,.10), rgba(255,255,255,.06));
  opacity:.65; pointer-events:none;
}

.depo-wrap { position:relative; }

/* carrossel */
.depo-list{
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  scroll-snap-type: x proximity;       /* evita “trancos” */
  gap: clamp(24px, 3.6vw, 40px);
  cursor: grab;
}
.depo-list:active{ cursor: grabbing; }

.no-scrollbar{ scrollbar-width:none; -ms-overflow-style:none; }
.no-scrollbar::-webkit-scrollbar{ display:none; }

/* cards (sombra mais suave, sem “barrinha” visual) */
.depo-card{
  min-width: clamp(420px, 36vw, 560px);
  max-width: 560px;
  padding: clamp(18px, 2vw, 24px);
  box-sizing: border-box;
  background: #fff;
  border-radius: 18px;
  box-shadow: 0 16px 32px -12px rgba(0,0,0,.25);
  scroll-snap-align: center;
  scroll-snap-stop: always;
}

/* progresso */
.depo-progress{ margin-top: 12px; display:grid; place-items:center; }
.depo-progress__track{
  position:relative;
  width:min(620px, 72%);
  height:8px; border-radius:999px;
  background:rgba(255,255,255,.35);
  overflow:hidden;
}
.depo-progress__thumb{
  position:absolute; left:0; top:0; bottom:0;
  width:120px; border-radius:999px;
  background:#0e0e0e; opacity:.48;
  transform: translateX(0);
  transition: transform .12s linear, width .12s ease;
}

  </style>
</head>

<body class="bg-white">

  @include('components.header')

  <!-- ===== HERO ===== -->
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

  <!-- ===== Para quem é? ===== -->
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

  <!-- ===== Como funciona? ===== -->
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

  <!-- ===== Depoimentos ===== -->
  <section class="depo bg-[#39C0F2] relative overflow-hidden">
     
    <div class="depo-band" aria-hidden="true"></div>
    <div class="section-inner relative z-[1]">
      <h2 class="text-white text-[34px] md:text-[42px] font-extrabold mb-8">Depoimentos</h2>
      <div class="depo-wrap">
        <div id="dep-list"
            class="depo-list no-scrollbar snap-x snap-mandatory overflow-x-auto flex gap-8 md:gap-10 px-[var(--gutter)] pb-6">
          @for($i=0; $i<10; $i++)
            <article class="depo-card snap-center bg-white/98 rounded-[18px] md:rounded-[20px] shadow-[0_8px_20px_rgba(0,0,0,.12)]">
              <div class="flex items-center gap-3 mb-3">
                <img class="w-10 h-10 rounded-full object-cover" src="{{ asset('images/beneficios/user.png') }}" alt="">
                <div>
                  <div class="font-semibold text-[#212121]">David Rodrigo W.</div>
                  <div class="text-xs text-black/60 leading-none mt-0.5">Traveler</div>
                </div>
              </div>
              <p class="text-[15px] leading-relaxed text-black/80">
                Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum
                qui auda sundi num quisque proresequis modic to berrovdiem. Musam aliquo optae que
                nonecul luptionempos a nossi sum autares pictori buscim laboresut.
              </p>
            </article>
          @endfor
        </div>

        <!-- trilho de progresso -->
        <div class="depo-progress">
          <div id="depoTrack" class="depo-progress__track">
            <div id="depoThumb" class="depo-progress__thumb"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('components.footer')

<script>
  (function(){
    const wrap  = document.getElementById('dep-list');
    const track = document.getElementById('depoTrack');
    const thumb = document.getElementById('depoThumb');
    if(!wrap || !track || !thumb) return;

    /* ===== helpers ===== */
    const gap = () => parseFloat(getComputedStyle(wrap).gap || 0) || 0;
    const step = () => {
      const c = wrap.querySelector('.depo-card');
      return c ? Math.ceil(c.getBoundingClientRect().width + gap()) : wrap.clientWidth * .9;
    };
    const maxScroll = () => Math.max(0, wrap.scrollWidth - wrap.clientWidth);
    const trackW = () => track.clientWidth;

    /* ===== progresso (tamanho/posição) ===== */
    function updateThumb(){
      const tw = trackW();
      const ratio = wrap.clientWidth / wrap.scrollWidth;
      const w = Math.max(60, Math.min(tw, Math.round(tw * ratio)));     // clamp p/ não passar do trilho
      const pos = maxScroll() ? (wrap.scrollLeft / maxScroll()) : 0;
      const x = (tw - w) * pos;

      thumb.style.width = w + 'px';
      thumb.style.transform = `translateX(${x}px)`;
    }

    /* ===== wheel: 1 passo por card ===== */
    let wheelLock = false;
    wrap.addEventListener('wheel', (e) => {
      if(!wrap.matches(':hover')) return;
      const delta = Math.abs(e.deltaY) >= Math.abs(e.deltaX) ? e.deltaY : e.deltaX;
      if(delta === 0) return;
      e.preventDefault();

      if (wheelLock) return;
      wheelLock = true;
      wrap.scrollBy({ left: (delta > 0 ? 1 : -1) * step(), behavior: 'smooth' });
      setTimeout(() => wheelLock = false, 180);
    }, { passive:false });

    /* ===== drag no conteúdo ===== */
    let down=false, startX=0, startScroll=0, pid=null;
    wrap.addEventListener('pointerdown', (e)=>{
      if(e.target.closest('#depoTrack')) return;  // se começou no slider, deixa o slider cuidar
      down = true; pid = e.pointerId; wrap.setPointerCapture(pid);
      startX = e.clientX; startScroll = wrap.scrollLeft;
      wrap.style.scrollSnapType = 'none';
    });
    wrap.addEventListener('pointermove', (e)=>{
      if(!down) return;
      wrap.scrollLeft = startScroll - (e.clientX - startX);
      updateThumb();
    });
    function endDrag(){
      if(!down) return;
      down=false; try{ wrap.releasePointerCapture(pid);}catch{}
      wrap.style.scrollSnapType = '';
      const i = Math.round(wrap.scrollLeft / step());
      wrap.scrollTo({ left: i * step(), behavior: 'smooth' });
    }
    wrap.addEventListener('pointerup', endDrag);
    wrap.addEventListener('pointercancel', endDrag);
    wrap.addEventListener('pointerleave', endDrag);

    /* ===== slider: clique no trilho ===== */
    track.addEventListener('pointerdown', (e)=>{
      if(e.target === thumb) return;                               // o thumb tem handler próprio
      const r = track.getBoundingClientRect();
      const x = Math.min(Math.max(0, e.clientX - r.left), r.width);
      const ratio = x / r.width;
      wrap.scrollTo({ left: maxScroll() * ratio, behavior: 'smooth' });
    });

    /* ===== slider: arrastar o thumb ===== */
    let draggingThumb = false, tPid=null, startThumbX=0, startThumbLeft=0;
    function currentThumbLeft(){
      // converte transform em número
      const m = getComputedStyle(thumb).transform;
      if (m && m !== 'none') {
        const v = new DOMMatrixReadOnly(m).m41; // translateX
        return v || 0;
      }
      return 0;
    }

    thumb.addEventListener('pointerdown', (e)=>{
      draggingThumb = true; tPid = e.pointerId; thumb.setPointerCapture(tPid);
      startThumbX = e.clientX;
      startThumbLeft = currentThumbLeft();
      wrap.style.scrollSnapType = 'none';
      e.preventDefault();
    });

    track.addEventListener('pointermove', (e)=>{
      if(!draggingThumb) return;
      const tw = trackW();
      const w  = thumb.clientWidth;
      const dx = e.clientX - startThumbX;
      const left = Math.min(Math.max(0, startThumbLeft + dx), tw - w);

      // move o thumb
      thumb.style.transform = `translateX(${left}px)`;

      // mapeia para o scroll (sem smooth para ficar “na mão”)
      const ratio = (tw - w) ? (left / (tw - w)) : 0;
      wrap.scrollLeft = maxScroll() * ratio;
      e.preventDefault();
    }, { passive:false });

    function endThumbDrag(){
      if(!draggingThumb) return;
      draggingThumb = false;
      try{ thumb.releasePointerCapture(tPid);}catch{}
      wrap.style.scrollSnapType = '';
      // snap para o card mais próximo
      const i = Math.round(wrap.scrollLeft / step());
      wrap.scrollTo({ left: i * step(), behavior: 'smooth' });
      updateThumb();
    }
    thumb.addEventListener('pointerup',   endThumbDrag);
    thumb.addEventListener('pointercancel', endThumbDrag);
    thumb.addEventListener('pointerleave',  endThumbDrag);

    /* ===== teclado ===== */
    wrap.setAttribute('tabindex','0');
    wrap.addEventListener('keydown', (e)=>{
      if(e.key !== 'ArrowRight' && e.key !== 'ArrowLeft') return;
      wrap.scrollBy({ left: (e.key === 'ArrowRight' ? step() : -step()), behavior:'smooth' });
    });

    wrap.addEventListener('scroll', updateThumb, {passive:true});
    window.addEventListener('resize', updateThumb);
    requestAnimationFrame(updateThumb);
  })();
</script>


</body>
</html>
