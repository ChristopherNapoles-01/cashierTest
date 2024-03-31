<?php

namespace App\Http\Services;

use App\Models\AccountModel;

class WebhookService
{
    public function __construct(
        private AccountModel $accountModel
    ){}

    public function handleCreateSubscription(array $payload)
    {
        // logger()->info(json_encode($payload));
        // logger()->info(current($payload['data'])['id']);
        // logger()->info(current($payload['data'])['customer']);
        // logger()->info(current($payload['data'])['metadata']);
        // $data = current($payload['data']);
        // $items = $data['items'];

        // $account = $this->accountModel->where(['stripe_id' => $data['customer']])->first();
        // $account->newSubscription('default')->create($data['default_payment_method']);
    }

    public function handleUpdateSubscription(array $payload)
    {
        // $data = current($payload['data']);
        // $items = $data['items'];

        // $account = $this->accountModel->where(['stripe_id' => $data['customer']])->first();
        // $account->subscription()->where(['subscription_id' => $data['id']])->update(['status' => $data['status']]);
    }
}
