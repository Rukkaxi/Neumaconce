<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Tag;

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
        return view('products.create', compact('brands','categories','tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'brandId' => 'required|exists:brands,id', // Assuming the brand_id is posted in the request
            'stock' => 'integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $path = '';
        $filename = '';

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            $filename = time() . '.' . $extension;
            $path = 'images/products';
            $file->move(public_path($path), $filename);
        }

        // Create a new Product record
        /* Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'brandId' => $request->brandId,
            'stock' => $request->stock ?? 0,
            'image' => $filename ? $path . '/' . $filename : null
        ]); */

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'brandId' => $request->brandId,
            'stock' => $request->stock ?? 0,
            'image' => $filename ? $path . '/' . $filename : null
        ]);

        $product->tags()->attach($request->tags);
        $product->categories()->attach($request->categories);

        // Redirect to the index page with a success message
        return redirect('products')->with('status', 'Producto creado exitósamente');
    }

    public function edit($id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $tags = Tag::all();
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product','brands','categories','tags'));
    }

    public function update(Request $request, $id)
    {

        
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'brandId' => 'required|exists:brands,id', // Assuming the brand_id is posted in the request
            'stock' => 'integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $path = '';

        $product = Product::findOrFail($id);

        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            if (File::exists($product->image)) {
                File::delete($product->image);
            }

            $filename = time() . '.' . $extension;
            $path = 'images/products';
            $file->move(public_path($path), $filename);
        }

        $filename = isset($filename) ? $filename : basename($product->image);

        // Update the Product record
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'brandId' => $request->brandId,
            'stock' => $request->stock ?? 0,
            'image' => $path . '/' . $filename
        ]);

        $product->categories()->sync($request->categories);
        $product->tags()->sync($request->tags);

        return redirect('products')->with('status', 'Producto actualizado exitósamente!');
    }

    public function destroy($productId)
    {
        $product = Product::find($productId);
        if ($product->image && File::exists($product->image)) {
            File::delete($product->image);
        }
        $product->delete();
        return redirect('products')->with('status', 'Producto eliminado exitósamente!');
    }
}
