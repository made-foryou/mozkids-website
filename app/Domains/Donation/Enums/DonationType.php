<?php

declare(strict_types=1);

namespace App\Domains\Donation\Enums;

use App\Domains\Shared\Enums\HasEasyEnumMethods;

enum DonationType: string
{
    use HasEasyEnumMethods;

    case Child = "child";
    case Common = "common";

    public function label(): string
    {
        return match ($this) {
            self::Child => "Een kind",
            self::Common => "Algemeen",
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Child => "Sponsoring voor een kind",
            self::Common => "Algemene sponsoring",
        };
    }
}
