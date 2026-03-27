@php
  // defaults vindos do config
  $d = $defaults ?? [];

  // content/meta atuais (se $data existir) + old()
  $cnt  = [];
  $meta = [];
  if (isset($data)) {
    $cnt  = is_array($data->content ?? null) ? $data->content : (array)($data->content ?? []);
    $meta = (array)($data->meta ?? []);
  }

  // aplica defaults sobre o que temos
  $c = array_merge($d, $cnt);

  // valores de content com fallback para old()
  $height       = old('content.height',      $c['height']       ?? '90vh');
  $autoplay     = old('content.autoplay',    $c['autoplay']     ?? true);
  $delayMs      = old('content.delay_ms',    $c['delay_ms']     ?? 5000);
  $overlay      = old('content.overlay',     $c['overlay']      ?? 'rgba(0,0,0,.25)');
  $captionShow  = old('content.caption_show',$c['caption_show'] ?? false);

  // meta (grupo/ordem): old() > meta > (fallback) grupo do 1º banner da seção (se houver)
  $fallbackGroup = null;
  if (isset($data) && method_exists($data, 'banners')) {
    $fallbackGroup = optional($data->banners->first()?->group)->id;
  }
  $currentGroupId = old('banner_group_id', $meta['banner_group_id'] ?? $fallbackGroup);
  $currentOrder   = old('banner_order',    $meta['banner_order']    ?? 'created_asc');
@endphp

<div class="mb-2">
  <label class="form-label">Altura (ex.: 90vh)</label>
  <input type="text" name="content[height]" class="form-control" value="{{ $height }}">
</div>

<div class="row g-2">
  <div class="col-6">
    <label class="form-label">Autoplay?</label>
    <select name="content[autoplay]" class="form-select">
      <option value="1" {{ $autoplay ? 'selected' : '' }}>Sim</option>
      <option value="0" {{ !$autoplay ? 'selected' : '' }}>Não</option>
    </select>
  </div>
  <div class="col-6">
    <label class="form-label">Delay (ms)</label>
    <input type="number" name="content[delay_ms]" class="form-control" value="{{ (int)$delayMs }}">
  </div>
</div>

<div class="mb-2 mt-2">
  <label class="form-label">Overlay (ex.: rgba(0,0,0,.25))</label>
  <input type="text" name="content[overlay]" class="form-control" value="{{ $overlay }}">
</div>

<div class="mb-2">
  <label class="form-label">Legenda textual por slide?</label>
  <select name="content[caption_show]" class="form-select">
    <option value="0" {{ !$captionShow ? 'selected' : '' }}>Não</option>
    <option value="1" {{  $captionShow ? 'selected' : '' }}>Sim</option>
  </select>
</div>

<hr class="my-3">

<div class="mb-2">
  <label class="form-label">Grupo de Banners</label>
  <select name="banner_group_id" class="form-select">
    <option value="">— selecione —</option>
    @foreach(($groups ?? []) as $g)
      <option value="{{ $g->id }}" {{ (string)$currentGroupId === (string)$g->id ? 'selected' : '' }}>
        {{ $g->name }} ({{ $g->banners_count }})
      </option>
    @endforeach
  </select>
</div>

<div class="mb-2">
  <label class="form-label">Ordenação</label>
  <select name="banner_order" class="form-select">
    <option value="created_asc"  {{ $currentOrder==='created_asc'  ? 'selected' : '' }}>Mais antigos primeiro</option>
    <option value="created_desc" {{ $currentOrder==='created_desc' ? 'selected' : '' }}>Mais recentes primeiro</option>
    <option value="title_asc"    {{ $currentOrder==='title_asc'    ? 'selected' : '' }}>Título A–Z</option>
    <option value="title_desc"   {{ $currentOrder==='title_desc'   ? 'selected' : '' }}>Título Z–A</option>
  </select>
</div>
