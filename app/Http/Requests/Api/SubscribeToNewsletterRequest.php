<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @method mixed get(string $key, mixed $default = null)
 */
class SubscribeToNewsletterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ];
    }

    /**
     * The newsletter form shows these messages to the visitor, so they need to be Dutch.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'firstname.required' => 'Vul je voornaam in.',
            'lastname.required' => 'Vul je achternaam in.',
            'email.required' => 'Vul je e-mailadres in.',
            'email.email' => 'Dit is geen geldig e-mailadres.',
            'string' => 'Dit is geen geldige tekst.',
            'max' => 'Dit veld mag maximaal :max tekens bevatten.',
        ];
    }
}
