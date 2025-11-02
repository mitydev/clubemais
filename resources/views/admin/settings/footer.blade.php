@extends('layouts.lte')

@section('content')
<h1 class="h4 mb-4">Footer</h1>

@if(session('ok')) <div class="alert alert-success">{{ session('ok') }}</div> @endif

<form action="{{ route('admin.footer.update') }}"
      method="post"
      enctype="multipart/form-data"
      class="vstack gap-4">
  @csrf @method('PUT')

  {{-- ================= Identidade / Contato ================= --}}
  <div class="card">
    <div class="card-header fw-semibold">Identidade & Contato</div>
    <div class="card-body row g-3">
      <div class="col-md-6">
        <label class="form-label">Logo (opcional)</label>
        <input type="file" name="logo" class="form-control">
        @if(!empty($data['logo_path']))
          <small class="text-muted d-block mt-1">Atual: {{ $data['logo_path'] }}</small>
        @endif
      </div>
      <div class="col-md-6">
        <label class="form-label">Ou caminho da imagem</label>
        <input type="text" name="logo_path"
               value="{{ old('logo_path', $data['logo_path'] ?? '') }}"
               class="form-control"
               placeholder="images/Logotipov2.svg">
      </div>

      <div class="col-12">
        <label class="form-label">Sobre (texto curto)</label>
        <textarea name="about" class="form-control" rows="3">{{ old('about', $data['about'] ?? '') }}</textarea>
      </div>

      <div class="col-md-4">
        <label class="form-label">Endereço</label>
        <textarea name="address" class="form-control" rows="3">{{ old('address', $data['address'] ?? '') }}</textarea>
      </div>
      <div class="col-md-4">
        <label class="form-label">Email</label>
        <input name="email" value="{{ old('email', $data['email'] ?? '') }}" class="form-control">
      </div>
      <div class="col-md-4">
        <label class="form-label">Telefone</label>
        <input name="phone" value="{{ old('phone', $data['phone'] ?? '') }}" class="form-control">
      </div>
    </div>
  </div>

  {{-- ================= Redes Sociais ================= --}}
  <div class="card">
    <div class="card-header fw-semibold d-flex align-items-center justify-content-between">
      <span>Redes Sociais</span>
      <button type="button" class="btn btn-sm btn-secondary" id="btn-add-social">+ Adicionar</button>
    </div>
    <div class="card-body">
      @php $social = old('social', $data['social'] ?? []); @endphp

      <div id="social-list" class="vstack gap-2">
        @forelse($social as $i => $row)
          <div class="row g-2 align-items-center">
            <div class="col-md-3">
              <label class="form-label mb-1">Ícone</label>
              <select name="social[{{ $i }}][icon]" class="form-select">
                @foreach(['x','instagram','facebook','youtube','tiktok','linkedin'] as $opt)
                  <option value="{{ $opt }}" @selected(($row['icon'] ?? '') === $opt)>{{ ucfirst($opt) }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-5">
              <label class="form-label mb-1">URL</label>
              <input name="social[{{ $i }}][url]" value="{{ $row['url'] ?? '' }}" placeholder="https://…" class="form-control">
            </div>
            <div class="col-md-3">
              <label class="form-label mb-1">Ícone customizado</label>
              <input type="file" name="social[{{ $i }}][icon_file]" class="form-control">
              @if(!empty($row['icon_path']))
                <small class="text-muted d-block mt-1">Atual: {{ $row['icon_path'] }}</small>
              @endif
            </div>
            <div class="col-md-1 d-flex align-items-end">
              <button type="button" class="btn btn-outline-danger w-100" data-remove-row>Remover</button>
            </div>
          </div>
        @empty
          <div class="text-muted" id="social-empty">Nenhum item. Clique “Adicionar”.</div>
        @endforelse
      </div>
    </div>
  </div>

  {{-- ================= Links Rápidos ================= --}}
  <div class="card">
    <div class="card-header fw-semibold d-flex align-items-center justify-content-between">
      <span>Links Rápidos</span>
      <button type="button" class="btn btn-sm btn-secondary" id="btn-add-link">+ Adicionar</button>
    </div>
    <div class="card-body">
      @php $links = old('quick_links', $data['quick_links'] ?? []); @endphp

      <div id="links-list" class="vstack gap-2">
        @forelse($links as $i => $row)
          <div class="row g-2 align-items-center">
            <div class="col-md-4">
              <label class="form-label mb-1">Rótulo</label>
              <input name="quick_links[{{ $i }}][label]" value="{{ $row['label'] ?? '' }}" placeholder="Rótulo" class="form-control">
            </div>
            <div class="col-md-7">
              <label class="form-label mb-1">Href</label>
              <input name="quick_links[{{ $i }}][href]" value="{{ $row['href'] ?? '' }}" placeholder="/rota ou https://…" class="form-control">
            </div>
            <div class="col-md-1 d-flex align-items-end">
              <button type="button" class="btn btn-outline-danger w-100" data-remove-row>Remover</button>
            </div>
          </div>
        @empty
          <div class="text-muted" id="links-empty">Nenhum item. Clique “Adicionar”.</div>
        @endforelse
      </div>
    </div>
  </div>

  {{-- ================= Newsletter ================= --}}
  <div class="card">
    <div class="card-header fw-semibold">Newsletter</div>
    <div class="card-body row g-3">
      <div class="col-12 form-check">
        <input class="form-check-input" type="checkbox" id="nl_enabled" name="newsletter[enabled]" value="1"
               @checked(old('newsletter.enabled', data_get($data,'newsletter.enabled', true)))>
        <label class="form-check-label" for="nl_enabled">Exibir card de cadastro</label>
      </div>
      <div class="col-md-4"><input class="form-control" name="newsletter[title]"        value="{{ old('newsletter.title', data_get($data,'newsletter.title')) }}"        placeholder="Título"></div>
      <div class="col-md-4"><input class="form-control" name="newsletter[button]"       value="{{ old('newsletter.button', data_get($data,'newsletter.button')) }}"       placeholder="Texto do botão"></div>
      <div class="col-md-4"><input class="form-control" name="newsletter[placeholder]"  value="{{ old('newsletter.placeholder', data_get($data,'newsletter.placeholder')) }}" placeholder="Placeholder do email"></div>
      <div class="col-12"><textarea class="form-control" rows="3" name="newsletter[text]" placeholder="Descrição">{{ old('newsletter.text', data_get($data,'newsletter.text')) }}</textarea></div>
      <div class="col-12"><input class="form-control" name="newsletter[action]" value="{{ old('newsletter.action', data_get($data,'newsletter.action')) }}" placeholder="URL/rota do submit"></div>
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
  const socialList = document.getElementById('social-list');
  const linksList  = document.getElementById('links-list');
  const socialEmpty = document.getElementById('social-empty');
  const linksEmpty  = document.getElementById('links-empty');

  function hideEmpty(place){
    if (place === 'social' && socialEmpty) socialEmpty.style.display = 'none';
    if (place === 'links'  && linksEmpty)  linksEmpty.style.display  = 'none';
  }

  function addSocial(){
    hideEmpty('social');
    const i = socialList.querySelectorAll('.row').length;
    const tpl = `
      <div class="row g-2 align-items-center">
        <div class="col-md-3">
          <label class="form-label mb-1">Ícone</label>
          <select name="social[${i}][icon]" class="form-select">
            <option>x</option><option>instagram</option><option>facebook</option>
            <option>youtube</option><option>tiktok</option><option>linkedin</option>
          </select>
        </div>
        <div class="col-md-5">
          <label class="form-label mb-1">URL</label>
          <input name="social[${i}][url]" placeholder="https://…" class="form-control">
        </div>
        <div class="col-md-3">
          <label class="form-label mb-1">Ícone customizado</label>
          <input type="file" name="social[${i}][icon_file]" class="form-control">
        </div>
        <div class="col-md-1 d-flex align-items-end">
          <button type="button" class="btn btn-outline-danger w-100" data-remove-row>Remover</button>
        </div>
      </div>`;
    socialList.insertAdjacentHTML('beforeend', tpl);
  }

  function addLink(){
    hideEmpty('links');
    const i = linksList.querySelectorAll('.row').length;
    const tpl = `
      <div class="row g-2 align-items-center">
        <div class="col-md-4">
          <label class="form-label mb-1">Rótulo</label>
          <input name="quick_links[${i}][label]" placeholder="Rótulo" class="form-control">
        </div>
        <div class="col-md-7">
          <label class="form-label mb-1">Href</label>
          <input name="quick_links[${i}][href]"  placeholder="/rota ou https://…" class="form-control">
        </div>
        <div class="col-md-1 d-flex align-items-end">
          <button type="button" class="btn btn-outline-danger w-100" data-remove-row>Remover</button>
        </div>
      </div>`;
    linksList.insertAdjacentHTML('beforeend', tpl);
  }

  document.getElementById('btn-add-social')?.addEventListener('click', addSocial);
  document.getElementById('btn-add-link')?.addEventListener('click', addLink);

  document.addEventListener('click', function (e) {
    const btn = e.target.closest('[data-remove-row]');
    if (!btn) return;
    const row = btn.closest('.row');
    if (row) row.remove();
  });
});
</script>
@endpush
