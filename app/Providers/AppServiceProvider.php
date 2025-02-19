<?php

namespace App\Providers;

use App\View\Composers\MainMenuItemsComposer;
use App\View\Composers\StatementsMenuItemsComposer;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Facades\View::composer('partials.navigation', MainMenuItemsComposer::class);

        Facades\View::composer('partials.footer', StatementsMenuItemsComposer::class);
    }
}
