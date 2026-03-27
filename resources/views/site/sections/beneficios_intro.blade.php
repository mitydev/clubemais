{{-- resources/views/site/sections/beneficios_intro.blade.php --}}
@php
  $d = config('pagebuilder.sections.beneficios_intro.defaults');
  $c = array_merge($d, (array) ($section->content ?? []));
  $cards = is_array($c['cards'] ?? null) ? $c['cards'] : [];
  $url = fn($p) => !$p ? '' : (preg_match('~^https?://|^/~',$p) ? $p : asset($p));
@endphp

<section class="bg-[#F4F1EA] pt-4 pb-4 section-beneficios-desc">
  <div class="max-w-[1440px] m-auto pt-[150px] section-content">
    <div class="w-full">
      <div class="grid grid-cols-5">
        <div class="col-span-2">
          <div class="max-w-[360px] m-auto">
            @if(!empty($c['title'])) <h1>{{ $c['title'] }}</h1> @endif
            @if(!empty($c['text']))  <p>{!! nl2br(e($c['text'])) !!}</p> @endif
          </div>
        </div>

        <div class="col-span-3 flex justify-center">
          @foreach($cards as $card)
            <div class="section-beneficios-content">
              <div class="relative">
                <div class="dot">
                  <img src="{{ asset('images/arrow_outward_white.svg') }}" alt="">
                </div>
                <img class="max-w-[343px] m-auto w-full" src="{{ $url($card['image'] ?? '') }}" alt="">
              </div>
              @if(!empty($card['caption']))
                <div class="px-6 pt-2">
                  <p>{!! nl2br(e($card['caption'])) !!}</p>
                </div>
              @endif
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
