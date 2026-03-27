@php
  $d = config('pagebuilder.sections.oqe_hero.defaults');
  $c = array_merge($d, (array) ($section->content ?? []));
  $url = fn($p)=> !$p ? '' : (preg_match('~^(https?:)?//|^/~',$p) ? $p : asset($p));
  $sentences = preg_split('/(?<=[.!?])\s+|[\r\n]+/u', trim((string)$c['text']), -1, PREG_SPLIT_NO_EMPTY);
@endphp

<section>
  <figure class="hero-band">
    <img class="hero-photo" src="{{ $url($c['bg_image']) }}" alt="{{ strip_tags($c['title']) ?: 'Hero' }}">
    <div class="hero-panel">
      <div class="hero-panel__inner">
        @if(!empty($c['title'])) <h1>{!! $c['title'] !!}</h1> @endif
        @foreach($sentences as $s) <p>{{ $s }}</p> @endforeach
      </div>
    </div>
  </figure>
</section>
