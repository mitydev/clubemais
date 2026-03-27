@php
  $d = config('pagebuilder.sections.oque_e.defaults');
  $c = array_merge($d, (array) ($section->content ?? []));

  // compat: se existir apenas 'kicker' antigo, usa como título
  $kTitle = trim((string)($c['kicker_title'] ?? $c['kicker'] ?? ''));
  $kText  = trim((string)($c['kicker_text']  ?? ''));

  // helper para aceitar absoluto ou relativo
  $url = function ($path) {
      if (!$path) return '';
      return preg_match('~^https?://|^/~', $path) ? $path : asset($path);
  };
@endphp

<section>
  <div class="w-full max-w-[1920px] relative max-h-[905px] h-screen mx-auto bg-cover bg-center"
       style="background-image: url('{{ $url($c['bg_image']) }}');">

    {{-- “quadro” da esquerda --}}
    <div class="ml-4 sm:ml-8 md:ml-12 relative
                w-[320px] sm:w-[420px] md:w-[500px]
                h-[360px] sm:h-[440px] md:h-[500px]
                bg-no-repeat bg-contain"
         style="background-image: url('{{ $url($c['card_image']) }}');">

      <div class="absolute top-0 right-0">
        <svg width="72" height="83" viewBox="0 0 72 83" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0 59.2768C0 72.1619 9.72216 82.6044 21.7099 82.6044H71.7645C71.7494 82.2034 71.708 81.8064 71.708 81.4013V0H0v59.2768Zm38.5343-42.2277c2.3938 0 4.3389 2.0902 4.3389 4.6704v12.0749h11.2452c2.3937 0 4.3389 2.0982 4.3389 4.6704v5.683c0 2.5802-1.9452 4.6703-4.3389 4.6703H42.8732V60.893c0 2.5803-1.9451 4.6704-4.3389 4.6704h-5.2965c-2.3938 0-4.3465-2.1897-4.3465-4.7701V48.8181H17.6537c-2.3938 0-4.3465-2.0901-4.3465-4.6703v-5.683c0-2.5722 1.9527-4.6704 4.3465-4.6704h11.2376V21.7195c0-2.5802 2.006-4.6704 4.3998-4.6704h5.2432Z" fill="white"/>
        </svg>
      </div>

      <div class="pt-[clamp(10px,3.472vw,50px)] pl-[clamp(10px,2.083vw,30px)]">
        @if(!empty($c['title']))
          <h1 class="text-[clamp(26px,3.264vw,47px)] font-bold text-white leading-[1.2] p-5">{!! $c['title'] !!}</h1>
        @endif

        @if(!empty($c['text']))
          <p class="text-[clamp(12px,1.389vw,20px)] p-5 pt-0 max-w-[296px] text-white">
            {!! $c['text'] !!}
            @if(!empty($c['link_text']) && !empty($c['link_url']))
              <a class="text-[#3FD0FC]" href="{{ $c['link_url'] }}">{{ $c['link_text'] }}</a>.
            @endif
          </p>
        @endif
      </div>
    </div>

    {{-- Kicker (título + texto) centralizado na base --}}
    @if($kTitle || $kText)
      <div class="absolute bottom-[10px] xl:bottom-[30px] left-1/2 -translate-x-1/2 max-w-[1280px] w-full px-4 sm:px-6">
        <div class="max-w-[680px]">
          @if($kTitle)
            <h2 class="text-[22px] xl:text-[clamp(10px,1.979vw,40px)] sm:text-[34px] md:text-[38px] leading-tight font-bold">
              {{ $kTitle }}
            </h2>
          @endif
          @if($kText)
            <p class="font-light opacity-50 mt-2 text-[14px] xl:text-[18px] sm:text-[15px]">
              {!! $kText !!}
            </p>
          @endif
        </div>
      </div>
    @endif
  </div>
</section>
