<?php

namespace App\Http\Controllers\Website;

use App\Builders\OrderBuilder;
use App\Enum\PaymentStatusEnum;
use App\Enum\PaymentTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\PaymobService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct(public PaymobService $paymentService) {}

    function show(Order $order)
    {
        return view('website.pages.order.order-details', compact('order'));
    }

    function create()
    {
        $orderBuilder = new OrderBuilder;
        DB::beginTransaction();
        try {
            $order = $orderBuilder
                ->setUser(Auth::guard('web')->id())
                ->setTax(request()->tax_percentage)
                ->setAddress(request()->address, (bool)request()->save_to_address)
                ->setShippingAddress(request()->shipping_area_id)
                ->setPaymentType(request()->payment_type)
                ->build();
            if (request()->payment_type == PaymentTypeEnum::Visa->value) {
                $data['price'] = $order->total;
                $paymentRsponse = $this->paymentService->processPayment($data, $order);

                $order->update([
                    'paymob_order_id' => $paymentRsponse['paymob_order_id'],
                ]);

                DB::commit();
                return redirect()->away($paymentRsponse['url']);
            }
            DB::commit();
            return redirect()->route('front.order.show', $order);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'something went wrong');
        }
    }

    public function callback()
    {
        $response = request()->all();

        if (!isset($response['success'], $response['order'], $response['id'])) {
            return redirect()->route('front.home.index')->with('error', 'Invalid data from payment gateway');
        }

        if ($response['success'] === 'true') {
            $order = Order::where('paymob_order_id', $response['order'])->first();

            if (!$order) {
                return redirect()->route('front.home.index')->with('error', 'Order not found');
            }

            $order->update([
                'payment_status' => PaymentStatusEnum::Paid->value,
                'transaction_reference' => $response['id'],
            ]);

            return redirect()->route('front.order.show', $order)
                ->with('success', 'Payment has been completed successfully. Thank you for shopping with us.');
        }
        return redirect()->route('front.home.index')->with('error', 'Payment failed.');
    }
}
