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

class BoardMembersStrip implements ContentStrip
{
    public static function id(): string
    {
        return 'board-members';
    }

    public static function render(array $attributes = []): View
    {
        $attributes['live'] = true;

        return view('strips.' . self::id(), $attributes);
    }

    public static function block(string $context = 'form'): Block
    {
        return Block::make(self::id())
            ->label('Bestuursleden')
            ->icon('heroicon-s-users')
            ->schema([
                TextInput::make('subtitle')
                    ->label('Subtitel')
                    ->helperText('Optionele eyebrow boven de bestuursleden.'),

                TextInput::make('title')
                    ->label('Titel')
                    ->helperText('Optionele display titel boven de bestuursleden.'),

                RichEditor::make('description')
                    ->label('Omschrijving')
                    ->helperText('Optionele korte intro onder de titel.')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'link',
                        'underline',
                        'redo',
                        'undo',
                    ]),

                Repeater::make('members')
                    ->label('Bestuursleden')
                    ->addActionLabel('Nieuw bestuurslid toevoegen')
                    ->schema([
                        TextInput::make('role')
                            ->label('Functie')
                            ->helperText('Bijvoorbeeld: Voorzitter, Penningmeester, Secretaris.')
                            ->required(),

                        TextInput::make('name')
                            ->label('Naam')
                            ->required(),

                        FileUpload::make('image')
                            ->label('Foto')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '4:5',
                                '1:1',
                                '3:4',
                            ])
                            ->preserveFilenames(),

                        RichEditor::make('description')
                            ->label('Omschrijving')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'link',
                                'underline',
                                'redo',
                                'undo',
                            ]),
                    ])
                    ->collapsed()
                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
            ]);
    }
}
