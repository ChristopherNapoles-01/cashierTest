<?php

namespace App\Http\Controllers;

use App\Models\AccountModel;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct(
        private AccountModel $accountModel
    ){}
    public function store(Request $request)
    {
        return response()->json([
            'data' => $this->accountModel->create($request->all()),
        ]);
    }
}
