@php
  $c = [];
  if (($mode ?? null) === 'edit' && isset($data)) $c = (array) ($data->content ?? []);
  $v = fn($k,$d=null)=> old("content.$k", $c[$k] ?? ($defaults[$k] ?? $d));
@endphp

<div class="border rounded p-2">
  <div class="fw-semibold mb-2">O-que-é • Hero</div>

  <div class="mb-2">
    <label class="form-label">Imagem de fundo (URL)</label>
    <input name="content[bg_image]" class="form-control" value="{{ $v('bg_image') }}">
  </div>

  <div class="mb-2">
    <label class="form-label">Título (H1)</label>
    <input name="content[title]" class="form-control" value="{{ $v('title') }}">
  </div>

  <div>
    <label class="form-label">Texto do painel</label>
    <textarea name="content[text]" rows="4" class="form-control">{{ $v('text') }}</textarea>
    <small class="text-muted">Frases separadas por ponto/quebra viram múltiplos parágrafos.</small>
  </div>
</div>
