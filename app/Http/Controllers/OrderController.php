<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'address', 'paymentMethod', 'items.product'])->where('user_id', Auth::id())->get();
        return view('orders.index', compact('orders'));
    }
}
