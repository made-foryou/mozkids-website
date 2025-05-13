<?php

declare(strict_types=1);

namespace App\Domains\Donation\Data;

use App\Http\Requests\Api\DonationFormRequest;

readonly class DonationData
{
    public string $type;

    public string $frequency;

    public function __construct(
        string $type,
        public float $amount,
        string $frequency,
        public string $firstname,
        public ?string $infix,
        public string $surname,
        public string $email,
        public string $phone,
        public bool $newsletter,
        public bool $privacy,
    ) {
        $this->type = match ($type) {
            'child' => 'Sponsoring voor een kind',
            'common' => 'Algemene sponsoring',
        };

        $this->frequency = match ($frequency) {
            'single' => 'Eenmalig',
            'monthly' => 'Maandelijks',
            'yearly' => 'Jaarlijks',
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
            frequency: $request->get('frequency'),
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