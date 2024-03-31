<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TestSubscribeController;
use App\Http\Controllers\WebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('account', [AccountController::class, 'store']);

Route::resource('checkout', PaymentController::class);

Route::resource('subscribe', TestSubscribeController::class);

Route::post('subscribe-with-metered', [TestSubscribeController::class, 'storeWithMetered']);

Route::post('stripe/webhook', [WebhookController::class, 'handleWebhook']);

Route::post('add-usage/{accountId}', [TestSubscribeController::class, 'addUsage']);

Route::post('add-seat/{accountId}', [TestSubscribeController::class, 'addSeat']);

Route::resource('invoice', InvoiceController::class);

Route::get('upcoming-invoice', [InvoiceController::class, 'getUpcomingInvoice']);

Route::post('add-price/{accountId}', [TestSubscribeController::class, 'addPrice']);