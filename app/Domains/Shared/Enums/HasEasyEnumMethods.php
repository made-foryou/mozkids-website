<?php

declare(strict_types=1);

namespace App\Domains\Shared\Enums;

use Illuminate\Support\Collection;

/**
 * @method static array cases()
 */
trait HasEasyEnumMethods
{
    /**
     * @return array<int, string>
     */
    public static function values(): array
    {
        return self::collect()
            ->map(fn(self $case): string => $case->value)
            ->toArray();
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        return self::collect()
            ->mapWithKeys(
                fn(self $case): array => [$case->value => $case->label()]
            )
            ->toArray();
    }

    /**
     * @return Collection<int, Frequency>
     */
    public static function collect(): Collection
    {
        return collect(self::cases());
    }
}
