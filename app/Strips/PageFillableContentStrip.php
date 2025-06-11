<?php

declare(strict_types=1);

namespace App\Strips;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\View\View;
use Made\Cms\Filament\Builder\ContentStrip;
use Made\Cms\Page\Models\Page;

class PageFillableContentStrip implements ContentStrip
{
    public static function render(array $attributes = []): View
    {
        $attributes["live"] = true;

        if (!empty($attributes["link"])) {
            $attributes["linkModel"] = Page::findOrFail(
                (int) $attributes["link"]
            );
        }

        return view("strips.page-fillable-content-strip", $attributes);
    }

    public static function id(): string
    {
        return "page-fillable-content-strip";
    }

    public static function block(string $context = "form"): Block
    {
        return Block::make(self::id())
            ->label("Pagina vullende inhoudsstrook")
            ->icon("heroicon-s-command-line")
            ->schema([
                TextInput::make("title")->label("Titel"),

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

                TextInput::make("label")->label("Button tekst"),

                Select::make("link")->label("Button link")->options(
                    fn() => Page::query()
                        ->select(["id", "name"])
                        ->published()
                        ->get()
                        ->mapWithKeys(
                            fn(Page $page) => [$page->id => $page->name]
                        )
                        ->toArray()
                ),
            ])
            ->columns(2);
    }
}
