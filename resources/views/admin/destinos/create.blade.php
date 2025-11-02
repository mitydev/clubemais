@extends('layouts.lte')

@section('content')
<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Novo Destino</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('destinos.index') }}">Destinos</a></li>
            <li class="breadcrumb-item active">Novo</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <form action="{{ route('destinos.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card">
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
              </div>
            @endif

            <div class="row g-3">
              {{-- Grupo --}}
              <div class="col-md-6">
                <label class="form-label">Grupo (escolher)</label>
                <select name="destination_group_id" class="form-select">
                  <option value="">— selecione um grupo —</option>
                  @foreach($groups as $g)
                    <option value="{{ $g->id }}" {{ old('destination_group_id')==$g->id?'selected':'' }}>
                      {{ $g->name }}
                    </option>
                  @endforeach
                </select>
                <small class="text-muted">Opcional se for criar um novo grupo ao lado.</small>
              </div>

              <div class="col-md-6">
                <label class="form-label">OU criar novo grupo</label>
                <input type="text" name="group" class="form-control"
                       value="{{ old('group') }}" placeholder="ex.: Praias do Nordeste">
                <small class="text-muted">Se informado, cria o grupo automaticamente (e ignora a seleção).</small>
              </div>

              {{-- Padrões (usados quando a imagem específica não trouxer valores) --}}
              <div class="col-md-4">
                <label class="form-label">Título padrão (opcional)</label>
                <input type="text" name="title" class="form-control"
                      value="{{ old('title') }}" placeholder="Ex.: Vivant Eco Beach" maxlength="28">
              </div>

              <div class="col-md-4">
                <label class="form-label">Descrição curta padrão (opcional)</label>
                <input type="text" name="excerpt" class="form-control"
                      value="{{ old('excerpt') }}" placeholder="Frase breve para o card" maxlength="85">
              </div>

              <div class="col-md-4">
                <label class="form-label">Link padrão (opcional)</label>
                <input type="url" name="link_url" class="form-control"
                       value="{{ old('link_url') }}" placeholder="https://...">
              </div>

              <div class="col-md-6">
                <label class="form-label">Imagens *</label>
                <input id="destFiles" type="file" name="images[]" class="form-control" accept="image/*" multiple>
                <small class="text-muted">Selecione 1+ imagens; arraste os cards abaixo para definir a ordem de criação.</small>
              </div>

              <div class="col-md-6">
                <label class="form-label">OU uma única imagem</label>
                <input id="singleFile" type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Se enviar aqui, o campo múltiplo é ignorado.</small>
              </div>

              <div class="col-md-3 d-flex align-items-end">
                <div class="form-check">
                  <input type="hidden" name="is_active" value="0">
                  <input class="form-check-input" type="checkbox" name="is_active" value="1"
                         id="d_active" {{ old('is_active','1') ? 'checked':'' }}>
                  <label class="form-check-label" for="d_active">Ativo</label>
                </div>
              </div>

              <div class="col-md-3">
                <label class="form-label">Início (opcional)</label>
                <input type="datetime-local" name="starts_at" class="form-control" value="{{ old('starts_at') }}">
              </div>

              <div class="col-md-3">
                <label class="form-label">Fim (opcional)</label>
                <input type="datetime-local" name="ends_at" class="form-control" value="{{ old('ends_at') }}">
              </div>

              {{-- GRID de previews + campos por arquivo --}}
              <div class="col-12">
                <label class="form-label">Arquivos selecionados</label>
                <div id="gridPreview" class="row g-3"></div>
                <input type="hidden" name="ordered_indexes" id="ordered_indexes">
              </div>
            </div>
          </div>

          <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('destinos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            <button class="btn btn-primary">Salvar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>

{{-- Sortable + preview --}}
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const inputMulti  = document.getElementById('destFiles');
  const inputSingle = document.getElementById('singleFile');
  const grid        = document.getElementById('gridPreview');
  const ordered     = document.getElementById('ordered_indexes');

  function refreshOrderHidden() {
    ordered.value = Array.from(grid.querySelectorAll('[data-index]'))
      .map(el => el.getAttribute('data-index')).join(',');
  }

  function renderGrid(files) {
    grid.innerHTML = '';
    Array.from(files).forEach((f, i) => {
      const url = URL.createObjectURL(f);

      const col = document.createElement('div');
      col.className = 'col-md-6';
      col.setAttribute('data-index', i.toString());
      col.innerHTML = `
        <div class="border rounded p-2 h-100 bg-body" style="cursor:grab">
          <div class="d-flex gap-2">
            <img src="${url}" alt="preview ${i+1}" style="width:120px;height:80px;object-fit:cover;border-radius:6px">
            <div class="flex-grow-1">
              <div class="small text-muted text-truncate" title="${f.name}">${i+1}. ${f.name}</div>
              <div class="row g-2 mt-1">
                <div class="col-12">
                  <div class="col-12">
                    <input type="text" name="titles[]" class="form-control form-control-sm"
                          placeholder="Título desta imagem (opcional)" maxlength="28">
                  </div>
                  <div class="col-6">
                    <input type="text" name="excerpts[]" class="form-control form-control-sm"
                          placeholder="Descrição curta desta imagem" maxlength="85">
                  </div>
                <div class="col-6">
                  <input type="url" name="links[]" class="form-control form-control-sm"
                         placeholder="https://... (link desta imagem)">
                </div>
              </div>
            </div>
          </div>
        </div>`;
      grid.appendChild(col);

      // liberar objectURL
      col.querySelector('img').onload = () => URL.revokeObjectURL(url);
    });
    refreshOrderHidden();
  }

  // Drag & drop
  new Sortable(grid, {
    animation: 150,
    handle: '.border',
    onSort: refreshOrderHidden,
  });

  inputMulti?.addEventListener('change', () => {
    if (inputMulti.files.length) { inputSingle.value=''; inputSingle.disabled=true; }
    else { inputSingle.disabled=false; }
    renderGrid(inputMulti.files);
  });

  inputSingle?.addEventListener('change', () => {
    if (inputSingle.files.length) { inputMulti.value=''; grid.innerHTML=''; inputMulti.disabled=true; }
    else { inputMulti.disabled=false; }
    ordered.value = '';
  });
});
</script>
@endsection
