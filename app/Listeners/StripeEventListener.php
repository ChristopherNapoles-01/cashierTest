<?php
 
namespace App\Listeners;

use Laravel\Cashier\Events\WebhookHandled;
use Laravel\Cashier\Events\WebhookReceived;
 
class StripeEventListener
{
    /**
     * Handle received Stripe webhooks.
     */
    public function handle(WebhookReceived $event)
    {
        logger()->info(json_encode(['key' => $event->payload]));
        if ($event->payload['type'] === 'invoice.payment_succeeded') {
            logger()->info($event->payload['type']);
        }
        if ($event->payload['type'] === 'customer.subscription.updated') {
            logger()->info($event->payload['type']);
        }
        if ($event->payload['type'] === 'customer.subscription.created') {
            logger()->info($event->payload['type']);
        }
        
        return response()->json(['message' => 'webhook handled']);
    }
}