<?php

declare(strict_types=1);

namespace App\View\Composers;

use App\Models\WebsiteSetting;

class DonationButtonComposer
{
    public function __construct(
        protected readonly WebsiteSetting $settings,
    ) {}

    public function compose($view)
    {
        $view->with('subject', $this->settings->donation_button_text);
    }
}