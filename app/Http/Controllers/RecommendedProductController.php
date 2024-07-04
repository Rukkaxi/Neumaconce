<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;

class RecommendedProductController extends Controller
{
    public function show()
    {
        $recommendedProducts = Product::inRandomOrder()->take(4)->get(); // Obtén 4 productos aleatorios
        return view('partials.recommended-products', compact('recommendedProducts'));
    }
}
