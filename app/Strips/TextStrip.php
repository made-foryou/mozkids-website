<?php

declare(strict_types=1);

namespace App\Strips;

use App\Enums\HeadingLevel;
use App\Schemas\HeadingSchema;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\View\View;
use Made\Cms\Filament\Builder\ContentStrip;

class TextStrip implements ContentStrip
{
    public static function id(): string
    {
        return "text";
    }

    public static function render(array $attributes = []): View
    {
        $attributes["live"] = true;

        $attributes = HeadingSchema::resolveViewAttributes($attributes, ["title_level" => HeadingLevel::H1]);

        return view("strips." . self::id(), $attributes);
    }

    public static function block(string $context = "form"): Block
    {
        return Block::make(self::id())
            ->label("Tekst")
            ->icon("heroicon-s-document-text")
            ->schema([
                TextInput::make("title")->label("Titel"),

                HeadingSchema::level("title_level", HeadingLevel::H1),

                RichEditor::make("content")
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
            ]);
    }
}
