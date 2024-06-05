<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Wishlist;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories', 'tags')->get();
        return view('products.index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $tags = Tag::all();
        return view('products.create', compact('brands', 'categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'nullable|numeric',
            'brandId' => 'required|exists:brands,id',
            'stock' => 'integer',
            'description' => 'required|string',
            'available' => 'boolean',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $images = [];
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('image' . $i)) {
                $file = $request->file('image' . $i);
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . $i . '.' . $extension;
                $path = 'images/products';
                $file->move(public_path($path), $filename);
                $images['image' . $i] = $path . '/' . $filename;
            } else {
                $images['image' . $i] = null;
            }
        }

        $productData = $request->only(['name', 'price', 'brandId', 'stock', 'description']);
        $productData['available'] = $request->has('available');
        $product = Product::create(array_merge($productData, $images));

        $product->tags()->attach($request->tags);
        $product->categories()->attach($request->categories);

        return redirect('products')->with('status', 'Producto creado exitósamente');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $tags = Tag::all();
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product', 'brands', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'nullable|numeric',
            'brandId' => 'required|exists:brands,id',
            'stock' => 'integer',
            'description' => 'required|string',
            'available' => 'boolean',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $product = Product::findOrFail($id);

        $images = [];
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('image' . $i)) {
                $file = $request->file('image' . $i);
                $extension = $file->getClientOriginalExtension();

                if (File::exists($product->{'image' . $i})) {
                    File::delete($product->{'image' . $i});
                }

                $filename = time() . '_' . $i . '.' . $extension;
                $path = 'images/products';
                $file->move(public_path($path), $filename);
                $images['image' . $i] = $path . '/' . $filename;
            } else {
                $images['image' . $i] = $product->{'image' . $i};
            }
        }

        $productData = $request->only(['name', 'price', 'brandId', 'stock', 'description']);
        $productData['available'] = $request->has('available');
        $product->update(array_merge($productData, $images));

        $product->categories()->sync($request->categories);
        $product->tags()->sync($request->tags);

        return redirect('products')->with('status', 'Producto actualizado exitósamente!');
    }

    public function destroy($productId)
    {
        $product = Product::find($productId);
        for ($i = 1; $i <= 5; $i++) {
            if ($product->{'image' . $i} && File::exists($product->{'image' . $i})) {
                File::delete($product->{'image' . $i});
            }
        }
        $product->delete();
        return redirect('products')->with('status', 'Producto eliminado exitósamente!');
    }

    public function show($id)
    {
        $product = Product::with('brand', 'categories', 'tags')->findOrFail($id);
        return view('shop.show', compact('product'));
    }

    public function wishlist()
    {
        $userId = auth()->id();
        $wishlist = Wishlist::where('user_id', $userId)->with('product')->get();
        return view('wishlist', compact('wishlist'));
    }

    public function addToWishlist(Request $request, $productId)
    {
        $userId = auth()->id();
        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId
        ]);
        return redirect()->back()->with('status', 'Product added to wishlist successfully.');
    }
}
