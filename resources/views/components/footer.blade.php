@php
  // helper: converte caminho relativo em URL absoluta do domínio atual
  $toUrl = function (?string $path) {
      if (!$path) return null;
      if (preg_match('#^(https?:)?//#', $path)) {
          return $path; // já é URL absoluta
      }
      return asset($path); // relativo -> asset()
  };

  // carrega do banco
  $cfg       = site_setting('footer') ?? [];
  $logoPath  = data_get($cfg, 'logo_path'); // pode vir "storage/..." ou URL absoluta
  $about     = data_get($cfg, 'about');
  $address   = data_get($cfg, 'address');
  $email     = data_get($cfg, 'email');
  $phone     = data_get($cfg, 'phone');
  $social    = collect(data_get($cfg, 'social', []))->filter(fn($r)=>!empty($r['url']))->values();
  $links     = collect(data_get($cfg, 'quick_links', []))->filter(fn($r)=>!empty($r['href']) && !empty($r['label']))->values();
  $nl  = (array) data_get($cfg, 'newsletter', []);

  // enabled: respeita false salvo e faz cast robusto
  if (array_key_exists('enabled', $nl)) {
      $nlEnabled = in_array($nl['enabled'], [true, 1, '1', 'true', 'on'], true);
  } else {
      $nlEnabled = true; // padrão quando não configurado
  }

  // logo com domínio atual
  $logoUrl = $toUrl($logoPath) ?? asset('images/novo_logo_320x100_white.svg');

  // mapeia ícones default (se não houver upload)
  $iconMap = [
    'x'         => 'images/x.svg',
    'instagram' => 'images/social/instagram.svg',
    'facebook'  => 'images/social/facebook.svg',
    'youtube'   => 'images/social/youtube.svg',
    'tiktok'    => 'images/social/tiktok.svg',
    'linkedin'  => 'images/social/linkedin.svg',
  ];

  $btn = 'w-10 h-10 grid place-items-center rounded-full bg-white/20 hover:bg-white/30 transition';
@endphp

<footer class="bg-[#EA6A0A] text-white">
  <div class="max-w-[1440px] mx-auto px-6 lg:px-[50px] py-12 lg:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

      {{-- Coluna 1 - Identidade / contato --}}
      <div class="lg:col-span-5 space-y-6">
        <div>
          <img src="{{ $logoUrl }}" alt="Clube+">
        </div>

        @if($about)
          <p class="max-w-md leading-relaxed text-white/90">{{ $about }}</p>
        @endif

        <div class="grid grid-cols-[auto_1fr] gap-x-6 gap-y-2 text-sm text-white/90">
          @if($address)
            <span class="opacity-80">Endereço</span> <span class="whitespace-pre-line">{{ $address }}</span>
          @endif
          @if($email)
            <span class="opacity-80">Email</span> <span>{{ $email }}</span>
          @endif
          @if($phone)
            <span class="opacity-80">Telefone</span> <span>{{ $phone }}</span>
          @endif
        </div>

        @if($social->isNotEmpty())
          <ul class="flex items-center gap-3 pt-2">
            @foreach($social as $s)
              @php
                $href     = $s['url'] ?? '#';
                $iconKey  = strtolower($s['icon'] ?? '');
                $iconFile = $s['icon_path'] ?? null; // ex.: "storage/footer/icons/abc.png" OU URL absoluta

                // 1) se tem upload, gera URL com domínio atual (ou usa a absoluta)
                $iconUploaded = $toUrl($iconFile);

                // 2) senão, cai no fallback mapeado, também com asset()
                $iconFallback = isset($iconMap[$iconKey]) ? asset($iconMap[$iconKey]) : null;

                $iconSrc  = $iconUploaded ?: $iconFallback;
              @endphp
              @if($iconSrc)
              <!--
                <li>
                  <a class="{{ $btn }}" href="{{ $href }}" target="_blank" rel="noopener">
                    <img src="{{ $iconSrc }}" alt="" class="w-5 h-5">
                  </a>
                </li>
                -->
              @endif
            @endforeach
          </ul>
        @endif
      </div>

      {{-- Coluna 2 – Links rápidos --}}
      <div class="lg:col-span-3 pt-4">
        @if($links->isNotEmpty())
          <h4 class="text-2xl font-semibold mb-4">Links Rápidos</h4>
          <ul class="space-y-3 text-white/90">
            @foreach($links as $ln)
              <li><a class="hover:underline" href="{{ $ln['href'] }}">{{ $ln['label'] }}</a></li>
            @endforeach
          </ul>
        @endif
      </div>
      {{-- Coluna 3 – Card de newsletter --}}
      <div class="lg:col-span-4">
        @if($nlEnabled)
          <div class="rounded-[16px] ring-1 ring-white/60 p-6 md:p-8">
            @if($t = data_get($nl,'title')) <h4 class="text-2xl font-semibold">{{ $t }}</h4> @endif
            @if($txt = data_get($nl,'text'))
              <p class="mt-2 text-sm text-white/90">{{ $txt }}</p>
            @endif

            <form class="mt-6 flex flex-col sm:flex-row gap-3" action="{{ data_get($nl,'action','#') }}" method="post">
              @csrf
              <input type="email" name="email" placeholder="{{ data_get($nl,'placeholder','Seu email') }}"
                     class="min-w-0 flex-1 h-11 bg-transparent border-0 border-b border-white/50 placeholder-white/70 focus:border-white focus:ring-0">
              <button type="submit"
                      class="h-11 px-6 rounded-full border border-white text-white hover:bg-white/10 transition">
                {{ data_get($nl,'button','Cadastre-se') }}
              </button>
            </form>
          </div>
        @endif
      </div>
    </div>

    <div class="mt-10 pt-6 text-center font-light text-sm text-white">
      Clube + © {{ date('Y') }}. Todos os direitos reservados.
    </div>
  </div>
</footer>
