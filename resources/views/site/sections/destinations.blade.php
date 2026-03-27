{{-- resources/views/site/sections/destinations.blade.php --}}
@php
use App\Models\Destination;
use Illuminate\Support\Facades\Storage;

$d = config('pagebuilder.sections.destinations.defaults');
$c = array_merge($d, (array) ($section->content ?? []));
$meta = (array) ($section->meta ?? []);
$groupId = $meta['destination_group_id'] ?? null;
$ordMeta = $meta['destination_order'] ?? 'created_desc';

[$col, $dir] = match ($ordMeta) {
  'created_asc' => ['created_at', 'asc'],
  'created_desc' => ['created_at', 'desc'],
  'title_asc' => ['title', 'asc'],
  'title_desc' => ['title', 'desc'],
  'position_asc' => ['position', 'asc'],
  'position_desc' => ['position', 'desc'],
  default => ['created_at', 'desc'],
};

$items = $groupId
  ? Destination::query()
      ->where('destination_group_id', $groupId)
      ->where('is_active', true)
      ->orderBy($col, $dir)
      ->get()
  : collect();
@endphp

@if ($items->isNotEmpty())
<style>
  @media (min-width: 1024px) {
    .dest-flex {
      display: flex;
      gap: 1.5rem;
      overflow-x: auto;
      overflow-y: hidden;
      scroll-behavior: smooth;
      scrollbar-width: thin;
      padding-bottom: 1rem;
      -webkit-overflow-scrolling: touch;
      pointer-events: auto;
      width: 100%;
    }
    .dest-flex::-webkit-scrollbar { height: 8px; }
    .dest-flex::-webkit-scrollbar-track { background: #d1d1d1; border-radius: 4px; }
    .dest-flex::-webkit-scrollbar-thumb { background: #F46E00; border-radius: 4px; }
    .dest-flex::-webkit-scrollbar-thumb:hover { background: #d85f00; }

    .dest-card {
      flex: 0 0 auto;
      width: 320px;
      max-width: 320px;
      min-width: 320px;
      transition: all .35s ease;
      border-radius: 1.5rem;
      cursor: pointer;
      will-change: width, transform;
    }
    .dest-card.active {
      width: 580px;
      max-width: 580px;
      min-width: 580px;
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .dest-card-link { pointer-events: none; }
    .dest-card.active .dest-card-link { pointer-events: auto; cursor: pointer; }

    .destination-button .btn-pill {
      width: max-content;
      max-width: 100%;
      transition: width .25s ease, background-color .2s ease, color .2s ease, padding .2s ease;
      pointer-events: auto;
    }
    .dest-card:hover .destination-button .btn-pill,
    .dest-card.active .destination-button .btn-pill {
      width: 100%;
      padding-left: 1.25rem;
      padding-right: 1.25rem;
    }

    .destination-text-description {
      opacity: 0;
      max-height: 0;
      overflow: hidden;
      transition: opacity .3s ease, max-height .3s ease;
    }
    .dest-card.active .destination-text-description {
      opacity: 1;
      max-height: 200px;
    }

    .scroll-nav {
      display: flex !important;
      justify-content: center;
      align-items: center;
      gap: 0.75rem;
      margin-top: 1.5rem;
      padding-bottom: 1rem;
      width: 100%;
    }
    .scroll-btn {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: white;
      border: 2px solid #F46E00;
      color: #F46E00;
      display: flex !important;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all .25s ease;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      flex-shrink: 0;
    }
    .scroll-btn:hover:not(:disabled) {
      background: #F46E00;
      color: white;
      transform: scale(1.1);
      box-shadow: 0 4px 12px rgba(244,110,0,0.3);
    }
    .scroll-btn:disabled {
      opacity: 0.3;
      cursor: not-allowed;
      border-color: #ccc;
      color: #ccc;
    }
    .scroll-btn svg { width: 20px; height: 20px; }
  }

  /* mobile/tablet */
  @media (max-width: 1023.98px) {
    .dest-flex {
      display: flex;
      flex-direction: column;
      align-items: stretch;
      gap: 1rem;
      padding: 0 1rem 0.5rem;
      width: 100%;
    }
    .dest-card {
      box-sizing: border-box;
      flex: 1 1 auto !important;
      width: 100% !important;
      max-width: none !important;
      min-width: 0 !important;
      cursor: pointer;
      border-radius: 1rem;
      min-height: clamp(340px, 60vh, 480px) !important;
    }
    .dest-card-link { pointer-events: auto; }

    .destination-description { padding: 1.25rem !important; }
    .destination-text-title { font-size: 1.5rem !important; }

    .destination-text-description {
      opacity: 1;
      max-height: none;
      font-size: 0.875rem !important;
      line-height: 1.4;
    }

    .scroll-nav { display: none !important; }
  }

  /* Tablets portrait e mobile landscape (768–1023px) */
  @media (min-width: 768px) and (max-width: 1023.98px) {
    .dest-card { min-height: clamp(420px, 65vh, 540px) !important; }
    .destination-description { padding: 1.5rem !important; }
    .destination-text-title { font-size: 1.75rem !important; }
  }

  /* Mobile pequeno (<=480px) */
  @media (max-width: 480px) {
    .dest-card { min-height: 340px !important; }
    .destination-description { padding: 1rem !important; }
    .destination-text-title { font-size: 1.25rem !important; }
    .destination-text-description { font-size: 0.8125rem !important; }
    .btn-pill { padding: 0.5rem 1rem !important; font-size: 0.875rem !important; }
  }
</style>


<section aria-labelledby="destinations-title">
  <div class="max-w-[1920px] bg-[#E1E1E1] pt-6 md:pt-10 pb-6 md:pb-10 mx-auto">
    <div class="max-w-[1280px] mx-auto px-4 sm:px-6">
      @if (!empty($c['title']))
      <h2 id="destinations-title" class="text-[#F46E00] text-[30px] sm:text-[42px] md:text-[54px] leading-tight max-w-[680px] mb-4 md:mb-0">
        {!! $c['title'] !!}
      </h2>
      @endif

      <div class="destination-content mt-4 md:mt-6 dest-flex">
        @foreach ($items as $idx => $dest)
          @php
            $img = $dest->image_path ? Storage::url($dest->image_path) : '';
            $title = $dest->title;
            $desc = $dest->excerpt;
            $link = $dest->link_url ?: '#';
          @endphp
          
          <article 
            class="destination-block dest-card bg-center bg-cover bg-no-repeat overflow-hidden shadow-sm {{ $idx === 0 ? 'active' : '' }}" 
            style="background-image:url('{{ $img }}'); min-height: 460px;" 
            data-index="{{ $idx }}"
            data-link="{{ $link }}"
            tabindex="0"
            role="button"
            aria-pressed="{{ $idx === 0 ? 'true' : 'false' }}"
          >
            <a href="{{ $link }}" class="dest-card-link absolute inset-0" aria-label="{{ $c['button_text'] }} – {{ $title }}"></a>
            
            <div class="destination-description relative z-[1] h-full flex flex-col justify-end p-5 md:p-6 bg-gradient-to-t from-black/60 to-transparent text-white pointer-events-none">
              <h3 class="destination-text-title text-2xl font-semibold drop-shadow">{{ $title }}</h3>
              
              @if ($desc)
              <p class="destination-text-description text-white/90 mt-1 text-sm">{{ $desc }}</p>
              @endif
              
              <div class="destination-button mt-3 pointer-events-auto">
                <a href="{{ $link }}" class="btn-pill inline-flex items-center justify-between rounded-full px-5 py-2 font-medium bg-white text-black hover:bg-gray-100 transition-colors">
                  <span>{{ $c['button_text'] }}</span>
                  <span class="ml-2 inline-block" aria-hidden="true">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path d="M12.172 7 6.808 1.636 8.222.222 16 8l-7.778 7.778-1.414-1.414L12.172 9H0V7h12.172Z"/>
                    </svg>
                  </span>
                </a>
              </div>
            </div>
          </article>
        @endforeach
      </div>
      
      <!-- Botões de navegação (apenas desktop) -->
      <div class="scroll-nav">
        <button class="scroll-btn scroll-prev" aria-label="Anterior">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"></polyline>
          </svg>
        </button>
        <button class="scroll-btn scroll-next" aria-label="Próximo">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </button>
      </div>
    </div>
  </div>
</section>

@push('page-scripts')
<script>
(function(){
  var wrap = document.querySelector('.destination-content');
  if (!wrap) return;
  
  var cards = Array.from(wrap.querySelectorAll('.dest-card'));
  if (cards.length < 2) return;

  var isScrolling = false;
  var scrollTimeout;
  var prevBtn = document.querySelector('.scroll-prev');
  var nextBtn = document.querySelector('.scroll-next');

  function setActive(card, scroll = true){
    cards.forEach(c => {
      c.classList.remove('active');
      c.setAttribute('aria-pressed', 'false');
    });
    card.classList.add('active');
    card.setAttribute('aria-pressed', 'true');
    
    // Atualiza estado dos botões
    updateButtons();
    
    // Auto-scroll para centralizar o card ativo (apenas desktop)
    if (scroll && window.innerWidth >= 1024 && !isScrolling) {
      requestAnimationFrame(function(){
        const cardRect = card.getBoundingClientRect();
        const wrapRect = wrap.getBoundingClientRect();
        const scrollLeft = wrap.scrollLeft;
        
        // Calcula a posição para centralizar o card
        const cardLeft = cardRect.left - wrapRect.left + scrollLeft;
        const cardCenter = cardLeft + (cardRect.width / 2);
        const wrapCenter = wrap.clientWidth / 2;
        const targetScroll = cardCenter - wrapCenter;
        
        wrap.scrollTo({
          left: Math.max(0, targetScroll),
          behavior: 'smooth'
        });
      });
    }
  }

  function updateButtons(){
    if (!prevBtn || !nextBtn || window.innerWidth < 1024) return;
    
    var activeIndex = cards.findIndex(c => c.classList.contains('active'));
    
    // Desabilita prev se estiver no primeiro
    prevBtn.disabled = activeIndex === 0;
    
    // Desabilita next se estiver no último
    nextBtn.disabled = activeIndex === cards.length - 1;
  }

  function scrollToCard(direction){
    if (window.innerWidth < 1024) return;
    
    var activeIndex = cards.findIndex(c => c.classList.contains('active'));
    var newIndex;
    
    if (direction === 'next' && activeIndex < cards.length - 1) {
      newIndex = activeIndex + 1;
    } else if (direction === 'prev' && activeIndex > 0) {
      newIndex = activeIndex - 1;
    }
    
    if (newIndex !== undefined && cards[newIndex]) {
      setActive(cards[newIndex], true);
    }
  }

  // Botões de navegação
  if (prevBtn) {
    prevBtn.addEventListener('click', function(){
      scrollToCard('prev');
    });
  }
  
  if (nextBtn) {
    nextBtn.addEventListener('click', function(){
      scrollToCard('next');
    });
  }

  // Detecta quando o usuário está scrollando manualmente
  wrap.addEventListener('scroll', function(){
    isScrolling = true;
    clearTimeout(scrollTimeout);
    scrollTimeout = setTimeout(function(){
      isScrolling = false;
    }, 150);
  }, { passive: true });

  // Click no card (desktop): ativa ou navega
  cards.forEach(card => {
    card.addEventListener('click', function(e){
      if (window.innerWidth >= 1024) {
        // Se clicou no botão, deixa navegar
        if (e.target.closest('.btn-pill')) {
          return;
        }
        
        // Se não está ativo, apenas ativa
        if (!card.classList.contains('active')) {
          e.preventDefault();
          e.stopPropagation();
          setActive(card, true);
        }
        // Se já está ativo e clicou no card (não no botão), navega
        else {
          window.location.href = card.dataset.link;
        }
      }
    });
  });

  // mouse hover (apenas desktop e quando não está scrollando)
  cards.forEach(card => {
    card.addEventListener('mouseenter', function(){
      if (window.innerWidth >= 1024 && !isScrolling) {
        setActive(card, false);
      }
    });
  });

  // teclado (acessibilidade)
  cards.forEach(card => {
    card.addEventListener('focus', function(){
      if (window.innerWidth >= 1024) {
        setActive(card, true);
      }
    });
    
    // Enter ou Space no card ativo navega
    card.addEventListener('keydown', function(e){
      if ((e.key === 'Enter' || e.key === ' ') && card.classList.contains('active')) {
        e.preventDefault();
        window.location.href = card.dataset.link;
      }
    });
  });

  // opcional: volta ao primeiro quando sai do container
  wrap.addEventListener('mouseleave', function(){
    if (window.innerWidth >= 1024 && !isScrolling) {
      setActive(cards[0], false);
    }
  });

  // Ajusta no resize
  var resizeTimeout;
  window.addEventListener('resize', function(){
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(function(){
      var activeCard = wrap.querySelector('.dest-card.active');
      if (activeCard && window.innerWidth >= 1024) {
        setActive(activeCard, false);
      }
      updateButtons();
    }, 250);
  });
  
  // Inicializa estado dos botões
  updateButtons();
})();
</script>
@endpush
@endif