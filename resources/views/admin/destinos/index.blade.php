@extends('layouts.lte')

@section('content')
<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Destinos</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('destinos.index') }}">Destinos</a></li>
            <li class="breadcrumb-item active">{{ ($mode ?? 'items') === 'groups' ? 'Grupos' : 'Lista' }}</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">

      {{-- Filtros / Toggle --}}
      @if(($mode ?? 'items') === 'groups')
        <form class="card mb-3" method="get" action="{{ route('destinos.groups') }}">
          <div class="card-body row g-2 align-items-end">
            <div class="col-md-6">
              <label class="form-label">Buscar grupo</label>
              <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Ex.: Praias, Serra…">
            </div>
            <div class="col-md-6 d-flex gap-2 justify-content-end">
              <a href="{{ route('destinos.index') }}" class="btn btn-outline-primary">Itens</a>
              <button class="btn btn-primary">Filtrar</button>
              <a class="btn btn-outline-light border" href="{{ route('destinos.groups') }}">Limpar</a>
              <a href="{{ route('destinos.create') }}" class="btn btn-success ms-auto">Novo Destino</a>
            </div>
          </div>
        </form>
      @else
        <form class="card mb-3" method="get" action="{{ route('destinos.index') }}">
          <div class="card-body row g-2 align-items-end">
            <div class="col-md-4">
              <label class="form-label">Buscar por título</label>
              <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Ex.: Porto, Serra…">
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
              <a class="btn btn-outline-light border" href="{{ route('destinos.index') }}">Limpar</a>
              <a href="{{ route('destinos.groups') }}" class="btn btn-outline-primary">Por grupo</a>
              <a href="{{ route('destinos.create') }}" class="btn btn-primary ms-auto">Novo Destino</a>
            </div>
          </div>
        </form>
      @endif

      <div class="card">
        <div class="card-body p-0">
          @if(($mode ?? 'items') === 'groups')
            <table class="table table-striped align-middle mb-0">
              <thead>
                <tr>
                  <th style="width:80px">#</th>
                  <th>Grupo</th>
                  <th style="width:160px">Qtd.</th>
                  <th style="width:160px">Ações</th>
                </tr>
              </thead>
              <tbody>
                @forelse($groupsPage ?? [] as $g)
                  <tr>
                    <td>{{ $g->id }}</td>
                    <td>{{ $g->name }}</td>
                    <td><span class="badge bg-info">{{ $g->destinations_count }}</span></td>
                    <td>
                      <a href="{{ route('destinos.groups.edit', $g) }}" class="btn btn-sm btn-primary">Gerenciar</a>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="4" class="text-center p-4">Nenhum grupo encontrado.</td></tr>
                @endforelse
              </tbody>
            </table>
          @else
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
                @forelse($destinos as $d)
                  <tr>
                    <td>{{ $d->id }}</td>
                    <td>{{ $d->group?->name ?? '—' }}</td>
                    <td>{{ $d->position }}</td>
                    <td>
                      <div class="fw-semibold">{{ $d->title }}</div>
                      @if($d->excerpt)<small class="text-muted">{{ \Illuminate\Support\Str::limit($d->excerpt, 60) }}</small>@endif
                    </td>
                    <td>
                      @if($d->image_path)
                        <img src="{{ Storage::url($d->image_path) }}" alt="" style="height:38px;border-radius:4px;object-fit:cover">
                      @endif
                    </td>
                    <td class="text-truncate" style="max-width:260px">{{ $d->link_url }}</td>
                    <td>
                      <span class="badge {{ $d->is_active ? 'bg-success':'bg-secondary' }}">
                        {{ $d->is_active ? 'Sim':'Não' }}
                      </span>
                    </td>
                    <td>
                      <a href="{{ route('destinos.edit', $d) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="8" class="text-center p-4">Nenhum destino cadastrado.</td></tr>
                @endforelse
              </tbody>
            </table>
          @endif
        </div>

        @if(($mode ?? 'items') === 'groups')
          <div class="card-footer">
            {{ ($groupsPage ?? null)?->withQueryString()->links() }}
          </div>
        @else
          @if(method_exists($destinos,'links'))
            <div class="card-footer">
              {{ $destinos->appends(request()->query())->links() }}
            </div>
          @endif
        @endif
      </div>
    </div>
  </div>
</main>
@endsection
