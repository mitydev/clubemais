@php
  $d = config('pagebuilder.sections.oqe_depo.defaults');
  $c = array_merge($d, (array) ($section->content ?? []));
  $url = fn($p)=> !$p ? '' : (preg_match('~^(https?:)?//|^/~',$p) ? $p : asset($p));
  $items = is_array($c['items'] ?? null) ? $c['items'] : [];
@endphp

<section class="depo bg-[#39C0F2] relative overflow-hidden">
  <div class="depo-band" aria-hidden="true"></div>
  <div class="section-inner relative z-[1]">
    @if(!empty($c['title']))
      <h2 class="text-white text-[34px] md:text-[42px] font-extrabold mb-8">{{ $c['title'] }}</h2>
    @endif

    <div class="depo-wrap">
      <div id="dep-list" class="depo-list no-scrollbar snap-x snap-mandatory overflow-x-auto flex gap-8 md:gap-10 px-[var(--gutter)] pb-6">
        @foreach($items as $it)
          <article class="depo-card snap-center bg-white/98 rounded-[18px] md:rounded-[20px] shadow-[0_8px_20px_rgba(0,0,0,.12)]">
            <div class="flex items-center gap-3 mb-3">
              @if(!empty($it['avatar'])) <img class="w-10 h-10 rounded-full object-cover" src="{{ $url($it['avatar']) }}" alt=""> @endif
              <div>
                <div class="font-semibold text-[#212121]">{{ $it['name'] ?? '' }}</div>
                @if(!empty($it['role'])) <div class="text-xs text-black/60 leading-none mt-0.5">{{ $it['role'] }}</div> @endif
              </div>
            </div>
            @if(!empty($it['text'])) <p class="text-[15px] leading-relaxed text-black/80">{{ $it['text'] }}</p> @endif
          </article>
        @endforeach
      </div>

      <div class="depo-progress">
        <div id="depoTrack" class="depo-progress__track">
          <div id="depoThumb" class="depo-progress__thumb"></div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Reusa o mesmo JS da sua página estática (pode extrair para um arquivo e incluir no layout) --}}
@include('site.sections.partials.depo_script')
