<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;

class ShopController extends Controller
{
    public function index(Request $request, $category = null)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $query = $request->input('query');

        // If a query is provided, filter products by name, category, or tag
        if ($query) {
            $productsQuery = Product::where('name', 'like', "%$query%")
                ->orWhereHas('categories', function ($categoryQuery) use ($query) {
                    $categoryQuery->where('name', 'like', "%$query%");
                })
                ->orWhereHas('tags', function ($tagQuery) use ($query) {
                    $tagQuery->where('name', 'like', "%$query%");
                });
        } else {
            // Otherwise, fetch all products
            $productsQuery = Product::query();
        }

        // If a category is provided, further filter products by that category
        if ($category) {
            $productsQuery->whereHas('categories', function ($query) use ($category) {
                $query->where('name', $category);
            });
        }

        // Get the products after applying all filters
        $products = $productsQuery->with('categories', 'tags')->get();

        return view('shop.index', compact('products', 'categories', 'query', 'category','tags'));
    }
}
