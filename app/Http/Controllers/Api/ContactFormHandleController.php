<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Domains\Contact\Data\ContactFormData;
use App\Domains\Contact\Mail\ContactFormMail;
use App\Domains\Contact\Spam\ContactFormSpamDetector;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactFormRequest;
use App\Models\WebsiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Made\Cms\Facades\Cms;

class ContactFormHandleController extends Controller
{
    public function __construct(
        protected readonly WebsiteSetting $settings,
        protected readonly ContactFormSpamDetector $spamDetector,
    ) { }

    public function __invoke(ContactFormRequest $request): JsonResponse
    {
        $data = ContactFormData::fromRequest($request);

        // Spam krijgt dezelfde response als een geldig bericht, zodat bots
        // niet merken dat ze worden tegengehouden.
        if ($reason = $this->spamDetector->reason($data)) {
            Log::info('Contactformulier als spam aangemerkt', [
                'reason' => $reason,
                'email' => $data->email,
                'ip' => $request->ip(),
            ]);
        } else {
            Mail::to($this->getEmailAddress())
                ->send(new ContactFormMail($data));
        }

        $successPage = $this->settings->getContactSuccessPage();

        if ($successPage) {
            return response()->json([
                'redirect' => Cms::url($successPage),
            ]);
        }

        return response()->json([], 200);
    }

    protected function getEmailAddress(): string
    {
        return $this->settings->donation_email ?? config('mozkids.donation_email');
    }
}
