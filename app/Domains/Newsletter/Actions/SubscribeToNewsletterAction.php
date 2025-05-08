<?php

namespace App\Domains\Newsletter\Actions;

use App\Domains\Newsletter\Data\SubscribingData;
use Lorisleiva\Actions\Concerns\AsAction;
use MailchimpMarketing\ApiClient;

class SubscribeToNewsletterAction
{
    use AsAction;

    public function __construct(
        protected ApiClient $client,
    ) { }

    public function handle(SubscribingData $data): void
    {
        $this->client->lists->setListMember($data->listID, $data->subscriberHash, [
            'email_address' => $data->email,
            'status_if_new' => $data->newStatus,
            'merge_fields' => [
                'FNAME' => $data->firstname,
                'LNAME' => $data->lastname,
            ],
            'language' => config('app.locale'),
        ]);

        return;
    }
}