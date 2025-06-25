<?php

namespace App\View\Composers;

use App\Domains\Agenda\Models\AgendaItem;

class LatestActivitiesComposer
{
    public function compose($view): void
    {
        $view->with('items', AgendaItem::query()
            ->published()
            ->orderBy('start_date', 'DESC')
            ->orderBy('end_date', 'DESC')
            ->limit(2)
            ->get()
        );
    }
}
