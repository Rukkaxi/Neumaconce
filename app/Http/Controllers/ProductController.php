<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Vehicle;
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

        // Obtener modelos y años de la tabla vehicles junto con los nombres de las marcas
        $vehicles = Vehicle::with('brand:id,name')->get();

        $brandTags = collect();
        $modelTags = collect();
        $yearTags = collect();

        foreach ($vehicles as $vehicle) {
            $brandTags->push($vehicle->brand->name);
            $modelTags->push($vehicle->model);
            $yearTags->push($vehicle->year);
        }

        // Filtrar etiquetas únicas
        $uniqueBrandTags = $brandTags->unique();
        $uniqueModelTags = $modelTags->unique();
        $uniqueYearTags = $yearTags->unique();

        // Crear etiquetas si no existen
        foreach ($uniqueBrandTags as $tagName) {
            Tag::firstOrCreate(['name' => $tagName]);
        }
        foreach ($uniqueModelTags as $tagName) {
            Tag::firstOrCreate(['name' => $tagName]);
        }
        foreach ($uniqueYearTags as $tagName) {
            Tag::firstOrCreate(['name' => $tagName]);
        }

        // Recargar las etiquetas después de la creación
        $tags = Tag::all();

        return view('products.create', compact('brands', 'categories', 'tags', 'uniqueBrandTags', 'uniqueModelTags', 'uniqueYearTags'));
    }


    public function store(Request $request)
    {
        // Validar los campos
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
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:255',
        ]);

        // Manejar las imágenes
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

        // Crear el producto
        $productData = $request->only(['name', 'price', 'brandId', 'stock', 'description']);
        $productData['available'] = $request->has('available') ? true : false;
        $product = Product::create(array_merge($productData, $images));

        // Asociar categorías
        if ($request->categories) {
            $product->categories()->attach($request->categories);
        }

        // Asociar etiquetas
        if ($request->tags) {
            $tagNames = $request->tags;
            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $product->tags()->attach($tag);
            }
        }

        return redirect('products')->with('status', 'Producto creado exitósamente');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $tags = Tag::all();
        $product = Product::findOrFail($id);

        // Obtener modelos y años de la tabla vehicles junto con los nombres de las marcas
        $vehicles = Vehicle::with('brand:id,name')->get();

        $brandTags = collect();
        $modelTags = collect();
        $yearTags = collect();

        foreach ($vehicles as $vehicle) {
            $brandTags->push($vehicle->brand->name);
            $modelTags->push($vehicle->model);
            $yearTags->push($vehicle->year);
        }

        // Filtrar etiquetas únicas
        $uniqueBrandTags = $brandTags->unique();
        $uniqueModelTags = $modelTags->unique();
        $uniqueYearTags = $yearTags->unique();

        return view('products.edit', compact('product', 'brands', 'categories', 'tags', 'uniqueBrandTags', 'uniqueModelTags', 'uniqueYearTags'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'nullable|numeric',
            'brandId' => 'required|exists:brands,id',
            'stock' => 'integer',
            'description' => 'required|string',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:255',
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
        $productData['available'] = $request->has('available') ? true : false; // Ensure it's a boolean value
        $product->update(array_merge($productData, $images));

        if ($request->categories) {
            $product->categories()->sync($request->categories);
        } else {
            $product->categories()->detach();
        }

        if ($request->tags) {
            $tagNames = $request->tags;
            $tagIds = collect();
            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds->push($tag->id);
            }
            $product->tags()->sync($tagIds);
        } else {
            $product->tags()->detach();
        }

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
        $product = Product::with(['brand', 'categories', 'tags'])->findOrFail($id);
        $userId = auth()->id();
        $wishlistItem = Wishlist::where('user_id', $userId)->where('product_id', $id)->first();
        $isInWishlist = $wishlistItem ? true : false;
        $product->increment('views');

        return view('shop.show', compact('product', 'isInWishlist', 'wishlistItem'));
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
    public function removeFromWishlist($id)
    {
        $userId = auth()->id();
        Wishlist::where('user_id', $userId)->where('id', $id)->delete();
        return redirect()->back()->with('status', 'Product removed from wishlist successfully.');
    }
    /* public function changeStock(Request $request, Product $product)
    {
        $action = $request->input('action');
        $stockChange = $action === 'increase' ? 1 : -1;

        $newStock = $product->stock + $stockChange;
        
        if ($newStock < 0) {
            return response()->json([
                'success' => false,
                'message' => 'El stock no puede ser negativo.'
            ]);
        }

        $product->stock = $newStock;
        $product->save();

        return response()->json([
            'success' => true,
            'new_stock' => $product->stock
        ]);
    } */

    public function changeStock(Request $request, Product $product)
    {
        $action = $request->input('action');

        if ($action === 'set') {
            $newStock = (int) $request->input('new_stock');

            if ($newStock < 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'El stock no puede ser negativo.'
                ]);
            }

            $product->stock = $newStock;
            $product->save();

            return response()->json([
                'success' => true,
                'new_stock' => $product->stock
            ]);
        } else {
            $stockChange = $action === 'increase' ? 1 : -1;

            $newStock = $product->stock + $stockChange;

            if ($newStock < 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'El stock no puede ser negativo.'
                ]);
            }

            $product->stock = $newStock;
            $product->save();

            return response()->json([
                'success' => true,
                'new_stock' => $product->stock
            ]);
        }
    }

    public function randomProducts()
    {
        $products = Product::inRandomOrder()->take(4)->get(); // Cambia 4 por 5 si deseas 5 productos
        return view('partials.recommended-products', compact('products'));
    }
}
