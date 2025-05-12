<?php

declare(strict_types=1);

namespace App\Domains\Website\Settings;

use App\Components\UsesInternalLinks;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class WebsiteSettings
{
    use UsesInternalLinks;

    public function __invoke()
    {
        return [
            Section::make('Extra\'s')
                ->description('Alle extra instellingen wat betreft de website.')
                ->aside()
                ->schema([

                    Toggle::make('donation_button')
                        ->label('Donatie button?')
                        ->helperText('Wil je op elke pagina van de website een donatie button tonen?')
                        ->live(),

                    TextInput::make('donation_button_text')
                        ->label('Onderwerp tekst van de donatie button')
                        ->helperText('Deze tekst komt onder de "Doneer direct" tekst in de button te staan.')
                        ->placeholder('Help ons de kinderen te steunen in Mozambique')
                        ->visible(fn (callable $get) => $get('donation_button')),

                    Select::make('donation_page')
                        ->label('Donatie pagina')
                        ->helperText('Op deze pagina is het donatie formulier te vinden en zal worden gebruikt voor alle standaard donatie buttons.')
                        ->options(self::options())
                        ->searchable(),

                ])
                    ->columnSpan(4),
        ];
    }
}