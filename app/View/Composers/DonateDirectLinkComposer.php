<?php

declare(strict_types=1);

namespace App\View\Composers;

use App\Models\WebsiteSetting;

class DonateDirectLinkComposer
{
    public function __construct(
        protected readonly WebsiteSetting $settings
    ) {
    }

    public function compose($view)
    {
        $view->with('bankLink', $this->settings->rabobank_link);
    }
}
