<?php

namespace App\Http\Controllers;

use App\Models\BannersModel;
use App\Models\GroupBannersModel;
use Illuminate\Http\Request;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = GroupBannersModel::all();
        return view('pages.banners.index', compact('banners'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $group = GroupBannersModel::query()->where('id', '=', $id)->firstOrFail();

        return view('pages.banners.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->getMethod() === "PATCH") {
            $banner = BannersModel::query()->where('id', '=', $id)->firstOrFail();

            $banner->position = $request->get('position')  ;
            $banner->link_url = $request->get('link') ?? "";
            $banner->active = $request->get('active') ?? false;

            $banner->save();

            return true;
        }

        $request->validate([
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        $groupId = $id;
        foreach ($request->file('images', []) as $image) {
            // salva no storage/app/public/banners
            $path = $image->store('banners', 'public');

            // grava no banco
            BannersModel::create([
                'group_banner_id' => $groupId,
                'image_path' => 'storage/' . $path,
                'link_url' => '',
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Banners enviados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = BannersModel::findOrFail($id);
        $banner->delete();

        return redirect()
            ->back()
            ->with('success', 'Banner excluído com sucesso!');
    }
}
