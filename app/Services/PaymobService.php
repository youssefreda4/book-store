<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PaymobService
{
    protected $apiKey;

    protected $integrationIds;

    protected $iframeId;

    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = env('PAYMOB_API_KEY');
        $this->integrationIds = explode(',', env('PAYMOB_INTEGRATION_ID'));
        $this->iframeId = env('PAYMOB_IFRAME_ID');
        $this->baseUrl = env('PAYMOB_BASE_URL');
    }

    // Step 1: Get authentication token
    public function processPayment($data, $order)
    {
        $amountCent = $data['price'] * 100;
        $authToken = $this->getAuthToken();
        $order = $this->createOrder($authToken, $amountCent, $order);
        
        // $paymentKey = $this->getPaymentKey($authToken, $order['id'], $amountCent, $data['billing_data']);
        return $order['url'];
        // return $this->getPaymentUrl($paymentKey['token']);
    }

    public function getAuthToken()
    {
        $response = Http::post($this->baseUrl.'/auth/tokens', [
            'api_key' => $this->apiKey,
        ]);

        return $response->json()['token'] ?? null;
    }

    // Step 2: Register order
    public function createOrder($authToken, $amountCents, $order)
    {

        $items = $order->books->map(fn ($book) => [
            'name' => $book->name,
            'amount_cents' => (int) ($book->pivot->price_after_discount * 100) * $book->pivot->quantity,
            'quantity' => $book->pivot->quantity,
            'description' => $book->description ?? '',
        ])->toArray();
        // dd($items);
        $response = Http::post($this->baseUrl.'/ecommerce/orders', [
            'auth_token' => $authToken,
            'api_source' => 'INVOICE',
            'delivery_needed' => false,
            'amount_cents' => (int) $amountCents,
            'integrations' => $this->integrationIds,
            'currency' => 'EGP',
            'shipping_data' => [
                'first_name' => $order->user->first_name,
                'last_name' => $order->user->last_name,
                'email' => $order->user->email,
                'phone_number' => $order->user->phone,
            ],
            'items' => $items,
        ]);

        return $response->json();
    }

    // Step 3: Get Payment Key
    public function getPaymentKey($authToken, $orderId, $amountCents, $billingData)
    {
        $response = Http::post('https://accept.paymob.com/api/acceptance/payment_keys', [
            'auth_token' => $authToken,
            'amount_cents' => $amountCents,
            'expiration' => 3600,
            'order_id' => $orderId,
            'currency' => 'EGP',
            'integration_id' => (int) $this->integrationIds[0],
            'billing_data' => $billingData,
        ]);

        return $response->json();
    }

    // Step 4: Get Payment URL
    public function getPaymentUrl($paymentKey)
    {
        return "https://accept.paymob.com/api/acceptance/iframes/{$this->iframeId}?payment_token={$paymentKey}";
    }
}
