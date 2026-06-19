<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Shipping Rates
Route::get('/shipping-rates', [\App\Http\Controllers\Api\ShippingController::class, 'getRates']);

// Midtrans Webhook
Route::post('/midtrans/webhook', [\App\Http\Controllers\Webhook\MidtransController::class, 'handleNotification']);

// Search Autocomplete
Route::get('/search/autocomplete', [\App\Http\Controllers\Api\SearchController::class, 'autocomplete']);
