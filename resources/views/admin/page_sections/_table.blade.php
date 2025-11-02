@php
  use App\Models\GroupBanner;
  use App\Models\DestinationGroup;

  // coleções necessárias para os campos específicos
  $groups     = GroupBanner::withCount('banners')->orderBy('name')->get();
  $destGroups = DestinationGroup::withCount('destinations')->orderBy('name')->get();

  // helper local p/ serializar valores no textarea JSON quando precisar
  $stringify = function ($v) {
    if (is_null($v)) return '';
    if (is_bool($v)) return $v ? 'true' : 'false';
    if (is_scalar($v)) return (string)$v;
    return json_encode($v, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
  };
@endphp

@foreach($sections as $section)
  {{-- Cabeçalho da seção (linha de título) --}}
  <tr>
    <td colspan="100" class="bg-body-secondary">
      <strong>{{ config('pagebuilder.sections.'.$section->type.'.label', $section->type) }}</strong>
      <span class="text-muted">• posição: {{ $section->position }} • {{ $section->is_active ? 'ativa' : 'inativa' }}</span>
    </td>
  </tr>

  {{-- Linha de edição --}}
  <tr>
    <td colspan="100" class="bg-light">
      <form action="{{ route('page_sections.update', [$section->page, $section]) }}" method="post" class="p-3 js-section-edit" data-current-type="{{ $section->type }}">
        @csrf @method('PUT')

        @php
          $contentValue = old('content') !== null ? $stringify(old('content')) : $stringify($section->content ?? '');
          $currentType  = $section->type;
        @endphp

        <div class="row g-3 align-items-end">
          <div class="col-md-2">
            <label class="form-label">Posição</label>
            <input type="number" name="position" value="{{ old('position', $section->position) }}" class="form-control">

            {{-- garante 0 quando desmarcado --}}
            <input type="hidden" name="is_active" value="0">
            <div class="form-check mt-2">
              <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active',$section->is_active) ? 'checked' : '' }}>
              <label class="form-check-label">Ativa</label>
            </div>
          </div>

          <div class="col-md-5">
            <label class="form-label">Conteúdo (JSON) — opcional</label>
            <textarea name="content" rows="6" class="form-control">{{ $contentValue }}</textarea>
            <small class="text-muted d-block mt-1">Se preferir, use os campos ao lado e deixe este em branco.</small>
          </div>

          <div class="col-md-5">
            {{-- HERO / SLIDER --}}
            <div class="js-fields" data-type="hero_slider"
                 style="display: {{ $currentType==='hero_slider' ? 'block' : 'none' }};">
              @include('admin.page_sections.fields.hero_slider', [
                'mode'     => 'edit',
                'groups'   => $groups,
                'defaults' => config('pagebuilder.sections.hero_slider.defaults'),
                'data'     => $section,
              ])
            </div>

            {{-- O QUE É --}}
            <div class="js-fields" data-type="oque_e"
                 style="display: {{ $currentType==='oque_e' ? 'block' : 'none' }};">
              @include('admin.page_sections.fields.oque_e', [
                'mode'     => 'edit',
                'defaults' => config('pagebuilder.sections.oque_e.defaults'),
                'data'     => $section,
              ])
            </div>

            {{-- DESTINOS --}}
            <div class="js-fields" data-type="destinations"
                 style="display: {{ $currentType==='destinations' ? 'block' : 'none' }};">
              @include('admin.page_sections.fields.destinations', [
                'mode'        => 'edit',
                'destGroups'  => $destGroups,
                'defaults'    => config('pagebuilder.sections.destinations.defaults'),
                'data'        => $section,
              ])
            </div>

            {{-- VANTAGENS --}}
            <div class="js-fields" data-type="advantages"
                 style="display: {{ $currentType==='advantages' ? 'block' : 'none' }};">
              @include('admin.page_sections.fields.advantages', [
                'mode'     => 'edit',
                'defaults' => config('pagebuilder.sections.advantages.defaults'),
                'data'     => $section,
              ])
            </div>
            {{-- oqe_hero --}}
            <div class="js-fields" data-type="oqe_hero"
                style="display: {{ $currentType==='oqe_hero' ? 'block' : 'none' }};">
              @include('admin.page_sections.fields.oqe_hero', [
                'mode'     => 'edit',
                'defaults' => config('pagebuilder.sections.oqe_hero.defaults'),
                'data'     => $section,
              ])
            </div>

            {{-- oqe_para_quem --}}
            <div class="js-fields" data-type="oqe_para_quem"
                style="display: {{ $currentType==='oqe_para_quem' ? 'block' : 'none' }};">
              @include('admin.page_sections.fields.oqe_para_quem', [
                'mode'     => 'edit',
                'defaults' => config('pagebuilder.sections.oqe_para_quem.defaults'),
                'data'     => $section,
              ])
            </div>

            {{-- oqe_how --}}
            <div class="js-fields" data-type="oqe_how"
                style="display: {{ $currentType==='oqe_how' ? 'block' : 'none' }};">
              @include('admin.page_sections.fields.oqe_how', [
                'mode'     => 'edit',
                'defaults' => config('pagebuilder.sections.oqe_how.defaults'),
                'data'     => $section,
              ])
            </div>

            {{-- oqe_depo --}}
            <div class="js-fields" data-type="oqe_depo"
                style="display: {{ $currentType==='oqe_depo' ? 'block' : 'none' }};">
              @include('admin.page_sections.fields.oqe_depo', [
                'mode'     => 'edit',
                'defaults' => config('pagebuilder.sections.oqe_depo.defaults'),
                'data'     => $section,
              ])
            </div>

            <div class="js-fields" data-type="beneficios_intro" style="display: {{   $currentType==='beneficios_intro' ? 'block' : 'none' }};">
              @include('admin.page_sections.fields.beneficios_intro', [
                'mode'     => 'edit',
                'defaults' => config('pagebuilder.sections.beneficios_intro.defaults'),
                'data'     => $section,
              ])
            </div>

            <div class="js-fields" data-type="beneficios_numbers" style="display: {{ $currentType==='beneficios_numbers' ? 'block' : 'none' }};">
              @include('admin.page_sections.fields.beneficios_numbers', [
                'mode'     => 'edit',
                'defaults' => config('pagebuilder.sections.beneficios_numbers.defaults'),
                'data'     => $section,
              ])
            </div>

            {{-- edit (_table) --}}
            <div class="js-fields" data-type="parc_rules" style="display: {{ $currentType==='parc_rules' ? 'block':'none' }};">
              @include('admin.page_sections.fields.parc_rules', [
                'mode'     => 'edit',
                'defaults' => config('pagebuilder.sections.parc_rules.defaults'),
                'data'     => $section,
              ])
            </div>

            <div class="js-fields" data-type="parc_partner" style="display: {{ $currentType==='parc_partner' ? 'block':'none' }};">
              @include('admin.page_sections.fields.parc_partner', [
                'mode'     => 'edit',
                'defaults' => config('pagebuilder.sections.parc_partner.defaults'),
                'data'     => $section,
              ])
            </div>

            
          </div>
        </div>

        <div class="text-end mt-3">
          <button class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </td>
  </tr>

  {{-- Script: desabilita inputs dos blocos escondidos --}}
  <script>
    (function(){
      const form = document.currentScript.closest('tr').querySelector('form.js-section-edit');
      if (!form) return;
      const blocks = form.querySelectorAll('.js-fields');
      blocks.forEach(block => {
        const visible = getComputedStyle(block).display !== 'none';
        block.querySelectorAll('input,select,textarea,button').forEach(el => el.disabled = !visible);
      });
    })();
  </script>
@endforeach
