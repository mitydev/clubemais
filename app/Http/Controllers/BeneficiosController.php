<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class BeneficiosController extends Controller
{
    public function show()
    {
        $now = now();

        $page = Page::query()
            ->where(fn($q) => $q->where('slug','/beneficios')->orWhere('slug','beneficios'))
            ->where('is_active', true)
            ->with(['sections' => function ($q) use ($now) {
                $q->where('is_active', true)
                  ->orderBy('position')
                  ->with([
                      'banners' => function ($bq) use ($now) {
                          $bq->where('banners.is_active', true)
                             ->where(fn($w)=>$w->whereNull('starts_at')->orWhere('starts_at','<=',$now))
                             ->where(fn($w)=>$w->whereNull('ends_at')->orWhere('ends_at','>=',$now))
                             ->orderBy('page_section_banner.position');
                      },
                      'destinations',
                  ]);
            }])
        ->first();
        return view('beneficios-teste', compact('page'));
    }
}
