<?php

namespace App\Providers;

use App\View\Composers\InformationSettingsComposer;
use App\View\Composers\MainMenuItemsComposer;
use App\View\Composers\StatementsMenuItemsComposer;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ApiClient::class, function ($app) {
            $client = new ApiClient();

            $client->setConfig([
                'apiKey' => config('services.mailchimp.api_key'),
                'server' => config('services.mailchimp.server_prefix'),
            ]);

            return $client;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Facades\View::composer('partials.navigation', MainMenuItemsComposer::class);

        Facades\View::composer('partials.footer', StatementsMenuItemsComposer::class);

        Facades\View::composer('partials.footer', InformationSettingsComposer::class);
    }
}
