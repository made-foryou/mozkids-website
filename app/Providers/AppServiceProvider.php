<?php

namespace App\Providers;

use App\Models\WebsiteSetting;
use App\View\Composers\DonateDirectLinkComposer;
use App\View\Composers\DonationButtonComposer;
use App\View\Composers\InformationSettingsComposer;
use App\View\Composers\LatestActivitiesComposer;
use App\View\Composers\LatestNewsComposer;
use App\View\Composers\MainMenuItemsComposer;
use App\View\Composers\StatementsMenuItemsComposer;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
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

            $apiKey = (string) config("services.mailchimp.api_key");

            // Mailchimp API keys end with their datacenter (e.g. "...-us21"), which
            // is also the server prefix. Fall back to it when no prefix is configured.
            $server = config("services.mailchimp.server_prefix")
                ?: (str_contains($apiKey, '-') ? Str::afterLast($apiKey, '-') : null);

            $client->setConfig([
                "apiKey" => $apiKey,
                "server" => $server,
            ]);

            return $client;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (true === app()->runningInConsole()) {
            return;
        }

        Facades\Vite::useScriptTagAttributes([
            'data-cookieconsent' => 'necessary',
        ]);
        Facades\Vite::usePreloadTagAttributes(
            fn (?string $src) => str_ends_with($src, '.js')
                ? ['data-cookieconsent' => 'necessary']
                : false
        );

        $settings = app()->make(WebsiteSetting::class);

        Facades\View::share(
            "donationPage",
            $this->resolveLink($settings->donation_page)
        );
        Facades\View::share("donation_button", $settings->donation_button);

        Facades\View::composer(
            "partials.navigation",
            MainMenuItemsComposer::class
        );

        Facades\View::composer(
            "partials.sidebar-menu",
            MainMenuItemsComposer::class
        );

        Facades\View::composer(
            "partials.footer",
            StatementsMenuItemsComposer::class
        );

        Facades\View::composer(
            "partials.footer",
            InformationSettingsComposer::class
        );

        Facades\View::composer(
            "partials.donation-button",
            DonationButtonComposer::class
        );

        Facades\View::composer(
            "components.columns.donation-form",
            DonateDirectLinkComposer::class
        );

        Facades\View::composer(
            'components.columns.news',
            LatestNewsComposer::class
        );

        Facades\View::composer(
            'components.columns.agenda',
            LatestActivitiesComposer::class
        );
    }

    public function resolveLink(string|null $link = null)
    {
        if ($link === null) {
            return null;
        }

        [$model, $id] = explode(":", $link);

        return $model::query()->find($id);
    }
}
