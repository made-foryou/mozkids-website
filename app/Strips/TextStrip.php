<?php

declare(strict_types=1);

namespace App\Strips;

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

        return view("strips." . self::id(), $attributes);
    }

    public static function block(string $context = "form"): Block
    {
        return Block::make(self::id())
            ->label("Tekst")
            ->icon("heroicon-s-document-text")
            ->schema([
                TextInput::make("title"),

                RichEditor::make("content")->label("Inhoud"),
            ]);
    }
}
