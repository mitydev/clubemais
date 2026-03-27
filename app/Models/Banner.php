<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'group_banner_id',
        'position',
        'title',
        'image_path',
        'link_url',
        'alt_text',
        'is_active',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at'   => 'datetime',
    ];

    // ===== Relationships =====
    public function group()
    {
        return $this->belongsTo(GroupBanner::class, 'group_banner_id');
    }

    public function sections()
    {
        return $this->belongsToMany(PageSection::class, 'page_section_banner')
            ->withPivot(['position', 'link_url_override', 'caption'])
            ->withTimestamps();
    }

    // ===== Scopes úteis =====
    public function scopeOrdered(Builder $q): Builder
    {
        return $q->orderBy('position')->orderBy('id');
    }

    public function scopeActive(Builder $q): Builder
    {
        $now = now();

        return $q->where('is_active', true)
            ->where(function ($qq) use ($now) {
                $qq->whereNull('starts_at')->orWhere('starts_at', '<=', $now);
            })
            ->where(function ($qq) use ($now) {
                $qq->whereNull('ends_at')->orWhere('ends_at', '>=', $now);
            });
    }

    /**
     * Filtra por grupo. Aceita id numérico OU slug da tabela group_banners.
     */
    public function scopeForGroup(Builder $q, $group): Builder
    {
        if (is_numeric($group)) {
            return $q->where('group_banner_id', (int)$group);
        }

        return $q->whereHas('group', fn ($qq) => $qq->where('slug', $group));
    }

    // ===== Helpers (opcional) =====
    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : null;
    }

    protected static function booted(): void
    {
        // posição default se vier nulo
        static::creating(function (Banner $m) {
            if ($m->position === null) {
                $m->position = 10;
            }
        });
    }
}
