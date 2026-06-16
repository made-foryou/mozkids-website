<?php

declare(strict_types=1);

namespace App\Strips;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\View\View;
use Made\Cms\Filament\Builder\ContentStrip;

class CookieDeclarationStrip implements ContentStrip
{
    public static function id(): string
    {
        return 'cookie-declaration';
    }

    public static function render(array $attributes = []): View
    {
        $attributes['live'] = true;

        return view('strips.' . self::id(), $attributes);
    }

    public static function block(string $context = 'form'): Block
    {
        return Block::make(self::id())
            ->label('Cookieverklaring')
            ->icon('heroicon-s-shield-check')
            ->schema([
                TextInput::make('subtitle')
                    ->label('Subtitel')
                    ->helperText('Optionele eyebrow boven de cookieverklaring.'),

                TextInput::make('title')
                    ->label('Titel')
                    ->helperText('Optionele titel boven de cookieverklaring.'),

                TextInput::make('url')
                    ->label('Cookiebot URL')
                    ->required()
                    ->url()
                    ->helperText('De src-URL uit de Cookiebot CookieDeclaration-embedcode, bijvoorbeeld https://consent.cookiebot.com/{id}/cd.js'),
            ]);
    }
}
