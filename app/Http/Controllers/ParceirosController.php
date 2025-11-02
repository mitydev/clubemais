<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class ParceirosController extends Controller
{
    public function show()
    {
        // return view('parceiros');
        $now = now();

        $page = Page::query()
            ->where(fn($q)=>$q->where('slug','/parceiros')->orWhere('slug','parceiros'))
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
                  ]);
            }])
        ->first();

        return view('parceiros-teste', compact('page'));
    }
}