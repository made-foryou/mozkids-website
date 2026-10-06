<?php

declare(strict_types=1);

namespace Tests\Feature\Strips;

use App\Enums\HeadingLevel;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Select;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StripBlocksTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function every_heading_level_select_offers_all_levels(): void
    {
        $selects = [];

        foreach (config('made-cms.content.blocks') as $strips) {
            foreach ($strips as $strip) {
                $this->collect($strip::block('form')->getChildComponents(), $strip::id(), $selects);
            }
        }

        $expected = array_map(fn (HeadingLevel $level): string => $level->value, HeadingLevel::cases());

        self::assertNotEmpty($selects);

        foreach ($selects as $path => $select) {
            self::assertSame($expected, array_keys($select->getOptions()), $path);
            self::assertNotNull(HeadingLevel::tryFrom((string) $select->getDefaultState()), $path);
        }

        self::assertArrayHasKey('hero-strip.heading_level', $selects);
        self::assertArrayHasKey('faq.items.title_level', $selects);
        self::assertArrayHasKey('two-columns-strip.left_columns.subtitle_level', $selects);
    }

    /**
     * @param  array<Component>  $components
     * @param  array<string, Select>  $selects
     */
    private function collect(array $components, string $prefix, array &$selects): void
    {
        foreach ($components as $component) {
            $name = method_exists($component, 'getName') ? $component->getName() : null;
            $path = $name ? "{$prefix}.{$name}" : $prefix;

            if ($component instanceof Select && str_ends_with((string) $name, '_level')) {
                $selects[$path] = $component;
            }

            $this->collect($component->getChildComponents(), $path, $selects);
        }
    }
}
