<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Column extends Component
{
    public const string LEFT = 'left';
    public const string RIGHT = 'right';
    public const string MIDDLE = 'middle';

    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $items = [],
        public string $side = self::MIDDLE,
        public bool $live = true,
    ) {
        //
    }

    public function isLeft(): bool
    {
        return $this->side === self::LEFT;
    }

    public function isRight(): bool
    {
        return $this->side === self::RIGHT;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.column');
    }
}
