<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = $this->calculateTotal($cart);

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Product $product)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    public function remove($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        $total = $this->calculateTotal($cart);
        $itemCount = count($cart);

        return response()->json([
            'success' => true,
            'total' => $total,
            'itemCount' => $itemCount
        ]);
    }

    public function clear()
    {
        Session::forget('cart');

        return redirect()->route('cart.index')->with('success', 'Carrito vaciado');
    }

    public function updateQuantity(Request $request)
    {
        $cart = Session::get('cart', []);
        $productId = $request->input('productId');
        $quantity = $request->input('quantity');

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
        }

        Session::put('cart', $cart);

        $total = $this->calculateTotal($cart);
        $subtotal = isset($cart[$productId]) ? $cart[$productId]['price'] * $quantity : 0;

        return response()->json([
            'success' => true,
            'subtotal' => $subtotal,
            'total' => $total
        ]);
    }

    private function calculateTotal($cart)
    {
        return array_reduce($cart, function ($carry, $item) {
            return $carry + $item['price'] * $item['quantity'];
        }, 0);
    }
}
