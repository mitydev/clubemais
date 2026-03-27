<?php

namespace App\Actions;

use App\Models\GroupBanner;
use App\Models\PageSection;
use Illuminate\Support\Facades\DB;

class SyncSectionBannersForGroup
{
    public function __invoke(int $groupId): void
    {
        $group = GroupBanner::with(['banners' => function ($q) {
            $now = now();
            $q->where('is_active', true)
              ->where(fn($w)=>$w->whereNull('starts_at')->orWhere('starts_at','<=',$now))
              ->where(fn($w)=>$w->whereNull('ends_at')->orWhere('ends_at','>=',$now))
              ->orderBy('position');
        }])->find($groupId);

        if (!$group) return;

        // MySQL/MariaDB:
        $sections = PageSection::query()
            ->where('type', 'hero_slider')
            ->where('meta->banner_group_id', $groupId)
            ->get();

        $attach = [];
        $pos = 10;
        foreach ($group->banners as $b) {
            $attach[$b->id] = ['position' => $pos];
            $pos += 10;
        }

        DB::transaction(function () use ($sections, $attach) {
            foreach ($sections as $section) {
                $section->banners()->sync($attach);
            }
        });
    }
}
