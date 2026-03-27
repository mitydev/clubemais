@php
  $c=[]; if(($mode??null)==='edit'&&isset($data)) $c=(array)($data->content??[]);
  $v=fn($k,$d=null)=>old("content.$k",$c[$k]??($defaults[$k]??$d));
  $steps = old('content.steps', $c['steps'] ?? ($defaults['steps'] ?? []));
@endphp

<div class="border rounded p-2">
  <div class="fw-semibold mb-2">O-que-é • Como funciona?</div>

  <div class="mb-2">
    <label class="form-label">Título</label>
    <input name="content[title]" class="form-control" value="{{ $v('title') }}">
  </div>
  <div class="mb-3">
    <label class="form-label">Lead</label>
    <textarea name="content[lead]" rows="3" class="form-control">{{ $v('lead') }}</textarea>
  </div>

  <div class="mb-2">
    <div class="d-flex justify-content-between align-items-center">
      <label class="form-label mb-0">Passos</label>
      <button type="button" class="btn btn-sm btn-outline-secondary" onclick="addStepRow()">+ Passo</button>
    </div>

    <div id="stepsWrap" class="mt-2">
      @foreach(($steps ?: []) as $i => $s)
        <div class="row g-2 mb-2 step-row">
          <div class="col-md-3">
            <input name="content[steps][{{ $i }}][icon]" class="form-control" placeholder="icon (URL)" value="{{ $s['icon'] ?? '' }}">
          </div>
          <div class="col-md-3">
            <input name="content[steps][{{ $i }}][title]" class="form-control" placeholder="título" value="{{ $s['title'] ?? '' }}">
          </div>
          <div class="col-md-5">
            <input name="content[steps][{{ $i }}][desc]" class="form-control" placeholder="descrição" value="{{ $s['desc'] ?? '' }}">
          </div>
          <div class="col-md-1 d-flex align-items-center">
            <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.step-row').remove()">x</button>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>

<script>
function addStepRow(){
  const wrap = document.getElementById('stepsWrap');
  const idx  = wrap.querySelectorAll('.step-row').length;
  const row  = document.createElement('div');
  row.className = 'row g-2 mb-2 step-row';
  row.innerHTML = `
    <div class="col-md-3"><input name="content[steps][${idx}][icon]"  class="form-control" placeholder="icon (URL)"></div>
    <div class="col-md-3"><input name="content[steps][${idx}][title]" class="form-control" placeholder="título"></div>
    <div class="col-md-5"><input name="content[steps][${idx}][desc]"  class="form-control" placeholder="descrição"></div>
    <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-outline-danger btn-sm" onclick="this.closest('.step-row').remove()">x</button></div>
  `;
  wrap.appendChild(row);
}
</script>
