@extends('layouts.lte')

@section('content')
<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Gerenciar Grupo — {{ $group->name }}</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('destinos.groups') }}">Grupos</a></li>
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

      {{-- Upload em lote --}}
      <form class="card mb-3" action="{{ route('destinos.groups.upload',$group) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body row g-3">
          <div class="col-md-6">
            <label class="form-label">Imagens</label>
            <input type="file" name="images[]" accept="image/*" class="form-control" multiple>
          </div>
          <div class="col-md-3">
                <label class="form-label">Título padrão</label>
                <input type="text" name="default_title" class="form-control" maxlength="28">
          </div>
          <div class="col-md-3">
                <label class="form-label">Descrição curta padrão</label>
                <input type="text" name="default_excerpt" class="form-control" maxlength="85">
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

      {{-- Edição em massa --}}
      <form class="card" method="post" action="{{ route('destinos.groups.bulk',$group) }}" id="bulkForm" enctype="multipart/form-data">
        @csrf
        <div class="table-responsive">
          <table class="table align-middle mb-0" id="sortableTable">
            <thead>
              <tr>
                <th style="width:36px"></th>
                <th>Imagem</th>
                <th style="width:18%">Título</th>
                <th style="width:22%">Descrição curta</th>
                <th style="width:22%">Link</th>
                <th style="width:12%">Início</th>
                <th style="width:12%">Fim</th>
                <th style="width:90px">Ativo</th>
                <th style="width:160px">Nova imagem</th>
                <th style="width:90px">Remover</th>
              </tr>
            </thead>
            <tbody>
              @foreach($group->destinations as $i => $d)
                <tr data-id="{{ $d->id }}">
                  <td class="text-muted" style="cursor:grab">⋮⋮</td>

                  {{-- Thumb atual --}}
                  <td>
                    @if($d->image_path)
                      <img src="{{ Storage::url($d->image_path) }}" class="js-thumb"
                           style="height:56px;object-fit:cover;border-radius:6px">
                    @else
                      <img src="" class="js-thumb d-none"
                           style="height:56px;object-fit:cover;border-radius:6px">
                    @endif
                    <input type="hidden" name="items[{{ $i }}][id]" value="{{ $d->id }}">
                    <input type="hidden" name="items[{{ $i }}][position]" value="{{ $d->position }}" class="js-pos">
                  </td>

                  <td><input type="text" class="form-control" name="items[{{ $i }}][title]" value="{{ $d->title }}" maxlength="28"></td>
                  <td><input type="text" class="form-control" name="items[{{ $i }}][excerpt]" value="{{ $d->excerpt }}" maxlength="85"></td>
                  <td><input type="url" class="form-control" name="items[{{ $i }}][link_url]" value="{{ $d->link_url }}"></td>
                  <td><input type="datetime-local" class="form-control" name="items[{{ $i }}][starts_at]" value="{{ optional($d->starts_at)->format('Y-m-d\TH:i') }}"></td>
                  <td><input type="datetime-local" class="form-control" name="items[{{ $i }}][ends_at]" value="{{ optional($d->ends_at)->format('Y-m-d\TH:i') }}"></td>

                  <td class="text-center">
                    <input type="hidden" name="items[{{ $i }}][is_active]" value="0">
                    <input type="checkbox" class="form-check-input" name="items[{{ $i }}][is_active]" value="1" {{ $d->is_active ? 'checked':'' }}>
                  </td>

                  <td>
                    <input type="file" accept="image/*" class="form-control js-new-image"
                           name="items[{{ $i }}][new_image]">
                    <small class="text-muted">Deixe em branco p/ manter.</small>
                  </td>

                  <td class="text-center">
                    <input type="checkbox" class="form-check-input js-del" data-id="{{ $d->id }}">
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div id="deleted_ids_box"></div>

        <div class="card-footer d-flex justify-content-between">
          <a href="{{ route('destinos.groups') }}" class="btn btn-outline-secondary">Voltar</a>
          <button class="btn btn-primary">Salvar alterações</button>
        </div>
      </form>

    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const tbody = document.querySelector('#sortableTable tbody');
  const boxDeleted = document.getElementById('deleted_ids_box');
  const delSet = new Set();

  new Sortable(tbody, {
    handle: 'td:first-child',
    animation: 150,
    onSort: () => {
      [...tbody.querySelectorAll('tr')].forEach((tr, idx) => {
        tr.querySelector('.js-pos').value = (idx + 1); // 1,2,3...
      });
    }
  });

  tbody.addEventListener('change', (e) => {
    // remover marcados
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

    // preview da nova imagem
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
