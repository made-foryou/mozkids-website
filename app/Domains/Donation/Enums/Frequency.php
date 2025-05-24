<?php

declare(strict_types=1);

namespace App\Domains\Donation\Enums;

use App\Domains\Shared\Enums\HasEasyEnumMethods;
use Illuminate\Support\Collection;

enum Frequency: string
{
    use HasEasyEnumMethods;

    case Single = "single";
    case Monthly = "monthly";
    case Yearly = "yearly";

    public function label(): string
    {
        return match ($this) {
            self::Single => "Eenmalig",
            self::Monthly => "Maandelijks",
            self::Yearly => "Jaarlijks",
        };
    }

    public function manually(): bool
    {
        return match ($this) {
            self::Single => false,
            default => true,
        };
    }
}
