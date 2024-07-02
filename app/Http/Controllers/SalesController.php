<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Order;

class SalesController extends Controller
{
    public function index()
    {
        $data = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->selectRaw('DATE(orders.created_at) as date, SUM(total) as total_sales')
            ->groupBy('date')
            ->get();

        return view('graphics.index', compact('data'));
    }
}