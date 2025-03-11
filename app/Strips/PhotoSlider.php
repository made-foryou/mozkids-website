<?php

declare(strict_types=1);

namespace App\Strips;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\View\View;
use Made\Cms\Filament\Builder\ContentStrip;

class PhotoSlider implements ContentStrip
{
    public static function id(): string
    {
        return 'photo-slider';
    }

    public static function render(array $attributes = []): View
    {
        $attributes['live'] = true;

        return view('strips.'. self::id(), $attributes);
    }

    public static function block(string $context = 'form'): Block
    {
        return Block::make(self::id())
            ->label('Foto slider')
            ->icon('heroicon-s-photo')
            ->schema([
                Repeater::make('photos')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Afbeelding')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '248:139',
                            ])
                            ->preserveFilenames()
                            ->required(),

                        TextInput::make('title')
                            ->label('Titel'),

                        Textarea::make('description')
                            ->label('Omschrijving'),
                    ])
                    ->addActionLabel('Foto toevoegen'), 
            ]);
    }
}