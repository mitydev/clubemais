<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Banner;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PageShowController extends Controller
{
    /**
     * Resolve e renderiza uma página pelo slug.
     * Ex.:  "/"  => slug "/"
     *       "/o-que-e" => slug "/o-que-e"
     */
    public function __invoke(Request $request, ?string $slug = null)
    {
        $slug = $this->normalizeSlug($slug);

        // Cache leve para página + seções
        $cacheKey = "page.render:{$slug}";
        [$page, $sections] = Cache::remember($cacheKey, now()->addMinutes(5), function () use ($slug) {
            $page = Page::query()
                ->where('is_active', true)
                ->where('slug', $slug)
                ->first();

            if (!$page) {
                return [null, collect()];
            }

            $sections = $page->sections()
                ->where('is_active', true)
                ->orderBy('position')
                ->get();

            // Enriquecer seções de acordo com o "expects" do builder (banners/destinos)
            $sections->transform(function ($s) {
                $meta = (array) ($s->meta ?? []);

                // Grupo de BANNERS?
                if (!empty($meta['banner_group_id'])) {
                    $s->banners = $this->loadBanners(
                        (int) $meta['banner_group_id'],
                        $meta['banner_order'] ?? 'created_asc'
                    );
                }

                // Grupo de DESTINOS?
                if (!empty($meta['destination_group_id'])) {
                    $s->destinations = $this->loadDestinations(
                        (int) $meta['destination_group_id'],
                        $meta['destination_order'] ?? 'created_asc'
                    );
                }

                return $s;
            });

            return [$page, $sections];
        });

        if (!$page) {
            abort(404);
        }

        // Blade genérica que inclui parciais por tipo de seção:
        // resources/views/site/pages/show.blade.php
        return view('site.pages.show', compact('page', 'sections'));
    }

    private function normalizeSlug(?string $slug): string
    {
        $slug = trim((string) $slug);
        if ($slug === '' || $slug === '/') {
            return '/';
        }
        return '/' . ltrim($slug, '/');
    }

    private function loadBanners(int $groupId, string $order)
    {
        $q = Banner::query()->where('group_banner_id', $groupId)->where('is_active', true);

        switch ($order) {
            case 'created_desc': $q->orderByDesc('id'); break;
            case 'title_asc':    $q->orderBy('title');   break;
            case 'title_desc':   $q->orderByDesc('title'); break;
            default:             $q->orderBy('id');      break; // created_asc
        }

        // posição + id como desempate
        return $q->orderBy('position')->orderBy('id')->get();
    }

    private function loadDestinations(int $groupId, string $order)
    {
        $q = Destination::query()->where('destination_group_id', $groupId)->where('is_active', true);

        switch ($order) {
            case 'created_desc': $q->orderByDesc('id'); break;
            case 'title_asc':    $q->orderBy('title');  break;
            case 'title_desc':   $q->orderByDesc('title'); break;
            default:             $q->orderBy('id');     break; // created_asc
        }

        return $q->orderBy('position')->orderBy('id')->get();
    }
}
