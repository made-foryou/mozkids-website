<?php

declare(strict_types=1);

namespace App\Strips;

use App\Schemas\ButtonSchema;
use App\Schemas\ColumnSchema;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Illuminate\Contracts\View\View;
use Made\Cms\Filament\Builder\ContentStrip;

class ThreeColumnStrip implements ContentStrip
{
    public static function id(): string
    {
        return 'three-columns-strip';
    }

    public static function render(array $attributes = []): View
    {
        $attributes['live'] = true;

        foreach ($attributes['left_columns'] as &$column) {
            $column = ButtonSchema::resolveViewAttributes($column);
        }

        foreach ($attributes['middle_columns'] as &$column) {
            $column = ButtonSchema::resolveViewAttributes($column);
        }

        foreach ($attributes['right_columns'] as &$column) {
            $column = ButtonSchema::resolveViewAttributes($column);
        }

        return view('strips.'. self::id(), $attributes);
    }

    public static function block(string $context = 'form'): Block
    {
        return Block::make(self::id())
            ->label('Drie kolommen')
            ->icon('heroicon-s-view-columns')
            ->schema([
                Repeater::make('left_columns')
                    ->label('Inhoud linker kolom')
                    ->schema(ColumnSchema::schema()),

                Repeater::make('middle_columns')
                    ->label('Inhoud middelste kolom')
                    ->schema(ColumnSchema::schema()),

                Repeater::make('right_columns')
                    ->label('Inhoud rechter kolom')
                    ->schema(ColumnSchema::schema()),
            ])
            ->columns([
                'default' => 1,
                'xl' => 3,
            ]);
    }
}