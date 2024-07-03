<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Brand;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('vehicles.index', [
            'vehicles' => $vehicles
        ]);
    }

    public function create()
    {
        $brands = Brand::all();
        return view('vehicles.create', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'model' => 'required|string',
            'year' => 'required|integer',
            'brandId' => 'required|exists:brands,id'
        ]);

        Vehicle::create($request->all());

        return redirect('vehicles')->with('status', 'Vehículo creado exitósamente!');
    }

    public function edit(Vehicle $vehicle)
    {
        $brands = Brand::all();
        return view('vehicles.edit', compact('vehicle', 'brands'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'model' => 'required|string',
            'year' => 'required|integer',
            'brandId' => 'required|exists:brands,id'
        ]);

        $vehicle->update($request->all());

        return redirect('vehicles')->with('status', 'Vehículo actualizado exitósamente!');
    }

    public function destroy($vehicleId)
    {
        $vehicle = Vehicle::findOrFail($vehicleId);
        $vehicle->delete();
        return redirect('vehicles')->with('status', 'Vehículo eliminado exitósamente!');
    }

    public function getYears(Request $request)
    {
        $brandId = $request->input('brandId');
        $model = $request->input('model');

        $years = Vehicle::where('brandId', $brandId)
            ->where('model', $model)
            ->distinct()
            ->pluck('year')
            ->toArray();

        return response()->json($years);
    }

    public function getBrands()
    {
        $brands = Brand::all();
        return response()->json($brands);
    }

    public function getModels(Request $request)
    {
        $brandId = $request->brandId;

        $models = Vehicle::select('model')
            ->where('brandId', $brandId)
            ->distinct()
            ->get();

        return response()->json($models);
    }
}
