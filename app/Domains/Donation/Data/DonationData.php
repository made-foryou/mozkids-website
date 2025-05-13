<?php

declare(strict_types=1);

namespace App\Domains\Donation\Data;

use App\Http\Requests\Api\DonationFormRequest;

readonly class DonationData
{
    public function __construct(
        public string $type,
        public float $amount,
        public string $firstname,
        public ?string $infix,
        public string $surname,
        public string $email,
        public string $phone,
        public bool $newsletter,
        public bool $privacy,
    ) {
        $this->type = match ($this->type) {
            'child' => 'Sponsoring voor een kind',
            'common' => 'Algemene sponsoring',
        };
     }

    public static function fromRequest(DonationFormRequest $request): self
    {
        $amount = $request->get('amount');
        if ($amount === 'other') {
            $amount = (float) $request->get('other-amount');
        } else {
            $amount = match ($amount) {
                '20' => 20.0,
                '40' => 40.0,
                '60' => 60.0,
            };
        }

        return new self(
            type: $request->get('type'),
            amount: $amount,
            firstname: $request->get('firstname'),
            infix: $request->get('infix'),
            surname: $request->get('surname'),
            email: $request->get('email'),
            phone: $request->get('phone'),
            newsletter: $request->has('newsletter'),
            privacy: $request->has('privacy'),
        );
    }
}