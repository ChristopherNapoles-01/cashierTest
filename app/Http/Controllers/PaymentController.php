<?php

namespace App\Http\Controllers;

use App\Http\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(
        private PaymentService $paymentService
    ){}
    public function store(Request $request)
    {
        $data = $this->paymentService->checkout($request->all());
        
        return response()->json([
            'data' => $data
        ]);
    }
}
