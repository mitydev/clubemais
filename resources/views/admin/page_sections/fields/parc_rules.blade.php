@php
  use Illuminate\Support\Str;

  // limites
  $MAX_PARAS  = 30;   // máx. de parágrafos
  $MAX_LEN    = 500;  // máx. de caracteres por parágrafo
  $MAX_TOKEN  = 80;   // máx. de caracteres contínuos sem espaço

  $c = [];
  if (($mode ?? null)==='edit' && isset($data)) $c = (array)($data->content ?? []);
  $v = fn($k,$def=null)=> old("content.$k", $c[$k] ?? ($defaults[$k] ?? $def));
  $paras = old('content.paragraphs', $c['paragraphs'] ?? ($defaults['paragraphs'] ?? []));

  // normaliza entrada (string -> array de linhas)
  if (is_string($paras)) {
      $paras = preg_split('/\R+/', $paras);
  }
  $paras = collect($paras ?? [])
      ->map(fn($l) => Str::of((string)$l)->squish()->trim())
      ->filter()
      // limita tamanho do parágrafo
      ->map(fn($l) => Str::limit($l, $MAX_LEN, ''))
      // injeta soft-break em tokens muito longos (evita quebrar layout na exibição)
      ->map(fn($l) => preg_replace('/(\S{' . $MAX_TOKEN . '})/u', '$1' . "\u{200B}", $l))
      ->take($MAX_PARAS)
      ->values()
      ->all();
@endphp

<div class="border rounded p-2">
  <div class="fw-semibold mb-2">Parceiros • Regras de uso</div>

  <div class="mb-2">
    <label class="form-label">Título</label>
    <input name="content[title]" class="form-control" value="{{ $v('title') }}">
  </div>

  <div class="mb-2">
    <label class="form-label">Parágrafos (um por linha)</label>
    <textarea id="rules-paras"
      name="content[paragraphs]"
      rows="5"
      class="form-control"
      data-max-paras="{{ $MAX_PARAS }}"
      data-max-len="{{ $MAX_LEN }}"
      data-max-token="{{ $MAX_TOKEN }}"
      >{{ is_array($paras)? implode("\n",$paras) : $paras }}</textarea>
    <small class="text-muted">
      Máx. {{ $MAX_PARAS }} linhas • {{ $MAX_LEN }} caracteres por parágrafo. Sequências muito longas serão quebradas automaticamente.
    </small>
  </div>

  <div class="row g-2">
    <div class="col-md-6">
      <label class="form-label">Imagem do balão (URL)</label>
      <input name="content[balloon_bg]" class="form-control" value="{{ $v('balloon_bg') }}">
    </div>
    <div class="col-md-6">
      <label class="form-label">Pílula (texto curto)</label>
      <input name="content[pill_text]" class="form-control" value="{{ $v('pill_text') }}">
    </div>
  </div>

  <div class="mt-2">
    <label class="form-label">Conteúdo interno do balão (HTML)</label>
    <textarea name="content[slot_html]" rows="5" class="form-control">{{ $v('slot_html') }}</textarea>
  </div>

  <div class="form-check mt-2">
    <input class="form-check-input" type="checkbox" name="content[show_button]" value="1" id="pr_showbtn" {{ old('content.show_button', $v('show_button')) ? 'checked' : '' }}>
    <label class="form-check-label" for="pr_showbtn">Exibir botão</label>
  </div>
</div>

{{-- Guard-rail leve no front (não substitui validação no backend) --}}
<script>
(function () {
  const ta = document.getElementById('rules-paras');
  if (!ta) return;

  const MAX_PARAS  = parseInt(ta.dataset.maxParas, 10) || 30;
  const MAX_LEN    = parseInt(ta.dataset.maxLen, 10) || 500;
  const MAX_TOKEN  = parseInt(ta.dataset.maxToken, 10) || 80;
  const softBreakRe = new RegExp('(\\S{'+MAX_TOKEN+'})', 'g');

  function sanitize(value) {
    let lines = (value || '').split(/\r\n|\r|\n/).map(l => l.replace(/\s+/g,' ').trim()).filter(Boolean);

    if (lines.length > MAX_PARAS) lines = lines.slice(0, MAX_PARAS);

    lines = lines.map(l => {
      if (l.length > MAX_LEN) l = l.slice(0, MAX_LEN);
      // injeta soft-break em tokens gigantes
      return l.replace(softBreakRe, '$1\u200B');
    });

    return lines.join('\n');
  }

  ta.addEventListener('input', () => {
    const caret = ta.selectionStart;
    const before = ta.value;
    const after  = sanitize(before);
    if (after !== before) {
      ta.value = after;
      // tenta preservar o caret
      ta.selectionStart = ta.selectionEnd = Math.min(caret, ta.value.length);
    }
  });

  // sanitize inicial
  ta.value = sanitize(ta.value);
})();
</script>
