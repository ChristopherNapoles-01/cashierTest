<?php
 
namespace App\Listeners;

use App\Models\AccountModel;
use App\Models\SubscriptionsModel;
use Laravel\Cashier\Events\WebhookHandled;
use Laravel\Cashier\Events\WebhookReceived;
 
class StripeHandleListener
{
    /**
     * Handle received Stripe webhooks.
     */
    public function __construct(
        private AccountModel $accountModel,
        private SubscriptionsModel $subscriptionsModel
    ){}
    
    public function handle(WebhookHandled $event): void
    {
        if ($event->payload['type'] === 'invoice.payment_succeeded') {
            // $data = $event->payload['data']['object'];
        }

        if ($event->payload['type'] === 'customer.subscription.created') {
      
            $data = $event->payload['data']['object'];
            $status = $data['status'];

            $subscription = $this->subscriptionsModel->firstWhere(['stripe_id' => $data['id']]);
            $subscription->update(['subscriptions_status' => $status]);
        }

        if ($event->payload['type'] === 'customer.subscription.updated') {
            $data = $event->payload['data']['object'];
            $status = $data['status'];

            $subscription = $this->subscriptionsModel->firstWhere(['stripe_id' => $data['id']]);
            $subscription->update(['subscriptions_status' => $status]);
        }

        if ($event->payload['type'] === 'customer.subscription.deleted') {
            logger()->info("Deleted");
        }

        if ($event->payload['type'] === 'payment_intent.succeeded') {
 
            // $data = $event->payload['data']['object'];
            // $paymentMethod = $data['payment_method'];

            // $account = $this->accountModel->where(['stripe_id' => $data['customer']]);
            // logger()->info($paymentMethod);
            // $account->updateDefaultPaymentMethod($paymentMethod);
            // $account->updateDefaultPaymentMethodFromStripe();

            // logger()->info("payment_method set to default");
        }
        
    }
}