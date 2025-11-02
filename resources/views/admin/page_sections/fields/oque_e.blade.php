@php
  $c = [];
  if (($mode ?? null) === 'edit' && isset($data)) $c = (array) ($data->content ?? []);
  $v = fn($key,$def=null) => old("content.$key", $c[$key] ?? ($defaults[$key] ?? $def));
@endphp

<div class="border rounded p-2">
  <div class="fw-semibold mb-2">O que é o Clube +</div>

  <div class="mb-2">
    <label class="form-label">Imagem de fundo (URL)</label>
    <input name="content[bg_image]" class="form-control" value="{{ $v('bg_image') }}">
  </div>

  <div class="mb-2">
    <label class="form-label">Imagem do “quadro” (URL)</label>
    <input name="content[card_image]" class="form-control" value="{{ $v('card_image') }}">
  </div>

  <div class="mb-2">
    <label class="form-label">Título</label>
    <input maxlength="17" name="content[title]" class="form-control" value="{{ $v('title') }}">
  </div>

  <div class="mb-2">
    <label class="form-label">Texto (HTML ou texto)</label>
    <textarea  maxlength="92" name="content[text]" rows="3" class="form-control">{{ $v('text') }}</textarea>
  </div>

  <div class="row g-2">
    <div class="col-6">
      <label class="form-label">Texto do link</label>
      <input  maxlength="30" name="content[link_text]" class="form-control" value="{{ $v('link_text') }}">
    </div>
    <div class="col-6">
      <label class="form-label">URL do link</label>
      <input name="content[link_url]" class="form-control" value="{{ $v('link_url') }}">
    </div>
  </div>

  <div class="row g-2 mt-2">
    <div class="col-6">
      <label class="form-label">Título abaixo (kicker)</label>
      <input  maxlength="40" name="content[kicker_title]" class="form-control" value="{{ $v('kicker_title') }}">
    </div>
    <div class="col-6">
      <label class="form-label">Chamada secundária (kicker)</label>
      <input  maxlength="174" name="content[kicker_text]" class="form-control" value="{{ $v('kicker_text') }}">
    </div>
  </div>
</div>
