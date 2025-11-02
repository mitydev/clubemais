{{-- resources/views/site/sections/beneficios_numbers.blade.php --}}
@php
  $d = config('pagebuilder.sections.beneficios_numbers.defaults');
  $c = array_merge($d, (array) ($section->content ?? []));
  $items = is_array($c['items'] ?? null) ? $c['items'] : [];
  $url = fn($p) => !$p ? '' : (preg_match('~^https?://|^/~',$p) ? $p : asset($p));
@endphp

@if(!empty($items))
<section class="bg-[#F4F1EA] pb-8">
  <div class="max-w-[1440px] m-auto number-contents">
    @foreach($items as $it)
      <div class="box">
        <div class="box-icon">
          @if(!empty($it['icon']))
            <img src="{{ $url($it['icon']) }}" alt="">
          @endif
        </div>
        <div class="box-description">
          <p>
            @if(!empty($it['value'])) <span>{{ $it['value'] }}</span><br>@endif
            {{ $it['label'] ?? '' }}
          </p>
        </div>
      </div>
    @endforeach
  </div>
</section>
@endif
