<?php

declare(strict_types=1);

namespace App\Domains\Website\Settings;

use App\Components\UsesInternalLinks;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Made\Cms\Facades\Made;

class WebsiteSettings
{
    use UsesInternalLinks;

    public function __invoke()
    {
        return [
            Section::make('Sponsoring')
                ->description('Instellingen omtrendt het doneren en sponsoren van Moz Kids via de website.')
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

                    TextInput::make('donation_email')
                        ->label('Donatie e-mailadres')
                        ->helperText('Naar dit e-mailadres worden de donatie aanvragen gestuurd. Mocht deze niet ingevuld zijn dan wordt deze naar het standaard e-mailadres (' . config('mozkids.donation_email') . ') gestuurd.'),

                    Select::make('donation_success_page')
                        ->label('Bedankt pagina')
                        ->helperText('Na het invullen en versturen van het donatie / sponsoring formulier wordt de bezoeker doorgestuurd naar deze pagina.')
                        ->options(Made::madeLinkOptions([Made::LINK_TYPE_PAGES])),

                    TextInput::make('rabobank_link')
                        ->label('Directe donatie rabobank link')
                        ->helperText('Deze link komt achter de "Doneer direct via internetbankieren" button te staan. Hiermee kunnen bezoekers direct een bedrag overmaken naar de rekening van Moz Kids. Deze button wordt alleen zichtbaar als dit veld is ingevuld.'),

                ])
                    ->columnSpan(4),
        ];
    }
}