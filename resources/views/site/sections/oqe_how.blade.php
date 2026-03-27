@php
  $d = config('pagebuilder.sections.oqe_how.defaults');
  $c = array_merge($d, (array) ($section->content ?? []));
  $url = fn($p)=> !$p ? '' : (preg_match('~^(https?:)?//|^/~',$p) ? $p : asset('images/o-que-e/'.$p));
  $steps = is_array($c['steps'] ?? null) ? $c['steps'] : [];
@endphp

<section class="bg-white">
  <div class="section-inner">
    @if(!empty($c['title']))
      <h2 class="how-title text-[34px] md:text-[42px] mb-3">{{ $c['title'] }}</h2>
    @endif
    @if(!empty($c['lead']))
      <p class="how-lead text-black/70 mb-10 md:mb-12 max-w-2xl">{{ $c['lead'] }}</p>
    @endif
  </div>

  @if($steps)
    <div class="section-inner">
      <ol class="timeline5">
        @foreach($steps as $i => $s)
          @php $pos = in_array($i, [1,3]) ? 'up' : 'down'; @endphp
          <li class="tl-item {{ $pos }} {{ $pos==='up' ? 'blue' : 'orange' }}">
            <div class="tl-center">
              <span class="tl-dot"></span>
              <span class="tl-connector"></span>
              <div class="tl-hexwrap">
                <div class="how-hex" aria-hidden="true">
                  <svg viewBox="0 0 100 100"><polygon points="25,6.7 75,6.7 100,50 75,93.3 25,93.3 0,50"/></svg>
                  @if(!empty($s['icon']))
                    <img src="{{ $url($s['icon']) }}" alt="">
                  @endif
                </div>
              </div>
            </div>
            <div class="tl-text">
              <div class="tl-slot">
                @if(!empty($s['title'])) <h3 class="font-semibold text-[#6C6C6C]">{{ $s['title'] }}</h3> @endif
                @if(!empty($s['desc']))  <p class="text-sm text-[#6C6C6C] mt-1 leading-relaxed">{{ $s['desc'] }}</p> @endif
              </div>
            </div>
          </li>
        @endforeach
      </ol>
    </div>
  @endif
</section>
