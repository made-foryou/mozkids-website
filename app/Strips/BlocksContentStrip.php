<?php

declare(strict_types=1);

namespace App\Strips;

use App\Enums\HeadingLevel;
use App\Schemas\HeadingSchema;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms;
use Illuminate\Contracts\View\View;
use Made\Cms\Filament\Builder\ContentStrip;

class BlocksContentStrip implements ContentStrip
{
    public static function id(): string
    {
        return "blocks-content-strip";
    }

    public static function render(array $attributes = []): View
    {
        $attributes["live"] = true;

        $attributes = HeadingSchema::resolveViewAttributes($attributes, ["items.*.title_level" => HeadingLevel::H3]);

        return view("strips." . self::id(), $attributes);
    }

    public static function block(string $context = "form"): Block
    {
        return Block::make(self::id())
            ->label("Blokken inhoud")
            ->icon("iconic-grid")
            ->schema(
                components: [
                    Forms\Components\TextInput::make("subtitle")->label(
                        "Subtitel"
                    ),

                    Forms\Components\RichEditor::make("content")->label(
                        "inhoud"
                    ),

                    Forms\Components\Repeater::make("items")
                        ->label("Blokken")
                        ->addActionLabel("Nieuw blok toevoegen")
                        ->schema([
                            Forms\Components\FileUpload::make("image")
                                ->image()
                                ->label("Afbeelding")
                                ->imageEditor()
                                ->imageEditorAspectRatios(["35:24"])
                                ->preserveFilenames(),

                            Forms\Components\TextInput::make("subtitle")->label(
                                "Subtitel"
                            ),

                            Forms\Components\TextInput::make("title")->label(
                                "Titel"
                            ),

                            HeadingSchema::level(
                                "title_level",
                                HeadingLevel::H3
                            ),

                            Forms\Components\RichEditor::make("content")
                                ->label("Inhoud")
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
                        ])
                        ->grid([
                            "default" => 1,
                            "md" => 3,
                        ]),
                ]
            );
    }
}
