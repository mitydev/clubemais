@php
  use Illuminate\Support\Str;

  $d = [
    'title'      => 'Regras de Uso',
    'paragraphs' => [
      'Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequís modic to berrovdiem. Musam aliquo optae que nonecul.',
      'Optaquae perepedi dende officia cabore, niandi opti ut lam de cumque nimo ommolum qui auda sundi num quisque proresequís modic to berrovdiem. Musam aliquo optae que nonecul.',
    ],
    'balloon_bg' => 'images/parceiros/bg.png',
    'pill_text'  => 'Lorem Ipsum Lorem',
    'slot_html'  => '<p>Conteúdo do balão (HTML livre).</p><p>Lorem ipsum…</p>',
    'show_button'=> true,
  ];
  $c = array_merge($d, (array)($section->content ?? []));

  // ===== Proteções de layout =====
  $MAX_PARAS = 30;   // máx. de parágrafos
  $MAX_LEN   = 500;  // máx. chars por parágrafo
  $MAX_TOKEN = 80;   // máx. sequência contínua sem espaço

  $rawParas = $c['paragraphs'] ?? [];
  if (is_string($rawParas)) $rawParas = preg_split('/\R+/', $rawParas);

  $paras = collect($rawParas)
    ->map(fn($l) => Str::of((string)$l)->squish()->trim())
    ->filter()
    ->map(fn($l) => Str::limit($l, $MAX_LEN, ''))                                     // limita tamanho
    ->map(fn($l) => preg_replace('/(\S{'.$MAX_TOKEN.'})/u', '$1'."\u{200B}", $l))     // soft-break em tokens longos
    ->take($MAX_PARAS)
    ->values()
    ->all();

  $bgPath = $c['balloon_bg'] ?: $d['balloon_bg'];
  $bgAbs  = public_path($bgPath);
  $bgUrl  = asset($bgPath) . (file_exists($bgAbs) ? '?v=' . filemtime($bgAbs) : '');
@endphp

<style>
/* GRID balanceado e centralizado */
.rules .rules__grid{
  display:grid;
  grid-template-columns:
    clamp(420px, 32vw, 560px)   /* coluna esquerda */
    clamp(520px, 40vw, 680px);  /* coluna direita */
  column-gap: clamp(24px, 3.5vw, 56px);
  justify-content: center;
  align-items: start;
}

/* Empilha no tablet/mobile */
@media (max-width: 1024px){
  .rules .rules__grid{
    grid-template-columns: 1fr;
    column-gap: 0;
    row-gap: 24px;
  }
}

/* ————— LADO ESQUERDO ————— */
.rules .rules__copy{
  /* removemos o limite fixo; a largura é controlada pela coluna acima */
  max-width: none;
}

/* quebra QUALQUER sequência longa apenas no lado esquerdo */
.rules .rules__copy,
.rules .rules__copy *{
  white-space: pre-wrap;     /* preserva \n */
  overflow-wrap: anywhere;   /* quebra tokens sem espaço */
  word-break: break-word;    /* fallback */
  hyphens: auto;             /* hifeniza quando possível */
}
.rules .rules__p{ margin: 0 0 14px; }

/* (opcional) limitar o título para não “atropelar” */
.rules .rules__title{ margin:0 0 20px; max-width: 24ch; }
</style>

<section class="rules">
  <div class="section-inner rules__grid">
    <div class="rules__copy">
      @if(!empty($c['title']))
        <h2 class="rules__title">{{ e($c['title']) }}</h2>
      @endif

      @foreach($paras as $p)
        <p class="rules__p">{{ e($p) }}</p>
      @endforeach
    </div>

    <aside class="rules__frame">
      <img class="rules__img" src="{{ $bgUrl }}" alt="" aria-hidden="true">
      @if(!empty($c['pill_text']))
        <span class="rules__pill">{{ e($c['pill_text']) }}</span>
      @endif
      <div class="rules__slot">{!! $c['slot_html'] !!}</div>
      @if(!empty($c['show_button']))
        <button class="rules__cta" aria-label="Próxima regra">
          <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M12 16a1 1 0 0 1-.71-.29l-6-6 1.42-1.42L12 13.59l5.29-5.3 1.42 1.42-6 6A1 1 0 0 1 12 16z"/>
          </svg>
        </button>
      @endif
    </aside>
  </div>
</section>

