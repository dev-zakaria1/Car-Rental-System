<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\WebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/stripe/webhook', [WebhookController::class, 'handle']);
