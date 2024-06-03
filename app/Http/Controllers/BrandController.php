<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
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
        $brands = Brand::get();
        return view('brands.index', [
            'brands' => $brands
        ]);
    }

    public function create()
    {
        return view('brands.create');
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
            $path = 'images/marcas';
            $file->move(public_path($path), $filename);
        }

        // Create a new Brand record
        Brand::create([
            'name'=>$request->name,
            'photo' => $filename ? $path.'/'.$filename : null
        ]);

        // Redirect to the index page with a success message
        return redirect('brands')->with('status', 'Marca creada exitósamente');
    }

    public function edit($id)
    {

        $brand = Brand::findOrFail($id);
        return view('brands.edit', compact('brand'));

    }
     public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = '';

        $brand = Brand::findOrFail($id);

        if($request->has('photo')){
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();

            if (File::exists($brand->photo)){
                File::delete($brand->photo);
            }

            $filename = time().'.'.$extension;
            $path = 'images/marcas';
            $file->move(public_path($path), $filename);

            
        }

        $filename = isset($filename) ? $filename : basename($brand->photo);

        // Create a new Brand record
        $brand->update([
            'name'=>$request->name,
            'photo'=>$path.'/'.$filename
        ]);

        return redirect('brands')->with('status', 'Marca actualizada exitósamente!');
    }
    public function destroy($brandId)
    {
        $brand = Brand::find($brandId);
        $brand->delete();
        return redirect('brands')->with('status', 'Marca eliminada exitósamente!');
    }
}
