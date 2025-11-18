{{-- resources/views/site/sections/faq.blade.php --}}
@php
use Illuminate\Support\Arr;

$d = config('pagebuilder.sections.faq.defaults');
$c = array_merge($d, (array) ($section->content ?? []));

$title = $c['title'] ?? null;
$items = collect($c['items'] ?? [])
  ->filter(fn($it) => !empty(Arr::get($it, 'q')) || !empty(Arr::get($it, 'a')))
  ->values();
@endphp

@if ($items->isNotEmpty())

<style>
  .faq-section .faq-shell {
    border-radius: 1.5rem;
    border: 1px solid #e5e7eb;
    background: #ffffff;
    box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
    padding: 1.25rem 1rem;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
  }

  @media (min-width: 768px) {
    .faq-section .faq-shell {
      padding: 1.75rem 2rem;
      gap: 1rem;
    }
  }

  .faq-item {
    border-radius: 1.25rem;
    border: 1px solid #e5e7eb;
    background: #ffffff;
    overflow: hidden;
    transition:
      box-shadow .25s ease,
      transform .18s ease,
      background-color .2s ease;
  }

  .faq-item:hover {
    box-shadow: 0 16px 30px rgba(15, 23, 42, 0.06);
    transform: translateY(-1px);
  }

  /* estado aberto: destaque leve */
  .faq-item[data-open="true"] .faq-toggle {
    background: #f9fafb;
  }

  .faq-item[data-open="true"] .faq-icon {
    border-color: #F46E00;
    color: #F46E00;
  }

  .faq-panel {
    overflow: hidden;
    max-height: 0;
    opacity: 0;
    transform: translateY(-4px);
    transition:
      max-height .45s cubic-bezier(.25,.8,.25,1),
      opacity .35s ease,
      transform .35s ease;
  }
</style>

<section class="faq-section py-10 md:py-16 bg-[#F4F4F4]" aria-labelledby="faq-title">
  <div class="max-w-[960px] mx-auto px-4 sm:px-6">

    @if ($title)
      <div class="text-center mb-8 md:mb-10">
        <h2 id="faq-title"
            class="text-[#F46E00] text-[28px] sm:text-[32px] md:text-[40px] font-semibold leading-tight">
          {!! $title !!}
        </h2>
        <div class="mt-3 flex justify-center">
          <span class="h-[3px] w-16 rounded-full bg-[#F46E00]"></span>
        </div>
      </div>
    @endif

    <div class="faq-shell">
      @foreach ($items as $idx => $item)
        @php
          $q = $item['q'] ?? '';
          $a = $item['a'] ?? '';
          $rowId    = 'faq-item-'.$section->id.'-'.$idx;
          $panelId  = $rowId.'-panel';
          $buttonId = $rowId.'-button';
          $isOpen   = $idx === 0;
        @endphp

        <article class="faq-item" data-open="{{ $isOpen ? 'true' : 'false' }}">
          <button
            id="{{ $buttonId }}"
            class="w-full flex items-center justify-between gap-4 px-5 sm:px-7 py-5 sm:py-6 text-left faq-toggle hover:bg-gray-50/60 transition-colors"
            type="button"
            aria-expanded="{{ $isOpen ? 'true' : 'false' }}"
            aria-controls="{{ $panelId }}"
            data-faq-index="{{ $idx }}"
          >
            {{-- PERGUNTA: maior, com mais presença --}}
            <span class="text-[16px] sm:text-[18px] md:text-[19px] font-semibold text-gray-900 tracking-[0.01em]">
              {{ $q }}
            </span>

            <span class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-full border border-gray-300 bg-white text-gray-700 faq-icon shadow-sm">
              <svg class="w-4 h-4 plus {{ $isOpen ? 'hidden' : '' }}" viewBox="0 0 20 20" fill="none">
                <path d="M10 4v12M4 10h12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
              </svg>
              <svg class="w-4 h-4 minus {{ $isOpen ? '' : 'hidden' }}" viewBox="0 0 20 20" fill="none">
                <path d="M4 10h12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
              </svg>
            </span>
          </button>

          {{-- RESPOSTA: um pouco menor e mais leve --}}
          <div
            id="{{ $panelId }}"
            class="faq-panel px-5 sm:px-7 pb-5 sm:pb-6 text-[14px] sm:text-[15px] leading-relaxed text-gray-700"
            role="region"
            aria-labelledby="{{ $buttonId }}"
            data-open="{{ $isOpen ? 'true' : 'false' }}"
          >
            {!! nl2br(e($a)) !!}
          </div>
        </article>
      @endforeach
    </div>
  </div>
</section>

@push('page-scripts')
<script>
(function(){
  var root = document.currentScript.closest('.faq-section');
  if (!root) root = document.querySelector('.faq-section');
  if (!root) return;

  var items = root.querySelectorAll('.faq-item');
  if (!items.length) return;

  function openPanel(panel, btn, iconPlus, iconMinus) {
    const item = btn.closest('.faq-item');
    if (item) item.dataset.open = 'true';

    btn.setAttribute('aria-expanded', 'true');
    panel.dataset.open = 'true';
    panel.style.maxHeight = panel.scrollHeight + 'px';
    panel.style.opacity   = '1';
    panel.style.transform = 'translateY(0)';
    if (iconPlus && iconMinus) {
      iconPlus.classList.add('hidden');
      iconMinus.classList.remove('hidden');
    }
  }

  function closePanel(panel, btn, iconPlus, iconMinus) {
    const item = btn.closest('.faq-item');
    if (item) item.dataset.open = 'false';

    btn.setAttribute('aria-expanded', 'false');
    panel.dataset.open = 'false';
    panel.style.maxHeight = '0px';
    panel.style.opacity   = '0';
    panel.style.transform = 'translateY(-4px)';
    if (iconPlus && iconMinus) {
      iconPlus.classList.remove('hidden');
      iconMinus.classList.add('hidden');
    }
  }

  items.forEach(function(item){
    var btn   = item.querySelector('.faq-toggle');
    var panel = item.querySelector('.faq-panel');
    var icon  = item.querySelector('.faq-icon');
    if (!btn || !panel || !icon) return;

    var plus  = icon.querySelector('.plus');
    var minus = icon.querySelector('.minus');
    var isOpen = btn.getAttribute('aria-expanded') === 'true';

    if (isOpen) {
      item.dataset.open = 'true';
      panel.style.maxHeight = panel.scrollHeight + 'px';
      panel.style.opacity   = '1';
      panel.style.transform = 'translateY(0)';
    } else {
      item.dataset.open = 'false';
      panel.style.maxHeight = '0px';
    }

    btn.addEventListener('click', function(){
      var currentlyOpen = btn.getAttribute('aria-expanded') === 'true';

      items.forEach(function(other){
        var b  = other.querySelector('.faq-toggle');
        var p  = other.querySelector('.faq-panel');
        var ic = other.querySelector('.faq-icon');
        if (!b || !p || !ic) return;
        var pl = ic.querySelector('.plus');
        var mn = ic.querySelector('.minus');
        closePanel(p, b, pl, mn);
      });

      if (!currentlyOpen) {
        openPanel(panel, btn, plus, minus);
      }
    });
  });

  window.addEventListener('resize', function(){
    items.forEach(function(item){
      var panel = item.querySelector('.faq-panel');
      var btn   = item.querySelector('.faq-toggle');
      if (!panel || !btn) return;
      if (btn.getAttribute('aria-expanded') === 'true') {
        panel.style.maxHeight = panel.scrollHeight + 'px';
      }
    });
  });
})();
</script>
@endpush
@endif
