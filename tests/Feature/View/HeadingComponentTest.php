<?php

declare(strict_types=1);

namespace Tests\Feature\View;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class HeadingComponentTest extends TestCase
{
    #[Test]
    public function it_renders_the_chosen_heading_level(): void
    {
        $this->blade('<x-heading level="h2" class="title">Hallo</x-heading>')
            ->assertSee('<h2 class="title">Hallo</h2>', false);
    }

    #[Test]
    public function it_renders_a_span_when_there_is_no_heading(): void
    {
        $this->blade('<x-heading level="none" class="title">Hallo</x-heading>')
            ->assertSee('<span class="title">Hallo</span>', false);
    }

    #[Test]
    public function it_renders_the_fallback_tag_when_there_is_no_heading(): void
    {
        $this->blade('<x-heading :level="null" fallback="div">Hallo</x-heading>')
            ->assertSee('<div>Hallo</div>', false);
    }

    #[Test]
    public function it_keeps_extra_attributes(): void
    {
        $this->blade('<x-heading level="h3" data-highlightable>Hallo</x-heading>')
            ->assertSee('<h3 data-highlightable="data-highlightable">Hallo</h3>', false);
    }
}
