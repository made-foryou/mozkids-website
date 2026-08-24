<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Domains\Donation\Mail\DonationRequestConfirmationMail;
use App\Domains\Donation\Mail\DonationRequestMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DonationFormTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_requires_a_payment_method(): void
    {
        Mail::fake();

        $response = $this->postJson(
            route('api.donate'),
            $this->validPayload(['payment-method' => null]),
        );

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('payment-method');
    }

    #[Test]
    public function it_rejects_an_unknown_payment_method(): void
    {
        Mail::fake();

        $response = $this->postJson(
            route('api.donate'),
            $this->validPayload(['payment-method' => 'cash']),
        );

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('payment-method');
    }

    #[Test]
    public function it_accepts_both_known_payment_methods(): void
    {
        Mail::fake();

        foreach (['direct-debit', 'transfer'] as $method) {
            $response = $this->postJson(
                route('api.donate'),
                $this->validPayload(['payment-method' => $method]),
            );

            $response->assertStatus(200);
        }
    }

    #[Test]
    public function it_mentions_the_payment_method_in_both_mails(): void
    {
        Mail::fake();

        $response = $this->postJson(
            route('api.donate'),
            $this->validPayload(['payment-method' => 'transfer']),
        );

        $response->assertStatus(200);

        Mail::assertSent(DonationRequestMail::class, function (DonationRequestMail $mail): bool {
            $mail->assertSeeInHtml('Betaalwijze');
            $mail->assertSeeInHtml('Zelf overmaken');

            return true;
        });

        Mail::assertSent(DonationRequestConfirmationMail::class, function (DonationRequestConfirmationMail $mail): bool {
            $mail->assertSeeInHtml('Betaalwijze');
            $mail->assertSeeInHtml('Zelf overmaken');

            return true;
        });
    }

    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    protected function validPayload(array $overrides = []): array
    {
        return array_merge([
            'type' => 'child',
            'amount' => '20',
            'frequency' => 'monthly',
            'payment-method' => 'direct-debit',
            'firstname' => 'Sanne',
            'surname' => 'de Vries',
            'email' => 'sanne@example.com',
            'phone' => '0612345678',
            'account-holder' => 'S. de Vries',
            'iban' => 'NL91ABNA0417164300',
            'privacy' => '1',
        ], $overrides);
    }
}
