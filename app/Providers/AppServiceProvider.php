<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\GroupBanner;
use App\Observers\BannerObserver;
use App\Observers\GroupBannerObserver;
use Illuminate\Support\Facades\Event;
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

        // Garante que o provedor Socialite Manager está carregado
        $this->app->register(\SocialiteProviders\Manager\ServiceProvider::class);

        // REGISTRA O PROVEDOR KEYCLOAK DIRETAMENTE COM O LISTENER
        Event::listen(\SocialiteProviders\Manager\SocialiteWasCalled::class, [
            \SocialiteProviders\Keycloak\KeycloakExtendSocialite::class,
            'handle'
        ]);
    }
}
