<?php

use App\Http\Controllers\Api\ContactFormHandleController;
use App\Http\Controllers\Api\DonationFormHandleController;
use App\Http\Controllers\Api\SubscribeToNewsletterController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::post('subscribe-to-newsletter', SubscribeToNewsletterController::class)
    ->name('api.subscribe-to-newsletter')
    ->middleware('throttle:5,1');

Route::post('donate', DonationFormHandleController::class)
    ->name('api.donate')
    ->middleware('throttle:5,1');

Route::post('contact-form', ContactFormHandleController::class)
    ->name('api.contact-form')
    ->middleware([
        'throttle:5,1',
        ProtectAgainstSpam::class,
    ]);
