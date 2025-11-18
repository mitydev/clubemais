@extends('layouts.lte')

@section('content')
<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Página – [{{ $page->title }}]</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('pages.index') }}">Páginas</a></li>
            <li class="breadcrumb-item active">{{ $page->title }}</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      {{-- Dados principais da página --}}
      <form action="{{ route('pages.update', $page) }}" method="post">
        @csrf @method('PUT')
        <div class="card">
          <div class="card-header"><h3 class="card-title">{{ $page->title }}</h3></div>
          <div class="card-body">
            @if (session('ok'))
              <div class="alert alert-success">{{ session('ok') }}</div>
            @endif

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Título *</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $page->title) }}" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Slug (URL) *</label>
                <select id="slug" name="slug" class="form-control" required>
                  <option value="">Selecione um slug</option>
                  <option value="/" {{ old('slug', $page->slug) == '/' ? 'selected' : '' }}>/</option>
                  <option value="/o-que-e" {{ old('slug', $page->slug) == '/o-que-e' ? 'selected' : '' }}>/o-que-e</option>
                  <option value="/beneficios" {{ old('slug', $page->slug) == '/beneficios' ? 'selected' : '' }}>/beneficios</option>
                  <option value="/parceiros" {{ old('slug', $page->slug) == '/parceiros' ? 'selected' : '' }}>/parceiros</option>
                  <option value="/faq" {{ old('slug', $page->slug) == '/faq' ? 'selected' : '' }}>/faq</option>
                </select>
                <small class="text-muted">Selecione o slug da página</small>
              </div>

              <div class="col-md-6">
                <label class="form-label">Meta Title</label>
                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $page->meta_title) }}">
              </div>

              <div class="col-md-6">
                <label class="form-label">Template</label>
                @php($tpls = $templates ?? config('pagebuilder.templates'))
                <select name="template" class="form-select">
                  <option value="">— default —</option>
                  @foreach($tpls as $key => $tpl)
                    <?php
                      $rawLabel = $tpl['label'] ?? null;
                      if (is_array($rawLabel)) {
                          $rawLabel = $rawLabel['pt'] ?? $rawLabel['en'] ?? reset($rawLabel);
                      }
                      $label = $rawLabel ?: ucfirst($key);
                    ?>
                    <option value="{{ $key }}" {{ old('template', $page->template) === $key ? 'selected' : '' }}>
                      {{ $label }}
                    </option>
                  @endforeach
                </select>
                <small class="text-muted">Mudar o template altera os tipos de seção disponíveis abaixo.</small>
              </div>

              <div class="col-12">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_description" rows="3" class="form-control">{{ old('meta_description', $page->meta_description) }}</textarea>
              </div>

              <div class="col-12">
                {{-- garante 0 quando desmarcado --}}
                <input type="hidden" name="is_active" value="0">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                         {{ old('is_active', $page->is_active) ? 'checked' : '' }}>
                  <label class="form-check-label" for="is_active">Ativa</label>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-primary">Atualizar Página</button>
          </div>
        </div>
      </form>

      {{-- Seções da página --}}
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3 class="card-title">Seções</h3>
          <button class="btn btn-sm btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#collapseNewSection">
            Nova Seção
          </button>
        </div>

        <div id="collapseNewSection" class="collapse">
          <div class="card-body">
            @include('admin.page_sections._form_create', [
              'page' => $page,
              'sectionTypes' => $sectionTypes ?? [],
            ])
          </div>
        </div>

        <div class="card-body p-0">
          @include('admin.page_sections._table', ['sections' => $page->sections])
        </div>
      </div>
    </div>
  </div>
</main>

<script>
  const slug = document.getElementById('slug');
  slug?.addEventListener('blur', () => {
    if (slug.value && slug.value[0] !== '/') {
      slug.value = '/' + slug.value.replace(/^\/+/, '');
    }
  });
</script>
@endsection
