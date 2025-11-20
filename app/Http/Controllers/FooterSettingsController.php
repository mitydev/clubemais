<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class FooterSettingsController extends Controller
{
    public function edit()
    {
        $data = SiteSetting::footer() ?? [];
        return view('admin.settings.footer', compact('data'));
    }

    public function update(Request $r)
    {
        $r->validate([
            'logo'                  => ['nullable','image','mimes:png,jpg,jpeg,webp,svg'],
            'logo_path'             => ['nullable','string'],
            'about'                 => ['nullable','string','max:600'],
            'address'               => ['nullable','string','max:600'],
            'email'                 => ['nullable','email'],
            'phone'                 => ['nullable','string','max:100'],

            'social'                => ['nullable','array'],
            'social.*.icon'         => ['required_with:social.*.url', Rule::in(['x','instagram','facebook','youtube','tiktok','linkedin'])],
            'social.*.url'          => ['nullable','url'],
            'social.*.icon_file'    => ['nullable','file','mimes:png,svg,webp,jpg,jpeg'],

            'quick_links'           => ['nullable','array'],
            'quick_links.*.label'   => ['required_with:quick_links.*.href','string','max:120'],
            'quick_links.*.href'    => ['nullable','string','max:255'],

            'newsletter.enabled'    => ['nullable','boolean'],
            'newsletter.title'      => ['nullable','string','max:120'],
            'newsletter.text'       => ['nullable','string','max:600'],
            'newsletter.button'     => ['nullable','string','max:60'],
            'newsletter.placeholder'=> ['nullable','string','max:80'],
            'newsletter.action'     => ['nullable','string','max:255'],
        ]);

        $prev   = SiteSetting::footer() ?? [];
        $input  = $r->except(['_token','_method','logo','social']);
        $data   = array_replace_recursive($prev, $input);

        // Normaliza o checkbox (quando desmarcado não vem no request)
        data_set($data, 'newsletter.enabled', $r->boolean('newsletter.enabled'));

        if ($r->hasFile('logo')) {
            $path = $r->file('logo')->store('footer', 'public');
            $data['logo_path'] = 'storage/' . ltrim($path, '/');
        } elseif ($r->filled('logo_path')) {
            $data['logo_path'] = trim($r->input('logo_path'));
        }

        $socialInput = collect($r->input('social', []))->map(fn($row) => [
            'icon'      => Arr::get($row, 'icon'),
            'url'       => Arr::get($row, 'url'),
            'icon_path' => Arr::get($row, 'icon_path'),
        ]);

        $files = $r->file('social', []);
        $data['social'] = $socialInput->map(function ($row, $idx) use ($files) {
            if (isset($files[$idx]['icon_file']) && $files[$idx]['icon_file']->isValid()) {
                $path = $files[$idx]['icon_file']->store('footer/icons', 'public');
                $row['icon_path'] = 'storage/' . ltrim($path, '/');
            }
            return $row;
        })->filter(fn ($row) => !empty($row['url']))->values()->all();

        $data['quick_links'] = collect(Arr::get($data, 'quick_links', []))
            ->filter(fn ($r) => !empty($r['label']) && !empty($r['href']))
            ->values()
            ->all();

        SiteSetting::updateOrCreate(['group' => 'footer'], ['data' => $data]);

        Cache::forget('site_setting:footer');
        Cache::forget('footer_settings');

        Artisan::call('optimize:clear');

        return back()->with('ok', 'Footer atualizado.');
    }

}