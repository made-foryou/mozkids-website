<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

/**
 * Het HTML-kopniveau van een titel. Bepaalt alleen de tag (structuur en SEO),
 * nooit de opmaak: die blijft in de utility-classes van de view.
 */
enum HeadingLevel: string implements HasLabel
{
    case H1 = 'h1';
    case H2 = 'h2';
    case H3 = 'h3';
    case H4 = 'h4';
    case H5 = 'h5';
    case H6 = 'h6';
    case None = 'none';

    public function getLabel(): string
    {
        return match ($this) {
            self::None => 'Geen kop (alleen tekst)',
            default => 'Kop '.substr($this->value, 1),
        };
    }

    /**
     * De HTML-tag voor dit niveau. Bij "geen kop" wordt de fallback-tag gebruikt.
     */
    public function tag(string $fallback = 'span'): string
    {
        return $this === self::None ? $fallback : $this->value;
    }

    /**
     * Zet een opgeslagen waarde om naar een niveau. Ontbrekende of ongeldige
     * waarden (oude content) vallen terug op de default.
     */
    public static function resolve(
        self|string|null $value,
        self $default = self::None
    ): self {
        if ($value instanceof self) {
            return $value;
        }

        if (is_string($value)) {
            return self::tryFrom($value) ?? $default;
        }

        return $default;
    }
}
