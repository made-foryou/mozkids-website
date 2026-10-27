<?php

namespace App\Domains\Newsletter\Actions;

use App\Domains\Newsletter\Data\SubscribingData;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;
use MailchimpMarketing\ApiClient;

class SubscribeToNewsletterAction
{
    use AsAction;

    public function __construct(
        protected ApiClient $client,
    ) { }

    /**
     * @throws ValidationException When Mailchimp refuses the e-mail address itself.
     */
    public function handle(SubscribingData $data): void
    {
        try {
            $this->client->lists->setListMember($data->listID, $data->subscriberHash, [
                'email_address' => $data->email,
                'status_if_new' => $data->newStatus,
                'merge_fields' => [
                    'FNAME' => $data->firstname,
                    'LNAME' => $data->lastname,
                ],
                'language' => config('app.locale'),
            ]);
        } catch (ClientException $exception) {
            $error = json_decode((string) $exception->getResponse()->getBody(), true);
            $error = is_array($error) ? $error : [];

            if (! $this->rejectsTheEmailAddress($exception, $error)) {
                throw $exception;
            }

            // Mailchimp weigert adressen die er nep uitzien, permanent verwijderd zijn of
            // eerder zijn afgemeld. Dat ligt aan de invoer van de bezoeker, niet aan een
            // storing, dus geen exception maar wel de volledige melding in de logs.
            Log::warning('Nieuwsbriefaanmelding door Mailchimp geweigerd', [
                'title' => $error['title'] ?? null,
                'detail' => $error['detail'] ?? null,
            ]);

            throw ValidationException::withMessages([
                'email' => 'Dit e-mailadres wordt niet geaccepteerd. Controleer of het klopt, of gebruik een ander adres.',
            ]);
        }
    }

    /**
     * A 400 is about the subscriber, unless Mailchimp points at a field other than the
     * e-mail address. Every other client error (wrong API key, unknown list, invalid
     * merge field) is a mistake on our side and has to keep surfacing as an exception.
     *
     * @param  array<string, mixed>  $error
     */
    protected function rejectsTheEmailAddress(ClientException $exception, array $error): bool
    {
        if ($exception->getResponse()->getStatusCode() !== 400) {
            return false;
        }

        return collect($error['errors'] ?? [])
            ->every(fn (array $field): bool => ($field['field'] ?? null) === 'email_address');
    }
}
