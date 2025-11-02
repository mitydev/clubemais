@php
  $c = [];
  if (($mode ?? null) === 'edit' && isset($data)) $c = (array) ($data->content ?? []);
  $v = fn($k,$def=null) => old("content.$k", $c[$k] ?? ($defaults[$k] ?? $def));
  $items = is_array(old('content.items', $c['items'] ?? ($defaults['items'] ?? []))) ? old('content.items', $c['items'] ?? ($defaults['items'] ?? [])) : [];
@endphp

<div class="border rounded p-2">
  <div class="fw-semibold mb-2">Benefícios • Números</div>

  <div id="bn-items">
    @foreach($items as $i => $it)
      <div class="row g-2 align-items-center mb-2">
        <div class="col-5">
          <input name="content[items][{{ $i }}][icon]"  class="form-control" placeholder="Ícone (URL)"
                 value="{{ $it['icon'] ?? '' }}">
        </div>
        <div class="col-3">
          <input name="content[items][{{ $i }}][value]" class="form-control" placeholder="Valor"
                 value="{{ $it['value'] ?? '' }}">
        </div>
        <div class="col-4">
          <input name="content[items][{{ $i }}][label]" class="form-control" placeholder="Rótulo"
                 value="{{ $it['label'] ?? '' }}">
        </div>
      </div>
    @endforeach
  </div>

  <button type="button" class="btn btn-sm btn-outline-secondary" onclick="
    (function(c){
      const i = c.querySelectorAll('.row').length;
      const row = document.createElement('div');
      row.className = 'row g-2 align-items-center mb-2';
      row.innerHTML = `
        <div class=&quot;col-5&quot;><input name=&quot;content[items][${i}][icon]&quot;  class=&quot;form-control&quot; placeholder=&quot;Ícone (URL)&quot;></div>
        <div class=&quot;col-3&quot;><input name=&quot;content[items][${i}][value]&quot; class=&quot;form-control&quot; placeholder=&quot;Valor&quot;></div>
        <div class=&quot;col-4&quot;><input name=&quot;content[items][${i}][label]&quot; class=&quot;form-control&quot; placeholder=&quot;Rótulo&quot;></div>
      `;
      c.appendChild(row);
    })(document.getElementById('bn-items'));
  ">+ Item</button>
</div>
