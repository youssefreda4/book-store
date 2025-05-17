<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\PaymobService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymobService;

    public function __construct(PaymobService $paymobService)
    {
        $this->paymobService = $paymobService;
    }

    public function pay()
    {
        $amountCents = 10000; // Example: 100 EGP

        // Step 1: Get Auth Token
        $authToken = $this->paymobService->getAuthToken();

        // Step 2: Create Order
        $orderData = Order::where('number', 'ORD-6712')->first();
        $order = $this->paymobService->createOrder($authToken, $amountCents, $orderData);

        // Step 3: Generate Payment Key
        $billingData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'phone_number' => '+201234567890',
            'city' => 'Cairo',
            'country' => 'EG',
            'street' => 'NA',
            'building' => 'NA',
            'floor' => 'NA',
            'apartment' => 'NA',
        ];
        $paymentKey = $this->paymobService->getPaymentKey($authToken, $order['id'], $amountCents, $billingData);

        // Step 4: Redirect to Payment Page
        return redirect()->away($this->paymobService->getPaymentUrl($paymentKey['token']));
    }

    // refundOrderUsingPaymob

    public function callback(Request $request)
    {
        return response()->json($request->all());
    }
}
