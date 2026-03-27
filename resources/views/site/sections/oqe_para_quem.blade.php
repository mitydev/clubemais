@php
  $d = config('pagebuilder.sections.oqe_para_quem.defaults');
  $c = array_merge($d, (array) ($section->content ?? []));
  $url = fn($p)=> !$p ? '' : (preg_match('~^(https?:)?//|^/~',$p) ? $p : asset($p));
  $paras = preg_split('/(?<=[.!?])\s+|[\r\n|]+/u', trim((string)$c['text']), -1, PREG_SPLIT_NO_EMPTY);
@endphp

<section class="pq">
  <div class="section-inner">
    <div class="pq-wrap align-with-timeline">
      <div>
        @if(!empty($c['title'])) <h2>{{ $c['title'] }}</h2> @endif
        <div class="pq-copy">
          @foreach($paras as $p) <p>{{ $p }}</p> @endforeach
        </div>
      </div>
      <figure class="pq-art">
        @if(!empty($c['art_image']))
          <img src="{{ $url($c['art_image']) }}" alt="">
        @endif
      </figure>
    </div>
  </div>
</section>
