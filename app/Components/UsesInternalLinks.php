<?php

declare(strict_types=1);

namespace App\Components;

use Made\Cms\News\Models\Post;
use Made\Cms\Page\Models\Page;

trait UsesInternalLinks
{
    /**
     * @todo Dit moet vanuit het CMS komen.
     */
    public static function options(): array
    {
        $options = [];

        $pages = Page::query()
            ->select('id', 'name')
            ->published()
            ->get();

        $options['Pagina\'s'] = $pages->mapWithKeys(
            fn (Page $item) => [$item::class.':'.$item->id => $item->name]
        )->toArray();

        $posts = Post::query()
            ->select('id', 'name')
            ->published()
            ->get();

        $options['Nieuwsberichten'] = $posts->mapWithKeys(
            fn (Post $item) => [$item::class.':'.$item->id => $item->name]
        )->toArray();

        return $options;
    }
}