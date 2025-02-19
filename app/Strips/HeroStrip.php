<?php

declare(strict_types=1);

namespace App\Strips;

use App\Schemas\ButtonSchema;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Illuminate\Contracts\View\View;
use Made\Cms\Filament\Builder\ContentStrip;

class HeroStrip implements ContentStrip
{
    public static function render(array $attributes = []): View
    {
        $attributes['live'] = true;

        if (!empty($attributes['buttons'])) {
            $attributes['buttons'] = array_map(function (array $button): array {
                if ($button['website_link'] === null) {
                    return $button;
                }

                [$model, $id] = explode(':', $button['website_link']);

                $target = $model::query()
                    ->findOrFail($id);

                $button['website_link'] = $target;

                return $button;
            }, $attributes['buttons']);
        }

        return view('strips.' . self::id(), $attributes);
    }

    public static function id(): string
    {
        return 'hero-strip';
    }

    public static function block(): Block
    {
        return Block::make(self::id())
            ->label('Hero tekst')
            ->icon('heroicon-s-star')
            ->schema([
                Textarea::make('content')
                    ->label('Inhoud')
                    ->helperText('Om tekst rood en uitgelicht te maken kun je de tekst omringen met [ en een ].'),

                Repeater::make('buttons')
                    ->schema(ButtonSchema::schema())
                    ->addActionLabel('Button toevoegen')
            ])
            ->columns(2)
            ->preview('strips.' . self::id());
    }
}
