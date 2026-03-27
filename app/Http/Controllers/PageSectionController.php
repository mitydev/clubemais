<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\{Page, PageSection, Banner, Destination};
use Illuminate\Support\Facades\Log;

class PageSectionController extends Controller
{
    protected function readContent(Request $r): array
    {
        // 1) Campos estruturados (inputs content[...])
        $content = $r->input('content', []);

        // se vier como string por algum bug, descarta
        if (!is_array($content)) {
            $content = [];
        }

        // Se tiver qualquer coisa, usamos só isso
        if (!empty($content)) {
            return $content;
        }

        // 2) Só se não tiver NADA em content[...] é que olhamos o JSON
        $jsonString = $r->input('content_json');
        if (is_string($jsonString) && trim($jsonString) !== '') {
            $decoded = json_decode($jsonString, true);
            if (is_array($decoded)) {
                return $decoded;
            }
        }

        return [];
    }

    /** Normaliza tipos específicos por section (booleans/ints etc.). */
    private function normalizeContent(string $type, array $data, array $defaults = []): array
    {
        if ($type === 'hero_slider') {
            $data['autoplay']      = filter_var($data['autoplay']      ?? ($defaults['autoplay'] ?? false), FILTER_VALIDATE_BOOLEAN);
            $data['delay_ms']      = (int)     ($data['delay_ms']      ?? ($defaults['delay_ms'] ?? 5000));
            $data['caption_show']  = filter_var($data['caption_show']  ?? ($defaults['caption_show'] ?? false), FILTER_VALIDATE_BOOLEAN);
            // 'height' e 'overlay' ficam como string mesmo
        }

        if ($type === 'destinations') {
            $data['title']        = $data['title']        ?? ($defaults['title'] ?? null);
            $data['layout']       = $data['layout']       ?? ($defaults['layout'] ?? 'cards-4');
            $data['button_text']  = $data['button_text']  ?? ($defaults['button_text'] ?? 'Veja o Hotel');
        }
        // adicione aqui normalizações para outras sections se quiser
        return $data;
    }

    public function store(Request $r, Page $page)
    {
        $type = $r->input('type');
        $reg  = config("pagebuilder.sections.$type");
        abort_unless($reg, 422, 'Tipo de seção inválido.');

        // 1) Lê o conteúdo vindo do form (content[...])
        $payload = $this->readContent($r);
        if (!is_array($payload)) {
            $payload = [];
        }

        // 2) Valida somente o que tem regra, mas sem perder chaves do payload
        $rules = $reg['rules'] ?? [];

        if (!empty($rules)) {
            $validated = validator($payload, $rules)->validate();
            $data = array_merge($payload, $validated);
        } else {
            $data = $payload;
        }

        // 🔎 Força leitura explícita de campos "sensíveis" (só pra garantir)
        if ($type === 'oque_e') {
            $text = $r->input('content.text');
            if ($text !== null) {
                $data['text'] = $text;
            }
        }
        if ($type === 'advantages') {
            $title = $r->input('content.title');
            if ($title !== null) {
                $data['title'] = $title;
            }
        }

        // 3) Normaliza campos específicos por tipo
        $data = $this->normalizeContent($type, $data, $reg['defaults'] ?? []);

        // 4) Extras (posição, ativo, banners, destinos, etc.)
        $extra = $r->validate([
            'position'               => ['nullable','integer'],
            'is_active'              => ['sometimes','boolean'],
            'banner_group_id'        => ['nullable','integer','exists:group_banners,id'],
            'banner_order'           => ['nullable','in:created_asc,created_desc,title_asc,title_desc'],
            'banner_ids'             => ['nullable','array'],
            'banner_ids.*'           => ['integer','exists:banners,id'],
            'destination_group_id'   => ['nullable','integer','exists:destination_groups,id'],
            'destination_order'      => ['nullable','in:position_asc,position_desc,created_asc,created_desc,title_asc,title_desc'],
        ]);

        $position = ($page->sections()->max('position') ?? 0) + 10;

        // 5) Meta
        $meta = [];
        if ($type === 'hero_slider') {
            $meta['banner_group_id'] = $extra['banner_group_id'] ?? null;
            $meta['banner_order']    = $extra['banner_order']    ?? 'created_asc';
        }
        if ($type === 'destinations') {
            $meta['destination_group_id'] = $extra['destination_group_id'] ?? null;
            $meta['destination_order']    = $extra['destination_order']    ?? 'position_asc';
        }

        // 6) Cria a section com defaults + data
        $section = $page->sections()->create([
            'type'      => $type,
            'position'  => (int) $r->input('position', $position),
            'is_active' => (bool) $r->input('is_active', true),
            'content'   => array_replace($reg['defaults'] ?? [], $data),
            'meta'      => $meta,
        ]);

        // 7) HERO SLIDER – vincula banners
        if ($type === 'hero_slider') {
            if (!empty($extra['banner_group_id'])) {
                $this->syncBannersFromGroup(
                    $section,
                    (int) $extra['banner_group_id'],
                    $extra['banner_order'] ?? 'created_asc'
                );
            } elseif (!empty($extra['banner_ids'])) {
                $this->syncBannersByIds($section, $extra['banner_ids']);
            } else {
                $section->banners()->detach();
            }
        }

        // 8) DESTINATIONS – vincula destinos
        if ($type === 'destinations') {
            if (!empty($extra['destination_group_id'])) {
                $this->syncDestinationsFromGroup(
                    $section,
                    (int) $extra['destination_group_id'],
                    $extra['destination_order'] ?? ($meta['destination_order'] ?? 'position_asc')
                );
            } else {
                $section->destinations()->detach();
            }
        }

        return back()->with('ok', 'Seção criada.');
    }

    public function update(Request $r, Page $page, PageSection $section)
    {
        abort_unless($section->page_id === $page->id, 404);

        $type = $section->type;
        $reg  = config("pagebuilder.sections.{$type}");
        $rules = $reg['rules'] ?? [];

        // 1) Lê o conteúdo vindo do form (content[...])
        $payload = $this->readContent($r);
        if (!is_array($payload)) {
            $payload = [];
        }

        // 2) Valida somente o que tem regra, mas sem perder chaves do payload
        if (!empty($rules)) {
            $validated = validator($payload, $rules)->validate();
            $data = array_merge($payload, $validated);
        } else {
            $data = $payload;
        }

        if (in_array($type, ['oque_e','advantages'])) {
            Log::debug('[PageSectionUpdate DEBUG]', [
                'type'            => $type,
                'content_input'   => $r->input('content', []),
                'payload'         => $payload,
                'data_final'      => $data,
                'content_before'  => $section->content,
            ]);
        }

        // 🔎 Força leitura explícita daqueles campos chatos
        if ($type === 'oque_e') {
            $text = $r->input('content.text');
            if ($text !== null) {
                $data['text'] = $text;
            }
        }
        if ($type === 'advantages') {
            $title = $r->input('content.title');
            if ($title !== null) {
                $data['title'] = $title;
            }
        }

        // 3) Normaliza campos específicos por tipo
        $data = $this->normalizeContent($type, $data, $reg['defaults'] ?? []);

        // 4) Extras
        $extra = $r->validate([
            'position'               => ['nullable','integer'],
            'is_active'              => ['sometimes','boolean'],
            'banner_group_id'        => ['nullable','integer','exists:group_banners,id'],
            'banner_order'           => ['nullable','in:created_asc,created_desc,title_asc,title_desc'],
            'banner_ids'             => ['nullable','array'],
            'banner_ids.*'           => ['integer','exists:banners,id'],
            'destination_group_id'   => ['nullable','integer','exists:destination_groups,id'],
            'destination_order'      => ['nullable','in:position_asc,position_desc,created_asc,created_desc,title_asc,title_desc'],
        ]);

        // 5) Campos base
        $section->position  = (int) $r->input('position', $section->position);
        $section->is_active = (bool) $r->input('is_active', true);

        // 6) Conteúdo: sempre defaults + data (não reaproveita lixo antigo)
        $section->content = array_replace($reg['defaults'] ?? [], $data);

        // 7) Meta
        $meta = (array) ($section->meta ?? []);
        if ($type === 'hero_slider') {
            $meta['banner_group_id'] = $extra['banner_group_id'] ?? ($meta['banner_group_id'] ?? null);
            $meta['banner_order']    = $extra['banner_order']    ?? ($meta['banner_order']    ?? 'created_asc');
        }
        if ($type === 'destinations') {
            $meta['destination_group_id'] = $extra['destination_group_id'] ?? ($meta['destination_group_id'] ?? null);
            $meta['destination_order']    = $extra['destination_order']    ?? ($meta['destination_order']    ?? 'position_asc');
        }
        $section->meta = $meta;

        $section->save();

        // 8) HERO SLIDER – vincula banners
        if ($type === 'hero_slider') {
            if (!empty($extra['banner_group_id'])) {
                $this->syncBannersFromGroup(
                    $section,
                    (int) $extra['banner_group_id'],
                    $extra['banner_order'] ?? ($meta['banner_order'] ?? 'created_asc')
                );
            } elseif (!empty($extra['banner_ids'])) {
                $this->syncBannersByIds($section, $extra['banner_ids']);
            } else {
                $section->banners()->detach();
            }
        }

        // 9) DESTINATIONS – vincula destinos
        if ($type === 'destinations') {
            if (!empty($extra['destination_group_id'])) {
                $this->syncDestinationsFromGroup(
                    $section,
                    (int) $extra['destination_group_id'],
                    $extra['destination_order'] ?? ($meta['destination_order'] ?? 'position_asc')
                );
            } else {
                $section->destinations()->detach();
            }
        }

        return back()->with('ok', 'Seção atualizada.');
    }

    public function destroy(Page $page, PageSection $section)
    {
        abort_unless($section->page_id === $page->id, 404);
        $section->delete();
        return back()->with('ok', 'Seção removida.');
    }

    private function syncBannersFromGroup(PageSection $section, int $groupId, string $order = 'created_asc'): void
    {
        $q = Banner::query()
            ->where('group_banner_id', $groupId)
            ->where('is_active', true)
            ->where(function ($qq) {
                $now = Carbon::now();
                $qq->whereNull('starts_at')->orWhere('starts_at', '<=', $now);
            })
            ->where(function ($qq) {
                $now = Carbon::now();
                $qq->whereNull('ends_at')->orWhere('ends_at', '>=', $now);
            });

        switch ($order) {
            case 'created_desc': $q->orderByDesc('id'); break;
            case 'title_asc':    $q->orderBy('title');  break;
            case 'title_desc':   $q->orderByDesc('title'); break;
            default:             $q->orderBy('id');     break;
        }

        $attach = [];
        $pos = 10;
        foreach ($q->get() as $b) {
            $attach[$b->id] = ['position' => $pos];
            $pos += 10;
        }

        $section->banners()->sync($attach);
    }

    private function syncBannersByIds(PageSection $section, array $ids): void
    {
        $attach = [];
        foreach (array_values($ids) as $i => $id) {
            $attach[$id] = ['position' => ($i + 1) * 10];
        }
        $section->banners()->sync($attach);
    }

    private function syncDestinationsFromGroup(PageSection $section, int $groupId, string $order = 'position_asc'): void
    {
        $q = Destination::query()
            ->where('destination_group_id', $groupId)
            ->where('is_active', true);

        switch ($order) {
            case 'position_desc': $q->orderByDesc('position'); break;
            case 'created_asc':  $q->orderBy('id');            break;
            case 'created_desc': $q->orderByDesc('id');        break;
            case 'title_asc':    $q->orderBy('title');         break;
            case 'title_desc':   $q->orderByDesc('title');     break;
            default:             $q->orderBy('position');      break; // position_asc
        }

        $attach = [];
        $pos = 10;
        foreach ($q->get() as $d) {
            $attach[$d->id] = ['position' => $pos];
            $pos += 10;
        }

        $section->destinations()->sync($attach);
    }

    private function syncDestinationsByIds(PageSection $section, array $ids): void
    {
        $attach = [];
        foreach (array_values($ids) as $i => $id) {
            $attach[$id] = ['position' => ($i + 1) * 10];
        }
        $section->destinations()->sync($attach);
    }
}