<?php

declare(strict_types=1);

namespace App\Strips;

use App\Enums\HeadingLevel;
use App\Schemas\HeadingSchema;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\View\View;
use Made\Cms\Filament\Builder\ContentStrip;

class FaqStrip implements ContentStrip
{
    public static function id(): string
    {
        return 'faq';
    }

    public static function render(array $attributes = []): View
    {
        $attributes['live'] = true;

        $attributes = HeadingSchema::resolveViewAttributes($attributes, ['title_level' => HeadingLevel::H2, 'items.*.title_level' => HeadingLevel::None]);

        return view('strips.' . self::id(), $attributes);
    }

    public static function block(string $context = 'form'): Block
    {
        return Block::make(self::id())
            ->label('Veelgestelde vragen')
            ->icon('heroicon-s-question-mark-circle')
            ->schema([
                TextInput::make('subtitle')
                    ->label('Subtitel')
                    ->helperText('Optionele eyebrow boven de FAQ.'),

                TextInput::make('title')
                    ->label('Titel')
                    ->helperText('Optionele display titel boven de FAQ.'),

                HeadingSchema::level('title_level', HeadingLevel::H2),

                Repeater::make('items')
                    ->label('Vragen')
                    ->addActionLabel('Nieuwe vraag toevoegen')
                    ->schema([
                        TextInput::make('title')
                            ->label('Vraag')
                            ->required(),

                        HeadingSchema::level('title_level', HeadingLevel::None, 'Kopniveau vraag'),

                        FileUpload::make('image')
                            ->label('Afbeelding')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '4:3',
                                '16:9',
                                '1:1',
                            ])
                            ->preserveFilenames(),

                        RichEditor::make('content')
                            ->label('Antwoord')
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
                            ]),
                    ])
                    ->collapsed()
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
            ]);
    }
}
