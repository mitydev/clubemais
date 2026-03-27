@extends('layouts.lte')

@section('content')
<h1 class="h4 mb-4">Navbar</h1>

@if(session('ok'))
  <div class="alert alert-success">{{ session('ok') }}</div>
@endif

<form action="{{ route('admin.navbar.update') }}"
      method="post"
      enctype="multipart/form-data"
      class="vstack gap-4">
  @csrf
  @method('PUT')

  {{-- ================= Identidade ================= --}}
  <div class="card">
    <div class="card-header fw-semibold">Identidade</div>
    <div class="card-body row g-3">
      <div class="col-md-6">
        <label class="form-label">Logo (opcional)</label>
        <input type="file" name="logo" class="form-control">
        @if(!empty($data['logo_path']))
          <small class="text-muted d-block mt-1">
            Atual: {{ $data['logo_path'] }}
          </small>
        @endif
      </div>
      <div class="col-md-6">
        <label class="form-label">Ou caminho da imagem</label>
        <input type="text"
               name="logo_path"
               value="{{ old('logo_path', $data['logo_path'] ?? '') }}"
               class="form-control"
               placeholder="images/novo_logo_320x100_tight.svg">
      </div>
    </div>
  </div>

  {{-- ================= Menu principal ================= --}}
  <div class="card">
    <div class="card-header fw-semibold d-flex align-items-center justify-content-between">
      <span>Itens de Menu</span>
      <button type="button" class="btn btn-sm btn-secondary" id="btn-add-menu">+ Adicionar</button>
    </div>

    <div class="card-body">
      @php $menu = old('menu', $data['menu'] ?? []); @endphp

      <div id="menu-list" class="vstack gap-2">
        @forelse($menu as $i => $row)
          <div class="row g-2 align-items-center">
            <div class="col-md-4">
              <label class="form-label mb-1">Rótulo</label>
              <input name="menu[{{ $i }}][label]"
                     value="{{ $row['label'] ?? '' }}"
                     placeholder="Ex.: O que é"
                     class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label mb-1">Href</label>
              <input name="menu[{{ $i }}][href]"
                     value="{{ $row['href'] ?? '' }}"
                     placeholder="/rota ou https://…"
                     class="form-control">
            </div>
            <div class="col-md-1">
              <div class="form-check mt-4">
                <input type="hidden" name="menu[{{ $i }}][is_external]" value="0">
                <input class="form-check-input"
                       type="checkbox"
                       value="1"
                       name="menu[{{ $i }}][is_external]"
                       @checked(!empty($row['is_external']))>
                <label class="form-check-label text-nowrap">Externo</label>
              </div>
            </div>
            <div class="col-md-1 d-flex align-items-end">
              <button type="button"
                      class="btn btn-outline-danger w-100"
                      data-remove-row>Remover</button>
            </div>
          </div>
        @empty
          <div class="text-muted" id="menu-empty">Nenhum item. Clique “Adicionar”.</div>
        @endforelse
      </div>
    </div>
  </div>

  <div class="text-end">
    <button class="btn btn-primary px-4">Salvar</button>
  </div>
</form>
@endsection

@push('lte-scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const menuList  = document.getElementById('menu-list');
  const menuEmpty = document.getElementById('menu-empty');

  function hideEmpty() {
    if (menuEmpty) menuEmpty.style.display = 'none';
  }

  function addMenu() {
    hideEmpty();
    const i = menuList.querySelectorAll('.row').length;
    const tpl = `
      <div class="row g-2 align-items-center">
        <div class="col-md-4">
          <label class="form-label mb-1">Rótulo</label>
          <input name="menu[${i}][label]" placeholder="Rótulo" class="form-control">
        </div>
        <div class="col-md-6">
          <label class="form-label mb-1">Href</label>
          <input name="menu[${i}][href]" placeholder="/rota ou https://…" class="form-control">
        </div>
        <div class="col-md-1">
          <div class="form-check mt-4">
            <input type="hidden" name="menu[${i}][is_external]" value="0">
            <input class="form-check-input" type="checkbox" name="menu[${i}][is_external]" value="1">
            <label class="form-check-label text-nowrap">Externo</label>
          </div>
        </div>
        <div class="col-md-1 d-flex align-items-end">
          <button type="button" class="btn btn-outline-danger w-100" data-remove-row>Remover</button>
        </div>
      </div>`;
    menuList.insertAdjacentHTML('beforeend', tpl);
  }

  document.getElementById('btn-add-menu')?.addEventListener('click', addMenu);

  document.addEventListener('click', function (e) {
    const btn = e.target.closest('[data-remove-row]');
    if (!btn) return;
    const row = btn.closest('.row');
    if (row) row.remove();
  });
});
</script>
@endpush
