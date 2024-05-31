<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{

    /* public function __construct()
    {
        $this->middleware('permission:Ver Permisos', ['only' => ['index']]);
        $this->middleware('permission:Crear Permiso', ['only' => ['create', 'store']]);
        $this->middleware('permission:Eliminar Permisos', ['only' => ['destroy']]);
        $this->middleware('permission:Editar Permisos', ['only' => ['update', 'edit']]);
    } */
    public function index()
    {
        $categories = Category::get();
        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = '';
        $filename = '';

        if($request->has('photo')){
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();

            $filename = time().'.'.$extension;
            $path = 'images/categorias';
            $file->move(public_path($path), $filename);
        }

        // Create a new Category record
        Category::create([
            'name'=>$request->name,
            'photo' => $filename ? $path.'/'.$filename : null
        ]);

        // Redirect to the index page with a success message
        return redirect('categories')->with('status', 'Categoría creada exitósamente');
    }

    public function edit($id)
    {

        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));

    }
     public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = '';

        $category = Category::findOrFail($id);

        if($request->has('photo')){
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();

            if (File::exists($category->photo)){
                File::delete($category->photo);
            }

            $filename = time().'.'.$extension;
            $path = 'images/categorias';
            $file->move(public_path($path), $filename);

            
        }

        $filename = isset($filename) ? $filename : basename($category->photo);

        // Update the Category record
        $category->update([
            'name'=>$request->name,
            'photo'=>$path.'/'.$filename
        ]);

        return redirect('categories')->with('status', 'Categoría actualizada exitósamente!');
    }
    public function destroy($categoryId)
    {
        $category = Category::find($categoryId);
        $category->delete();
        return redirect('categories')->with('status', 'Categoría eliminada exitósamente!');
    }
}

