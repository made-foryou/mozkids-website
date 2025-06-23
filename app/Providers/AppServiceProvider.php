<?php

namespace App\Providers;

use App\Models\WebsiteSetting;
use App\View\Composers\DonateDirectLinkComposer;
use App\View\Composers\DonationButtonComposer;
use App\View\Composers\InformationSettingsComposer;
use App\View\Composers\LatestNewsComposer;
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
                "apiKey" => config("services.mailchimp.api_key"),
                "server" => config("services.mailchimp.server_prefix"),
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
