<?php
 
namespace App\Listeners;
 
use Laravel\Cashier\Events\WebhookReceived;
 
class StripeEventListener
{
    /**
     * Handle received Stripe webhooks.
     */
    public function handle(WebhookReceived $event): void
    {
        logger()->info("HelloEvent");
        if ($event->payload['type'] === 'invoice.payment_succeeded') {
            logger()->info($event->payload['type']);
        }
    }
}