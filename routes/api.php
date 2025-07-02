<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\StripeWebhookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/webhook-debug', function (Request $request) {
    Log::info('📬 API WEBHOOK-DEBUG HIT', [
        'uri'     => $request->getRequestUri(),
        'payload' => $request->all(),
        'headers' => $request->headers->all(),
    ]);
    return response()->json(['status'=>'ok']);
});


// routes/api.php
Route::post('/stripe/webhook', [\App\Http\Controllers\StripeWebhookController::class, 'handle']);
