<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function index()
    {
        // Obtenemos los datos de ventas diarias
        $data = OrderItem::selectRaw('DATE(created_at) as sale_date, COUNT(*) as number_of_sales, SUM(quantity * price) as total_sales')
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderBy(DB::raw('DATE(created_at)'))
                ->get();
    
        // Convertir los datos a un array para pasarlos a la vista
        $data = $data->toArray();

        // Pasamos los datos a la vista
        return view('graphics.index', compact('data'));
    }
}
