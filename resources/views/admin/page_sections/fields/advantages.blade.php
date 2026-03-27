@php
  $c = [];
  if (($mode ?? null) === 'edit' && isset($data)) $c = (array) ($data->content ?? []);
  $v = fn($key,$def=null) => old("content.$key", $c[$key] ?? ($defaults[$key] ?? $def));

  // itens (cards)
  $items = old('content.items') ?? ($c['items'] ?? ($defaults['items'] ?? []));
  // normaliza 3 entradas por padrão
  $items = array_values($items);
  for ($i=count($items); $i<3; $i++) $items[] = ['icon'=>'','title'=>''];
@endphp

<div class="border rounded p-2">
  <div class="fw-semibold mb-2">Vantagens / Assinaturas</div>

  <div class="mb-2">
    <label class="form-label">Título</label>
    <input  maxlength="45" name="content[title]" class="form-control" value="{{ $v('title') }}">
  </div>

  <div class="row g-2">
    <div class="col-8">
      <label class="form-label">Texto do botão (CTA)</label>
      <input  maxlength="10" name="content[cta_text]" class="form-control" value="{{ $v('cta_text','ASSINE JÁ') }}">
    </div>
    <div class="col-4">
      <label class="form-label">URL do botão</label>
      <input name="content[cta_url]" class="form-control" value="{{ $v('cta_url','#') }}">
    </div>
  </div>

  <hr class="my-3">
  <div class="fw-semibold mb-2">Cartões de benefício (até 3)</div>

  @foreach($items as $i => $it)
    <div class="row g-2 mb-2">
      <div class="col-6">
        <label class="form-label">Ícone (URL)</label>
        <input name="content[items][{{ $i }}][icon]" class="form-control" value="{{ old("content.items.$i.icon", $it['icon'] ?? '') }}">
      </div>
      <div class="col-6">
        <label class="form-label">Título</label>
        <input maxlength="42" name="content[items][{{ $i }}][title]" class="form-control" value="{{ old("content.items.$i.title", $it['title'] ?? '') }}">
      </div>
    </div>
  @endforeach
</div>
