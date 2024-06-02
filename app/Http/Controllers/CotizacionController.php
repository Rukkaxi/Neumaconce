<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CotizacionController extends Controller
{
    public function showForm()
    {
        return view('cotizaciones.form');
    }
}