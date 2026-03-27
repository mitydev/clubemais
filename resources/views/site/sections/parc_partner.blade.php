@php
  $d = [
    'title'       => 'Seja Parceiro',
    'lead'        => 'Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequís modic to berrovdiem. Musam aliquo optae que nonecul.',
    // campos do form (rótulos)
    'fields'      => [
      ['label'=>'Lorem Ipsum','name'=>'campo1','placeholder'=>''],
      ['label'=>'Lorem Ipsum','name'=>'campo2','placeholder'=>''],
      ['label'=>'Lorem Ipsum','name'=>'campo3','placeholder'=>''],
      ['label'=>'Lorem Ipsum','name'=>'campo4','placeholder'=>''],
    ],
    'button_text' => 'Lorem Ipsum',
    'anchor_id'   => 'seja-parceiro',
    'action'      => '#',
    'method'      => 'post',
  ];
  $c = array_merge($d, (array)($section->content ?? []));
  $fields = (array)$c['fields'];
@endphp

<section class="partner" id="{{ $c['anchor_id'] ?? 'seja-parceiro' }}">
  <div class="section-inner" style="margin-bottom:100px;">
    <header class="partner__head" style="margin:100px 0;">
      @if(!empty($c['title'])) <h2>{{ $c['title'] }}</h2> @endif
      @if(!empty($c['lead']))  <p>{{ $c['lead'] }}</p> @endif
    </header>

    <form class="partner__form" action="{{ $c['action'] }}" method="{{ $c['method'] }}">
      {{-- 1) linha full --}}
      @if(isset($fields[0]))
        <div class="partner__row">
          <label class="u-field">
            <span class="u-label">{{ $fields[0]['label'] ?? '' }}</span>
            <input class="u-input" type="text" name="{{ $fields[0]['name'] ?? 'campo1' }}" placeholder="{{ $fields[0]['placeholder'] ?? '' }}">
          </label>
        </div>
      @endif

      {{-- 2) linha em duas colunas --}}
      <div class="partner__row partner__row--2">
        @if(isset($fields[1]))
          <label class="u-field">
            <span class="u-label">{{ $fields[1]['label'] ?? '' }}</span>
            <input class="u-input" type="text" name="{{ $fields[1]['name'] ?? 'campo2' }}" placeholder="{{ $fields[1]['placeholder'] ?? '' }}">
          </label>
        @endif
        @if(isset($fields[2]))
          <label class="u-field">
            <span class="u-label">{{ $fields[2]['label'] ?? '' }}</span>
            <input class="u-input" type="text" name="{{ $fields[2]['name'] ?? 'campo3' }}" placeholder="{{ $fields[2]['placeholder'] ?? '' }}">
          </label>
        @endif
      </div>

      {{-- 3) linha full --}}
      @if(isset($fields[3]))
        <div class="partner__row">
          <label class="u-field">
            <span class="u-label">{{ $fields[3]['label'] ?? '' }}</span>
            <input class="u-input" type="text" name="{{ $fields[3]['name'] ?? 'campo4' }}" placeholder="{{ $fields[3]['placeholder'] ?? '' }}">
          </label>
        </div>
      @endif

      <button class="partner__btn" type="submit">{{ $c['button_text'] }}</button>
    </form>
  </div>
</section>
