<?php

declare(strict_types=1);

namespace App\Domains\Contact\Data;

use App\Http\Requests\Api\ContactFormRequest;
use Illuminate\Http\Request;

readonly class ContactFormData
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $phone,
        public ?string $subject,
        public string $message,
        public bool $privacy,
    ) { }

    public static function fromRequest(ContactFormRequest|Request $request): self
    {
        return new self(
            name: $request->validated('name'),
            email: $request->validated('email'),
            phone: $request->validated('phone'),
            subject: $request->validated('subject'),
            message: $request->validated('message'),
            privacy: $request->has('privacy'),
        );
    }
}

