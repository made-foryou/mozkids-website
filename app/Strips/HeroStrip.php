<?php

declare(strict_types=1);

namespace App\Strips;

use App\Enums\HeadingLevel;
use App\Schemas\ButtonSchema;
use App\Schemas\HeadingSchema;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Get;
use Illuminate\Contracts\View\View;
use Made\Cms\Filament\Builder\ContentStrip;

class HeroStrip implements ContentStrip
{
    public static function render(array $attributes = []): View
    {
        $attributes["live"] = true;
        $attributes["heading_level"] = self::resolveHeadingLevel($attributes);

        if (!empty($attributes["buttons"])) {
            $attributes["buttons"] = array_map(function (array $button): array {
                if ($button["website_link"] === null) {
                    return $button;
                }

                [$model, $id] = explode(":", $button["website_link"]);

                $target = $model::query()->findOrFail($id);

                $button["website_link"] = $target;

                return $button;
            }, $attributes["buttons"]);
        }

        return view("strips." . self::id(), $attributes);
    }

    public static function id(): string
    {
        return "hero-strip";
    }

    /**
     * Bepaalt het kopniveau. Strips die nog niet opnieuw zijn opgeslagen hebben
     * de oude velden `heading` (bool) en `heading_number` ("1".."6").
     *
     * @param array<mixed, mixed> $attributes
     */
    public static function resolveHeadingLevel(array $attributes): HeadingLevel
    {
        if (filled($attributes["heading_level"] ?? null)) {
            return HeadingSchema::resolve(
                $attributes,
                "heading_level",
                HeadingLevel::None
            );
        }

        return self::legacyHeadingLevel(
            $attributes["heading"] ?? false,
            $attributes["heading_number"] ?? null
        );
    }

    public static function legacyHeadingLevel(
        mixed $heading,
        mixed $number
    ): HeadingLevel {
        if (!$heading) {
            return HeadingLevel::None;
        }

        return HeadingLevel::tryFrom("h" . $number) ?? HeadingLevel::H1;
    }

    public static function block(string $context = "form"): Block
    {
        return Block::make(self::id())
            ->label("Hero tekst")
            ->icon("heroicon-s-star")
            ->schema([
                Textarea::make("content")
                    ->label("Inhoud")
                    ->helperText(
                        "Om tekst rood en uitgelicht te maken kun je de tekst omringen met [ en een ]."
                    ),

                HeadingSchema::level(
                    "heading_level",
                    HeadingLevel::None
                )->afterStateHydrated(function (
                    Select $component,
                    $state,
                    Get $get
                ): void {
                    if (filled($state)) {
                        return;
                    }

                    $component->state(
                        self::legacyHeadingLevel(
                            $get("heading"),
                            $get("heading_number")
                        )->value
                    );
                }),

                Repeater::make("buttons")
                    ->schema(ButtonSchema::schema())
                    ->addActionLabel("Button toevoegen")
                    ->grid([
                        "default" => 1,
                        "md" => 2,
                    ]),
            ]);
    }
}
