<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Domains\Contact\Data\ContactFormData;
use App\Domains\Contact\Mail\ContactFormMail;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ContactFormRequest;
use App\Models\WebsiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Made\Cms\Facades\Cms;

class ContactFormHandleController extends Controller
{
    public function __construct(
        protected readonly WebsiteSetting $settings,
    ) { }

    public function __invoke(ContactFormRequest $request): JsonResponse
    {
        Mail::to($this->getEmailAddress())->send(
            new ContactFormMail(ContactFormData::fromRequest($request))
        );  

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
