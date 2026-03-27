@extends('layouts.lte')

@section('content')
<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Gerenciar Grupo — {{ $group->name }}</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('banners.groups') }}">Grupos</a></li>
            <li class="breadcrumb-item active">{{ $group->name }}</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">

      @if (session('ok')) <div class="alert alert-success">{{ session('ok') }}</div> @endif
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
      @endif

      {{-- Upload em lote (opcional) --}}
      <form class="card mb-3" action="{{ route('banners.groups.upload',$group) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body row g-3">
          <div class="col-md-6">
            <label class="form-label">Imagens</label>
            <input type="file" name="images[]" accept="image/*" class="form-control" multiple>
          </div>
          <div class="col-md-3">
            <label class="form-label">Título padrão</label>
            <input type="text" name="default_title" class="form-control">
          </div>
          <div class="col-md-3">
            <label class="form-label">Link padrão</label>
            <input type="url" name="default_link" class="form-control" placeholder="https://…">
          </div>
          <div class="col-md-3">
            <div class="form-check mt-4">
              <input class="form-check-input" type="checkbox" name="is_active" value="1" id="up_active" checked>
              <label class="form-check-label" for="up_active">Ativos</label>
            </div>
          </div>
          <div class="col-12 d-flex justify-content-end">
            <button class="btn btn-outline-primary">Adicionar ao grupo</button>
          </div>
        </div>
      </form>

      {{-- Edição em massa + reordenação --}}
      <form class="card" method="post"
            action="{{ route('banners.groups.bulk',$group) }}"
            id="bulkForm" enctype="multipart/form-data">
        @csrf
        <div class="table-responsive">
          <table class="table align-middle mb-0" id="sortableTable">
            <thead>
              <tr>
                <th style="width:36px"></th>
                <th>Imagem</th>
                <th style="width:22%">Título</th>
                <th style="width:26%">Link</th>
                <th style="width:12%">Início</th>
                <th style="width:12%">Fim</th>
                <th style="width:90px">Ativo</th>
                <th style="width:160px">Nova imagem</th>
                <th style="width:100px">Remover</th>
              </tr>
            </thead>
            <tbody>
              @foreach($group->banners as $i => $b)
                <tr data-id="{{ $b->id }}">
                  <td class="text-muted" style="cursor:grab">⋮⋮</td>

                  {{-- Miniatura atual (ou vazia) --}}
                  <td>
                    @if($b->image_path)
                      <img src="{{ Storage::url($b->image_path) }}" class="js-thumb"
                           style="height:56px;object-fit:cover;border-radius:6px">
                    @else
                      <img src="" class="js-thumb d-none"
                           style="height:56px;object-fit:cover;border-radius:6px">
                    @endif
                    <input type="hidden" name="banners[{{ $i }}][id]" value="{{ $b->id }}">
                    <input type="hidden" name="banners[{{ $i }}][position]" value="{{ $b->position }}" class="js-pos">
                  </td>

                  <td><input type="text" class="form-control" name="banners[{{ $i }}][title]" value="{{ $b->title }}"></td>
                  <td><input type="url" class="form-control" name="banners[{{ $i }}][link_url]" value="{{ $b->link_url }}"></td>
                  <td><input type="datetime-local" class="form-control" name="banners[{{ $i }}][starts_at]" value="{{ optional($b->starts_at)->format('Y-m-d\TH:i') }}"></td>
                  <td><input type="datetime-local" class="form-control" name="banners[{{ $i }}][ends_at]" value="{{ optional($b->ends_at)->format('Y-m-d\TH:i') }}"></td>

                  <td class="text-center">
                    <input type="hidden" name="banners[{{ $i }}][is_active]" value="0">
                    <input type="checkbox" class="form-check-input" name="banners[{{ $i }}][is_active]" value="1" {{ $b->is_active ? 'checked':'' }}>
                  </td>

                  {{-- Input de nova imagem com preview instantâneo --}}
                  <td>
                    <input type="file" accept="image/*" class="form-control js-new-image"
                           name="banners[{{ $i }}][new_image]">
                    <small class="text-muted">Deixe em branco p/ manter.</small>
                  </td>

                  <td class="text-center">
                    <input type="checkbox" class="form-check-input js-del" data-id="{{ $b->id }}">
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{-- deleted_ids[] será montado via JS aqui --}}
        <div id="deleted_ids_box"></div>

        <div class="card-footer d-flex justify-content-between">
          <a href="{{ route('banners.groups') }}" class="btn btn-outline-secondary">Voltar</a>
          <button class="btn btn-primary">Salvar alterações</button>
        </div>
      </form>

    </div>
  </div>
</main>

{{-- SortableJS para drag-and-drop --}}
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const tbody = document.querySelector('#sortableTable tbody');
  const boxDeleted = document.getElementById('deleted_ids_box');
  const delSet = new Set();

  // Drag-and-drop das linhas; atualiza posição 1,2,3...
  new Sortable(tbody, {
    handle: 'td:first-child',
    animation: 150,
    onSort: () => {
      [...tbody.querySelectorAll('tr')].forEach((tr, idx) => {
        tr.querySelector('.js-pos').value = idx + 1;   // << era (idx+1)*10
      });
    }
  });

  // Garante 1..n mesmo se o usuário não arrastar nada
  document.getElementById('bulkForm')?.addEventListener('submit', () => {
    [...tbody.querySelectorAll('tr')].forEach((tr, idx) => {
      tr.querySelector('.js-pos').value = idx + 1;
    });
  });

  // Preview instantâneo da nova imagem e marcação de removidos
  tbody.addEventListener('change', (e) => {
    // 1) Toggle remover
    if (e.target.classList.contains('js-del')) {
      const id = e.target.dataset.id;
      e.target.checked ? delSet.add(id) : delSet.delete(id);
      boxDeleted.innerHTML = '';
      [...delSet].forEach(v => {
        const i = document.createElement('input');
        i.type = 'hidden';
        i.name = 'deleted_ids[]';
        i.value = v;
        boxDeleted.appendChild(i);
      });
      return;
    }

    // 2) Preview de nova imagem
    if (e.target.matches('.js-new-image')) {
      const file = e.target.files?.[0];
      if (!file) return;
      const tr  = e.target.closest('tr');
      const img = tr.querySelector('.js-thumb');
      const url = URL.createObjectURL(file);
      img.src = url;
      img.classList.remove('d-none');
      img.onload = () => URL.revokeObjectURL(url);
    }
  });
});
</script>

@endsection
