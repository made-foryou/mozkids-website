<?php

declare(strict_types=1);

namespace App\Domains\Donation\Data;

use App\Domains\Donation\Enums\DonationType;
use App\Domains\Donation\Enums\Frequency;
use App\Http\Requests\Api\DonationFormRequest;
use Illuminate\Http\Request;

readonly class DonationData
{
    public function __construct(
        public DonationType $type,
        public float $amount,
        public Frequency $frequency,
        public string $firstname,
        public ?string $infix,
        public string $surname,
        public string $email,
        public string $phone,
        public ?string $comments,
        public ?string $accountHolder,
        public ?string $address,
        public ?string $zipcode,
        public ?string $city,
        public ?string $iban,
        public bool $authority,
        public bool $newsletter,
        public bool $privacy
    ) {}

    public static function fromRequest(
        DonationFormRequest|Request $request
    ): self {
        $amount = $request->validated("amount");
        if ($amount === "other") {
            $amount = (float) $request->validated("otherAmount");
        } else {
            $amount = match ($amount) {
                "20" => 20.0,
                "40" => 40.0,
                "60" => 60.0,
            };
        }

        return new self(
            type: DonationType::from($request->validated("type")),
            amount: $amount,
            frequency: Frequency::from($request->validated("frequency")),
            firstname: $request->validated("firstname"),
            infix: $request->validated("infix"),
            surname: $request->validated("surname"),
            email: $request->validated("email"),
            phone: $request->validated("phone"),
            comments: $request->validated("comments"),
            accountHolder: $request->validated("accountHolder"),
            address: $request->validated("address"),
            zipcode: $request->validated("zipcode"),
            city: $request->validated("city"),
            iban: $request->validated("iban"),
            authority: $request->has("authority"),
            newsletter: $request->has("newsletter"),
            privacy: $request->has("privacy")
        );
    }
}
