<?php
 
namespace App\Listeners;

use App\Models\AccountModel;
use Laravel\Cashier\Events\WebhookReceived;
 
class StripeEventListener
{

    /**
     * Handle received Stripe webhooks.
     */
    public function __construct(
        private AccountModel $accountModel,
    ){}

    public function handle(
        WebhookReceived $event,
    ): void
    {
        // if ($event->payload['type'] === 'invoice.payment_succeeded') {
        //     logger()->info($event->payload['type']);
        // }

        if ($event->payload['type'] === 'payment_intent.succeeded') {

            $data = $event->payload['data']['object'];
            $paymentMethod = $data['payment_method'];
            logger()->info($paymentMethod);
            $account = $this->accountModel->where(['stripe_id' => $data['customer']])->first();
            // logger()->info($account);
            $account->updateDefaultPaymentMethod($paymentMethod);
            // $account->updateDefaultPaymentMethodFromStripe();

            logger()->info("payment_method set to default");
        }
        
    }
}