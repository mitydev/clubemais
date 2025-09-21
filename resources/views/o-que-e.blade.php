<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Clube+ | O que é</title>
    <link rel="icon" type="image/png" href="{{ asset('images/plus.png') }}">


  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  @vite(['resources/css/default.css','resources/css/app.css', 'resources/css/pages/o-que-e.css', 'resources/js/app.js'])

  <style>
  </style>
</head>

<body class="bg-white">

  @include('components.header')

  <!-- ===== HERO ===== -->
  <section>
    <figure class="hero-band">
      <img class="hero-photo" src="{{ asset('images/o-que-e/benefioPrograma.png') }}" alt="O programa - Clube+">
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
          <img src="{{ asset('images/o-que-e/praquem.png') }}" alt="Públicos do Clube+">
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
                  <img src="{{ asset('images/o-que-e/'.$s['icon']) }}" alt="">
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
                <img class="w-10 h-10 rounded-full object-cover" src="{{ asset('images/o-que-e/user.png') }}" alt="">
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
(function () {
  'use strict';

  const wrap  = document.getElementById('dep-list');
  const track = document.getElementById('depoTrack');
  const thumb = document.getElementById('depoThumb');
  if (!wrap || !track || !thumb) return;

  /* ========= helpers ========= */
  const gap = () => parseFloat(getComputedStyle(wrap).gap || 0) || 0;
  const step = () => {
    const c = wrap.querySelector('.depo-card');
    return c ? Math.ceil(c.getBoundingClientRect().width + gap())
             : Math.ceil(wrap.clientWidth * 0.9);
  };
  const maxScroll = () => Math.max(0, wrap.scrollWidth - wrap.clientWidth);
  const trackW    = () => track.clientWidth;

  function updateThumb() {
    const tw    = trackW();
    const ratio = wrap.clientWidth / wrap.scrollWidth;
    const w     = Math.max(60, Math.min(tw, Math.round(tw * ratio)));
    const pos   = maxScroll() ? (wrap.scrollLeft / maxScroll()) : 0;
    const x     = (tw - w) * pos;

    thumb.style.width     = w + 'px';
    thumb.style.transform = `translateX(${x}px)`;
  }

  /* ========= wheel: arrasto suave + snap no final ========= */
  let wheelSnapTimer = null;
  wrap.addEventListener('wheel', (e) => {
    if (!wrap.matches(':hover')) return;

    // eixo dominante (suporta mouse e trackpad)
    const dx = Math.abs(e.deltaY) >= Math.abs(e.deltaX) ? e.deltaY : e.deltaX;
    if (!dx) return;

    e.preventDefault();

    // desativa o CSS snap durante o gesto
    const oldSnap = wrap.style.scrollSnapType;
    wrap.style.scrollSnapType = 'none';

    // move 1:1 com o gesto
    wrap.scrollLeft += dx;
    updateThumb();

    // quando parar de rolar, faz snap para o card mais próximo
    clearTimeout(wheelSnapTimer);
    wheelSnapTimer = setTimeout(() => {
      wrap.style.scrollSnapType = oldSnap;
      const i = Math.round(wrap.scrollLeft / step());
      wrap.scrollTo({ left: i * step(), behavior: 'smooth' });
    }, 90);
  }, { passive: false });

  /* ========= drag no conteúdo ========= */
  let down = false, startX = 0, startScroll = 0, pid = null;

  wrap.addEventListener('pointerdown', (e) => {
    if (e.target.closest('#depoTrack')) return; // se começou no slider, deixa o slider cuidar
    down = true; pid = e.pointerId; wrap.setPointerCapture(pid);
    startX = e.clientX; startScroll = wrap.scrollLeft;
    wrap.style.scrollSnapType = 'none';
  });

  wrap.addEventListener('pointermove', (e) => {
    if (!down) return;
    wrap.scrollLeft = startScroll - (e.clientX - startX);
    updateThumb();
  });

  function endDrag() {
    if (!down) return;
    down = false; try { wrap.releasePointerCapture(pid); } catch {}
    wrap.style.scrollSnapType = '';
    const i = Math.round(wrap.scrollLeft / step());
    wrap.scrollTo({ left: i * step(), behavior: 'smooth' });
  }
  wrap.addEventListener('pointerup', endDrag);
  wrap.addEventListener('pointercancel', endDrag);
  wrap.addEventListener('pointerleave', endDrag);

  /* ========= slider: clique no trilho ========= */
  track.addEventListener('pointerdown', (e) => {
    if (e.target === thumb) return; // o thumb tem handler próprio
    const r = track.getBoundingClientRect();
    const x = Math.min(Math.max(0, e.clientX - r.left), r.width);
    const ratio = x / r.width;
    wrap.scrollTo({ left: maxScroll() * ratio, behavior: 'smooth' });
  });

  /* ========= slider: arrastar o thumb ========= */
  let draggingThumb = false, tPid = null, startThumbX = 0, startThumbLeft = 0;

  function currentThumbLeft() {
    const m = getComputedStyle(thumb).transform;
    if (m && m !== 'none') {
      try { return new DOMMatrixReadOnly(m).m41 || 0; } catch { return 0; }
    }
    return 0;
  }

  thumb.addEventListener('pointerdown', (e) => {
    draggingThumb = true; tPid = e.pointerId; thumb.setPointerCapture(tPid);
    startThumbX = e.clientX;
    startThumbLeft = currentThumbLeft();
    wrap.style.scrollSnapType = 'none';
    e.preventDefault();
  });

  // usar o próprio thumb para receber os moves (com capture)
  thumb.addEventListener('pointermove', (e) => {
    if (!draggingThumb) return;
    const tw = trackW();
    const w  = thumb.clientWidth;
    const dx = e.clientX - startThumbX;
    const left = Math.min(Math.max(0, startThumbLeft + dx), tw - w);

    thumb.style.transform = `translateX(${left}px)`;

    // mapeia posição do thumb para o scroll da lista
    const ratio = (tw - w) ? (left / (tw - w)) : 0;
    wrap.scrollLeft = maxScroll() * ratio;
  }, { passive: false });

  function endThumbDrag() {
    if (!draggingThumb) return;
    draggingThumb = false;
    try { thumb.releasePointerCapture(tPid); } catch {}
    wrap.style.scrollSnapType = '';
    const i = Math.round(wrap.scrollLeft / step());
    wrap.scrollTo({ left: i * step(), behavior: 'smooth' });
    updateThumb();
  }
  thumb.addEventListener('pointerup', endThumbDrag);
  thumb.addEventListener('pointercancel', endThumbDrag);
  thumb.addEventListener('pointerleave', endThumbDrag);

  /* ========= teclado ========= */
  wrap.setAttribute('tabindex', '0');
  wrap.addEventListener('keydown', (e) => {
    if (e.key !== 'ArrowRight' && e.key !== 'ArrowLeft') return;
    wrap.scrollBy({ left: (e.key === 'ArrowRight' ? step() : -step()), behavior: 'smooth' });
  });

  /* ========= sincronização ========= */
    wrap.addEventListener('scroll', updateThumb, { passive: true });
    window.addEventListener('resize', updateThumb);
    requestAnimationFrame(updateThumb);
  })();
</script>



</body>
</html>
