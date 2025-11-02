<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model {
    protected $fillable = ['page_id','type','position','is_active','content', 'meta'];

    protected $casts = [
        'is_active' => 'boolean',
        'content'   => 'array',
        'meta'      => 'array'
    ];

    public function page(){ return $this->belongsTo(Page::class); }

    public function banners()
    {
        return $this->belongsToMany(\App\Models\Banner::class, 'page_section_banner')
            ->withPivot(['position', 'link_url_override', 'caption'])
            ->withTimestamps()
            ->orderByPivot('position'); 
    }

    public function metaValue(string $key, $default = null)
    {
        return data_get($this->meta ?? [], $key, $default);
    }

    
    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'page_section_destination')
            ->withPivot('position')
            ->orderBy('page_section_destination.position');
    }

    public function syncBannersFromGroup(?int $groupId = null): void
    {
        $groupId = $groupId ?? (int) data_get($this->meta, 'banner_group_id');
        if (!$groupId) return;

        $banners = Banner::query()
            ->where('group_banner_id', $groupId)
            ->where('is_active', true)
            ->orderBy('position')   // ajuste se usa outro campo (ex.: id)
            ->get(['id']);

        $sync = [];
        $pos  = 10;
        foreach ($banners as $b) {
            $sync[$b->id] = ['position' => $pos];
            $pos += 1;
        }

        // Atualiza/insere e remove os que saíram do grupo
        $this->banners()->sync($sync);
    }
}
