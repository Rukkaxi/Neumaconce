@extends('layouts.backend')

@section('content')
    <h1>Editar Método de Pago</h1>
    <form action="{{ route('payment-methods.update', $paymentMethod->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="{{ $paymentMethod->nombre }}" required>
        </div>
        <div>
            <label for="descripcion">Descripción</label>
            <input type="text" id="descripcion" name="descripcion" value="{{ $paymentMethod->descripcion }}" required>
        </div>
        <button type="submit">Actualizar</button>
    </form>
@endsection
