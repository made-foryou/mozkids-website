<?php

declare(strict_types=1);

namespace App\Http\Requests\Api;

use App\Domains\Donation\Enums\DonationType;
use App\Domains\Donation\Enums\Frequency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Nembie\IbanRule\ValidIban;

class DonationFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array>
     */
    public function rules(): array
    {
        return [
            "type" => [
                "required",
                "string",
                "in:" . implode(",", DonationType::values()),
            ],
            "amount" => ["required", "string", "in:20,40,60,other"],
            "otherAmount" => ["required_if:amount,other", "string"],
            "frequency" => [
                "required",
                "string",
                "in:" . implode(",", Frequency::values()),
            ],
            "firstname" => ["required", "string", "max:255"],
            "infix" => ["nullable", "string", "max:255"],
            "surname" => ["required", "string", "max:255"],
            "email" => ["required", "email", "max:255"],
            "phone" => ["required", "string", "max:255"],
            "comments" => ["nullable", "string"],
            "accountHolder" => [
                Rule::requiredIf(
                    fn(): bool => Frequency::tryFrom(
                        request()->get("frequency")
                    )?->manually() ?? false
                ),
                "nullable",
            ],
            "address" => [
                Rule::requiredIf(
                    fn(): bool => Frequency::tryFrom(
                        request()->get("frequency")
                    )?->manually() ?? false
                ),
                "nullable",
            ],
            "zipcode" => [
                Rule::requiredIf(
                    fn(): bool => Frequency::tryFrom(
                        request()->get("frequency")
                    )?->manually() ?? false
                ),
                "nullable",
            ],
            "city" => [
                Rule::requiredIf(
                    fn(): bool => Frequency::tryFrom(
                        request()->get("frequency")
                    )?->manually() ?? false
                ),
                "nullable",
            ],
            "iban" => [
                Rule::requiredIf(
                    fn(): bool => Frequency::tryFrom(
                        request()->get("frequency")
                    )?->manually() ?? false
                ),
                "nullable",
                new ValidIban(),
            ],
            "authority" => [
                Rule::requiredIf(
                    fn(): bool => Frequency::tryFrom(
                        request()->get("frequency")
                    )?->manually() ?? false
                ),
                "nullable",
            ],
            "newsletter" => ["nullable"],
            "privacy" => ["required", "accepted"],
        ];
    }
}
