<?php

declare(strict_types=1);

namespace App\Strips;

use Filament\Forms\Components\FileUpload;
use Made\Cms\Filament\Builder\ContentStrip;

class QuoteStrip implements ContentStrip
{
    public static function id(): string
    {
        return "quote";
    }

    public static function render(
        array $attributes = []
    ): \Illuminate\Contracts\View\View {
        $attributes["live"] = true;

        return view("strips." . self::id(), $attributes);
    }

    public static function block(
        string $context = "form"
    ): \Filament\Forms\Components\Builder\Block {
        return \Filament\Forms\Components\Builder\Block::make(self::id())
            ->label("Quote")
            ->icon("heroicon-s-chat-bubble-bottom-center-text")
            ->schema([
                \Filament\Forms\Components\Textarea::make("quote")->label(
                    "Quote"
                ),

                \Filament\Forms\Components\TextInput::make("author")->label(
                    "Auteur"
                ),

                FileUpload::make("image")
                    ->label("Afbeelding")
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios(["116:65", "547:175"])
                    ->preserveFilenames()
                    ->required(),
            ]);
    }
}
