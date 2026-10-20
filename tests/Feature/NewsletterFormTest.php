<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use MailchimpMarketing\Api\ListsApi;
use MailchimpMarketing\ApiClient;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Test;
use Spatie\Honeypot\Honeypot;
use Tests\TestCase;

class NewsletterFormTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_subscribes_a_valid_request(): void
    {
        $this->mockMailchimpLists()
            ->shouldReceive('setListMember')
            ->once();

        $response = $this->postNewsletterForm($this->validPayload());

        $response->assertStatus(200);
    }

    #[Test]
    public function it_silently_drops_requests_without_honeypot_fields(): void
    {
        $this->mockMailchimpLists()
            ->shouldNotReceive('setListMember');

        $this->post(route('api.subscribe-to-newsletter'), $this->validPayload());
    }

    #[Test]
    public function it_silently_drops_requests_that_are_submitted_too_fast(): void
    {
        $this->mockMailchimpLists()
            ->shouldNotReceive('setListMember');

        $this->post(route('api.subscribe-to-newsletter'), [
            ...$this->validPayload(),
            ...$this->honeypotFields(),
        ]);
    }

    #[Test]
    public function it_renders_the_honeypot_fields(): void
    {
        $html = (string) $this->blade('<x-columns.newsletter />');

        self::assertStringContainsString('name="valid_from"', $html);
    }

    #[Test]
    public function it_renders_a_hidden_error_message(): void
    {
        $html = (string) $this->blade('<x-columns.newsletter />');

        self::assertMatchesRegularExpression('/class="made-mailchimp-error hidden/', $html);
        self::assertStringContainsString('Het aanmelden is niet gelukt.', $html);
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    protected function postNewsletterForm(array $payload): TestResponse
    {
        $fields = $this->honeypotFields();

        $this->travel(5)->seconds();

        return $this->postJson(route('api.subscribe-to-newsletter'), [...$payload, ...$fields]);
    }

    /**
     * @return array<string, string>
     */
    protected function honeypotFields(): array
    {
        $honeypot = app(Honeypot::class);

        return [
            $honeypot->nameFieldName() => '',
            $honeypot->validFromFieldName() => $honeypot->encryptedValidFrom(),
        ];
    }

    protected function mockMailchimpLists(): MockInterface
    {
        $lists = Mockery::mock(ListsApi::class);

        $client = new ApiClient;
        $client->lists = $lists;

        $this->app->instance(ApiClient::class, $client);

        return $lists;
    }

    /**
     * @return array<string, string>
     */
    protected function validPayload(): array
    {
        return [
            'firstname' => 'Sanne',
            'lastname' => 'de Vries',
            'email' => 'sanne@example.com',
        ];
    }
}
