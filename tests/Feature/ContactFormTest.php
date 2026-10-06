<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Domains\Contact\Mail\ContactFormMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Test;
use Spatie\Honeypot\Honeypot;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_sends_a_valid_message(): void
    {
        Mail::fake();

        $response = $this->postContactForm($this->validPayload());

        $response->assertStatus(200);
        Mail::assertSent(ContactFormMail::class);
    }

    #[Test]
    public function it_silently_drops_requests_without_honeypot_fields(): void
    {
        Mail::fake();

        $this->post(route('api.contact-form'), $this->validPayload());

        Mail::assertNothingSent();
    }

    #[Test]
    public function it_silently_drops_requests_that_are_submitted_too_fast(): void
    {
        Mail::fake();

        $this->post(route('api.contact-form'), [
            ...$this->validPayload(),
            ...$this->honeypotFields(),
        ]);

        Mail::assertNothingSent();
    }

    #[Test]
    public function it_silently_drops_messages_filled_with_random_strings(): void
    {
        Mail::fake();

        $response = $this->postContactForm([
            'name' => 'PPKTOlBtWWAZoZjpYz',
            'email' => 'a.y.o.s.a.r.o.m.33@gmail.com',
            'phone' => '5757743797',
            'subject' => 'tjLzlUxBVIDSMIwuUNsjdI',
            'message' => 'mfuedqrjzKBYRYGyBtQ',
            'privacy' => 'on',
        ]);

        $response->assertStatus(200);
        Mail::assertNothingSent();
    }

    #[Test]
    public function it_silently_drops_messages_from_dotted_email_addresses(): void
    {
        Mail::fake();

        $response = $this->postContactForm($this->validPayload([
            'email' => 'vo.yoj.a.y.ak.e555@gmail.com',
        ]));

        $response->assertStatus(200);
        Mail::assertNothingSent();
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    protected function postContactForm(array $payload): \Illuminate\Testing\TestResponse
    {
        $fields = $this->honeypotFields();

        $this->travel(5)->seconds();

        return $this->postJson(route('api.contact-form'), [...$payload, ...$fields]);
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

    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    protected function validPayload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Sanne de Vries',
            'email' => 'sanne@example.com',
            'phone' => '0612345678',
            'subject' => 'Vraag over de Polderrun',
            'message' => 'Hallo, ik wil graag meer informatie over de Polderrun.',
            'privacy' => 'on',
        ], $overrides);
    }
}
