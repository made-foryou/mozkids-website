<?php

declare(strict_types=1);

namespace App\Strips;

use App\Models\YearReport;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\View\View;
use Made\Cms\Filament\Builder\ContentStrip;

class YearReportsStrip implements ContentStrip
{
    public static function id(): string
    {
        return "year-reports-strip";
    }

    public static function render(array $attributes = []): View
    {
        $attributes["live"] = true;

        return view(
            "strips." . self::id(),
            array_merge($attributes, [
                "reports" => YearReport::query()
                    ->orderByDesc("year")
                    ->get()
                    ->groupBy("year"),
            ])
        );
    }

    public static function block(string $context = "form"): Block
    {
        return Block::make(self::id())
            ->label("Jaarverslagen")
            ->schema([
                TextInput::make("subtitle")->label("Subtitel"),
                TextInput::make("title")->label("titel"),
            ]);
    }
}
