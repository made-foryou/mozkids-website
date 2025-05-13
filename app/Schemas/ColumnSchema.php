<?php

declare(strict_types=1);

namespace App\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;

class ColumnSchema 
{
    public static function schema(): array
    {
        return [
            Select::make('type')
                ->label("Inhoudstype")
                ->live()
                ->options([
                    'text' => 'Tekst',
                    'image' => 'Afbeelding',
                    // 'movie' => 'Video', @todo
                    'agenda' => 'Activiteiten agenda',
                    'news' => 'Laatste nieuws',
                    'newsletter' => 'Nieuwsbrief',
                    'donation-form' => 'Donatie formulier',
                ]),

            // text
            ...self::text(),

            // image
            ...self::image(),
            
            // All
            Repeater::make('buttons')
                ->schema(ButtonSchema::schema())
                ->addActionLabel('Button toevoegen')
                ->live()
                ->hidden(fn (Get $get): bool => $get('type') === 'donation-form')
                ->defaultItems(0),
        ];
    }

    public static function text(): array
    {
        return [
            TextInput::make('subtitle')
                ->label("Subtitel")
                ->hidden(fn (Get $get): bool => $get('type') !== 'text'),

            RichEditor::make('content')
                ->label('Inhoud')
                ->hidden(fn (Get $get): bool => $get('type') !== 'text'),
        ];
    }

    public static function image(): array
    {
        return [
            FileUpload::make('image')
                ->image()
                ->label('Afbeelding')
                ->imageEditor()
                ->imageEditorAspectRatios([
                    '134:125',
                ])
                ->preserveFilenames()
                ->hidden(fn (Get $get): bool => $get('type') !== 'image'),

            TextInput::make('alt')
                ->label('Afbeelding alt tekst')
                ->hidden(fn (Get $get): bool => $get('type') !== 'image'),
        ];
    }
}