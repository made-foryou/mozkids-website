<?php

declare(strict_types=1);

namespace App\Enums;

enum Icon: string
{
    case Identification = "identification";
    case Rocket = "rocket";
    case Pyramid = "pyramid";
    case Trust = "trust";
    case Involved = "involved";

    public function icon(): string
    {
        return match ($this) {
            self::Identification => "svg.identification",
            self::Rocket => "svg.rocket",
            self::Pyramid => "svg.pyramid",
            self::Trust => "svg.trust",
            self::Involved => "svg.involved",
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Identification => "Identificatie",
            self::Rocket => "Raket",
            self::Pyramid => "Piramide",
            self::Trust => "Vertrouwen",
            self::Involved => "Betrokken",
        };
    }

    public static function selectOptions(): array
    {
        return collect(self::cases())
            ->mapWithKeys(
                fn(Icon $case): array => [$case->value => $case->label()]
            )
            ->toArray();
    }
}
