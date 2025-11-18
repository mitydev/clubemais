{{-- resources/views/admin/page_sections/fields/faq.blade.php --}}
@php
  /** @var array $defaults */
  $mode = $mode ?? 'create';

  if ($mode === 'edit') {
      $c = array_merge($defaults, (array) ($section->content ?? []));
  } else {
      $oldContent = old('content', []);
      $c = array_merge($defaults, is_array($oldContent) ? $oldContent : []);
  }

  $items = collect($c['items'] ?? [])->values();
@endphp

<div data-faq-root>
  <div class="space-y-4 faq-fields">
    {{-- Título do bloco --}}
    <div>
      <label class="form-label">Título do bloco (opcional)</label>
      <input type="text"
             name="content[title]"
             class="form-control"
             value="{{ old('content.title', $c['title'] ?? '') }}">
    </div>

    {{-- Repeater de perguntas/respostas --}}
    <div class="space-y-3 js-faq-items">
      <label class="form-label d-block">Perguntas e respostas</label>

      @forelse ($items as $i => $item)
        <div class="border rounded p-3 mb-2 js-faq-item">
          <div class="mb-2 d-flex justify-content-between align-items-center">
            <label class="form-label mb-0">
              Pergunta <span class="text-muted faq-index">#{{ $i + 1 }}</span>
            </label>
            <button type="button" class="btn btn-sm btn-outline-danger js-faq-remove">
              Remover
            </button>
          </div>

          <div class="mb-2">
            <input type="text"
                   name="content[items][{{ $i }}][q]"
                   class="form-control"
                   value="{{ $item['q'] ?? '' }}">
          </div>

          <div>
            <label class="form-label">Resposta</label>
            <textarea name="content[items][{{ $i }}][a]"
                      rows="3"
                      class="form-control">{{ $item['a'] ?? '' }}</textarea>
          </div>
        </div>
      @empty
        {{-- pelo menos 1 item vazio para começar --}}
        <div class="border rounded p-3 mb-2 js-faq-item">
          <div class="mb-2 d-flex justify-content-between align-items-center">
            <label class="form-label mb-0">
              Pergunta <span class="text-muted faq-index">#1</span>
            </label>
            <button type="button" class="btn btn-sm btn-outline-danger js-faq-remove">
              Remover
            </button>
          </div>

          <div class="mb-2">
            <input type="text"
                   name="content[items][0][q]"
                   class="form-control">
          </div>

          <div>
            <label class="form-label">Resposta</label>
            <textarea name="content[items][0][a]"
                      rows="3"
                      class="form-control"></textarea>
          </div>
        </div>
      @endforelse
    </div>

    <div class="mt-2">
      <button type="button" class="btn btn-sm btn-outline-primary js-faq-add">
        + Adicionar pergunta
      </button>
    </div>

    {{-- Template para novos itens --}}
    <template data-faq-template>
      <div class="border rounded p-3 mb-2 js-faq-item">
        <div class="mb-2 d-flex justify-content-between align-items-center">
          <label class="form-label mb-0">
            Pergunta <span class="text-muted faq-index">#__</span>
          </label>
          <button type="button" class="btn btn-sm btn-outline-danger js-faq-remove">
            Remover
          </button>
        </div>

        <div class="mb-2">
          <input type="text"
                 name="content[items][__INDEX__][q]"
                 class="form-control">
        </div>

        <div>
          <label class="form-label">Resposta</label>
          <textarea name="content[items][__INDEX__][a]"
                    rows="3"
                    class="form-control"></textarea>
        </div>
      </div>
    </template>
  </div>

  {{-- JS local do repeater --}}
  <script>
  (function(){
    const scriptEl = document.currentScript;
    const root = scriptEl.closest('[data-faq-root]');
    if (!root) return;

    const list   = root.querySelector('.js-faq-items');
    const addBtn = root.querySelector('.js-faq-add');
    const tpl    = root.querySelector('template[data-faq-template]');

    if (!list || !addBtn || !tpl) return;

    function refreshIndexes() {
      const items = Array.from(list.querySelectorAll('.js-faq-item'));
      items.forEach(function(item, idx) {
        const idxLabel = item.querySelector('.faq-index');
        if (idxLabel) idxLabel.textContent = '#' + (idx + 1);

        item.querySelectorAll('input[name^="content[items]"], textarea[name^="content[items]"]').forEach(function(field){
          const isQ = field.name.includes('[q]');
          const base = isQ ? 'q' : 'a';
          field.name = 'content[items][' + idx + '][' + base + ']';
        });
      });

      items.forEach(function(item){
        const btnRemove = item.querySelector('.js-faq-remove');
        if (!btnRemove) return;

        if (items.length <= 1) {
          btnRemove.dataset.onlyClear = '1';
        } else {
          btnRemove.dataset.onlyClear = '0';
        }
      });
    }

    function bindRemove(btn){
      btn.addEventListener('click', function(){
        const item = btn.closest('.js-faq-item');
        if (!item) return;

        const items = Array.from(list.querySelectorAll('.js-faq-item'));
        if (btn.dataset.onlyClear === '1' || items.length <= 1) {
          item.querySelectorAll('input,textarea').forEach(function(field){
            field.value = '';
          });
        } else {
          item.remove();
        }
        refreshIndexes();
      });
    }

    list.querySelectorAll('.js-faq-item .js-faq-remove').forEach(bindRemove);
    refreshIndexes();

    addBtn.addEventListener('click', function(){
      const clone = tpl.content.firstElementChild.cloneNode(true);
      list.appendChild(clone);

      const btnRemove = clone.querySelector('.js-faq-remove');
      if (btnRemove) bindRemove(btnRemove);

      refreshIndexes();
    });
  })();
  </script>
</div>
