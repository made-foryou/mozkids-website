<?php

declare(strict_types=1);

namespace App\Schemas;

use App\Components\UsesInternalLinks;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class ButtonSchema
{
    use UsesInternalLinks;

    public static function schema(): array
    {
        return [
            Select::make('color')
                ->label('Button kleur')
                ->options([
                    'primary' => 'Rood',
                    'secondary' => 'Creme',
                    'white' => 'Wit',
                ])
                ->default('primary'),

            TextInput::make('label')
                ->label('Button tekst'),

            Select::make('website_link')
                ->label('Linken naar website onderdeel')
                ->nullable()
                ->options(self::options()),
        ];
    }

    public static function resolveViewAttributes(array $attributes): array
    {
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

        return $attributes;
    }
}
