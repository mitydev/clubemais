@extends('layouts.lte')

@section('content')
<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Novo Banner</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('banners.index') }}">Banners</a></li>
            <li class="breadcrumb-item active">Novo</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <form action="{{ route('banners.store') }}" method="post" enctype="multipart/form-data" id="bannerForm">
        @csrf

        <div class="card">
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
            @endif

            <div class="row g-3">
              {{-- Grupo --}}
              <div class="col-md-6">
                <label class="form-label">Grupo (escolher)</label>
                <select name="group_banner_id" class="form-select">
                  <option value="">— selecione um grupo —</option>
                  @foreach($groups as $g)
                    <option value="{{ $g->id }}" {{ old('group_banner_id')==$g->id?'selected':'' }}>
                      {{ $g->name }}
                    </option>
                  @endforeach
                </select>
                <small class="text-muted">Opcional se for criar um novo grupo no campo ao lado.</small>
              </div>
              <div class="col-md-6">
                <label class="form-label">OU criar novo grupo</label>
                <input type="text" name="group" class="form-control" value="{{ old('group') }}" placeholder="ex.: Home – Hero">
                <small class="text-muted">Se informado, cria o grupo automaticamente (ignora seleção).</small>
              </div>

              <div class="col-md-6">
                <label class="form-label">Título (opcional)</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Usado em todas as imagens do lote">
              </div>

              <div class="col-md-6">
                <label class="form-label">Link padrão (opcional)</label>
                <input type="url" name="link_url" class="form-control" value="{{ old('link_url') }}" placeholder="https://...">
                <small class="text-muted">Se o link específico da imagem ficar vazio, usaremos este.</small>
              </div>

              {{-- Upload --}}
              <div class="col-md-6">
                <label class="form-label">Imagens *</label>
                <input id="bannerFiles" type="file" name="images[]" class="form-control" accept="image/*" multiple>
                <small class="text-muted">Selecione 1 ou várias imagens (jpg, png, webp). Arraste para reordenar.</small>
              </div>

              <div class="col-md-6">
                <label class="form-label">OU uma única imagem</label>
                <input id="singleFile" type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Se enviar aqui, ignora o campo múltiplo.</small>
              </div>

              <div class="col-md-3 d-flex align-items-end">
                <div class="form-check">
                  <input type="hidden" name="is_active" value="0">
                  <input class="form-check-input" type="checkbox" name="is_active" value="1" id="b_active" {{ old('is_active','1') ? 'checked':'' }}>
                  <label class="form-check-label" for="b_active">Ativo</label>
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

              {{-- Lista ordenável com thumbs + link/alt por item --}}
              <div class="col-12">
                <label class="form-label">Links e ALT por imagem (opcional)</label>

                <div id="filesBoard" class="row g-3"></div>

                {{-- Fallback para o backend (se o navegador não deixar reordenar o FileList) --}}
                <input type="hidden" name="ordered_indexes" id="ordered_indexes">
                <small class="text-muted d-block mt-2">
                  Arraste as miniaturas para definir a ordem de criação (posição). Link específico tem prioridade sobre o link padrão. ALT vazio será omitido.
                </small>
              </div>
            </div>
          </div>

          <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('banners.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            <button class="btn btn-primary">Salvar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>

{{-- Sortable para drag-and-drop --}}
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const inputMulti  = document.getElementById('bannerFiles');
  const inputSingle = document.getElementById('singleFile');
  const board       = document.getElementById('filesBoard');
  const orderedInp  = document.getElementById('ordered_indexes');

  let filesCache = []; // espelho do FileList para manipular ordem/remoção

  function buildPreview() {
    board.innerHTML = '';
    if (!filesCache.length) { orderedInp.value = ''; return; }

    filesCache.forEach((file, i) => {
      const url = URL.createObjectURL(file);

      const col = document.createElement('div');
      col.className = 'col-12';
      col.innerHTML = `
        <div class="d-flex gap-3 align-items-start file-item border rounded p-2" data-idx="${i}" style="cursor:grab">
          <div class="flex-shrink-0">
            <img src="${url}" style="width:92px;height:64px;object-fit:cover;border-radius:6px">
          </div>
          <div class="flex-grow-1">
            <div class="small text-muted mb-1 text-truncate" title="${file.name}">
              <strong class="js-num">${i+1}.</strong> ${file.name}
            </div>
            <div class="row g-2">
              <div class="col-md-6">
                <input type="url" name="links[]" class="form-control" placeholder="https://... (link desta imagem)">
              </div>
              <div class="col-md-5">
                <input type="text" name="alt_texts[]" class="form-control" placeholder="ALT text (opcional)">
              </div>
              <div class="col-md-1 d-flex justify-content-end">
                <button type="button" class="btn btn-outline-danger btn-sm js-remove" title="Remover">
                  &times;
                </button>
              </div>
            </div>
          </div>
        </div>`;
      board.appendChild(col);

      // libera o blob URL depois de renderizar
      col.querySelector('img').addEventListener('load', () => URL.revokeObjectURL(url), {once:true});
    });

    updateOrderedIndexes();
  }

  function setInputFilesFromCache() {
    // recria o FileList do input na ordem atual usando DataTransfer
    const dt = new DataTransfer();
    filesCache.forEach(f => dt.items.add(f));
    inputMulti.files = dt.files;
  }

  function updateOrderedIndexes() {
    // fallback para o backend: "0,2,1,3"
    const ids = [...board.querySelectorAll('.file-item')].map(el => +el.dataset.idx);
    orderedInp.value = ids.join(',');
    // atualiza a numeração visível
    [...board.querySelectorAll('.js-num')].forEach((el, k) => el.textContent = (k+1)+'.');
  }

  // Quando escolher arquivos
  inputMulti?.addEventListener('change', () => {
    if (inputMulti.files.length) { inputSingle.value=''; inputSingle.disabled=true; }
    else { inputSingle.disabled=false; }

    filesCache = Array.from(inputMulti.files);
    buildPreview();
  });

  // Se usar o single, limpa a interface múltipla
  inputSingle?.addEventListener('change', () => {
    if (inputSingle.files.length) {
      inputMulti.value=''; inputMulti.disabled=true;
      filesCache = [];
      board.innerHTML='';
      orderedInp.value = '';
    } else {
      inputMulti.disabled=false;
    }
  });

  // Drag & drop
  new Sortable(board, {
    handle: '.file-item',
    animation: 150,
    onEnd: () => {
      // Reordena o filesCache conforme DOM atual
      const order = [...board.querySelectorAll('.file-item')].map(el => +el.dataset.idx);
      filesCache = order.map(i => filesCache[i]);
      // Atualiza o FileList real
      setInputFilesFromCache();
      // Atualiza numeração e fallback
      // (recria data-idx sequencial para refletir a nova ordem)
      [...board.querySelectorAll('.file-item')].forEach((el, i) => el.dataset.idx = i);
      updateOrderedIndexes();
    }
  });

  // Remover item individual
  board.addEventListener('click', (e) => {
    if (!e.target.classList.contains('js-remove')) return;
    const item = e.target.closest('.file-item');
    const idx  = +item.dataset.idx;

    filesCache.splice(idx, 1);
    setInputFilesFromCache();
    buildPreview(); // reconstrói tudo para manter idx corretos
  });
});
</script>
@endsection
