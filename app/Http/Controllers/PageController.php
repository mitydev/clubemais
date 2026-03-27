<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageStoreRequest;
use App\Http\Requests\PageUpdateRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller {
    public function index() {
        $pages = Page::orderBy('id')->paginate(20);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $templates = config('pagebuilder.templates');
        return view('admin.pages.create', compact('templates'));
    }

    public function store(PageStoreRequest $r) {
        $page = Page::create($r->validated());
        return redirect()->route('pages.edit', $page)->with('ok','Página criada.');
    }

    public function edit(Page $page)
    {
        $page->load('sections');

        $allSections = config('pagebuilder.sections');
        $templates   = config('pagebuilder.templates');

        $allowed = $templates[$page->template]['allowed_sections'] ?? array_keys($allSections);
        $sectionTypes = array_intersect_key($allSections, array_flip($allowed));

        // normaliza labels que possam vir como array (pt/en/…)
        $sectionTypes = collect($sectionTypes)->map(function ($cfg) {
            $label = $cfg['label'] ?? null;
            if (is_array($label)) {
                $label = $label['pt'] ?? $label['en'] ?? reset($label);
            }
            $cfg['label'] = $label ?: 'Section';
            return $cfg;
        })->toArray();

        // remova o dd() para não interromper a view
        // dd($sectionTypes);

        return view('admin.pages.edit', compact('page','sectionTypes','templates'));
    }

    public function update(PageUpdateRequest $r, Page $page) {
        $page->update($r->validated());
        return back()->with('ok','Página atualizada.');
    }
}

