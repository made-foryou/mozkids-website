<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Container extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public bool $fullScreenMobile = false,
    )
    {
        //
    }

    public function containerClasses(): string
    {
        $classes = [
            'mx-auto',
            "sm:px-6",
            "lg:px-8",
        ];

        if ($this->fullScreenMobile === false) {
            $classes[] = 'px-4';
        }

        return implode(' ', $classes);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.container');
    }
}
