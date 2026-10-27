<?php

declare(strict_types=1);

namespace Tests\Feature;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Support\Facades\Log;
use Illuminate\Testing\TestResponse;
use MailchimpMarketing\Api\ListsApi;
use MailchimpMarketing\ApiClient;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\DataProvider;
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
    public function it_returns_a_validation_error_when_mailchimp_rejects_the_email_address(): void
    {
        Exceptions::fake();
        Log::spy();

        $this->mockMailchimpLists()
            ->shouldReceive('setListMember')
            ->once()
            ->andThrow($this->mailchimpError(400, [
                'title' => 'Invalid Resource',
                'status' => 400,
                'detail' => 'sanne@example.com looks fake or invalid, please enter a real email address.',
            ]));

        $response = $this->postNewsletterForm($this->validPayload());

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email' => 'Dit e-mailadres wordt niet geaccepteerd.']);
        Exceptions::assertNothingReported();
        Log::shouldHaveReceived('warning')
            ->once()
            ->with('Nieuwsbriefaanmelding door Mailchimp geweigerd', Mockery::on(
                fn (array $context): bool => str_contains($context['detail'], 'looks fake or invalid'),
            ));
    }

    /**
     * @param  array<string, mixed>  $body
     */
    #[Test]
    #[DataProvider('mailchimpErrorsThatAreNotAboutTheEmailAddress')]
    public function it_keeps_reporting_mailchimp_errors_that_are_not_about_the_email_address(int $status, array $body): void
    {
        Exceptions::fake();

        $this->mockMailchimpLists()
            ->shouldReceive('setListMember')
            ->once()
            ->andThrow($this->mailchimpError($status, $body));

        $response = $this->postNewsletterForm($this->validPayload());

        $response->assertStatus(500);
        Exceptions::assertReported(ClientException::class);
    }

    public static function mailchimpErrorsThatAreNotAboutTheEmailAddress(): array
    {
        return [
            'invalid api key' => [401, [
                'title' => 'API Key Invalid',
                'status' => 401,
                'detail' => "Your API key may be invalid, or you've attempted to access the wrong datacenter.",
            ]],
            'invalid merge field' => [400, [
                'title' => 'Invalid Resource',
                'status' => 400,
                'detail' => "The resource submitted could not be validated. For field-specific details, see the 'errors' array.",
                'errors' => [
                    ['field' => 'merge_fields.FNAME', 'message' => 'Data did not match any of the schemas described in the documentation.'],
                ],
            ]],
        ];
    }

    #[Test]
    public function it_returns_dutch_validation_messages(): void
    {
        $this->mockMailchimpLists()
            ->shouldNotReceive('setListMember');

        $response = $this->postNewsletterForm([...$this->validPayload(), 'email' => 'geen-adres']);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email' => 'Dit is geen geldig e-mailadres.']);
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
     * @param  array<string, mixed>  $body
     */
    protected function mailchimpError(int $status, array $body): ClientException
    {
        return new ClientException(
            "Client error: Mailchimp responded with {$status}",
            new Request('PUT', 'https://us16.api.mailchimp.com/3.0/lists/list-id/members/hash'),
            new Response($status, ['Content-Type' => 'application/problem+json'], json_encode($body)),
        );
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
