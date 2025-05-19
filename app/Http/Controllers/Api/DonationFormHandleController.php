<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Domains\Donation\Data\DonationData;
use App\Domains\Donation\Mail\DonationRequestConfirmationMail;
use App\Domains\Donation\Mail\DonationRequestMail;
use App\Domains\Newsletter\Actions\SubscribeToNewsletterAction;
use App\Domains\Newsletter\Data\SubscribingData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DonationFormRequest;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Mail;
use Made\Cms\Facades\Cms;

class DonationFormHandleController extends Controller
{
    public function __construct(
        protected readonly WebsiteSetting $settings,
    ) { }

    public function __invoke(DonationFormRequest $request)
    {
        $data = DonationData::fromRequest($request);

        // Send information to Moz Kids.
        Mail::to($this->getEmailAddress())->send(
            new DonationRequestMail($data)
        );

        // // Send confirmation to user.
        Mail::to($data->email)->send(
            new DonationRequestConfirmationMail($data)
        );

        if ($data->newsletter) {
            SubscribeToNewsletterAction::run(
                new SubscribingData(
                    $data->email,
                    $data->firstname,
                    !empty($data->infix) ? $data->infix . ' ' : '' . $data->surname,
                ),
            );
        }

        // @todo conversie plaatsen - voor het bijhouden van de gebruiker zijn sessie.
        // https://app.todoist.com/app/task/acties-van-bezoekers-bijhouden-6Xxc9MvcRj4g5Fj4

        $successPage = $this->settings->getDonationSuccessPage();

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
