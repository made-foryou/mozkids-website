<?php

declare(strict_types=1);

namespace App\Strips;

use App\Domains\Agenda\Models\AgendaItem;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\View\View;
use Made\Cms\Filament\Builder\ContentStrip;

class AgendaStrip implements ContentStrip
{
    public static function id(): string
    {
        return 'agenda-strip';
    }

    public static function render(array $attributes = []): View
    {
        $attributes['live'] = true;

        $items = AgendaItem::query()
            ->published()
            ->orderBy('start_date', 'DESC')
            ->orderBy('end_date', 'DESC')
            ->get();
        $grouped = $items->groupBy(fn (AgendaItem $item): string => $item->start_date->format('Y'));

        $attributes['items'] = $grouped;

        return view('strips.' . self::id(), $attributes);
    }

    public static function block(string $context = 'form'): Block
    {
        return Block::make(self::id())
            ->label('Agenda overzicht')
            ->icon('heroicon-s-calendar')
            ->schema([
                TextInput::make('title')
                    ->label('Titel'),
            ]);
    }
}
