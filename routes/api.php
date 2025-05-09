<?php

use App\Http\Controllers\Api\SubscribeToNewsletterController;
use Illuminate\Support\Facades\Route;

Route::post('subscribe-to-newsletter', SubscribeToNewsletterController::class)
    ->name('api.subscribe-to-newsletter')
    ->middleware('throttle:5,1');