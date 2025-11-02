<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
            'logo'                 => ['nullable','image','mimes:png,jpg,jpeg,webp,svg'],
            'logo_path'            => ['nullable','string'],
            'about'                => ['nullable','string','max:600'],
            'address'              => ['nullable','string','max:600'],
            'email'                => ['nullable','email'],
            'phone'                => ['nullable','string','max:100'],

            'social'               => ['nullable','array'],
            'social.*.icon'        => ['required_with:social.*.url', Rule::in(['x','instagram','facebook','youtube','tiktok','linkedin'])],
            'social.*.url'         => ['nullable','url'],
            'social.*.icon_file'   => ['nullable','file','mimes:png,svg,webp,jpg,jpeg'],

            'quick_links'          => ['nullable','array'],
            'quick_links.*.label'  => ['required_with:quick_links.*.href','string','max:120'],
            'quick_links.*.href'   => ['nullable','string','max:255'],

            'newsletter.enabled'    => ['boolean'],
            'newsletter.title'      => ['nullable','string','max:120'],
            'newsletter.text'       => ['nullable','string','max:600'],
            'newsletter.button'     => ['nullable','string','max:60'],
            'newsletter.placeholder'=> ['nullable','string','max:80'],
            'newsletter.action'     => ['nullable','string','max:255'],
        ]);

        // 1) Começa pelos dados atuais e mescla com o que veio no request
        $prev  = SiteSetting::footer() ?? [];
        $input = $r->except(['_token','_method','logo','social']); // social trataremos abaixo
        $data  = array_replace_recursive($prev, $input);

        // 2) Logo
        if ($r->hasFile('logo')) {
            // salva caminho relativo web para gerar URL com o domínio atual via asset()
            $path = $r->file('logo')->store('footer', 'public'); // storage/app/public/footer/...
            $data['logo_path'] = 'storage/' . ltrim($path, '/');  // => storage/footer/...
        } elseif ($r->filled('logo_path')) {
            // se o usuário forneceu manualmente um caminho/URL, usamos como veio
            $val = trim($r->input('logo_path'));
            $data['logo_path'] = $val;
        } else {
            // se o campo veio vazio, NÃO toque no valor existente (já está em $data via merge)
            // nada a fazer aqui
        }

        // 3) SOCIAL (reconstrói a lista, processa uploads e guarda apenas itens com URL)
        $socialInput = collect($r->input('social', []))->map(fn($row) => [
            'icon'      => Arr::get($row, 'icon'),
            'url'       => Arr::get($row, 'url'),
            'icon_path' => Arr::get($row, 'icon_path'), // mantém se já existir
        ]);

        $files = $r->file('social', []);
        $socialBuilt = $socialInput->map(function ($row, $idx) use ($files) {
            if (isset($files[$idx]['icon_file']) && $files[$idx]['icon_file']->isValid()) {
                $path = $files[$idx]['icon_file']->store('footer/icons', 'public');
                $row['icon_path'] = 'storage/' . ltrim($path, '/'); // relativo web
            }
            return $row;
        })
        ->filter(fn ($row) => !empty($row['url']))
        ->values()
        ->all();

        $data['social'] = $socialBuilt;

        // 4) QUICK LINKS
        $data['quick_links'] = collect(Arr::get($data, 'quick_links', []))
            ->filter(fn ($r) => !empty($r['label']) && !empty($r['href']))
            ->values()
            ->all();

        // 5) Persiste tudo
        SiteSetting::updateOrCreate(['group' => 'footer'], ['data' => $data]);

        // 6) Limpa caches
        Cache::forget('footer_settings');     // usado por SiteSetting::footer()
        Cache::forget('site_setting:footer'); // usado por site_setting('footer')

        return back()->with('ok', 'Footer atualizado.');
    }
}