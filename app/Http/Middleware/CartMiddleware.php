<?php
//FALTA IMPLEMENTAR CARTMIDDLEWARE
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use Darryldecode\Cart\Cart as Cart;

class CartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $cartId = Session::get('cart_id');

        if (!$cartId) {
            // Crear un nuevo carrito y guardar el ID en la sesión
            $cart = Cart::create();
            Session::put('cart_id', $cart->id);
        } else {
            // Recuperar el carrito existente
            $cart = Cart::find($cartId);
        }
        
        // Pasar el carrito a la solicitud para que esté disponible en el controlador
        $request->attributes->set('cart', $cart);
        
        // Compartir los datos del carrito con todas las vistas
        view()->share('cartItems', $cart->items);
        view()->share('cartTotal', $cart->getTotal());
        
        return $next($request);
    }
}
