<?php

declare(strict_types=1);

namespace App\Strips;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\View\View;
use Made\Cms\Filament\Builder\ContentStrip;

class TimelineStrip implements ContentStrip
{
    public static function id(): string
    {
        return 'timeline';
    }

    public static function render(array $attributes = []): View
    {
        $attributes['live'] = true;

        return view('strips.' . self::id(), $attributes);
    }

    public static function block(string $context = 'form'): Block
    {
        return Block::make(self::id())
            ->label('Tijdlijn')
            ->icon('heroicon-s-clock')
            ->schema([
                TextInput::make('subtitle')
                    ->label('Subtitel')
                    ->helperText('Optionele eyebrow boven de tijdlijn.'),

                TextInput::make('title')
                    ->label('Titel')
                    ->helperText('Optionele display titel boven de tijdlijn.'),

                Repeater::make('items')
                    ->label('Tijdlijn items')
                    ->addActionLabel('Nieuw item toevoegen')
                    ->schema([
                        TextInput::make('name')
                            ->label('Naam / Jaartal')
                            ->helperText('Bijvoorbeeld een jaartal (2020) of een mijlpaal-naam.')
                            ->required(),

                        FileUpload::make('image')
                            ->label('Afbeelding')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '4:3',
                                '1:1',
                                '3:2',
                            ])
                            ->preserveFilenames(),

                        TextInput::make('alt')
                            ->label('Alt-tekst afbeelding')
                            ->helperText('Korte beschrijving van de afbeelding voor toegankelijkheid en SEO.'),

                        RichEditor::make('content')
                            ->label('Inhoud')
                            ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'italic',
                                'link',
                                'orderedList',
                                'strike',
                                'underline',
                                'redo',
                                'undo',
                            ])
                            ->required(),
                    ])
                    ->collapsed()
                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
            ]);
    }
}
