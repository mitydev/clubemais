<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\GroupBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BannerController extends Controller
{
    // ==========================
    // Helpers internos
    // ==========================

    /**
     * Resolve o ID do grupo a partir de:
     *  - group_banner_id (select) OU
     *  - group (texto livre) -> cria se não existir.
     * Se $required=true, falha se nenhum dos dois vier.
     */
    protected function resolveGroupId(Request $request, bool $required = true): ?int{
        if ($request->filled('group_banner_id')) {
            return (int) $request->input('group_banner_id');
        }

        if ($request->filled('group')) {
            $name = trim($request->input('group'));
            if ($name !== '') {
                $slug = Str::slug($name);
                $gb = GroupBanner::firstOrCreate(['slug' => $slug], ['name' => $name]);
                return $gb->id;
            }
        }

        if ($required) {
            abort(422, 'Selecione um grupo ou informe o nome do grupo.');
        }
        return null;
    }

    /**
     * Próxima posição para um banner dentro do grupo.
     */
    protected function nextPosition(int $groupId): int
    {
        $max = (int) Banner::where('group_banner_id', $groupId)->max('position');
        return $max + 1; // antes era +10
    }

    // ==========================
    // CRUD
    // ==========================

    /**
     * Lista de banners (com paginação + filtro de grupo + busca simples)
     */
    public function index(Request $request)
    {
        $groups = GroupBanner::orderBy('name')->get();

        $banners = Banner::query()
            ->with('group')
            ->when($request->filled('group'), function ($q) use ($request) {
                $g = $request->group;
                if (is_numeric($g)) {
                    $q->where('group_banner_id', (int) $g);
                } else {
                    $q->whereHas('group', fn($w) => $w->where('slug', $g));
                }
            })
            ->when($request->filled('q'), function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%');
            })
            ->orderBy('group_banner_id')
            ->orderBy('position')
            ->orderBy('id')
            ->paginate(20)
            ->withQueryString();

        return view('admin.banners.index', compact('banners', 'groups'));
    }

    /**
     * Form de criação
     */
    public function create()
    {
        $groups = GroupBanner::orderBy('name')->get();
        return view('admin.banners.create', compact('groups'));
    }

    /**
     * Salva novo(s) banner(s).
     * Suporta single (image) ou múltiplo (images[] + links[] + alt_texts[]).
     */
    public function store(Request $request)
    {
        $single = $request->hasFile('image');
        $multi  = $request->hasFile('images');

        $baseRules = [
            'title'            => ['nullable', 'string', 'max:180'],
            'link_url'         => ['nullable', 'url', 'max:500'],
            'group_banner_id'  => ['nullable', 'integer', 'exists:group_banners,id'],
            'group'            => ['nullable', 'string', 'max:100'],
            'is_active'        => ['sometimes', 'boolean'],
            'starts_at'        => ['nullable', 'date'],
            'ends_at'          => ['nullable', 'date', 'after_or_equal:starts_at'],
        ];

        // Exigimos grupo (via select ou texto)
        $groupId = $this->resolveGroupId($request, true);

        if ($single) {
            $data = $request->validate($baseRules + [
                'image'    => ['required', 'image', 'max:5120'],
                'alt_text' => ['nullable', 'string', 'max:255'],
            ]);

            $path = $request->file('image')->store('banners', 'public');

            $pos = $this->nextPosition($groupId);

            $banner = Banner::create([
                'group_banner_id' => $groupId,
                'position'        => $pos,
                'title'           => $data['title'] ?? pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME),
                'link_url'        => $data['link_url'] ?? null,
                'image_path'      => $path,
                'alt_text'        => $data['alt_text'] ?? null,
                'is_active'       => $request->boolean('is_active'),
                'starts_at'       => $data['starts_at'] ?? null,
                'ends_at'         => $data['ends_at'] ?? null,
            ]);

            return redirect()->route('banners.edit', $banner)->with('ok', 'Banner criado.');
        }

        if ($multi) {
            $data = $request->validate($baseRules + [
                'images'      => ['required', 'array', 'min:1'],
                'images.*'    => ['file', 'image', 'max:5120'],
                'links'       => ['nullable', 'array'],
                'links.*'     => ['nullable', 'url', 'max:500'],
                'alt_texts'   => ['nullable', 'array'],
                'alt_texts.*' => ['nullable', 'string', 'max:255'],
            ]);

            $links    = array_values((array) $request->input('links', []));
            $altTexts = array_values((array) $request->input('alt_texts', []));

            DB::transaction(function () use ($request, $data, $links, $altTexts, $groupId) {
                $pos = $this->nextPosition($groupId);

                foreach ($request->file('images') as $idx => $file) {
                    $path  = $file->store('banners', 'public');
                    $title = $data['title'] ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

                    Banner::create([
                        'group_banner_id' => $groupId,
                        'position'        => $pos,
                        'title'           => $title,
                        'link_url'        => $links[$idx]    ?? ($data['link_url'] ?? null),
                        'image_path'      => $path,
                        'alt_text'        => $altTexts[$idx] ?? null,
                        'is_active'       => $request->boolean('is_active'),
                        'starts_at'       => $data['starts_at'] ?? null,
                        'ends_at'         => $data['ends_at'] ?? null,
                    ]);

                    $pos++;
                }
            });

            return redirect()->route('banners.index')
                ->with('ok', count($request->file('images')) . ' banners criados.');
        }

        return back()->withErrors(['images' => 'Envie pelo menos uma imagem (múltipla) ou use o campo de imagem única.']);
    }

    /**
     * Form de edição
     */
    public function edit(Banner $banner)
    {
        $groups = GroupBanner::orderBy('name')->get();
        return view('admin.banners.edit', compact('banner', 'groups'));
    }

    /**
     * Atualiza um banner (suporta troca de imagem e de grupo).
     * Se trocar de grupo, reposiciona ao final do novo grupo.
     */
    public function update(Request $request, Banner $banner)
    {
        $data = $request->validate([
            'title'           => ['required', 'string', 'max:180'],
            'link_url'        => ['nullable', 'url', 'max:500'],
            'image'           => ['nullable', 'image', 'max:5120'],
            'alt_text'        => ['nullable', 'string', 'max:255'],
            'group_banner_id' => ['nullable', 'integer', 'exists:group_banners,id'],
            'group'           => ['nullable', 'string', 'max:100'],
            'is_active'       => ['sometimes', 'boolean'],
            'starts_at'       => ['nullable', 'date'],
            'ends_at'         => ['nullable', 'date', 'after_or_equal:starts_at'],
        ]);

        $newGroupId = $this->resolveGroupId($request, true);

        // Troca a imagem se enviada
        if ($request->hasFile('image')) {
            if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
                Storage::disk('public')->delete($banner->image_path);
            }
            $banner->image_path = $request->file('image')->store('banners', 'public');
        }

        // Se mudou de grupo, joga para o fim do novo grupo
        if ($banner->group_banner_id !== $newGroupId) {
            $banner->group_banner_id = $newGroupId;
            $banner->position        = $this->nextPosition($newGroupId);
        }

        $banner->fill([
            'title'     => $data['title'],
            'link_url'  => $data['link_url'] ?? null,
            'alt_text'  => $data['alt_text'] ?? null,
            'is_active' => $request->boolean('is_active'),
            'starts_at' => $data['starts_at'] ?? null,
            'ends_at'   => $data['ends_at'] ?? null,
        ])->save();

        return back()->with('ok', 'Banner atualizado com sucesso.');
    }

    /**
     * Remove um banner
     */
    public function destroy(Banner $banner)
    {
        if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
            Storage::disk('public')->delete($banner->image_path);
        }

        $banner->delete();

        return redirect()->route('banners.index')->with('ok', 'Banner removido.');
    }

    public function groupsIndex(Request $request)
    {
        $q = GroupBanner::withCount('banners')->orderBy('name');
        if ($term = trim($request->query('q',''))) {
            // use where('name','like',...) se não estiver usando Postgres
            $q->where('name','like',"%{$term}%");
        }
        $groupsPage = $q->paginate(20)->withQueryString();

        // Reaproveita a sua blade index para exibir “modo grupos”
        $mode = 'groups';
        return view('admin.banners.index', [
            'mode'       => $mode,
            'groupsPage' => $groupsPage,
            // as variáveis que ela já usa no modo normal:
            'banners'    => null,
            'groups'     => GroupBanner::orderBy('name')->get(),
        ]);
    }

    public function groupsEdit(GroupBanner $group)
    {
        $group->load(['banners' => fn($q) => $q->orderBy('position')->orderBy('id')]);
        return view('admin.banners.groups_edit', compact('group'));
    }

    public function groupsBulk(Request $r, GroupBanner $group)
    {
        $data = $r->validate([
            'banners'                       => ['array'],
            'banners.*.id'                  => ['required','integer', Rule::exists('banners','id')->where('group_banner_id',$group->id)],
            'banners.*.title'               => ['nullable','string','max:180'],
            'banners.*.link_url'            => ['nullable','url','max:500'],
            'banners.*.is_active'           => ['required','boolean'],
            'banners.*.starts_at'           => ['nullable','date'],
            'banners.*.ends_at'             => ['nullable','date','after_or_equal:banners.*.starts_at'],
            'banners.*.position'            => ['required','integer','min:0'],
            'banners.*.new_image'           => ['nullable','image','max:5120'],   // <- NOVO
            'deleted_ids'                   => ['array'],
            'deleted_ids.*'                 => [Rule::exists('banners','id')->where('group_banner_id',$group->id)],
        ]);

        DB::transaction(function () use ($group, $data, $r) {
            // deletar marcados
            if (!empty($data['deleted_ids'])) {
                Banner::where('group_banner_id',$group->id)
                    ->whereIn('id',$data['deleted_ids'])
                    ->get()
                    ->each(function($b){
                        if ($b->image_path && Storage::disk('public')->exists($b->image_path)) {
                            Storage::disk('public')->delete($b->image_path);
                        }
                        $b->delete();
                    });
            }

            // atualizar cada linha
            foreach (($data['banners'] ?? []) as $idx => $b) {
                $banner = Banner::where('group_banner_id',$group->id)
                                ->where('id',$b['id'])->first();

                if (!$banner) continue;

                // se veio arquivo, substitui imagem
                if ($r->hasFile("banners.$idx.new_image")) {
                    $file = $r->file("banners.$idx.new_image");
                    $path = $file->store('banners','public');

                    if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
                        Storage::disk('public')->delete($banner->image_path);
                    }
                    $banner->image_path = $path;
                }

                $banner->fill([
                    'title'     => $b['title'] ?? null,
                    'link_url'  => $b['link_url'] ?? null,
                    'is_active' => (bool)$b['is_active'],
                    'starts_at' => $b['starts_at'] ?? null,
                    'ends_at'   => $b['ends_at'] ?? null,
                    'position'  => (int) $b['position'],
                ])->save();
            }
        });

        return back()->with('ok','Grupo atualizado.');
    }

    public function groupsUpload(Request $r, GroupBanner $group)
    {
        $v = $r->validate([
            'images'        => ['required','array','min:1'],
            'images.*'      => ['file','image','max:5120'],
            'default_title' => ['nullable','string','max:180'],
            'default_link'  => ['nullable','url','max:500'],
            'is_active'     => ['required','boolean'],
        ]);

        DB::transaction(function () use ($r, $group, $v) {
            $pos = (int) Banner::where('group_banner_id',$group->id)->max('position') + 10;

            foreach ($r->file('images') as $file) {
                $path = $file->store('banners','public');

                Banner::create([
                    'group_banner_id' => $group->id,
                    'position'        => $pos,
                    'title'           => $v['default_title'] ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                    'link_url'        => $v['default_link'] ?? null,
                    'image_path'      => $path,
                    'is_active'       => (bool)$v['is_active'],
                ]);

                $pos++;
            }
        });

        return back()->with('ok','Imagens adicionadas ao grupo.');
    }
}
