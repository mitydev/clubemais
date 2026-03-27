@extends('layouts.lte')

@section('content')
<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Destino – [{{ $destino->title }}]</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('destinos.index') }}">Destinos</a></li>
            <li class="breadcrumb-item active">{{ $destino->title }}</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <form action="{{ route('destinos.update', $destino) }}" method="post" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="card">
          <div class="card-body">
            @if (session('ok')) <div class="alert alert-success">{{ session('ok') }}</div> @endif
            @if ($errors->any())
              <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
            @endif

            <div class="row g-3">
              {{-- Grupo --}}
              <div class="col-md-6">
                <label class="form-label">Grupo (escolher)</label>
                <select name="destination_group_id" class="form-select">
                  <option value="">— selecione —</option>
                  @foreach($groups as $g)
                    <option value="{{ $g->id }}" {{ old('destination_group_id',$destino->destination_group_id)==$g->id?'selected':'' }}>
                      {{ $g->name }}
                    </option>
                  @endforeach
                </select>
                <small class="text-muted">Opcional se for criar um novo ao lado.</small>
              </div>

              <div class="col-md-6">
                <label class="form-label">OU criar novo grupo</label>
                <input type="text" name="group" class="form-control" placeholder="Novo grupo…">
              </div>

              <div class="col-md-6">
                <label class="form-label">Título *</label>
                <input type="text" name="title" class="form-control"
                      value="{{ old('title',$destino->title) }}" required maxlength="32">
              </div>

              <div class="col-md-6">
                <label class="form-label">Link</label>
                <input type="url" name="link_url" class="form-control"
                       value="{{ old('link_url',$destino->link_url) }}" placeholder="https://...">
              </div>

              <div class="col-md-12">
                <label class="form-label">Descrição curta</label>
                <input type="text" name="excerpt" class="form-control"
                      value="{{ old('excerpt',$destino->excerpt) }}" placeholder="Frase breve para o card" maxlength="85">
              </div>

              <div class="col-md-6">
                <label class="form-label">Substituir imagem</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Deixe em branco para manter a atual.</small>
              </div>

              <div class="col-md-3 d-flex align-items-end">
                <div class="form-check">
                  <input type="hidden" name="is_active" value="0">
                  <input class="form-check-input" type="checkbox" name="is_active" value="1"
                         id="d_active" {{ old('is_active',$destino->is_active)?'checked':'' }}>
                  <label class="form-check-label" for="d_active">Ativo</label>
                </div>
              </div>

              <div class="col-md-3">
                @if($destino->image_path)
                  <img src="{{ Storage::url($destino->image_path) }}" alt="Imagem atual"
                       class="img-fluid rounded">
                @endif
              </div>

              <div class="col-md-3">
                <label class="form-label">Posição</label>
                <input class="form-control" value="{{ $destino->position }}" readonly>
                <small class="text-muted">Gerenciada automaticamente por grupo.</small>
              </div>

              <div class="col-md-3">
                <label class="form-label">Início</label>
                <input type="datetime-local" name="starts_at" class="form-control"
                       value="{{ old('starts_at',optional($destino->starts_at)->format('Y-m-d\TH:i')) }}">
              </div>

              <div class="col-md-3">
                <label class="form-label">Fim</label>
                <input type="datetime-local" name="ends_at" class="form-control"
                       value="{{ old('ends_at',optional($destino->ends_at)->format('Y-m-d\TH:i')) }}">
              </div>
            </div>
          </div>

          <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('destinos.index') }}" class="btn btn-outline-secondary">Voltar</a>
            <div>
              <button class="btn btn-primary">Salvar</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
@endsection
