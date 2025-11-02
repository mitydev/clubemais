@extends('layouts.lte')

@section('content')
<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Banners</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('banners.index') }}">Banners</a></li>
            <li class="breadcrumb-item active">{{ ($mode ?? 'banners') === 'groups' ? 'Grupos' : 'Lista' }}</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">

      {{-- Filtros / Toggle de modo --}}
      @if(($mode ?? 'banners') === 'groups')
        {{-- MODO GRUPOS --}}
        <form class="card mb-3" method="get" action="{{ route('banners.groups') }}">
          <div class="card-body row g-2 align-items-end">
            <div class="col-md-6">
              <label class="form-label">Buscar grupo</label>
              <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Ex.: Home, Header…">
            </div>
            <div class="col-md-6 d-flex gap-2 justify-content-end">
              <a href="{{ route('banners.index') }}" class="btn btn-outline-primary">Banners</a>
              <button class="btn btn-primary">Filtrar</button>
              <a class="btn btn-outline-light border" href="{{ route('banners.groups') }}">Limpar</a>
              <a href="{{ route('banners.create') }}" class="btn btn-success ms-auto">Novo Banner</a>
            </div>
          </div>
        </form>
      @else
        {{-- MODO BANNERS (o seu atual) --}}
        <form class="card mb-3" method="get" action="{{ route('banners.index') }}">
          <div class="card-body row g-2 align-items-end">
            <div class="col-md-4">
              <label class="form-label">Buscar por título</label>
              <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Ex.: Promoção">
            </div>
            <div class="col-md-4">
              <label class="form-label">Grupo</label>
              <select name="group" class="form-select">
                <option value="">— todos —</option>
                @foreach($groups as $g)
                  <option value="{{ $g->id }}" {{ (string)request('group')===(string)$g->id ? 'selected':'' }}>
                    {{ $g->name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
              <button class="btn btn-outline-secondary">Filtrar</button>
              <a class="btn btn-outline-light border" href="{{ route('banners.index') }}">Limpar</a>
              <a href="{{ route('banners.groups') }}" class="btn btn-outline-primary">Por grupo</a>
              <a href="{{ route('banners.create') }}" class="btn btn-primary ms-auto">Novo Banner</a>
            </div>
          </div>
        </form>
      @endif

      <div class="card">
        <div class="card-body p-0">

          @if(($mode ?? 'banners') === 'groups')
            {{-- TABELA DE GRUPOS --}}
            <table class="table table-striped align-middle mb-0">
              <thead>
                <tr>
                  <th style="width:80px">#</th>
                  <th>Grupo</th>
                  <th style="width:140px">Qtd. Banners</th>
                  <th style="width:160px">Ações</th>
                </tr>
              </thead>
              <tbody>
                @forelse($groupsPage ?? [] as $g)
                  <tr>
                    <td>{{ $g->id }}</td>
                    <td>{{ $g->name }}</td>
                    <td><span class="badge bg-info">{{ $g->banners_count }}</span></td>
                    <td>
                      <a href="{{ route('banners.groups.edit', $g) }}" class="btn btn-sm btn-primary">Gerenciar</a>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="4" class="text-center p-4">Nenhum grupo encontrado.</td></tr>
                @endforelse
              </tbody>
            </table>

          @else
            {{-- SUA TABELA ATUAL DE BANNERS --}}
            <table class="table table-striped align-middle mb-0">
              <thead>
                <tr>
                  <th style="width:70px">#</th>
                  <th>Grupo</th>
                  <th>Posição</th>
                  <th>Título</th>
                  <th>Imagem</th>
                  <th>Link</th>
                  <th>Ativo</th>
                  <th style="width:140px">Ações</th>
                </tr>
              </thead>
              <tbody>
                @forelse($banners as $b)
                  <tr>
                    <td>{{ $b->id }}</td>
                    <td>{{ $b->group?->name ?? '—' }}</td>
                    <td>{{ $b->position }}</td>
                    <td>{{ $b->title }}</td>
                    <td>
                      @if($b->image_path)
                        <img src="{{ Storage::url($b->image_path) }}" alt="" style="height:38px;border-radius:4px">
                      @endif
                    </td>
                    <td class="text-truncate" style="max-width:260px">{{ $b->link_url }}</td>
                    <td>
                      <span class="badge {{ $b->is_active ? 'bg-success':'bg-secondary' }}">
                        {{ $b->is_active ? 'Sim':'Não' }}
                      </span>
                    </td>
                    <td>
                      <a href="{{ route('banners.edit', $b) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="8" class="text-center p-4">Nenhum banner cadastrado.</td></tr>
                @endforelse
              </tbody>
            </table>
          @endif

        </div>

        {{-- Paginação conforme o modo --}}
        @if(($mode ?? 'banners') === 'groups')
          <div class="card-footer">
            {{ ($groupsPage ?? null)?->withQueryString()->links() }}
          </div>
        @else
          @if(method_exists($banners,'links'))
            <div class="card-footer">
              {{ $banners->appends(request()->query())->links() }}
            </div>
          @endif
        @endif
      </div>
    </div>
  </div>
</main>
@endsection
