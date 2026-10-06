<?php

declare(strict_types=1);

namespace App\Schemas;

use App\Enums\HeadingLevel;
use Filament\Forms\Components\Select;

class HeadingSchema
{
    /**
     * Select waarmee de redacteur het kopniveau van een titel kiest.
     *
     * Filament past `default()` alleen toe op nieuwe items. Bestaande strips
     * krijgen via `afterStateHydrated` de default, zodat het veld het werkelijke
     * niveau toont en het bij de eerstvolgende keer opslaan wordt bewaard.
     */
    public static function level(
        string $name = 'title_level',
        HeadingLevel $default = HeadingLevel::H2,
        string $label = 'Kopniveau'
    ): Select {
        return Select::make($name)
            ->label($label)
            ->options(HeadingLevel::class)
            ->default($default->value)
            ->selectablePlaceholder(false)
            ->helperText(
                'Bepaalt alleen de HTML-kop (h1 t/m h6) voor structuur en SEO, niet de opmaak.'
            )
            ->afterStateHydrated(function (Select $component, $state) use (
                $default
            ): void {
                if (blank($state)) {
                    $component->state($default->value);
                }
            });
    }

    /**
     * @param  array<mixed, mixed>  $attributes
     */
    public static function resolve(
        array $attributes,
        string $key,
        HeadingLevel $default
    ): HeadingLevel {
        return HeadingLevel::resolve($attributes[$key] ?? null, $default);
    }

    /**
     * Zet de opgeslagen kopniveaus om naar HeadingLevel-instanties, met per
     * veld een default voor content die nog geen niveau heeft opgeslagen.
     *
     * Paden met `.*.` lopen over een lijst, bijv. `items.*.title_level`.
     *
     * @param  array<mixed, mixed>  $attributes
     * @param  array<string, HeadingLevel>  $defaults
     * @return array<mixed, mixed>
     */
    public static function resolveViewAttributes(
        array $attributes,
        array $defaults
    ): array {
        foreach ($defaults as $path => $default) {
            if (! str_contains($path, '.*.')) {
                $attributes[$path] = self::resolve($attributes, $path, $default);

                continue;
            }

            [$list, $key] = explode('.*.', $path, 2);

            if (! is_array($attributes[$list] ?? null)) {
                continue;
            }

            foreach ($attributes[$list] as &$item) {
                if (is_array($item)) {
                    $item[$key] = self::resolve($item, $key, $default);
                }
            }

            unset($item);
        }

        return $attributes;
    }
}
