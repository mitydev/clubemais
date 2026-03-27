<?php

namespace App\Observers;

use App\Actions\SyncSectionBannersForGroup;
use App\Models\GroupBanner;

class GroupBannerObserver
{
    public bool $afterCommit = true;

    public function saved(GroupBanner $group): void
    {
        app(SyncSectionBannersForGroup::class)($group->id);
    }
}
