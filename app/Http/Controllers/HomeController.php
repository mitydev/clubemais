<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{

    public function home(Request $request)
    {
        try {
            $now = now();

            $page = Page::query()
                ->where('slug', '/')
                ->where('is_active', true)
                ->with([
                    'sections' => function ($q) use ($now) {
                        $q->where('is_active', true)
                        ->orderBy('position')
                        ->with([
                            'banners' => function ($bq) use ($now) {
                                $bq->where('banners.is_active', true)
                                    ->where(function ($w) use ($now) {
                                        $w->whereNull('starts_at')->orWhere('starts_at', '<=', $now);
                                    })
                                    ->where(function ($w) use ($now) {
                                        $w->whereNull('ends_at')->orWhere('ends_at', '>=', $now);
                                    })
                                    ->orderBy('page_section_banner.position');
                            },
                        ]);
                    },
                ])
                ->with([
                    'sections' => function ($q) use ($now) {
                        $q->where('is_active', true)
                            ->orderBy('position')
                            ->with([
                                'banners' => function ($bq) use ($now) {
                                    $bq->where('banners.is_active', true)
                                        ->where(fn($w) => $w->whereNull('starts_at')->orWhere('starts_at','<=',$now))
                                        ->where(fn($w) => $w->whereNull('ends_at')->orWhere('ends_at','>=',$now))
                                        ->orderBy('page_section_banner.position');
                                },
                                'destinations'
                            ]);
                    },
                ])
                ->first();

            if (!$page) {
                return view('home');  // fallback estático
            }
            if ($request->has('event')){
                // Lista os eventos
                if ($request->get('event') == 'login'){
                    return redirect()->route('login.sso');
                }
            }
            return view('homeTeste', compact('page'));
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function index()
    {
        $termos = Term::orderBy('name')->get(['id','name']);
        return view('home', compact('termos')); // sua blade principal
    }
}
