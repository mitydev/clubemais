{{-- resources/views/site/sections/advantages.blade.php --}}
@php
  use Illuminate\Support\Str;

  $d = config('pagebuilder.sections.advantages.defaults');
  $c = array_merge($d, (array) ($section->content ?? []));

  $bgImage = $c['bg_image'] ?? asset('images/vantagens.png');
  $height  = $c['height']   ?? '636px';
  $title   = $c['title']    ?? 'Conheça as vantagens e assinaturas do Clube+';

  $items   = is_array($c['items']  ?? null) ? $c['items']  : [];
  $badges  = is_array($c['badges'] ?? null) ? $c['badges'] : [];

  $ctaText = $c['cta_text'] ?? 'ASSINE JÁ';
  $ctaUrl  = $c['cta_url']  ?? '#';

  // id único para o clipPath
  $clipId = 'shape-' . Str::uuid()->toString();
@endphp

<section class="bg-[#F4F1EA] section-vantagens">
  <div
    class="max-w-[1920px] mx-auto h-[{{ $height }}] p-4 bg-left bg-no-repeat"
    style="background-size:1440px; background-image:url('{{ $bgImage }}')"
  >
    <div class="max-w-[600px] m-[50px]">
      <h2 class="font-semibold text-[50px]">{{ $title }}</h2>
    </div>

    @if(!empty($items))
      <div class="flex max-w-[620px] ml-[60px] mt-[90px] justify-between relative">
        @foreach($items as $it)
          @php
            $icon  = $it['icon']  ?? null;
            $label = $it['title'] ?? '';
          @endphp

          <div class="relative">
            <div class="dot">
              <img src="{{ asset('images/arrow_outward.svg') }}" alt="">
            </div>

            <div class="relative"
                 style="-webkit-clip-path:url('#{{ $clipId }}'); clip-path:url('#{{ $clipId }}'); width:178px; height:243px; background:#E8CC00; padding-top:40px;">
              <div class="h-max">
                <div class="h-max p-4">
                  @if($icon)
                    <img src="{{ $icon }}" class="mb-4" alt="">
                  @endif
                  <p class="font-bold" style="font-size:20px">{{ $label }}</p>
                </div>
              </div>
            </div>
          </div>
        @endforeach

        @if(!empty($ctaText))
          {{-- CTA desktop com estilo inline (não depende de home.css) --}}
        <div class="absolute bottom-0 button-assine-ja"
            style="transform: translate(-6%, 8px);">
          <a href="{{ $ctaUrl }}"
            class="btn-assine"
            style="display:inline-flex;align-items:center;justify-content:center;height:64px;padding:0 28px;border-radius:9999px;background:#39C0F2;color:#fff;font-weight:700;font-size:28px;line-height:1;white-space:nowrap;text-decoration:none;box-shadow:0 16px 40px rgba(57,192,242,.35);">
            {{ $ctaText }}
          </a>
        </div>
        @endif
      </div>
    @endif

    @if(!empty($badges))
      <div class="max-w-full my-4 mx-4 grid grid-cols-2">
        <div class="flex w-full max-w-full m-auto justify-between">
          @foreach($badges as $logo)
            <div class="badge">
              <img src="{{ $logo }}" alt="">
            </div>
          @endforeach
        </div>
      </div>
    @endif

    @if(!empty($ctaText))
      {{-- CTA mobile (fica full-width, como no seu CSS) --}}
      <div class="button-assine-ja-mobile" style="padding:0 16px; margin-top:12px; display:none;">
        <a href="{{ $ctaUrl }}"
           style="
             display:block; width:100%; height:56px; border-radius:9999px;
             background:#39C0F2; color:#fff; font-weight:600; font-size:20px;
             line-height:56px; text-align:center; text-decoration:none;
           ">
          {{ $ctaText }}
        </a>
      </div>
      {{-- Ativa o CTA mobile via media query (fallback caso home.css não carregue) --}}
      <style>
        @media (max-width: 1023px){
          .section-vantagens .flex.max-w-\[620px\] .button-assine-ja{ display:none !important; }
          .section-vantagens .button-assine-ja-mobile{ display:block !important; }
        }
      </style>
    @endif

    {{-- defs do clipPath (id único) --}}
    <svg width="0" height="0" aria-hidden="true" focusable="false">
      <defs>
        <clipPath id="{{ $clipId }}" clipPathUnits="userSpaceOnUse">
          <path d="M17.9365 1.46045H120.665C128.794 1.46052 135.384 8.05028 135.384 16.1792V24.8765C135.384 35.0585 143.638 43.3128 153.82 43.313H162.518C170.646 43.3132 177.236 49.9028 177.236 58.0317V224.354C177.236 233.984 169.43 241.79 159.8 241.791H17.9365C8.30672 241.79 0.500214 233.984 0.5 224.354V18.897C0.50008 9.26708 8.30663 1.46053 17.9365 1.46045Z"/>
        </clipPath>
      </defs>
    </svg>
  </div>
</section>
