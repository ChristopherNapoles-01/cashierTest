<?php

namespace App\Http\Services;

use App\Models\AccountModel;
use Laravel\Cashier\PaymentMethod;
use Laravel\Cashier\SubscriptionItem;

class SubscriptionService
{
    public function __construct(
        private AccountModel $accountModel,
    ){}
    public function newSubscription(array $request)
    {
        $accountId = $request['account_id'];
        $priceId = $request['price_id'];
        $subscriptionName = $request['subscription_name'];
        $account = $this->accountModel->find($accountId);

        $accountInfo = current($account->paymentMethods()->all()) ?? [];
        $payment = '';
        if ($accountInfo) {
            $payment = $accountInfo->asStripePaymentMethod()->values()[0];
        }

        return $account->newSubscription(
            $subscriptionName, $priceId
        )
        ->create($payment);
    }

    public function newSubscriptionWithMeteredPrice(array $request)
    {
        $accountId = $request['account_id'];
        $priceId = $request['price_id'];
        $meteredPriceId = $request['metered_price_id'];
        $subscriptionName = $request['name'];

        $account = $this->accountModel->find($accountId);

        $accountInfo = current($account->paymentMethods()->all()) ?? [];
        $payment = '';
        if ($accountInfo) {
            $payment = $accountInfo->asStripePaymentMethod()->values()[0];
        }

        return $account->newSubscription(
            $subscriptionName, $priceId
        )
        ->meteredPrice($meteredPriceId)
        ->create($payment);
    }

    public function addUsage(string $accountId, array $request)
    {
        $account = $this->accountModel->findOrFail($accountId);

        return $account->subscription($request['subscription_name'])->noProrate()->reportUsageFor($request['usage_price_id']);
    }

    public function addSeats(string $accountId, array $request)
    {
        $noProrate = $request['no_prorate'] ?? false;

        $account = $this->accountModel->findOrFail($accountId);
        $subscription = $account->subscription($request['name']);

        if ($noProrate) {
            $subscription = $subscription->noProrate();
        }

        return $subscription->incrementQuantity(price:$request['price_id']);
    }


    public function checkAccountSubscription(string $accountId, array $request)
    {
        $account = $this->accountModel->findOrFail($accountId);
        
        // dd($account);
        // return $account->defaultPaymentMethod();
        // return $account->subscription('basic5');
        // return $account->subscribedToPrice($request['price_id']);
        // dd($account->subscribedToProduct($request['product_id']));
        // return $account->updateDefaultPaymentMethod('pm_1P05GBDJjs9tuVo1FQhCfNB1');
        return $account->addPaymentMethod('pm_1P05GBDJjs9tuVo1FQhCfNB1');

    }

    public function cancelSubscription(string $accountId, array $request)
    {
        $subscriptionName = $request['name'];
        $account = $this->accountModel->findOrFail($accountId);

        // $account->subscription($subscriptionName)->cancelNow();

        return $account->subscription($subscriptionName)->noProrate()->cancelNowAndInvoice();
    }

    //add usages
    public function addPrice(string $accountId, array $request)
    {
        $account = $this->accountModel->findOrFail($accountId);

        return $account->subscription($request['name'])->addMeteredPrice($request['usage_price_id']);

        // return $account->subscription($request['name'])->addPrice($request['usage_price_id']);
    }



}