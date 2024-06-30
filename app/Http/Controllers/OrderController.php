<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function admin()
    {
        $orders = Order::with(['user', 'address', 'paymentMethod', 'items.product'])->get();
        return view('orders.admin_index', compact('orders'));
    }
    public function index()
    {
        $orders = Order::with(['user', 'address', 'paymentMethod', 'items.product'])->where('user_id', Auth::id())->get();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Verificar si el usuario tiene permiso para ver este pedido
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:EN ESPERA,DESPACHADA,RETIRADA,TERMINADA',
        ]);

        $order->update([
            'status' => $request->input('status'),
        ]);

        return redirect()->back()->with('success', 'Estado del pedido actualizado correctamente.');
    }
}
