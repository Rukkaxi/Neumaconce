<?php

namespace App\Http\Controllers;

use App\Mail\ProductPromotionMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use App\Models\User;

class MailController extends Controller
{
    public function sendPromotion()
    {
        // Obtener productos en promoción
        $products = Product::where('on_promotion', true)->get();

        // Obtener correos de los usuarios que desean recibir promociones
        $recipients = User::where('wants_promotions', true)->pluck('email');

        // Enviar correos a todos los destinatarios
        foreach ($recipients as $recipient) {
            Mail::to($recipient)->send(new ProductPromotionMail($products));
        }

        return response()->json(['message' => 'Correos enviados']);
    }
}
