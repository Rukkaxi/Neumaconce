<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Commune; // Don't forget to import the Brand model

class CommuneController extends Controller
{
    public function index(){
        $communes = Commune::all();
        return view('communes.index', [
            'communes' => $communes
        ]);
    }

    public function create(){
        $regions = Region::all(); // Fetch all brands for select dropdown
        return view('communes.create', compact('regions'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'region_id' => 'required|exists:regions,id'
        ]);
        
        Commune::create([
            'name' => $request->input('name'),
            'region_id' => $request->input('region_id')
        ]);

        return redirect('communes')->with('status', 'Comuna creada exitósamente!');
    }

    public function edit(Commune $commune){
        $regions = Region::all(); // Fetch all brands for select dropdown
        return view('communes.edit', compact('commune', 'regions'));
    }

    public function update(Request $request, Commune $commune){
        $request->validate([
            'name' => 'required|string',
            'region_id' => 'required|exists:regions,id'
        ]);

        $commune->update([
            'name' => $request->input('name'),
            'region_id' => $request->input('region_id')
        ]);

        return redirect('communes')->with('status', 'Comuna actualizada exitósamente!');
    }

    public function destroy($communeId){
        $commune = Commune::findOrFail($communeId);
        $commune->delete();
        return redirect('communes')->with('status', 'Comuna eliminada exitósamente!');
    }
}
