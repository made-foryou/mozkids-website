<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class NewsletterFormTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_renders_a_hidden_error_message(): void
    {
        $html = (string) $this->blade('<x-columns.newsletter />');

        self::assertMatchesRegularExpression('/class="made-mailchimp-error hidden/', $html);
        self::assertStringContainsString('Het aanmelden is niet gelukt.', $html);
    }
}
