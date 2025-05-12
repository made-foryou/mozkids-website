<?php

declare(strict_types=1);

namespace App\Strips;

use App\Components\UsesInternalLinks;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components;
use Illuminate\Contracts\View\View;
use Made\Cms\Filament\Builder\ContentStrip;

class CallToActionStrip implements ContentStrip
{
    use UsesInternalLinks;

    public static function render(array $attributes = []): View
    {
        $attributes['live'] = true;

        $attributes = self::resolveLink($attributes);    

        return view('strips.' . self::id(), $attributes);
    }

    public static function resolveLink(array $attributes): array
    {
        if (!empty($attributes['link'])) {
            [$model, $id] = explode(':', $attributes['link']);

            $target = $model::query()
                ->findOrFail($id);

            $attributes['link'] = $target;
        }

        return $attributes;
    }

    public static function id(): string
    {
        return 'call-to-action';
    }

    public static function block(string $context = 'form'): Block
    {
        return Block::make(self::id())
            ->label('Call to action')
            ->icon('heroicon-s-command-line')
            ->schema([
                Components\RichEditor::make('content')
                    ->label('Button inhoud')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'link',
                    ])
                    ->required(),

                Components\Select::make('link')
                    ->label('Waar moet de call-to-action naartoe linken?')
                    ->options(self::options())
                    ->searchable()
                    ->required(),
            ])
            ->columns([
                'default' => 1,
                'lg' => 2,
            ]);
    }
}