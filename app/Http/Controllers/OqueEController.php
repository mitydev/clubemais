<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class OqueEController extends Controller
{
    public function OqueE()
    {
        $now = now();

        // Aceita slug '/o-que-e' ou 'o-que-e' (depende de como você cadastrou no Page)
        $page = Page::query()
            ->where(function ($q) {
                $q->where('slug', '/o-que-e')
                  ->orWhere('slug', 'o-que-e');
            })
            ->where('is_active', true)
            ->with(['sections' => function ($q) use ($now) {
                $q->where('is_active', true)
                  ->orderBy('position')
                  ->with([
                      // Estes relacionamentos só serão usados se alguma section precisar.
                      'banners' => function ($bq) use ($now) {
                          $bq->where('banners.is_active', true)
                             ->where(fn($w) => $w->whereNull('starts_at')->orWhere('starts_at','<=',$now))
                             ->where(fn($w) => $w->whereNull('ends_at')->orWhere('ends_at','>=',$now))
                             ->orderBy('page_section_banner.position');
                      },
                      'destinations', // inócuo nas oqe_*, mas não atrapalha
                  ]);
            }])
            ->first();

        // Se não houver Page cadastrada, renderiza mesmo assim o fallback
        return view('o-que-e-teste', compact('page'));
    }
}
