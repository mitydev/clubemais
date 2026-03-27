@php
  $c = [];
  if (($mode ?? null)==='edit' && isset($data)) $c = (array)($data->content ?? []);
  $v = fn($k,$def=null)=> old("content.$k", $c[$k] ?? ($defaults[$k] ?? $def));

  $fields = old('content.fields', $c['fields'] ?? ($defaults['fields'] ?? []));
  if (!is_array($fields)) $fields = [];
@endphp

<div class="border rounded p-2">
  <div class="fw-semibold mb-2">Parceiros • Seja Parceiro</div>

  <div class="mb-2">
    <label class="form-label">Título</label>
    <input name="content[title]" class="form-control" value="{{ $v('title') }}">
  </div>

  <div class="mb-2">
    <label class="form-label">Lead</label>
    <textarea name="content[lead]" rows="3" class="form-control">{{ $v('lead') }}</textarea>
  </div>

  <div class="row g-2">
    <div class="col-md-4">
      <label class="form-label">Âncora (id)</label>
      <input name="content[anchor_id]" class="form-control" value="{{ $v('anchor_id','seja-parceiro') }}">
    </div>
    <div class="col-md-4">
      <label class="form-label">Action</label>
      <input name="content[action]" class="form-control" value="{{ $v('action','#') }}">
    </div>
    <div class="col-md-4">
      <label class="form-label">Method</label>
      <input name="content[method]" class="form-control" value="{{ $v('method','post') }}">
    </div>
  </div>

  <div class="mt-2">
    <label class="form-label">Texto do botão</label>
    <input name="content[button_text]" class="form-control" value="{{ $v('button_text','Lorem Ipsum') }}">
  </div>

  <hr>
  <div class="fw-semibold mb-2">Campos do formulário (até 4)</div>

  @for($i=0; $i<4; $i++)
    @php
      $row = $fields[$i] ?? ['label'=>'','name'=>"campo".($i+1),'placeholder'=>''];
    @endphp
    <div class="row g-2 mb-2">
      <div class="col-md-4">
        <label class="form-label">Label</label>
        <input name="content[fields][{{ $i }}][label]" class="form-control" value="{{ old("content.fields.$i.label", $row['label']) }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">Name</label>
        <input name="content[fields][{{ $i }}][name]" class="form-control" value="{{ old("content.fields.$i.name", $row['name']) }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">Placeholder</label>
        <input name="content[fields][{{ $i }}][placeholder]" class="form-control" value="{{ old("content.fields.$i.placeholder", $row['placeholder']) }}">
      </div>
    </div>
  @endfor
</div>
