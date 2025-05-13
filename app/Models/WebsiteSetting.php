<?php

declare(strict_types=1);

namespace App\Models;

use Made\Cms\Page\Models\Page;
use Made\Cms\Website\Models\Settings\WebsiteSetting as SettingsWebsiteSetting;

class WebsiteSetting extends SettingsWebsiteSetting
{
    public bool $donation_button = false;

    public string $donation_button_text = '';

    public string|null $donation_page = null;

    public string|null $donation_email = null;

    public string|null $donation_success_page = null;

    public function getDonationSuccessPage(): ?Page
    {
        return $this->getPage('donation_success_page');
    }
}