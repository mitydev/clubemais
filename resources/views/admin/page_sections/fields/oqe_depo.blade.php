@php
  $c=[]; if(($mode??null)==='edit'&&isset($data)) $c=(array)($data->content??[]);
  $v=fn($k,$d=null)=>old("content.$k",$c[$k]??($defaults[$k]??$d));
  $items = old('content.items', $c['items'] ?? ($defaults['items'] ?? []));
@endphp

<div class="border rounded p-2">
  <div class="fw-semibold mb-2">O-que-é • Depoimentos</div>

  <div class="mb-2">
    <label class="form-label">Título</label>
    <input name="content[title]" class="form-control" value="{{ $v('title') }}">
  </div>

  <div class="d-flex justify-content-between align-items-center">
    <label class="form-label mb-0">Cards</label>
    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="addDepo()">+ Card</button>
  </div>
  <div id="depoWrap" class="mt-2">
    @foreach(($items ?: []) as $i => $it)
      <div class="row g-2 mb-2 depo-row">
        <div class="col-md-3"><input name="content[items][{{ $i }}][name]"   class="form-control" placeholder="Nome"   value="{{ $it['name'] ?? '' }}"></div>
        <div class="col-md-2"><input name="content[items][{{ $i }}][role]"   class="form-control" placeholder="Cargo"  value="{{ $it['role'] ?? '' }}"></div>
        <div class="col-md-3"><input name="content[items][{{ $i }}][avatar]" class="form-control" placeholder="Avatar" value="{{ $it['avatar'] ?? '' }}"></div>
        <div class="col-md-3"><input name="content[items][{{ $i }}][text]"   class="form-control" placeholder="Texto"  value="{{ $it['text'] ?? '' }}"></div>
        <div class="col-md-1 d-flex align-items-center">
          <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.depo-row').remove()">x</button>
        </div>
      </div>
    @endforeach
  </div>
</div>

<script>
function addDepo(){
  const wrap = document.getElementById('depoWrap');
  const i = wrap.querySelectorAll('.depo-row').length;
  const row = document.createElement('div');
  row.className = 'row g-2 mb-2 depo-row';
  row.innerHTML = `
    <div class="col-md-3"><input name="content[items][${i}][name]"   class="form-control" placeholder="Nome"></div>
    <div class="col-md-2"><input name="content[items][${i}][role]"   class="form-control" placeholder="Cargo"></div>
    <div class="col-md-3"><input name="content[items][${i}][avatar]" class="form-control" placeholder="Avatar"></div>
    <div class="col-md-3"><input name="content[items][${i}][text]"   class="form-control" placeholder="Texto"></div>
    <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.depo-row').remove()">x</button></div>
  `;
  wrap.appendChild(row);
}
</script>
