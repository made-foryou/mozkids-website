<?php

declare(strict_types=1);

namespace App\Domains\Website\Settings;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;

class WebsiteSettings
{
    public function __invoke()
    {
        return [
            Section::make('Extra\'s')
                ->description('Alle extra instellingen wat betreft de website.')
                ->aside()
                ->schema([

                    Toggle::make('donation_button')
                        ->label('Donatie button?')
                        ->helperText('Wil je op elke pagina van de website een donatie button tonen?'),

                ])
                    ->columnSpan(4),
        ];
    }
}