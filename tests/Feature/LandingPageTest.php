<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_returns_an_error_when_no_landing_page_is_selected()
    {
        $response = $this->get('/');
        $response->assertStatus(404);
    }
}
