<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus\Transaction;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

class WebpayController extends Controller
{
    public function initTransaction()
    {
        $buyOrder = 'ordenCompra' . rand(1000, 9999);
        $sessionId = session()->getId();
        $amount = round(Cart::getTotal());
        $returnUrl = route('webpay.response');

        // Save the preliminary order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $amount,
        ]);

        $transaction = new Transaction();
        $response = $transaction->create($buyOrder, $sessionId, $amount, $returnUrl);

        if ($response->getToken() && $response->getUrl()) {
            // Save the order ID and token to session
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
                // Update the order with payment details
                $order->update([
                    'payment_method_id' => 1, // Assuming 1 is the WebPay payment method ID
                    'transactionID' => $response->getAuthorizationCode(),
                    'address_id' => session('address_id'), // Assume address_id is stored in session
                ]);

                // Add order items
                $cartItems = Cart::getContent();
                foreach ($cartItems as $item) {
                    $order->items()->create([
                        'product_id' => $item->id,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                    ]);
                }

                // Clear the cart
                Cart::clear();
            }

            return view('webpay.success', ['result' => $response]);
        }

        return view('webpay.failure', ['result' => $response]);
    }

    public function finish()
    {
        return view('webpay.finish');
    }
}
