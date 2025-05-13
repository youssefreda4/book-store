<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['shippingArea', 'user', 'books'])->filter(request()->all())->paginate();
        return view('dashboard.order.index', compact('orders'));
    }
}
