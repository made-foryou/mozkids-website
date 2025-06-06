<?php

declare(strict_types=1);

namespace App\Components;

use App\Enums\Icon;

trait UsesIcons
{
    public static function iconOptions(): array
    {
        return Icon::selectOptions();
    }

    /**
     * @param array<mixed, mixed> $attributes
     *
     * @return array<mixed, mixed>
     */
    public static function resolveIconValue(string $value): Icon
    {
        return Icon::from($value);
    }
}
