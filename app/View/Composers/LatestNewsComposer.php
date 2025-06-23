<?php

namespace App\View\Composers;

use Made\Cms\News\Facades\MadeNews;

class LatestNewsComposer
{
    public function compose($view): void
    {
        $view->with('items', MadeNews::news()->limit(2)->get());
        $view->with('newsPage', MadeNews::overviewPage());
    }
}
