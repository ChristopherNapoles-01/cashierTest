<?php

namespace App\Http\Services;

use App\Models\AccountModel;
use Laravel\Cashier\Cashier;

class PaymentService
{
    public function __construct(
        private AccountModel $accountModel
    ){}
    public function checkout(array $request)
    {
        $accountId = $request['account_id'];

        $account = $this->accountModel->find($accountId);

        $priceId = $request['price_id'];
        $quantity = $request['quantity'];

        // $transaction = $account->checkout([ $priceId => $quantity ], [
        //     'mode' => 'subscription',
        //     'payment_method_types' => ['card'],
        // ]);

        $transaction = $account->newSubscription('default', $priceId)
        ->withMetadata(['account_id' => $accountId])
        ->checkout();

        return $transaction->url;
    }
}