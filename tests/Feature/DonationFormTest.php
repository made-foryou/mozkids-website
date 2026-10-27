<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Domains\Donation\Mail\DonationRequestConfirmationMail;
use App\Domains\Donation\Mail\DonationRequestMail;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Support\Facades\Mail;
use MailchimpMarketing\Api\ListsApi;
use MailchimpMarketing\ApiClient;
use Mockery;
use Mockery\MockInterface;
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

    #[Test]
    public function it_subscribes_to_the_newsletter_with_infix_and_surname_as_lastname(): void
    {
        Mail::fake();

        $lists = $this->mockMailchimpLists();
        $lists->shouldReceive('setListMember')
            ->once()
            ->withArgs(fn (string $listId, string $hash, array $body): bool => $body['merge_fields']['FNAME'] === 'Sanne'
                && $body['merge_fields']['LNAME'] === 'de Vries');

        $response = $this->postJson(
            route('api.donate'),
            $this->validPayload(['infix' => 'de', 'surname' => 'Vries', 'newsletter' => '1']),
        );

        $response->assertStatus(200);
    }

    #[Test]
    public function it_still_succeeds_when_the_newsletter_subscription_fails(): void
    {
        Mail::fake();

        $lists = $this->mockMailchimpLists();
        $lists->shouldReceive('setListMember')
            ->once()
            ->andThrow(new ConnectException(
                'cURL error 6: Could not resolve host',
                new Request('PUT', 'https://.api.mailchimp.com/3.0/lists'),
            ));

        $response = $this->postJson(
            route('api.donate'),
            $this->validPayload(['newsletter' => '1']),
        );

        $response->assertStatus(200);
        Mail::assertSent(DonationRequestMail::class);
        Mail::assertSent(DonationRequestConfirmationMail::class);
    }

    #[Test]
    public function it_does_not_report_an_email_address_that_mailchimp_rejects(): void
    {
        Mail::fake();
        Exceptions::fake();

        $lists = $this->mockMailchimpLists();
        $lists->shouldReceive('setListMember')
            ->once()
            ->andThrow(new ClientException(
                'Client error: Mailchimp responded with 400',
                new Request('PUT', 'https://us16.api.mailchimp.com/3.0/lists/list-id/members/hash'),
                new Response(400, [], json_encode([
                    'title' => 'Invalid Resource',
                    'status' => 400,
                    'detail' => 'sanne@example.com looks fake or invalid, please enter a real email address.',
                ])),
            ));

        $response = $this->postJson(
            route('api.donate'),
            $this->validPayload(['newsletter' => '1']),
        );

        $response->assertStatus(200);
        Exceptions::assertNothingReported();
    }

    #[Test]
    public function it_renders_the_payment_method_question_with_direct_debit_preselected(): void
    {
        $html = (string) $this->blade('<x-columns.donation-form />');

        self::assertStringContainsString('Betaalwijze', $html);
        self::assertStringContainsString('Hoe wil je de betaling regelen?', $html);
        self::assertStringContainsString('name="payment-method"', $html);
        self::assertStringContainsString('Automatische incasso', $html);
        self::assertStringContainsString('Zelf overmaken', $html);

        self::assertMatchesRegularExpression(
            '/id="payment-direct-debit"[^>]*checked/',
            $html,
            'De automatische incasso hoort voorgeselecteerd te zijn.',
        );

        self::assertDoesNotMatchRegularExpression(
            '/id="payment-transfer"[^>]*checked/',
            $html,
            'Zelf overmaken hoort niet voorgeselecteerd te zijn.',
        );
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
