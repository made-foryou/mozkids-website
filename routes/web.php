<?php

use App\Http\Controllers\MollieWebhookController;
use Illuminate\Support\Facades\Route;
use Made\Cms\Facades\Cms;

Cms::routes();

Route::get('mollie-webhook', MollieWebhookController::class)
    ->name('mollie-webhook');
