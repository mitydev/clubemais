@extends('layouts.lte')

@section('content')
<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Nova Página</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('pages.index') }}">Páginas</a></li>
            <li class="breadcrumb-item active">Nova</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <form action="{{ route('pages.store') }}" method="post">
        @csrf
        <div class="card">
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
              </div>
            @endif

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Título *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Slug (URL) *</label>
                <select id="slug" name="slug" class="form-control" required>
                  <option value="">Selecione um slug</option>
                  <option value="/" {{ old('slug') == '/' ? 'selected' : '' }}>/</option>
                  <option value="/o-que-e" {{ old('slug') == '/o-que-e' ? 'selected' : '' }}>/o-que-e</option>
                  <option value="/beneficios" {{ old('slug') == '/beneficios' ? 'selected' : '' }}>/beneficios</option>
                  <option value="/parceiros" {{ old('slug') == '/parceiros' ? 'selected' : '' }}>/parceiros</option>
                  <!-- <option value="/contato" {{ old('slug') == '/contato' ? 'selected' : '' }}>/contato</option>
                  <option value="/servicos" {{ old('slug') == '/servicos' ? 'selected' : '' }}>/servicos</option> -->
                </select>
                <small class="text-muted">Selecione o slug da página</small>
              </div>

              <div class="col-md-6">
                <label class="form-label">Meta Title</label>
                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
              </div>

              <div class="col-md-6">
                <label class="form-label">Template</label>
                <select name="template" class="form-select">
                  @php($tpls = $templates ?? config('pagebuilder.templates'))
                  <option value="">— default —</option>
                  @foreach($tpls as $key => $tpl)
                    <option value="{{ $key }}" {{ old('template')===$key ? 'selected' : '' }}>
                      {{ $tpl['label'] ?? ucfirst($key) }}
                    </option>
                  @endforeach
                </select>
                <small class="text-muted">O template define quais tipos de seção estarão disponíveis.</small>
              </div>

              <div class="col-12">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_description" rows="3" class="form-control">{{ old('meta_description') }}</textarea>
              </div>

              <div class="col-12">
                {{-- garante 0 quando desmarcado --}}
                <input type="hidden" name="is_active" value="0">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
                  <label class="form-check-label" for="is_active">Ativa</label>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('pages.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            <button class="btn btn-primary">Criar Página</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>

{{-- UX: prefixa "/" automaticamente --}}
<script>
  const slug = document.getElementById('slug');
  slug?.addEventListener('blur', () => {
    if (slug.value && slug.value[0] !== '/') slug.value = '/'+slug.value.replace(/^\/+/, '');
  });
</script>
@endsection
