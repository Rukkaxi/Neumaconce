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
    // Método para mostrar la vista de seguimiento de pedidos en la vista de administrador
    public function adminTracking(Order $order)
    {
        return view('orders.admin_tracking', compact('order'));
    }
    public function tracking($buyOrder)
    {
        // Busca la orden por el número de pedido
        $order = Order::where('buy_order', $buyOrder)->first();

        // Verifica si la orden existe
        if (!$order) {
            abort(404);
        }

        /* // Verifica si el usuario está logueado y si es el dueño de la orden
        $isOwner = Auth::check() && $order->user_id === Auth::id();

        // Si no es el dueño y la orden no está en estado "TERMINADA", redirige o muestra un mensaje según lo necesites
        if (!$isOwner && $order->status !== 'TERMINADA') {
            return redirect()->route('home')->with('error', 'No tienes permiso para ver este pedido.');
        } */

        // Si es el dueño o la orden está en estado "TERMINADA", muestra la vista de seguimiento
        return view('orders.tracking', compact('order'));
    }

    public function showTrackingForm()
    {
        return view('orders.tracking_form');
    }

    public function searchOrder(Request $request)
    {
        $request->validate([
            'buy_order' => 'required|string',
        ]);

        $order = Order::where('buy_order', $request->input('buy_order'))->first();

        if (!$order) {
            return redirect()->back()->with('error', 'No se encontró ninguna orden con ese número de compra.');
        }

        return redirect()->route('orders.tracking', ['buyOrder' => $order->buy_order]);
    }

public function updateTracking(Request $request, Order $order)
{
    $request->validate([
        'update_description' => 'required|string|max:255',
    ]);

    // Actualizar la descripción de seguimiento del pedido
    $order->tracking_updates()->create([
        'description' => $request->update_description,
        'user_id' => auth()->id(), 
    ]);

    return back()->with('status', 'Se ha actualizado el seguimiento correctamente.');
}

}
