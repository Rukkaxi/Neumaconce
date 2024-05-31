<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index($category = null)
    {
        $categories = Category::all();

        // If a category is provided, filter products by that category
        if ($category) {
            $products = Product::whereHas('categories', function ($query) use ($category) {
                $query->where('name', $category);
            })->get();
        } else {
            // Otherwise, fetch all products
            $products = Product::with('categories', 'tags')->get();
        }

        return view('shop.index', compact('products', 'categories', 'category'));
    }
}
