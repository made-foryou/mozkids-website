<?php

namespace App\Http\Controllers;

use App\Models\WebsiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Made\Cms\App\Http\Controllers\CmsRoutingContract;
use Made\Cms\News\Facades\MadeNews;
use Made\Cms\News\Models\Post;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller implements CmsRoutingContract
{
    public function __construct(
        protected readonly WebsiteSetting $websiteSetting
    ) {}

    public function __invoke(Request $request, Post|Model $model): View|Response
    {
        return view("pages.news.detail", [
            "model" => $model,
            "donation_button" => $this->websiteSetting->donation_button,
            "newsPage" => MadeNews::overviewPage(),
            "next" => MadeNews::nextPosts($model),
        ]);
    }
}
