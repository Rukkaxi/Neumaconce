@extends('layouts.backend')

@section('content')
    <h1>Crear Método de Pago</h1>
    <form action="{{ route('payment-methods.store') }}" method="POST">
        @csrf
        <div>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div>
            <label for="descripcion">Descripción</label>
            <input type="text" id="descripcion" name="descripcion" required>
        </div>
        <button type="submit">Guardar</button>
    </form>
@endsection
