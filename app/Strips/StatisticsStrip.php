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

class StatisticsStrip implements ContentStrip
{
    public static function id(): string
    {
        return 'statistics';
    }

    public static function render(array $attributes = []): View
    {
        $attributes['live'] = true;

        $attributes['mobileColumns'] = 3;
        $attributes['columns'] = 6;

        if (count($attributes['stats']) <= 6) {
            $attributes['columns'] = count($attributes['stats']);
        }

        if (count($attributes['stats']) <= 3) {
            $attributes['mobileColumns'] = count($attributes['stats']);
        }

        return view('strips.' . self::id(), $attributes);
    }

    public static function block(string $context = 'form'): Block
    {
        return Block::make(self::id())
            ->icon('heroicon-s-chart-bar-square')
            ->schema([
                Repeater::make('stats')
                    ->schema([
                        FileUpload::make('icon')
                            ->label('Icoon')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '77:59',
                            ])
                            ->preserveFilenames()
                            ->required(),

                        TextInput::make('label')
                            ->label('Statistiek')
                            ->required(),

                        Textarea::make('description')
                            ->label('Omschrijving'),
                        
                    ])
                    ->grid([
                        'default' => 1,
                        'md' => 3,
                        '2xl' => 6
                    ])
            ]);
    }
}