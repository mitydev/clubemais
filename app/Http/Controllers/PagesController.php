<?php

namespace App\Http\Controllers;

use App\Models\PagesModel;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = PagesModel::query()->get();
        return view('pages.pages.pages', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page = PagesModel::query()->where('id', '=', $id)->firstOrFail();
        $page->content = $page->content ? json_decode($page->content, true) : null;
        return view('pages.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'content' => 'required|array',
            'content.title' => 'required|string|max:255',
            'content.slug' => 'required|string',
            'content.meta_title' => 'nullable|string',
            'content.meta_description' => 'nullable|string'
        ]);
        $page = PagesModel::query()->where('id', '=', $id)->firstOrFail();

        $content = json_encode(
            $request->get('content')
        );

        $page->content = $content;
        $page->save();

        return redirect()->back()->with('success', 'Página atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
