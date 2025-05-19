<?php

declare(strict_types=1);

namespace App\Domains\Donation\Data;

use App\Http\Requests\Api\DonationFormRequest;
use Illuminate\Http\Request;

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
        public ?string $comments,
        public string $accountHolder,
        public string $iban,
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

    public static function fromRequest(DonationFormRequest|Request $request): self
    {
        $amount = $request->validated('amount');
        if ($amount === 'other') {
            $amount = (float) $request->validated('other-amount');
        } else {
            $amount = match ($amount) {
                '20' => 20.0,
                '40' => 40.0,
                '60' => 60.0,
            };
        }

        return new self(
            type: $request->validated('type'),
            amount: $amount,
            frequency: $request->validated('frequency'),
            firstname: $request->validated('firstname'),
            infix: $request->validated('infix'),
            surname: $request->validated('surname'),
            email: $request->validated('email'),
            phone: $request->validated('phone'),
            comments: $request->validated('comments'),
            accountHolder: $request->validated('account-holder'),
            iban: $request->validated('iban'),
            newsletter: $request->has('newsletter'),
            privacy: $request->has('privacy'),
        );
    }
}
