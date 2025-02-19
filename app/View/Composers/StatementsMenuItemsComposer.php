<?php

declare(strict_types=1);

namespace App\View\Composers;

use Illuminate\View\View;
use Made\Cms\Facades\Cms;

class StatementsMenuItemsComposer
{
    public function compose(View $view): void
    {
        $view->with('items', Cms::navigationItems('statements'));
    }
}

