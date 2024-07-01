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
        $deliveryType = $request->session()->get('delivery_type');
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

        return view('cart.preorder', compact('addresses', 'paymentMethods', 'communes', 'step', 'branches', 'deliveryType'));
    }

    public function purchase(Request $request)
    {
        // Validar y procesar la solicitud
        $request->validate([
            // Otros campos validados
            'delivery_type' => 'required|in:store_pickup,home_delivery',
        ]);

        // Crear el pedido en la base de datos
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $amount, // Ajusta según cómo obtengas el total
            'delivery_type' => $request->input('delivery_type'), // Guardar el tipo de entrega seleccionado
            // Otros campos del pedido
        ]);      
        
    }

}
