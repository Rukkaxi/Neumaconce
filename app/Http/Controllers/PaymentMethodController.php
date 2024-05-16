<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Storage;


class PaymentMethodController extends Controller
{
    public function index()
    {
        $payment_methods = PaymentMethod::all();
        //dd($payment_methods);  // Añade esto para depurar
        return view('payment-methods.index', compact('payment_methods'));
    }

    public function create()
    {
        return view('payment-methods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la foto
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('payment-methods', 'public');
        }

        PaymentMethod::create([
            'name' => $request->name,
            'guard_name' => 'web',
            'description' => $request->description,
            'photo' => $request->$photoPath,
        ]);

        return redirect()->route('payment-methods.index')->with('success', 'Método de pago creado correctamente');
    }

    public function edit($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        return view('payment-methods.edit', compact('paymentMethod'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la foto
        ]);

        $paymentMethod = PaymentMethod::findOrFail($id);

        if ($request->hasFile('photo')) {
            // Eliminar la foto anterior si existe
            if ($paymentMethod->photo) {
                Storage::disk('public')->delete($paymentMethod->photo);
            }
            $photoPath = $request->file('photo')->store('payment-methods', 'public');
            $paymentMethod->photo = $photoPath;
        }


        $paymentMethod->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('payment-methods.index')->with('success', 'Método de pago actualizado correctamente');
    }

    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        if ($paymentMethod->photo) {
            Storage::disk('public')->delete($paymentMethod->photo);
        }
        $paymentMethod->delete();
        return redirect()->route('payment-methods.index')->with('success', 'Método de pago eliminado correctamente');
    }

    public function show($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        return view('payment-methods.show', compact('paymentMethod'));
    }
}
