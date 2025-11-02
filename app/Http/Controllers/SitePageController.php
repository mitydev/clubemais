<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class SitePageController extends Controller {
  public function show($slug) {
    $page = Page::where('slug', '/'.ltrim($slug,'/'))
      ->where('is_active', true)
      ->with(['sections' => fn($q)=>$q->where('is_active',true)->orderBy('position'),
              'sections.banners'])
    ->firstOrFail();

    return view('site.page', compact('page'));
  }
}
