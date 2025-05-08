<?php

namespace App\Domains\Newsletter\Data;

use App\Http\Requests\Api\SubscribeToNewsletterRequest;

final readonly class SubscribingData
{
    const STATUS_PENDING = 'pending';

    public string $subscriberHash;

    public string $listID;

    public function __construct(
        public string $email,
        public string $firstname,
        public string $lastname,
        public string $newStatus = self::STATUS_PENDING,
        ?string $listID = null,
    ) {
        $this->listID = $listID === null ? config('services.mailchimp.list_id') : $listID;
        $this->subscriberHash = md5(strtolower($this->email));
    }

    public static function fromRequest(SubscribeToNewsletterRequest $request): self
    {
        return new self(
            $request->get('email'),
            $request->get('firstname'),
            $request->get('lastname'),
        );
    }
}