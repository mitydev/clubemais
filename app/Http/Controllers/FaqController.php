<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function show()
    {
        $now = now();

        $page = Page::query()
            ->where(fn ($q) => $q->where('slug', 'faq')->orWhere('slug', '/faq'))
            ->where('is_active', true)
            ->with(['sections' => function ($q) use ($now) {
                $q->where('is_active', true)
                  ->orderBy('position')
                  ->with([
                      // hero_slider pode precisar de banners
                      'banners' => fn($bq) => $bq
                          ->where('banners.is_active', true)
                          ->where(fn($w) => $w->whereNull('starts_at')->orWhere('starts_at', '<=', $now))
                          ->where(fn($w) => $w->whereNull('ends_at')->orWhere('ends_at', '>=', $now))
                          ->orderBy('page_section_banner.position'),
                  ]);
            }])
            ->firstOrFail();

        return view('faq', compact('page'));
    }
}
