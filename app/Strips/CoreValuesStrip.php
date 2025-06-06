<?php

declare(strict_types=1);

namespace App\Strips;

use App\Components\UsesIcons;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\View\View;
use Made\Cms\Filament\Builder\ContentStrip;

class CoreValuesStrip implements ContentStrip
{
    use UsesIcons;

    public static function id(): string
    {
        return "core-values-strip";
    }

    public static function render(array $attributes = []): View
    {
        $attributes["live"] = true;

        if ($attributes["values"]) {
            foreach ($attributes["values"] as &$value) {
                if ($value["icon"]) {
                    $value["icon"] = self::resolveIconValue($value["icon"]);
                }
            }
        }

        return view("strips." . self::id(), $attributes);
    }

    public static function block(string $context = "form"): Block
    {
        return Block::make(self::id())
            ->label("Kernwaarden")
            ->icon("iconic-grid")
            ->schema(
                components: [
                    TextInput::make("subtitle")->label("Subtitel"),

                    RichEditor::make("title")->label("Titel"),

                    Repeater::make("values")
                        ->label("Onderdelen")
                        ->addActionLabel("Nieuw onderdeel toevoegen")
                        ->schema(
                            components: [
                                Select::make("icon")
                                    ->options(self::iconOptions())
                                    ->label("Icoon"),

                                TextInput::make("title")->label("Titel"),

                                RichEditor::make("content")->label(
                                    "Omschrijving"
                                ),
                            ]
                        )
                        ->grid([
                            "default" => 1,
                            "md" => 3,
                        ]),
                ]
            );
    }
}
