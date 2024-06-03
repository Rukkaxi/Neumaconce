<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region; 

class RegionController extends Controller
{
    public function index(){
        $regions = Region::all();
        return view('regions.index', [
            'regions' => $regions
        ]);
    }

    public function create(){
        $regions = Region::all(); // Fetch all brands for select dropdown
        return view('regions.create', compact('regions'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
        ]);

        Region::create($request->all());

        return redirect('regions')->with('status', 'Región creada exitósamente!');
    }

    public function edit($id){
        $region = Region::findOrFail($id);
        return view('regions.edit', compact('region'));
    }

    public function update(Request $request, Region $region){
        $request->validate([
            'name' => 'required|string',
        ]);

        $region->update($request->all());

        return redirect('regions')->with('status', 'Región actualizada exitósamente!');
    }

    public function destroy($id){
        $region = Region::findOrFail($id);
        $region->delete();
        return redirect('regions')->with('status', 'Región eliminada exitósamente!');
    }
}
