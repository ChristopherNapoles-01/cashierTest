<?php

namespace App\Http\Services;

use App\Models\AccountModel;

class InvoiceService 
{
    public function __construct(
        private AccountModel $accountModel   
    ){}

    public function listInvoices(array $request) : array
    {
        $accountId = $request['account_id'];
        $account = $this->accountModel->find($accountId);
        // return $account->invoices()->toArray();
        return $account->invoicesIncludingPending()->toArray();
    }

    public function upcomingInvoices(array $request) : array
    {
        $accountId = $request['account_id'];
        $account = $this->accountModel->find($accountId);
        // return $account->invoices()->toArray();
        return $account->subscription($request['name'])->upcomingInvoice()->toArray();
    }

    public function findInvoice() : array
    {
        return [];
    }
}