<?php


namespace App\Http\Controllers;

use App\Http\Services\WebhookService;
use Illuminate\Http\Request;
use Laravel\Cashier\Http\Controllers\WebhookController as ControllersWebhookController;

class WebhookController extends ControllersWebhookController
{

    public function __construct(
        private WebhookService $webhookService
    ){}
    
    //Manual Creation of webhooks
    public function handleWebhook(Request $request)
    {
        try {
            $payload = $request->all();
            // Handle webhook event

            match ($payload['type']) {
                'customer.subscription.created' => $this->webhookService->handleCreateSubscription($payload),
                'customer.subscription.updated' => $this->webhookService->handleUpdateSubscription($payload),
                'payment_intent.payment_failed' => $this->webhookService->handlePaymentIntentFailed($payload),
                default => '',
            };

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            logger()->info(json_encode($e->getMessage()));
        }
    }
}
