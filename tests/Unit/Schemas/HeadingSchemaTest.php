<?php

declare(strict_types=1);

namespace Tests\Unit\Schemas;

use App\Enums\HeadingLevel;
use App\Schemas\HeadingSchema;
use App\Strips\HeroStrip;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class HeadingSchemaTest extends TestCase
{
    #[Test]
    public function it_resolves_a_top_level_heading_with_a_default(): void
    {
        $resolved = HeadingSchema::resolveViewAttributes(
            ['title' => 'Titel'],
            ['title_level' => HeadingLevel::H2],
        );

        self::assertSame(HeadingLevel::H2, $resolved['title_level']);
        self::assertSame('Titel', $resolved['title']);
    }

    #[Test]
    public function it_keeps_a_stored_heading_level(): void
    {
        $resolved = HeadingSchema::resolveViewAttributes(
            ['title_level' => 'h4'],
            ['title_level' => HeadingLevel::H2],
        );

        self::assertSame(HeadingLevel::H4, $resolved['title_level']);
    }

    #[Test]
    public function it_resolves_heading_levels_inside_a_list(): void
    {
        $resolved = HeadingSchema::resolveViewAttributes(
            ['items' => [['title' => 'A', 'title_level' => 'h2'], ['title' => 'B']]],
            ['items.*.title_level' => HeadingLevel::H3],
        );

        self::assertSame(HeadingLevel::H2, $resolved['items'][0]['title_level']);
        self::assertSame(HeadingLevel::H3, $resolved['items'][1]['title_level']);
    }

    #[Test]
    public function it_ignores_a_missing_list(): void
    {
        $resolved = HeadingSchema::resolveViewAttributes(
            ['items' => null],
            ['items.*.title_level' => HeadingLevel::H3],
        );

        self::assertNull($resolved['items']);
    }

    #[Test]
    public function it_maps_the_legacy_hero_heading_fields(): void
    {
        self::assertSame(HeadingLevel::H3, HeroStrip::legacyHeadingLevel(true, '3'));
        self::assertSame(HeadingLevel::H1, HeroStrip::legacyHeadingLevel(true, null));
        self::assertSame(HeadingLevel::None, HeroStrip::legacyHeadingLevel(false, '2'));
        self::assertSame(HeadingLevel::None, HeroStrip::legacyHeadingLevel(null, null));
    }
}
