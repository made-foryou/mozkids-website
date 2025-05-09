<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('web.donation_button', false);
        $this->migrator->add('web.donation_button_text', 'Help ons de kinderen te steunen in Mozambique');
    }
};
