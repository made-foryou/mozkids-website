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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Made\Cms\Facades\Cms;
use Mollie\Api\Http\Requests\CreatePaymentRequest;
use Mollie\Api\MollieApiClient;
use Mollie\Api\Resources\Payment;
use PDO;

class DonationFormHandleController extends Controller
{
    public function __construct(
        protected readonly WebsiteSetting $settings,
        protected readonly MollieApiClient $mollieApiClient
    ) {}

    public function __invoke(
        DonationFormRequest $request
    ): JsonResponse|RedirectResponse {
        $data = DonationData::fromRequest($request);

        if ($data->newsletter) {
            SubscribeToNewsletterAction::run(
                new SubscribingData(
                    $data->email,
                    $data->firstname,
                    !empty($data->infix)
                        ? $data->infix . " "
                        : "" . $data->surname
                )
            );
        }

        if ($data->frequency->manually()) {
            // Send information to Moz Kids.
            Mail::to($this->getEmailAddress())->send(
                new DonationRequestMail($data)
            );

            // // Send confirmation to user.
            Mail::to($data->email)->send(
                new DonationRequestConfirmationMail($data)
            );

            // @todo conversie plaatsen - voor het bijhouden van de gebruiker zijn sessie.
            // https://app.todoist.com/app/task/acties-van-bezoekers-bijhouden-6Xxc9MvcRj4g5Fj4

            $successPage = $this->settings->getDonationSuccessPage();

            if ($successPage) {
                return response()->json([
                    "redirect" => Cms::url($successPage),
                ]);
            }

            return response()->json([], 200);
        } else {

            // @todo conversie plaatsen - voor het bijhouden van de gebruiker zijn sessie.
            // https://app.todoist.com/app/task/acties-van-bezoekers-bijhouden-6Xxc9MvcRj4g5Fj4

            /** @var Payment $payment */
            $payment = $this->mollieApiClient->send($data->toPaymentRequest());

            return redirect()->json([
                'redirect' => $payment->getCheckoutUrl()
            ]);
        }
    }

    protected function getEmailAddress(): string
    {
        return $this->settings->donation_email ??
            config("mozkids.donation_email");
    }
}
