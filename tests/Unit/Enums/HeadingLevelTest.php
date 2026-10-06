<?php

declare(strict_types=1);

namespace Tests\Unit\Enums;

use App\Enums\HeadingLevel;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class HeadingLevelTest extends TestCase
{
    #[Test]
    public function it_returns_the_heading_tag(): void
    {
        self::assertSame('h1', HeadingLevel::H1->tag());
        self::assertSame('h6', HeadingLevel::H6->tag());
    }

    #[Test]
    public function it_uses_the_fallback_tag_when_there_is_no_heading(): void
    {
        self::assertSame('span', HeadingLevel::None->tag());
        self::assertSame('div', HeadingLevel::None->tag('div'));
    }

    #[Test]
    public function it_resolves_stored_values(): void
    {
        self::assertSame(HeadingLevel::H3, HeadingLevel::resolve('h3'));
        self::assertSame(HeadingLevel::H2, HeadingLevel::resolve(HeadingLevel::H2));
        self::assertSame(HeadingLevel::None, HeadingLevel::resolve('none', HeadingLevel::H1));
    }

    #[Test]
    public function it_falls_back_to_the_default_for_missing_or_invalid_values(): void
    {
        self::assertSame(HeadingLevel::H1, HeadingLevel::resolve(null, HeadingLevel::H1));
        self::assertSame(HeadingLevel::H2, HeadingLevel::resolve('h9', HeadingLevel::H2));
        self::assertSame(HeadingLevel::None, HeadingLevel::resolve(''));
    }

    #[Test]
    public function it_has_dutch_labels(): void
    {
        self::assertSame('Kop 2', HeadingLevel::H2->getLabel());
        self::assertSame('Geen kop (alleen tekst)', HeadingLevel::None->getLabel());
    }
}
