<?php

declare(strict_types=1);

namespace App\Strips;

use App\Schemas\ButtonSchema;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\View\View;
use Made\Cms\Filament\Builder\ContentStrip;

class TextWithImageStrip implements ContentStrip
{
    public static function id(): string
    {
        return 'text-with-image';
    }

    public static function render(array $attributes = []): View
    {
        $attributes['live'] = true;

        if (!empty($attributes['buttons'])) {
            $attributes['buttons'] = array_map(function (array $button): array {
                if ($button['website_link'] === null) {
                    return $button;
                }

                [$model, $id] = explode(':', $button['website_link']);

                $target = $model::query()
                    ->findOrFail($id);

                $button['website_link'] = $target;

                return $button;
            }, $attributes['buttons']);
        }

        return view('strips.' . self::id(), $attributes);
    }

    public static function block(string $context = 'form'): Block
    {
        return Block::make(self::id())
            ->icon('heroicon-s-document-text')
            ->schema([
                TextInput::make('title')
                    ->label('Titel'),

                TextInput::make('subtitle')
                    ->label('Subtitel')
                    ->helperText('Tekst in het rood boven de titel.'),

                RichEditor::make('content')
                    ->label('Inhoud'),

                Repeater::make('buttons')
                    ->schema(ButtonSchema::schema())
                    ->addActionLabel('Button toevoegen'),

                FileUpload::make('image')
                    ->label('Afbeelding'),

            ])
            ->preview('strips.'. self::id());
    }
}
