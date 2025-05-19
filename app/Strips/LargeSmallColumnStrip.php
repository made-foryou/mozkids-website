<?php

declare(strict_types=1);

namespace App\Strips;

use App\Schemas\ButtonSchema;
use App\Schemas\ColumnSchema;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Illuminate\Contracts\View\View;
use Made\Cms\Filament\Builder\ContentStrip;

class LargeSmallColumnStrip implements ContentStrip
{
    use HasColumns;

    public static function id(): string
    {
        return 'large-small-column-strip';
    }

    public static function render(array $attributes = []): View
    {
        return view('strips.' . self::id(), self::resolveAttributes($attributes));
    }

    public static function block(string $context = 'form'): Block
    {
        return Block::make(self::id())
            ->label('Twee kolommen, links groot en rechts klein')
            ->icon('heroicon-s-view-columns')
            ->schema([
                Repeater::make('left_columns')
                    ->label('Inhoud linker kolom')
                    ->schema(ColumnSchema::schema()),

                Repeater::make('right_columns')
                    ->label('Inhoud rechter kolom')
                    ->schema(ColumnSchema::schema()),
            ])
            ->columns([
                'default' => 1,
                'xl' => 2,
            ]);
    }
}
