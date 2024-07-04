<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class SalesController extends Controller
{
    public function index()
    {
        // Obtener datos de ventas diarias
        $data = OrderItem::selectRaw('DATE(created_at) as sale_date, COUNT(*) as number_of_sales, SUM(quantity * price) as total_sales, SUM(quantity) as total_quantity')
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy(DB::raw('DATE(created_at)'))
            ->get()
            ->toArray();

        // Obtener las 5 categorías más vistas
        $topCategories = $this->topCategories();

        // Obtener los 10 productos más vendidos
        $topProducts = $this->topProducts();

        // Pasar los datos a la vista
        return view('graphics.index', compact('data', 'topCategories', 'topProducts'));
    }

    public function topCategories()
    {
        // Obtener productos con sus categorías y vistas
        $products = Product::with('categories')->get();

        // Contar vistas por categoría
        $categoryViews = [];
        foreach ($products as $product) {
            foreach ($product->categories as $category) {
                if (!isset($categoryViews[$category->name])) {
                    $categoryViews[$category->name] = 0;
                }
                $categoryViews[$category->name] += $product->views;
            }
        }

        // Ordenar categorías por vistas y obtener las 5 más vistas
        arsort($categoryViews);
        $topCategories = array_slice($categoryViews, 0, 5, true);

        return $topCategories;
    }

    public function topProducts()
    {
        // Obtener los productos y la cantidad total vendida por producto
        $products = OrderItem::with('product')->get();

        // Contar cantidad vendida por producto
        $productSales = [];
        foreach ($products as $orderItem) {
            $productName = $orderItem->product->name;
            if (!isset($productSales[$productName])) {
                $productSales[$productName] = 0;
            }
            $productSales[$productName] += $orderItem->quantity;
        }

        // Ordenar productos por cantidad vendida y obtener los 10 más vendidos
        arsort($productSales);
        $topProducts = array_slice($productSales, 0, 10, true);

        return $topProducts;
    }
}
