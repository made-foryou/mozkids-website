<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Made\Cms\Information\Models\ContactInformationSettings;

class InformationSettingsComposer 
{
    public function __construct(
        protected readonly ContactInformationSettings $settings,
    ) { }

    public function compose(View $view): void
    {
        $address = $this->settings->getAddress('contact');
        $contact = $this->settings->getContact('contact');
        $bankAccount = $this->settings->getAccount('bank');
        $sinAccount = $this->settings->getAccount('sin');
        $instagram = $this->settings->getAccount('instagram');

        $view->with(compact('address', 'contact', 'bankAccount', 'sinAccount', 'instagram'));
    }
}