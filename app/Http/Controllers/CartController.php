<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Darryldecode\Cart\Cart as Cart;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $product = Product::find($request->id);

        \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'attributes' => [
                'image' => $product->image1,
            ]
        ]);

        return response()->json([
            'success' => 'Product added to cart!',
            'cart' => \Cart::getContent(),
            'total' => \Cart::getTotal()
        ]);
    }

    public function content()
    {
        $cartItems = \Cart::getContent();
        $total = \Cart::getTotal();

        return response()->json([
            'success' => true,
            'cart' => $cartItems,
            'total' => $total
        ]);
    }


    public function update(Request $request, $id)
    {
        \Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $request->quantity
            ],
        ]);

        return response()->json([
            'success' => 'Cart updated successfully!',
            'cart' => \Cart::getContent(),
            'total' => \Cart::getTotal()
        ]);
    }

    public function remove($id)
    {
        \Cart::remove($id);

        return response()->json([
            'success' => 'Product removed from cart!',
            'cart' => \Cart::getContent(),
            'total' => \Cart::getTotal()
        ]);
    }

    public function clear()
    {
        \Cart::clear();

        return response()->json([
            'success' => 'Cart cleared successfully!',
            'cart' => \Cart::getContent(),
            'total' => \Cart::getTotal()
        ]);
    }

    public function show()
    {
        $cartItems = \Cart::getContent();

        return view('cart.index', compact('cartItems'));
    }
}
