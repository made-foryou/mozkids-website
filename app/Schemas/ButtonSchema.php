<?php

declare(strict_types=1);

namespace App\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Made\Cms\News\Models\Post;
use Made\Cms\Page\Models\Page;

class ButtonSchema
{
    public static function schema(): array
    {
        return [
            Select::make('color')
                ->label('Button kleur')
                ->options([
                    'primary' => 'Rood',
                    'secondary' => 'Creme',
                    'white' => 'Wit',
                ])
                ->default('primary'),

            TextInput::make('label')
                ->label('Button tekst'),

            Select::make('website_link')
                ->label('Linken naar website onderdeel')
                ->nullable()
                ->options(self::options()),
        ];
    }

    protected static function options(): array
    {
        $options = collect();

        $pages = Page::query()
            ->select('id', 'name')
            ->published()
            ->get();

        $options = $options->merge(
            $pages->mapWithKeys(fn (Page $item) => [$item::class.':'.$item->id => 'Pagina: ' . $item->name])
        );

        $posts = Post::query()
            ->select('id', 'name')
            ->published()
            ->get();

        $options = $options->merge(
            $posts->mapWithKeys(fn (Post $item) => [$item::class.':'.$item->id => 'Nieuwsbericht: ' . $item->name])
        );

        /**
         * @todo Ervoor zorgen dat er nog meer types aan toegevoegd kunnen worden.
         */

        return $options->toArray();
    }
}
