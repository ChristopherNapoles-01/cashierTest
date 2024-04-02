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
        logger()->info(json_encode(['created' => $payload]));
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
        logger()->info(json_encode(['updated' => $payload]));
        // $data = current($payload['data']);
        // $items = $data['items'];

        // $account = $this->accountModel->where(['stripe_id' => $data['customer']])->first();
        // $account->subscription()->where(['subscription_id' => $data['id']])->update(['status' => $data['status']]);
    }

    public function handlePaymentIntentFailed(array $payload)
    {
        logger()->info(json_encode(['data' => $payload]));
    }
}
