@php
  use App\Models\GroupBanner;
  use App\Models\DestinationGroup;

  $groups       = GroupBanner::withCount('banners')->orderBy('name')->get();
  $destGroups   = DestinationGroup::withCount('destinations')->orderBy('name')->get();

  // normaliza tipos (label)
  $sectionTypes = $sectionTypes ?? [];
  $normalizedTypes = [];
  foreach ($sectionTypes as $key => $cfg) {
    $label = is_array($cfg) ? ($cfg['label'] ?? ucfirst((string)$key)) : (string)$cfg;
    $normalizedTypes[(string)$key] = (string)$label;
  }

  // valor antigo do JSON (opcional)
  $oldContent = old('content');
  if (is_array($oldContent)) {
    $oldContent = json_encode($oldContent, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
  } elseif (!is_string($oldContent)) {
    $oldContent = '';
  }
@endphp

<form action="{{ route('page_sections.store', $page) }}" method="post">
  @csrf

  {{-- Tipo / Posição / Ativa --}}
  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Tipo de Seção *</label>
      <select id="js-type-create" name="type" class="form-select" required>
        @foreach($normalizedTypes as $key => $label)
          <option value="{{ $key }}" {{ old('type')===$key ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
      </select>
      <small class="text-muted">Selecione o tipo para ver os campos específicos.</small>
    </div>

    <div class="col-md-3">
      <label class="form-label">Posição</label>
      <input type="number" name="position" class="form-control" value="{{ old('position', 1) }}">
    </div>

    <div class="col-md-3 d-flex align-items-end">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="sec_active_c"
               {{ old('is_active', 1) ? 'checked' : '' }}>
        <label class="form-check-label" for="sec_active_c">Ativa</label>
      </div>
    </div>
  </div>

  {{-- Conteúdo JSON (opcional) --}}
  <div class="mb-3 mt-3">
    <label class="form-label">Conteúdo (JSON) — opcional</label>
    <textarea name="content" class="form-control" rows="6" placeholder="{}">{{ $oldContent }}</textarea>
    <small class="text-muted">Se preferir, preencha os campos abaixo e deixe este em branco.</small>
  </div>

  {{-- BLOCO DE CAMPOS POR TIPO --}}
  <div class="border rounded p-3 mb-3">
    {{-- hero_slider --}}
    <div class="js-fields" data-type="hero_slider">
      @include('admin.page_sections.fields.hero_slider', [
        'mode'        => 'create',
        'groups'      => $groups,
        'defaults'    => config('pagebuilder.sections.hero_slider.defaults'),
        'old'         => request()->old(),
      ])
    </div>

    {{-- oque_e --}}
    <div class="js-fields" data-type="oque_e">
      @include('admin.page_sections.fields.oque_e', [
        'mode'     => 'create',
        'defaults' => config('pagebuilder.sections.oque_e.defaults'),
        'old'      => request()->old(),
      ])
    </div>

    {{-- destinations --}}
    <div class="js-fields" data-type="destinations">
      @include('admin.page_sections.fields.destinations', [
        'mode'        => 'create',
        'destGroups'  => $destGroups,
        'defaults'    => config('pagebuilder.sections.destinations.defaults'),
        'old'         => request()->old(),
      ])
    </div>

    {{-- advantages --}}
    <div class="js-fields" data-type="advantages">
      @include('admin.page_sections.fields.advantages', [
        'mode'     => 'create',
        'defaults' => config('pagebuilder.sections.advantages.defaults'),
        'old'      => request()->old(),
      ])
    </div>

    {{-- oqe_hero --}}
    <div class="js-fields" data-type="oqe_hero">
      @include('admin.page_sections.fields.oqe_hero', [
        'mode'     => 'create',
        'defaults' => config('pagebuilder.sections.oqe_hero.defaults'),
        'old'      => request()->old(),
      ])
    </div>

    {{-- oqe_para_quem --}}
    <div class="js-fields" data-type="oqe_para_quem">
      @include('admin.page_sections.fields.oqe_para_quem', [
        'mode'     => 'create',
        'defaults' => config('pagebuilder.sections.oqe_para_quem.defaults'),
        'old'      => request()->old(),
      ])
    </div>

    {{-- oqe_how --}}
    <div class="js-fields" data-type="oqe_how">
      @include('admin.page_sections.fields.oqe_how', [
        'mode'     => 'create',
        'defaults' => config('pagebuilder.sections.oqe_how.defaults'),
        'old'      => request()->old(),
      ])
    </div>

    {{-- oqe_depo --}}
    <div class="js-fields" data-type="oqe_depo">
      @include('admin.page_sections.fields.oqe_depo', [
        'mode'     => 'create',
        'defaults' => config('pagebuilder.sections.oqe_depo.defaults'),
        'old'      => request()->old(),
      ])
    </div>

    {{-- beneficios_intro --}}
    <div class="js-fields" data-type="beneficios_intro">
      @include('admin.page_sections.fields.beneficios_intro', [
        'mode'     => 'create',
        'defaults' => config('pagebuilder.sections.beneficios_intro.defaults'),
        'old'      => request()->old(),
      ])
    </div>

    {{-- beneficios_numbers --}}
    <div class="js-fields" data-type="beneficios_numbers">
      @include('admin.page_sections.fields.beneficios_numbers', [
        'mode'     => 'create',
        'defaults' => config('pagebuilder.sections.beneficios_numbers.defaults'),
        'old'      => request()->old(),
      ])
    </div>

    {{-- create --}}
    <div class="js-fields" data-type="parc_rules">
      @include('admin.page_sections.fields.parc_rules', [
        'mode'     => 'create',
        'defaults' => config('pagebuilder.sections.parc_rules.defaults'),
        'old'      => request()->old(),
      ])
    </div>

    <div class="js-fields" data-type="parc_partner">
      @include('admin.page_sections.fields.parc_partner', [
        'mode'     => 'create',
        'defaults' => config('pagebuilder.sections.parc_partner.defaults'),
        'old'      => request()->old(),
      ])
    </div>

  </div>

  <div class="text-end">
    <button class="btn btn-primary">Adicionar Seção</button>
  </div>
</form>

{{-- JS: mostra/esconde campos por tipo e desabilita inputs ocultos --}}
<script>
  (function () {
    const select = document.getElementById('js-type-create');
    const blocks = Array.from(document.querySelectorAll('.js-fields'));

    function toggleBlocks() {
      const t = select.value;
      blocks.forEach(b => {
        const on = b.dataset.type === t;
        b.style.display = on ? '' : 'none';
        // habilita/desabilita inputs do bloco para não "vazar" dados
        b.querySelectorAll('input,select,textarea').forEach(el => {
          el.disabled = !on;
        });
      });
    }
    select?.addEventListener('change', toggleBlocks);
    toggleBlocks();
  })();
</script>
