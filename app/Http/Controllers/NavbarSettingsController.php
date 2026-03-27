<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class NavbarSettingsController extends Controller
{
    public function edit()
    {
        $data = SiteSetting::navbar() ?? [];
        return view('admin.settings.navbar', compact('data'));
    }

    public function update(Request $r)
    {
        $r->validate([
            'logo'      => ['nullable','image','mimes:png,jpg,jpeg,webp,svg'],
            'logo_path' => ['nullable','string','max:255'],

            'menu'              => ['nullable','array'],
            'menu.*.label'      => ['required_with:menu.*.href','string','max:60'],
            'menu.*.href'       => ['nullable','string','max:255'],
            'menu.*.is_external'=> ['nullable','boolean'],
        ]);

        $prev  = SiteSetting::navbar() ?? [];
        $input = $r->except(['_token','_method','logo']);
        $data  = array_replace_recursive($prev, $input);

        if ($r->hasFile('logo')) {
            $path = $r->file('logo')->store('navbar', 'public');
            $data['logo_path'] = 'storage/' . ltrim($path, '/');
        } elseif ($r->filled('logo_path')) {
            $data['logo_path'] = trim($r->input('logo_path'));
        }

        // limpa e normaliza menu
        $data['menu'] = collect(Arr::get($data, 'menu', []))
            ->map(function ($row) {
                return [
                    'label'      => trim($row['label'] ?? ''),
                    'href'       => trim($row['href'] ?? ''),
                    'is_external'=> !empty($row['is_external']),
                ];
            })
            ->filter(fn ($row) => !empty($row['label']) && !empty($row['href']))
            ->values()
            ->all();

        SiteSetting::updateOrCreate(['group' => 'navbar'], ['data' => $data]);

        Cache::forget('site_setting:navbar');
        Cache::forget('navbar_settings');

        Artisan::call('optimize:clear');

        return back()->with('ok', 'Navbar atualizada.');
    }
}
