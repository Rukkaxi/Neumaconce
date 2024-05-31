<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Darryldecode\Cart\Cart as Cart;

class CartController extends Controller
{

    /* public function show()
    {
        $cartItems = \Cart::getContent();
        return view('cart.index', compact('cartItems'));
    } */


    public function add(Request $request)
    {
        $product = Product::find($request->id);

        \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'attributes' => [
                'image' => $product->image1, // Include image attribute here
                // You can include other attributes as needed
            ]
        ]);

        return response()->json(['success' => 'Product added to cart!', 'cart' => \Cart::getContent()]);
    }

    public function update(Request $request, $id)
    {
        \Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $request->quantity
            ],
        ]);

        return response()->json(['success' => 'Cart updated successfully!', 'cart' => \Cart::getContent()]);
    }

    public function remove($id)
    {
        \Cart::remove($id);

        return response()->json(['success' => 'Product removed from cart!', 'cart' => \Cart::getContent()]);
    }

    public function clear()
    {
        \Cart::clear();

        return response()->json(['success' => 'Cart cleared successfully!', 'cart' => \Cart::getContent()]);
    }

    public function show()
    {
        $cartItems = \Cart::getContent();

        return view('cart', compact('cartItems'));
    }
}
