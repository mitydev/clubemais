@php
  $c = [];
  if (($mode ?? null) === 'edit' && isset($data)) $c = (array) ($data->content ?? []);
  $v = fn($k,$def=null) => old("content.$k", $c[$k] ?? ($defaults[$k] ?? $def));
  $cards = is_array(old('content.cards', $c['cards'] ?? ($defaults['cards'] ?? []))) ? old('content.cards', $c['cards'] ?? ($defaults['cards'] ?? [])) : [];
@endphp

<div class="border rounded p-2">
  <div class="fw-semibold mb-2">Benefícios • Intro</div>

  <div class="mb-2">
    <label class="form-label">Título</label>
    <input name="content[title]" class="form-control" value="{{ $v('title') }}">
  </div>

  <div class="mb-2">
    <label class="form-label">Texto</label>
    <textarea name="content[text]" rows="4" class="form-control">{{ $v('text') }}</textarea>
  </div>

  <div class="mb-2">
    <label class="form-label d-block">Cards (imagem + legenda)</label>
    <div id="bi-cards">
      @foreach($cards as $i => $it)
        <div class="d-flex gap-2 mb-2">
          <input name="content[cards][{{ $i }}][image]"   class="form-control" placeholder="URL da imagem"
                 value="{{ $it['image'] ?? '' }}">
          <input name="content[cards][{{ $i }}][caption]" class="form-control" placeholder="Legenda"
                 value="{{ $it['caption'] ?? '' }}">
        </div>
      @endforeach
    </div>
    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="
      (function(c){
        const idx = c.querySelectorAll('div.d-flex').length;
        const row = document.createElement('div');
        row.className='d-flex gap-2 mb-2';
        row.innerHTML = `
          <input name=&quot;content[cards][${idx}][image]&quot; class=&quot;form-control&quot; placeholder=&quot;URL da imagem&quot;>
          <input name=&quot;content[cards][${idx}][caption]&quot; class=&quot;form-control&quot; placeholder=&quot;Legenda&quot;>
        `;
        c.appendChild(row);
      })(document.getElementById('bi-cards'));
    ">+ Card</button>
  </div>
</div>
