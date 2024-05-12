@extends('layouts.backend')

@section('content')
    <h1>Listado de Métodos de Pago</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paymentMethods as $metodo_pago)
                <tr>
                    <td>{{ $metodo_pago->id }}</td>
                    <td>{{ $metodo_pago->nombre }}</td>
                    <td>{{ $metodo_pago->descripcion }}</td>
                    <td>
                        <a href="{{ route('payment-methods.edit', $paymentMethod->id) }}">Editar</a>
                        <form action="{{ route('payment-methods.destroy', $paymentMethod->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('payment-methods.create') }}">Agregar Método de Pago</a>
@endsection
