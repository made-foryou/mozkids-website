<?php

namespace App\Http\Controllers;

use App\Models\WebsiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Made\Cms\App\Http\Controllers\CmsRoutingContract;
use Made\Cms\Page\Models\Page;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller implements CmsRoutingContract
{
    public function __construct(
        protected readonly WebsiteSetting $websiteSetting,
    ) { }

    public function __invoke(Request $request, Page|Model $model): View|Response
    {
        return view('pages.page', [
            'model' => $model,
            'donation_button' => $this->websiteSetting->donation_button,
        ]);
    }
}
