@extends('layouts.lte')

@section('content')
<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Banner – [{{ $banner->title }}]</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('banners.index') }}">Banners</a></li>
            <li class="breadcrumb-item active">{{ $banner->title }}</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <form action="{{ route('banners.update', $banner) }}" method="post" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="card">
          <div class="card-body">
            @if (session('ok')) <div class="alert alert-success">{{ session('ok') }}</div> @endif
            @if ($errors->any())
              <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
            @endif

            <div class="row g-3">
              {{-- Grupo (mover de grupo reposiciona no fim do novo grupo) --}}
              <div class="col-md-6">
                <label class="form-label">Grupo (escolher)</label>
                <select name="group_banner_id" class="form-select">
                  <option value="">— selecione —</option>
                  @foreach($groups as $g)
                    <option value="{{ $g->id }}" {{ old('group_banner_id',$banner->group_banner_id)==$g->id?'selected':'' }}>
                      {{ $g->name }}
                    </option>
                  @endforeach
                </select>
                <small class="text-muted">Opcional se for criar um novo no campo ao lado.</small>
              </div>
              <div class="col-md-6">
                <label class="form-label">OU criar novo grupo</label>
                <input type="text" name="group" class="form-control" placeholder="Novo grupo…">
              </div>

              <div class="col-md-6">
                <label class="form-label">Título *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title',$banner->title) }}" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Link</label>
                <input type="url" name="link_url" class="form-control" value="{{ old('link_url',$banner->link_url) }}">
              </div>

              <div class="col-md-6">
                <label class="form-label">Substituir imagem</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Deixe em branco para manter a atual.</small>
              </div>

              <div class="col-md-3 d-flex align-items-end">
                <div class="form-check">
                  <input type="hidden" name="is_active" value="0">
                  <input class="form-check-input" type="checkbox" name="is_active" value="1" id="b_active" {{ old('is_active',$banner->is_active)?'checked':'' }}>
                  <label class="form-check-label" for="b_active">Ativo</label>
                </div>
              </div>

              <div class="col-md-3">
                @if($banner->image_path)
                  <img src="{{ Storage::url($banner->image_path) }}" alt="" class="img-fluid rounded">
                @endif
              </div>

              <div class="col-md-3">
                <label class="form-label">Posição</label>
                <input class="form-control" value="{{ $banner->position }}" readonly>
                <small class="text-muted">Gerenciada automaticamente por grupo.</small>
              </div>

              <div class="col-md-3">
                <label class="form-label">Início</label>
                <input type="datetime-local" name="starts_at" class="form-control" value="{{ old('starts_at',optional($banner->starts_at)->format('Y-m-d\TH:i')) }}">
              </div>

              <div class="col-md-3">
                <label class="form-label">Fim</label>
                <input type="datetime-local" name="ends_at" class="form-control" value="{{ old('ends_at',optional($banner->ends_at)->format('Y-m-d\TH:i')) }}">
              </div>
            </div>
          </div>

          <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('banners.index') }}" class="btn btn-outline-secondary">Voltar</a>
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
