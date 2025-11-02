@extends('layouts.lte')

@section('content')
<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Páginas</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('pages.index') }}">Home</a></li>
            <li class="breadcrumb-item active">Páginas</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3 class="card-title">Lista</h3>
          <a href="{{ route('pages.create') }}" class="btn btn-primary btn-sm">Nova Página</a>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped mb-0">
            <thead>
              <tr>
                <th style="width:80px">#</th>
                <th>Título</th>
                <th>Slug</th>
                <th>Template</th>
                <th>Ativa</th>
                <th style="width:140px">Ações</th>
              </tr>
            </thead>
            <tbody>
              @forelse($pages as $p)
              <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->title }}</td>
                <td><code>{{ $p->slug }}</code></td>
                <td>{{ $p->template ?: '-' }}</td>
                <td>
                  <span class="badge {{ $p->is_active ? 'bg-success' : 'bg-secondary' }}">
                    {{ $p->is_active ? 'Sim' : 'Não' }}
                  </span>
                </td>
                <td>
                  <a href="{{ route('pages.edit', $p) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                </td>
              </tr>
              @empty
              <tr><td colspan="6" class="text-center p-4">Nenhuma página cadastrada.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
        @if(method_exists($pages,'links'))
          <div class="card-footer">{{ $pages->links() }}</div>
        @endif
      </div>
    </div>
  </div>
</main>
@endsection
