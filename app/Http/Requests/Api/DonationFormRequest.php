<?php

declare(strict_types=1);

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class DonationFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'string', 'in:child,common'],
            'amount' => ['required', 'string', 'in:20,40,60,other'],
            'other-amount' => ['required_if:amount,other', 'string'],
            'firstname' => ['required', 'string', 'max:255'],
            'infix' => ['nullable', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'newsletter' => ['nullable'],
            'privacy' => ['required', 'accepted'],
        ];
    }
}