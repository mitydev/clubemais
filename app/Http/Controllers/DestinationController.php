<?php

// app/Http/Controllers/DestinationController.php
namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\DestinationGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    
    protected function resolveGroupId(Request $r, bool $required = true): ?int {
        if ($r->filled('destination_group_id')) return (int)$r->destination_group_id;
        if ($r->filled('group')) {
            $name = trim($r->group);
            if ($name !== '') {
                $slug = Str::slug($name);
                $g = DestinationGroup::firstOrCreate(['slug'=>$slug], ['name'=>$name]);
                return $g->id;
            }
        }
        if ($required) abort(422,'Selecione um grupo ou informe o nome do grupo.');
        return null;
    }

    protected function nextPosition(int $groupId): int {
        return (int) Destination::where('destination_group_id',$groupId)->max('position') + 1;
    }

    // LISTA
    public function index(Request $r) {
        $groups = DestinationGroup::orderBy('name')->get();

        $destinos = Destination::query()
          ->with('group')
          ->when($r->filled('group'), fn($q)=>$q->where('destination_group_id',(int)$r->group))
          ->when($r->filled('q'), fn($q)=>$q->where('title','like','%'.$r->q.'%'))
          ->orderBy('destination_group_id')->orderBy('position')->orderBy('id')
          ->paginate(20)->withQueryString();

        return view('admin.destinos.index', compact('destinos','groups'));
    }

    public function create() {
        $groups = DestinationGroup::orderBy('name')->get();
        return view('admin.destinos.create', compact('groups'));
    }

    public function store(Request $r)
    {
        $single = $r->hasFile('image');
        $multi  = $r->hasFile('images');

        $base = [
            'title'                 => ['nullable','string','max:180'],
            'excerpt'               => ['nullable','string','max:255'],
            'link_url'              => ['nullable','url','max:500'],
            'destination_group_id'  => ['nullable','integer','exists:destination_groups,id'],
            'group'                 => ['nullable','string','max:100'],
            'is_active'             => ['sometimes','boolean'],
            'starts_at'             => ['nullable','date'],
            'ends_at'               => ['nullable','date','after_or_equal:starts_at'],
        ];

        // Grupo é obrigatório (via select ou via texto)
        $groupId = $this->resolveGroupId($r, true);

        /**
         * ----- MODO SINGLE (uma imagem) -----
         */
        if ($single) {
            $data = $r->validate($base + [
                'image' => ['required','image','max:5120'],
            ]);

            $path = $r->file('image')->store('destinations','public');
            $pos  = $this->nextPosition($groupId);

            $d = Destination::create([
                'destination_group_id' => $groupId,
                'position'             => $pos,
                'title'                => $data['title'] ?? pathinfo($r->file('image')->getClientOriginalName(), PATHINFO_FILENAME),
                'excerpt'              => $data['excerpt'] ?? null,
                'link_url'             => $data['link_url'] ?? null,
                'image_path'           => $path,
                'is_active'            => $r->boolean('is_active'),
                'starts_at'            => $data['starts_at'] ?? null,
                'ends_at'              => $data['ends_at'] ?? null,
            ]);

            return redirect()->route('destinos.edit', $d)->with('ok','Destino criado.');
        }

        /**
         * ----- MODO MULTI (várias imagens) -----
         * Suporta títulos/links/excerpts por arquivo + ordenação manual (ordered_indexes).
         */
        if ($multi) {
            $data = $r->validate($base + [
                'images'          => ['required','array','min:1'],
                'images.*'        => ['file','image','max:5120'],

                // títulos, descrições e links por arquivo
                'titles'          => ['nullable','array'],
                'titles.*'        => ['nullable','string','max:180'],
                'excerpts'        => ['nullable','array'],
                'excerpts.*'      => ['nullable','string','max:255'],
                'links'           => ['nullable','array'],
                'links.*'         => ['nullable','url','max:500'],

                // ordem vinda do front (ex.: "2,0,1")
                'ordered_indexes' => ['nullable','string'],
            ]);

            // Arquivos e ordem
            $files = $r->file('images');
            $order = collect(explode(',', (string) $r->ordered_indexes))
                        ->filter(static fn ($v) => $v !== '')
                        ->map(static fn ($v) => (int) $v)
                        ->values();

            // Reaplica a ordem recebida (se houver)
            if ($order->isNotEmpty()) {
                $files = $order
                    ->map(fn ($i) => $r->file('images')[$i] ?? null)
                    ->filter() // remove índices inválidos
                    ->values()
                    ->all();
            }

            // Arrays paralelos (podem ter menos itens que $files)
            $titles   = array_values((array) $r->input('titles', []));
            $excerpts = array_values((array) $r->input('excerpts', []));
            $links    = array_values((array) $r->input('links', []));

            DB::transaction(function () use ($r, $data, $files, $titles, $excerpts, $links, $groupId) {
                $pos = $this->nextPosition($groupId);

                foreach ($files as $idx => $file) {
                    $path = $file->store('destinations','public');

                    // Título: o específico do card -> o padrão do form -> nome do arquivo
                    $title = $titles[$idx]
                        ?? $data['title']
                        ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

                    Destination::create([
                        'destination_group_id' => $groupId,
                        'position'             => $pos++,
                        'title'                => $title,
                        'excerpt'              => $excerpts[$idx] ?? ($data['excerpt'] ?? null),
                        'link_url'             => $links[$idx]    ?? ($data['link_url'] ?? null),
                        'image_path'           => $path,
                        'is_active'            => $r->boolean('is_active'),
                        'starts_at'            => $data['starts_at'] ?? null,
                        'ends_at'              => $data['ends_at'] ?? null,
                    ]);
                }
            });

            return redirect()->route('destinos.index')->with('ok','Destinos criados.');
        }

        return back()->withErrors([
            'images' => 'Envie pelo menos uma imagem (múltipla) ou use o campo de imagem única.',
        ]);
    }

    public function edit(Destination $destino) {
        $groups = DestinationGroup::orderBy('name')->get();
        return view('admin.destinos.edit', compact('destino','groups'));
    }

    public function update(Request $r, Destination $destino) {
        $data = $r->validate([
            'title'                => ['required','string','max:180'],
            'excerpt'              => ['nullable','string','max:255'],
            'link_url'             => ['nullable','url','max:500'],
            'image'                => ['nullable','image','max:5120'],
            'destination_group_id' => ['nullable','integer','exists:destination_groups,id'],
            'group'                => ['nullable','string','max:100'],
            'is_active'            => ['sometimes','boolean'],
            'starts_at'            => ['nullable','date'],
            'ends_at'              => ['nullable','date','after_or_equal:starts_at'],
        ]);

        $newGroupId = $this->resolveGroupId($r, true);

        if ($r->hasFile('image')) {
            if ($destino->image_path && Storage::disk('public')->exists($destino->image_path)) {
                Storage::disk('public')->delete($destino->image_path);
            }
            $destino->image_path = $r->file('image')->store('destinations','public');
        }

        if ($destino->destination_group_id !== $newGroupId) {
            $destino->destination_group_id = $newGroupId;
            $destino->position = $this->nextPosition($newGroupId);
        }

        $destino->fill([
            'title'=>$data['title'],
            'excerpt'=>$data['excerpt'] ?? null,
            'link_url'=>$data['link_url'] ?? null,
            'is_active'=>$r->boolean('is_active'),
            'starts_at'=>$data['starts_at'] ?? null,
            'ends_at'=>$data['ends_at'] ?? null,
        ])->save();

        return back()->with('ok','Destino atualizado.');
    }

    public function destroy(Destination $destino) {
        if ($destino->image_path && Storage::disk('public')->exists($destino->image_path)) {
            Storage::disk('public')->delete($destino->image_path);
        }
        $destino->delete();
        return redirect()->route('destinos.index')->with('ok','Destino removido.');
    }

    // --------- Modo grupos (opcional, igual banners) ----------
    public function groupsIndex(Request $r) {
        $q = DestinationGroup::withCount('destinations')->orderBy('name');
        if ($term = trim($r->query('q',''))) $q->where('name','like',"%{$term}%");
        $groupsPage = $q->paginate(20)->withQueryString();

        return view('admin.destinos.index', [
            'mode'       => 'groups',
            'groupsPage' => $groupsPage,
            'destinos'   => null,
            'groups'     => DestinationGroup::orderBy('name')->get(),
        ]);
    }

    public function groupsEdit(DestinationGroup $group) {
        $group->load(['destinations'=>fn($q)=>$q->orderBy('position')->orderBy('id')]);
        return view('admin.destinos.groups_edit', compact('group'));
    }

    public function groupsBulk(Request $r, DestinationGroup $group) {
        $data = $r->validate([
            'items'                         => ['array'],
            'items.*.id'                    => ['required','integer', Rule::exists('destinations','id')->where('destination_group_id',$group->id)],
            'items.*.title'                 => ['nullable','string','max:180'],
            'items.*.excerpt'               => ['nullable','string','max:255'],
            'items.*.link_url'              => ['nullable','url','max:500'],
            'items.*.is_active'             => ['required','boolean'],
            'items.*.starts_at'             => ['nullable','date'],
            'items.*.ends_at'               => ['nullable','date','after_or_equal:items.*.starts_at'],
            'items.*.position'              => ['required','integer','min:0'],
            'items.*.new_image'             => ['nullable','image','max:5120'],
            'deleted_ids'                   => ['array'],
            'deleted_ids.*'                 => [Rule::exists('destinations','id')->where('destination_group_id',$group->id)],
        ]);

        DB::transaction(function () use ($group,$data,$r) {
            if (!empty($data['deleted_ids'])) {
                Destination::where('destination_group_id',$group->id)
                    ->whereIn('id',$data['deleted_ids'])
                    ->get()->each(function($d){
                        if ($d->image_path && Storage::disk('public')->exists($d->image_path)) {
                            Storage::disk('public')->delete($d->image_path);
                        }
                        $d->delete();
                    });
            }

            foreach (($data['items'] ?? []) as $idx => $it) {
                $d = Destination::where('destination_group_id',$group->id)->where('id',$it['id'])->first();
                if (!$d) continue;

                if ($r->hasFile("items.$idx.new_image")) {
                    $file = $r->file("items.$idx.new_image");
                    $path = $file->store('destinations','public');
                    if ($d->image_path && Storage::disk('public')->exists($d->image_path)) {
                        Storage::disk('public')->delete($d->image_path);
                    }
                    $d->image_path = $path;
                }

                $d->fill([
                    'title'     => $it['title'] ?? null,
                    'excerpt'   => $it['excerpt'] ?? null,
                    'link_url'  => $it['link_url'] ?? null,
                    'is_active' => (bool)$it['is_active'],
                    'starts_at' => $it['starts_at'] ?? null,
                    'ends_at'   => $it['ends_at'] ?? null,
                    'position'  => (int)$it['position'],
                ])->save();
            }
        });

        return back()->with('ok','Grupo atualizado.');
    }

    public function groupsUpload(Request $r, DestinationGroup $group) {
        $v = $r->validate([
            'images'        => ['required','array','min:1'],
            'images.*'      => ['file','image','max:5120'],
            'default_title' => ['nullable','string','max:180'],
            'default_excerpt'=>['nullable','string','max:255'],
            'default_link'  => ['nullable','url','max:500'],
            'is_active'     => ['required','boolean'],
        ]);

        DB::transaction(function () use ($r,$group,$v) {
            $pos = (int) Destination::where('destination_group_id',$group->id)->max('position') + 1;
            foreach ($r->file('images') as $file) {
                $path = $file->store('destinations','public');
                Destination::create([
                    'destination_group_id'=>$group->id,
                    'position'=>$pos++,
                    'title'=>$v['default_title'] ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                    'excerpt'=>$v['default_excerpt'] ?? null,
                    'link_url'=>$v['default_link'] ?? null,
                    'image_path'=>$path,
                    'is_active'=>(bool)$v['is_active'],
                ]);
            }
        });

        return back()->with('ok','Imagens adicionadas ao grupo.');
    }
}
