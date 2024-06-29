<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Address;
use App\Models\Branch;
use App\Models\PaymentMethod;
use App\Models\Commune;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $product = Product::find($request->id);

        Cart::add([
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
            'cart' => Cart::getContent(),
            'total' => Cart::getTotal()
        ]);
    }

    public function content()
    {
        $cartItems = Cart::getContent();
        $total = Cart::getTotal();

        return response()->json([
            'success' => true,
            'cart' => $cartItems,
            'total' => $total
        ]);
    }


    public function update(Request $request, $id)
    {
        Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $request->quantity
            ],
        ]);

        return response()->json([
            'success' => 'Cart updated successfully!',
            'cart' => Cart::getContent(),
            'total' => Cart::getTotal()
        ]);
    }

    public function remove($id)
    {
        Cart::remove($id);

        return response()->json([
            'success' => 'Product removed from cart!',
            'cart' => Cart::getContent(),
            'total' => Cart::getTotal()
        ]);
    }

    public function clear()
    {
        Cart::clear();

        return response()->json([
            'success' => 'Cart cleared successfully!',
            'cart' => Cart::getContent(),
            'total' => Cart::getTotal()
        ]);
    }

    public function show()
    {
        $cartItems = Cart::getContent();

        return view('cart.index', compact('cartItems'));
    }

    public function showPreOrder(Request $request)
    {
        // Establecer el paso actual en la sesión del usuario
        $step = $request->session()->get('checkout_step', 1);

        $communes = Commune::all();
        $regions = Region::all();
        $addresses = Address::where('user_id', auth()->id())->get();
        // Concatenate the full address
        foreach ($addresses as $address) {
            $communeName = $address->commune ? $address->commune->name : '';
            $address->full_address = "{$address->name}, {$address->address1} {$address->number}, {$address->address2}, {$communeName}";
        }
        $paymentMethods = PaymentMethod::all();
        $branches = Branch::all(); // Fetch branches

        return view('cart.preorder', compact('addresses', 'paymentMethods', 'communes', 'step', 'branches'));
    }


    /* public function purchase(Request $request)
    {
        $user = Auth::user();
        $cartItems = Cart::getContent();
        $total = Cart::getTotal();

        // Create order
        $order = Order::create([
            'user_id' => $user->id,
            'address_id' => $request->address,
            'payment_method_id' => $request->payment_method,
            'total' => $total,
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        // Clear the cart
        Cart::clear();

        // Redirect to orders index with success message
        return redirect()->route('orders.index')->with('success', 'Compra realizada con éxito');
    } */
}
