<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Domains\Newsletter\Actions\SubscribeToNewsletterAction;
use App\Domains\Newsletter\Data\SubscribingData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SubscribeToNewsletterRequest;
use Illuminate\Http\JsonResponse;

class SubscribeToNewsletterController extends Controller
{
    public function __invoke(SubscribeToNewsletterRequest $request): JsonResponse
    {
        SubscribeToNewsletterAction::run(
            SubscribingData::fromRequest($request)
        );

        return response()->json([], 200);
    }
}