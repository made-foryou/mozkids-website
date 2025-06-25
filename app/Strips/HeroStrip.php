<?php

declare(strict_types=1);

namespace App\Strips;

use App\Schemas\ButtonSchema;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Checkbox;
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

    public static function block(string $context = "form"): Block
    {
        return Block::make(self::id())
            ->label("Hero tekst")
            ->icon("heroicon-s-star")
            ->schema([
                Checkbox::make("heading")
                    ->label("Heading")
                    ->default(false)
                    ->live()
                    ->helperText("Wil je deze titel als H1 gebruiken?"),

                Select::make("heading_number")
                    ->label("Heading Number")
                    ->options([
                        "1" => "Heading 1",
                        "2" => "Heading 2",
                        "3" => "Heading 3",
                        "4" => "Heading 4",
                        "5" => "Heading 5",
                        "6" => "Heading 6",
                    ])
                    ->default("1")
                    ->live()
                    ->selectablePlaceholder(false)
                    ->requiredIf(fn(Get $get) => $get("heading") === true, [])
                    ->hidden(fn(Get $get) => $get("heading") === false),

                Textarea::make("content")
                    ->label("Inhoud")
                    ->helperText(
                        "Om tekst rood en uitgelicht te maken kun je de tekst omringen met [ en een ]."
                    ),

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
