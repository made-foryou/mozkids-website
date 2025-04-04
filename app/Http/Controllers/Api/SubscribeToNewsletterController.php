<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SubscribeToNewsletterRequest;
use Illuminate\Http\JsonResponse;
use MailchimpMarketing\ApiClient;

class SubscribeToNewsletterController extends Controller
{
    public function __construct(protected ApiClient $mailchimp)
    {
    }

    public function __invoke(SubscribeToNewsletterRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $result = $this->mailchimp->lists->getListMember(
                config('services.mailchimp.list_id'), 
                md5(strtolower($validated['email'])),
            );

            if ($result->id) {
                // E-mail already found.
                return response()->json([], 302);
            }
        } catch (\Exception $e) {
            
        }

        $this->mailchimp->lists->addListMember(
            config('services.mailchimp.list_id'),
            [
                'email_address' => $validated['email'],
                'status' => 'pending',
                'merge_fields' => [
                    'FNAME' => $validated['firstname'],
                    'LNAME' => $validated['lastname'],
                ],
                'language' => config('app.locale'),
            ]
        );

        return response()->json([], 200);
    }
}