<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\GroupBanner;
use App\Observers\BannerObserver;
use App\Observers\GroupBannerObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Banner::observe(BannerObserver::class);
        GroupBanner::observe(GroupBannerObserver::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
