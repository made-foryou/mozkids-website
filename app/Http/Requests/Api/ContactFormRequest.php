<?php

declare(strict_types=1);

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @method get()
 */
class ContactFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'phone' => ['nullable', 'string'],
            'subject' => ['nullable', 'string'],
            'message' => ['required', 'string', 'min:10'],
            'privacy' => ['required', 'accepted'],
        ];
    }
}
