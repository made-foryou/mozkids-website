<?php

declare(strict_types=1);

namespace App\Domains\Contact\Mail;

use App\Domains\Contact\Data\ContactFormData;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        protected readonly ContactFormData $data,
    ) { }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->data->subject ?? 'Geen onderwerp' . ' - Contact formulier - Moz Kids Website',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.contact-form-mail',
            with: [
                'data' => $this->data,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
