<?php

namespace App\View\Components\Calendar;

use App\Domains\Agenda\Models\AgendaItem;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OverviewItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public readonly AgendaItem $item,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.calendar.overview-item');
    }
}
