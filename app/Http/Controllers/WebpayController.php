<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus\Transaction;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;

class WebpayController extends Controller
{
    public function initTransaction(Request $request)
    {
        // Obtener el último número de orden emitido
        $lastOrder = Order::orderBy('id', 'desc')->first();
        $buyOrder = $lastOrder ? $lastOrder->id + 1 : 1;

        $sessionId = session()->getId();
        $amount = round(Cart::getTotal());
        $returnUrl = route('webpay.response');

        // Crear la nueva orden con el número de orden secuencial
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $amount,
            'address_id' => $request->address_id,
            'delivery_type' => $request->delivery_type ?? 1,
        ]);

        $transaction = new Transaction();
        $response = $transaction->create($buyOrder, $sessionId, $amount, $returnUrl);

        if ($response->getToken() && $response->getUrl()) {
            session(['order_id' => $order->id, 'webpay_token' => $response->getToken()]);

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
            $order = Order::find(session('order_id'));

            if ($order) {
                $order->update([
                    'payment_method_id' => 1, // Assuming 1 is the WebPay payment method ID
                    'transactionID' => $response->getAuthorizationCode(),
                    //'address_id' => session('address_id'), // Assume address_id is stored in session
                    'status' => 'EN ESPERA',
                    'buy_order' => $response->getBuyOrder(), // Guardar Orden de Compra
                    'authorization_code' => $response->getAuthorizationCode(), // Guardar Código de Autorización
                ]);

                $cartItems = Cart::getContent();
                foreach ($cartItems as $item) {
                    $order->items()->create([
                        'product_id' => $item->id,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                    ]);
                }

                Cart::clear();
            }

            return view('webpay.success', ['result' => $response, 'order' => $order]);
        }

        return view('webpay.failure', ['result' => $response]);
    }

    public function finish()
    {
        return view('webpay.finish');
    }

    public function downloadInvoice($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId);

        $pdf = Pdf::loadView('webpay.receipt', compact('order'));
        return $pdf->download('receipt_' . $order->id . '.pdf');
    }
}
