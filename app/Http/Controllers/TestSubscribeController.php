<?php

namespace App\Http\Controllers;

use App\Http\Services\SubscriptionService;
use Illuminate\Http\Request;

class TestSubscribeController extends Controller
{

    public function __construct(
        private SubscriptionService $subscriptionService
    ){}
    public function store(Request $request)
    {
        $data = $this->subscriptionService->newSubscription($request->all());

        return response()->json([
            'data' => $data
        ]);
    }

    public function storeWithMetered(Request $request)
    {
        $data = $this->subscriptionService->newSubscriptionWithMeteredPrice($request->all());
        return response()->json([
            'data' => $data
        ]);
    }

    public function show(string $accountId, Request $request)
    {
        $data = $this->subscriptionService->checkAccountSubscription($accountId, $request->all());
        return response()->json([
            'data' => $data
        ]);
    }

    public function addUsage(string $accountId, Request $request)
    {
        $data = $this->subscriptionService->addUsage($accountId, $request->all());

        return [
            'data' => $data
        ];
    }

    public function addSeat(string $accountId, Request $request)
    {
        $data = $this->subscriptionService->addSeats($accountId, $request->all());

        return [
            'data' => $data
        ];
    }

    public function addPrice(string $accountId, Request $request)
    {
        $data = $this->subscriptionService->addPrice($accountId, $request->all());

        return response()->json([
            'data' => $data
        ]);
    }

    public function destroy(string $accountId, Request $request)
    {
        $data = $this->subscriptionService->cancelSubscription($accountId, $request->all());

        return response()->json([
            'data' => $data
        ]);
    }
}
