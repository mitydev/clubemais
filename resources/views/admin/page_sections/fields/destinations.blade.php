@php
  $d = $defaults ?? [];

  $cnt  = [];
  $meta = [];
  if (isset($data)) {
    $cnt  = is_array($data->content ?? null) ? $data->content : (array)($data->content ?? []);
    $meta = (array)($data->meta ?? []);
  }
  $c = array_merge($d, $cnt);

  // content
  $title      = old('content.title',       $c['title']       ?? 'Seu próximo destino com desconto');
  $layout     = old('content.layout',      $c['layout']      ?? 'cards-4');
  $buttonText = old('content.button_text', $c['button_text'] ?? 'Veja o Hotel');

  // meta
  $currentDestGroupId = old('destination_group_id', $meta['destination_group_id'] ?? null);
  $currentDestOrder   = old('destination_order',    $meta['destination_order']    ?? 'position_asc');
@endphp

<div class="mb-2">
  <label class="form-label">Título da sessão</label>
  <input  maxlength="32" type="text" name="content[title]" class="form-control" value="{{ $title }}">
</div>

<div class="row g-2">
  <div class="col-6">
    <label class="form-label">Layout</label>
    <select name="content[layout]" class="form-select">
      <option value="cards-4" {{ $layout==='cards-4' ? 'selected' : '' }}>Cards (4)</option>
      <option value="carousel" {{ $layout==='carousel' ? 'selected' : '' }}>Carrossel</option>
    </select>
  </div>
  <div class="col-6">
    <label class="form-label">Texto do botão</label>
    <input type="text" name="content[button_text]" class="form-control" value="{{ $buttonText }}">
  </div>
</div>

<hr class="my-3">

<div class="mb-2">
  <label class="form-label">Grupo de Destinos</label>
  <select name="destination_group_id" class="form-select">
    <option value="">— selecione —</option>
    @foreach(($destGroups ?? []) as $g)
      <option value="{{ $g->id }}" {{ (string)$currentDestGroupId === (string)$g->id ? 'selected' : '' }}>
        {{ $g->name }} ({{ $g->destinations_count }})
      </option>
    @endforeach
  </select>
</div>

<div class="mb-2">
  <label class="form-label">Ordenação</label>
  <select name="destination_order" class="form-select">
    <option value="position_asc"  {{ $currentDestOrder==='position_asc'  ? 'selected' : '' }}>Posição (asc)</option>
    <option value="position_desc" {{ $currentDestOrder==='position_desc' ? 'selected' : '' }}>Posição (desc)</option>
    <option value="created_asc"   {{ $currentDestOrder==='created_asc'   ? 'selected' : '' }}>Criados (asc)</option>
    <option value="created_desc"  {{ $currentDestOrder==='created_desc'  ? 'selected' : '' }}>Criados (desc)</option>
    <option value="title_asc"     {{ $currentDestOrder==='title_asc'     ? 'selected' : '' }}>Título A–Z</option>
    <option value="title_desc"    {{ $currentDestOrder==='title_desc'    ? 'selected' : '' }}>Título Z–A</option>
  </select>
</div>
