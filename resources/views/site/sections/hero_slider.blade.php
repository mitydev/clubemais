@php
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

$d = config('pagebuilder.sections.hero_slider.defaults');
$c = array_merge($d, (array) ($section->content ?? []));
$meta = (array) ($section->meta ?? []);

$height      = $c['height'] ?? '90vh';
$overlay     = $c['overlay'] ?? 'rgba(0,0,0,.25)';
$autoplay    = (bool) ($c['autoplay'] ?? true);
$delayMs     = (int)  ($c['delay_ms'] ?? 4000);
$captionShow = (bool) ($c['caption_show'] ?? $d['caption_show']);

$groupId = $meta['banner_group_id'] ?? null;

if ($groupId) {
  $slides = Banner::query()
      ->where('group_banner_id', $groupId)
      ->where('is_active', true)
      ->where(fn($w) => $w->whereNull('starts_at')->orWhere('starts_at','<=',now()))
      ->where(fn($w) => $w->whereNull('ends_at')->orWhere('ends_at','>=',now()))
      ->orderBy('position')
      ->get();
} else {
  $slides = collect($section?->banners ?? []);
}

/** NÃO recalcular $isHome aqui. Use o valor vindo do include.
 *  Fallback apenas se não vier do pai. */
$isHomeLocal = isset($isHome) ? (bool)$isHome : (
       request()->routeIs('home')
    || url()->current() === url('/')
    || request()->getPathInfo() === '/'
);
@endphp

@if($slides->isNotEmpty())
<section class="relative w-full"
         data-hero-slider
         style="--hero-h: {{ $height }}; min-height: var(--hero-h);">

  <div class="relative w-full overflow-hidden"
       style="min-height: var(--hero-h);"
       data-hero-autoplay="{{ $autoplay ? '1' : '0' }}"
       data-hero-delay="{{ $delayMs }}">

    @foreach($slides as $i => $b)
      @php
        $img  = !empty($b->image_path) ? Storage::url($b->image_path) : ($b->image_url ?? '');
        if (!$img) continue;
        $href = $b->link_url ?? '#';
        $alt  = $b->alt_text ?? $b->title ?? 'Slide';
      @endphp

      <a data-hero-slide
         class="block w-full h-full absolute inset-0 transition-opacity duration-700 {{ $i === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}"
         href="{{ $href }}"
         style="background-image:url('{{ $img }}'); background-size:cover; background-position:center;">
        @if($captionShow)<span class="sr-only">{{ $alt }}</span>@endif
      </a>
    @endforeach

    <button type="button"
            class="hero-nav hero-prev absolute left-3 md:left-5 top-1/2 -translate-y-1/2 z-20
                   w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/70 backdrop-blur
                   flex items-center justify-center shadow hover:bg-white focus:outline-none"
            aria-label="Slide anterior">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>
    <button type="button"
            class="hero-nav hero-next absolute right-3 md:right-5 top-1/2 -translate-y-1/2 z-20
                   w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/70 backdrop-blur
                   flex items-center justify-center shadow hover:bg-white focus:outline-none"
            aria-label="Próximo slide">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>
  </div>

  <div class="pointer-events-none absolute inset-0 z-10" style="background: {{ $overlay }};"></div>

  @if($isHomeLocal)
    <div class="absolute left-1/2 bottom-6 md:bottom-12 -translate-x-1/2 z-30 w-full max-w-[1204px] px-4 sm:px-6">
      <div class="bg-white rounded-3xl p-3 sm:p-4 shadow-xl">
        <div id="otabuilder-widget"></div>
      </div>
    </div>
  @endif
</section>

<script>
(function () {
  'use strict';
  function bootAll(){ document.querySelectorAll('section[data-hero-slider]').forEach(initSlider); }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', bootAll, {once:true}); else bootAll();

  function initSlider(section){
    if (section.dataset.heroInitialized === '1') return;
    section.dataset.heroInitialized = '1';

    const cont    = section.querySelector('[data-hero-autoplay]');
    if (!cont) return;

    const slides  = Array.from(cont.querySelectorAll('[data-hero-slide]'));
    const prevBtn = cont.querySelector('.hero-prev');
    const nextBtn = cont.querySelector('.hero-next');

    if (slides.length <= 1){
      cont.querySelectorAll('.hero-nav').forEach(n => n.style.display = 'none');
      return;
    }

    const autoplay = cont.dataset.heroAutoplay === '1';
    const delay    = parseInt(cont.dataset.heroDelay || '5000', 10);

    let i = Math.max(0, slides.findIndex(s => s.classList.contains('opacity-100')));
    if (i < 0) i = 0;

    slides.forEach((s, idx) => {
      s.classList.toggle('opacity-100', idx === i);
      s.classList.toggle('opacity-0',   idx !== i);
      s.classList.toggle('z-10',        idx === i);
      s.classList.toggle('z-0',         idx !== i);
    });

    function show(n){
      const next = (n + slides.length) % slides.length;
      if (next === i) return;
      slides[i].classList.remove('opacity-100','z-10');
      slides[i].classList.add('opacity-0','z-0');
      slides[next].classList.remove('opacity-0','z-0');
      slides[next].classList.add('opacity-100','z-10');
      i = next;
    }

    let timer = null;
    function startAuto(){ if (autoplay){ stopAuto(); timer = setInterval(() => show(i+1), isNaN(delay)?5000:delay); } }
    function stopAuto(){ if (timer){ clearInterval(timer); timer = null; } }

    prevBtn?.addEventListener('click', () => { show(i-1); startAuto(); });
    nextBtn?.addEventListener('click', () => { show(i+1); startAuto(); });

    startAuto();
  }
})();
</script>
@endif
