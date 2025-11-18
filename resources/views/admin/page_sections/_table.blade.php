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
      <form action="{{ route('page_sections.update', [$section->page, $section]) }}"
            method="post"
            class="p-3 js-section-edit">
        @csrf
        @method('PUT')

        @php
          $currentType = $section->type;

          // valor para o textarea de JSON desta section
          $contentValue = old('content_json');
          if ($contentValue === null) {
              $contentValue = $stringify($section->content ?? '');
          }
        @endphp

        <div class="row g-3 align-items-end">
          {{-- Coluna esquerda: posição / ativa / JSON --}}
          <div class="col-md-2">
            <label class="form-label">Posição</label>
            <input type="number"
                   name="position"
                   value="{{ old('position', $section->position) }}"
                   class="form-control">

            {{-- garante 0 quando desmarcado --}}
            <input type="hidden" name="is_active" value="0">
            <div class="form-check mt-2">
              <input class="form-check-input"
                     type="checkbox"
                     name="is_active"
                     value="1"
                     {{ old('is_active', $section->is_active) ? 'checked' : '' }}>
              <label class="form-check-label">Ativa</label>
            </div>
          </div>

          <div class="col-md-5">
            <label class="form-label">Conteúdo (JSON) — opcional</label>
            <textarea name="content_json"
                      rows="6"
                      class="form-control">{{ old('content_json', $contentValue) }}</textarea>
            <small class="text-muted d-block mt-1">
              Se preferir, use os campos ao lado e deixe este em branco.
            </small>
          </div>

          {{-- Coluna direita: campos específicos do tipo --}}
          <div class="col-md-5">
            @switch($currentType)

              @case('hero_slider')
                @include('admin.page_sections.fields.hero_slider', [
                  'mode'     => 'edit',
                  'groups'   => $groups,
                  'defaults' => config('pagebuilder.sections.hero_slider.defaults'),
                  'data'     => $section,
                ])
                @break

              @case('oque_e')
                @include('admin.page_sections.fields.oque_e', [
                  'mode'     => 'edit',
                  'defaults' => config('pagebuilder.sections.oque_e.defaults'),
                  'data'     => $section,
                ])
                @break

              @case('destinations')
                @include('admin.page_sections.fields.destinations', [
                  'mode'        => 'edit',
                  'destGroups'  => $destGroups,
                  'defaults'    => config('pagebuilder.sections.destinations.defaults'),
                  'data'        => $section,
                ])
                @break

              @case('advantages')
                @include('admin.page_sections.fields.advantages', [
                  'mode'     => 'edit',
                  'defaults' => config('pagebuilder.sections.advantages.defaults'),
                  'data'     => $section,
                ])
                @break

              @case('faq')
                @include('admin.page_sections.fields.faq', [
                  'mode'     => 'edit',
                  'defaults' => config('pagebuilder.sections.faq.defaults'),
                  'section'  => $section,
                ])
                @break

              @case('oqe_hero')
                @include('admin.page_sections.fields.oqe_hero', [
                  'mode'     => 'edit',
                  'defaults' => config('pagebuilder.sections.oqe_hero.defaults'),
                  'data'     => $section,
                ])
                @break

              @case('oqe_para_quem')
                @include('admin.page_sections.fields.oqe_para_quem', [
                  'mode'     => 'edit',
                  'defaults' => config('pagebuilder.sections.oqe_para_quem.defaults'),
                  'data'     => $section,
                ])
                @break

              @case('oqe_how')
                @include('admin.page_sections.fields.oqe_how', [
                  'mode'     => 'edit',
                  'defaults' => config('pagebuilder.sections.oqe_how.defaults'),
                  'data'     => $section,
                ])
                @break

              @case('oqe_depo')
                @include('admin.page_sections.fields.oqe_depo', [
                  'mode'     => 'edit',
                  'defaults' => config('pagebuilder.sections.oqe_depo.defaults'),
                  'data'     => $section,
                ])
                @break

              @case('beneficios_intro')
                @include('admin.page_sections.fields.beneficios_intro', [
                  'mode'     => 'edit',
                  'defaults' => config('pagebuilder.sections.beneficios_intro.defaults'),
                  'data'     => $section,
                ])
                @break

              @case('beneficios_numbers')
                @include('admin.page_sections.fields.beneficios_numbers', [
                  'mode'     => 'edit',
                  'defaults' => config('pagebuilder.sections.beneficios_numbers.defaults'),
                  'data'     => $section,
                ])
                @break

              @case('parc_rules')
                @include('admin.page_sections.fields.parc_rules', [
                  'mode'     => 'edit',
                  'defaults' => config('pagebuilder.sections.parc_rules.defaults'),
                  'data'     => $section,
                ])
                @break

              @case('parc_partner')
                @include('admin.page_sections.fields.parc_partner', [
                  'mode'     => 'edit',
                  'defaults' => config('pagebuilder.sections.parc_partner.defaults'),
                  'data'     => $section,
                ])
                @break

            @endswitch
          </div>
        </div>

        <div class="text-end mt-3">
          <button class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </td>
  </tr>
@endforeach
