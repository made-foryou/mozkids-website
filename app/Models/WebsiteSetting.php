<?php

declare(strict_types=1);

namespace App\Models;

use Made\Cms\Website\Models\Settings\WebsiteSetting as SettingsWebsiteSetting;

class WebsiteSetting extends SettingsWebsiteSetting
{
    public bool $donation_button = false;
}