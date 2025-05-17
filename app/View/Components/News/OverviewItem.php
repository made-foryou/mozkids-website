<?php

namespace App\View\Components\News;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Made\Cms\News\Models\Post;

class OverviewItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public readonly Post $post,
    ) { }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.news.overview-item');
    }
}
