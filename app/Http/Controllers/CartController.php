<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Darryldecode\Cart\Cart as Cart;
use App\Models\Address;
use App\Models\PaymentMethod;
use App\Models\Commune;
use App\Models\Region;

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

        return view('cart.preorder', compact('addresses', 'paymentMethods', 'communes', 'step' ));
    }

    public function purchase(Request $request)
    {
        $user = Auth::user();
        $cartItems = \Cart::getContent();
        $total = \Cart::getTotal();
        
        // Aquí puedes manejar la lógica de la compra, como guardar el pedido en la base de datos
        // Por ejemplo:
        $order = new Order();
        $order->user_id = $user->id;
        $order->address_id = $request->address;
        $order->payment_method_id = $request->payment_method;
        $order->total = $total;
        $order->save();

        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        // Limpia el carrito
        \Cart::clear();
        
        // Actualiza el paso en la sesión del usuario
        $request->session()->put('checkout_step', 1); // O el paso que corresponda después de la compra

        return redirect()->route('orders.index')->with('success', 'Compra realizada con éxito');
    }


}
