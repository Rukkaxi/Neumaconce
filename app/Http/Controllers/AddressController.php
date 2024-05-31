<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Commune;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::with('commune')->where('user_id', auth()->id())->get();
        return view('addresses.index', compact('addresses'));
    }

    public function create()
    {
        $communes = Commune::all();
        return view('addresses.create', compact('communes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address1' => 'required',
            'number' => 'required',
            'commune_id' => 'required',
        ]);

        $address = new Address();
        $address->user_id = auth()->id();
        $address->name = $request->name;
        $address->address1 = $request->address1;
        $address->number = $request->number;
        $address->address2 = $request->address2;
        $address->commune_id = $request->commune_id;
        $address->save();

        return redirect()->route('addresses.index')->with('status', 'Dirección añadida correctamente.');
    }

    public function edit($id)
    {
        $address = Address::findOrFail($id);
        $communes = Commune::all();
        return view('addresses.edit', compact('address', 'communes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address1' => 'required',
            'number' => 'required',
            'commune_id' => 'required',
        ]);

        $address = Address::findOrFail($id);
        $address->name = $request->name;
        $address->address1 = $request->address1;
        $address->number = $request->number;
        $address->address2 = $request->address2;
        $address->commune_id = $request->commune_id;
        $address->save();

        return redirect()->route('addresses.index')->with('status', 'Dirección actualizada correctamente.');
    }

    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();

        return redirect()->route('addresses.index')->with('status', 'Dirección eliminada correctamente.');
    }
}
