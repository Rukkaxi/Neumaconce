<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cotizacion;
use App\Models\Product;

class CotizacionController extends Controller
{
    public function create()
    {
        $products = Product::all();
        return view('cotizaciones.form', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'product_id' => 'required|integer',
            'descripcion' => 'required|string|max:1000',
        ]);
    
        Cotizacion::create($validated);
    
        return redirect()->route('cotizaciones.create')->with('success', 'Cotización registrada exitosamente!');
    }

    public function index()
    {
        $cotizaciones = Cotizacion::with('product')->get();
        return view('cotizaciones.index', compact('cotizaciones'));
    }
}
