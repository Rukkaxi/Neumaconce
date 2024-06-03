<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
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
        
        view()->share('cartItems', Cart::getContent());
        
        return $next($request);
    }
}
