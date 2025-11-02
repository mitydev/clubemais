<?php

namespace App\Observers;

use App\Actions\SyncSectionBannersForGroup;
use App\Models\Banner;

class BannerObserver
{
    public bool $afterCommit = true;

    public function saved(Banner $banner): void
    {
        if ($banner->group_banner_id) {
            app(SyncSectionBannersForGroup::class)($banner->group_banner_id);
        }
    }

    public function deleted(Banner $banner): void
    {
        if ($banner->group_banner_id) {
            app(SyncSectionBannersForGroup::class)($banner->group_banner_id);
        }
    }
}
