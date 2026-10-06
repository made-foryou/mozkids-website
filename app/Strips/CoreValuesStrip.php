<?php

declare(strict_types=1);

namespace App\Strips;

use App\Components\UsesIcons;
use App\Enums\HeadingLevel;
use App\Schemas\HeadingSchema;
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

        // De titel was eerder een RichEditor; oude HTML wordt hier platgeslagen.
        $attributes["title"] = trim(
            html_entity_decode(strip_tags((string) ($attributes["title"] ?? "")))
        );

        $attributes = HeadingSchema::resolveViewAttributes($attributes, [
            "title_level" => HeadingLevel::None,
            "values.*.title_level" => HeadingLevel::H3,
        ]);

        if (!empty($attributes["values"])) {
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

                    TextInput::make("title")->label("Titel"),

                    HeadingSchema::level("title_level", HeadingLevel::None),

                    Repeater::make("values")
                        ->label("Onderdelen")
                        ->addActionLabel("Nieuw onderdeel toevoegen")
                        ->schema(
                            components: [
                                Select::make("icon")
                                    ->options(self::iconOptions())
                                    ->label("Icoon"),

                                TextInput::make("title")->label("Titel"),

                                HeadingSchema::level(
                                    "title_level",
                                    HeadingLevel::H3
                                ),

                                RichEditor::make("content")
                                    ->label("Omschrijving")
                                    ->toolbarButtons([
                                        "attachFiles",
                                        "blockquote",
                                        "bold",
                                        "bulletList",
                                        "codeBlock",
                                        "h1",
                                        "h2",
                                        "h3",
                                        "h4",
                                        "italic",
                                        "link",
                                        "orderedList",
                                        "redo",
                                        "strike",
                                        "underline",
                                        "undo",
                                    ]),
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
