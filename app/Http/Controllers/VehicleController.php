<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Brand; // Don't forget to import the Brand model

class VehicleController extends Controller
{
    public function index(){
        $vehicles = Vehicle::all();
        return view('vehicles.index', [
            'vehicles' => $vehicles
        ]);
    }

    public function create(){
        $brands = Brand::all(); // Fetch all brands for select dropdown
        return view('vehicles.create', compact('brands'));
    }

    public function store(Request $request){
        $request->validate([
            'model' => 'required|string',
            'year' => 'required|integer',
            'brandId' => 'required|exists:brands,id'
        ]);

        Vehicle::create($request->all());

        return redirect('vehicles')->with('status', 'Vehículo creado exitósamente!');
    }

    public function edit(Vehicle $vehicle){
        $brands = Brand::all(); // Fetch all brands for select dropdown
        return view('vehicles.edit', compact('vehicle', 'brands'));
    }

    public function update(Request $request, Vehicle $vehicle){
        $request->validate([
            'model' => 'required|string',
            'year' => 'required|integer',
            'brandId' => 'required|exists:brands,id'
        ]);

        $vehicle->update($request->all());

        return redirect('vehicles')->with('status', 'Vehículo actualizado exitósamente!');
    }

    public function destroy($vehicleId){
        $vehicle = Vehicle::findOrFail($vehicleId);
        $vehicle->delete();
        return redirect('vehicles')->with('status', 'Vehículo eliminado exitósamente!');
    }
}
