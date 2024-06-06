<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus\Transaction;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class WebpayController extends Controller
{
    public function initTransaction()
    {
        $buyOrder = 'ordenCompra' . rand(1000, 9999);
        $sessionId = session()->getId();
        $amount = round(Cart::getTotal()); // Obtener el total del carro
        $returnUrl = route('webpay.response');

        $transaction = new Transaction();
        $response = $transaction->create($buyOrder, $sessionId, $amount, $returnUrl);

        if ($response->getToken() && $response->getUrl()) {
            return view('webpay.redirect', [
                'url' => $response->getUrl(),
                'token' => $response->getToken(),
            ]);
        }

        return 'Error al iniciar la transacción';
    }

    public function response(Request $request)
    {
        $token = $request->input('token_ws') ?? $request->input('TBK_TOKEN') ?? null;

        if (!$token) {
            return view('webpay.failure', ['message' => 'No es un flujo de pago normal.']);
        }

        $transaction = new Transaction();
        $response = $transaction->commit($token);

        if ($response->isApproved()) {
            // Limpiar el carro después de una transacción exitosa
            Cart::clear();
            return view('webpay.success', ['result' => $response]);
        }

        return view('webpay.failure', ['result' => $response]);
    }

    public function finish()
    {
        return view('webpay.finish');
    }
}
