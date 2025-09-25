<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Local;
use App\Models\Term;

class LocalController extends Controller
{
    /**
     * POST /ajax/get-taxonomy-slug
     * Retorna a slug do Term dado o ID (usado pelo JS na home).
     */
    public function slugById(Request $request)
    {
        $validated = $request->validate([
            'term_id' => ['required', 'integer', 'exists:terms,id'],
        ]);

        $slug = Term::where('id', $validated['term_id'])->value('slug');
        return $slug ? response($slug) : response('error', 400);
    }

    /**
     * GET /local/{term:slug}
     * Lista Locals (hotéis) daquele Term.
     * Esta view precisa conter #main-content pois é carregada por fragmento.
     */
    public function byTerm(Term $term)
    {
        $locals = Local::where('term_id', $term->id)
            ->orderBy('name')
            ->paginate(12);

        return view('local.index', compact('term', 'locals'));
    }

    /**
     * GET /hotel/{local:slug}
     * Detalhe de um Local (hotel).
     * Também com #main-content (pode ser carregado inteiro ou por fragmento).
     */
    public function show(Local $local)
    {
        return view('local.show', compact('local'));
    }
}
